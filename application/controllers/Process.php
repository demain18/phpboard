<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->helper('security');
	}

	function login()
	{

		$id = $this->db->escape_str($this->security->xss_clean($_POST['id']));
		$pw = $this->db->escape_str($this->security->xss_clean($_POST['pw']));

		$sql = "SELECT * FROM `auth` WHERE `id`='$id'";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$pw = strtoupper(hash("sha256", $pw));
			$sql = "SELECT * FROM `auth` WHERE `pw`='$pw'";
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0)
			{
				// 인증성공, 세션생성 및 로그생성

				$query = $this->db->query("SELECT * FROM `auth` WHERE `id`='$id'");
				foreach ($query->result() as $row)
				{
					$id = $row->id;
					$nickname = $row->nickname;
				}

				// 로그인 성공
				// session_destroy();
				session_start();
				$_SESSION['user_id'] = $id;
				$_SESSION["user_nickname"] = $nickname;
				$_SESSION['user_status'] = 1;
				echo("<script>alert('안녕하세요, ".$_SESSION['user_nickname']."님')</script>");
				echo("<script>location.href='/';</script>");
				exit();

			}
		else
		{
			echo("<script>alert('비밀번호가 틀립니다.')</script>");
			echo("<script>history.back();</script>");
			exit();
		}
		}
		else
		{
		echo("<script>alert('아이디가 틀립니다.')</script>");
		echo("<script>history.back();</script>");
		exit();
		}
	}

	function fb_login() 
	{
		require_once 'public/js/facebook_oauth/src/Facebook/autoload.php';

		$fb = new Facebook\Facebook([
			'app_id' => '{288197938753973}', // Replace {app-id} with your app id
			'app_secret' => '{app-secret}',
			'default_graph_version' => 'v2.2',
			]);
		  
		  $helper = $fb->getRedirectLoginHelper();
		  
		  $permissions = ['email']; // Optional permissions
		  $loginUrl = $helper->getLoginUrl('https://localhost/fb_callback.php', $permissions);
		  
		  echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
	}

	function fb_callback()
	{
		session_start();
		$fb = new Facebook\Facebook([
		'app_id' => '{288197938753973}', // Replace {app-id} with your app id
		'app_secret' => '{app-secret}',
		'default_graph_version' => 'v3.2',
		]);

		$helper = $fb->getRedirectLoginHelper();

		try {
		$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
		}

		if (! isset($accessToken)) {
		if ($helper->getError()) {
			header('HTTP/1.0 401 Unauthorized');
			echo "Error: " . $helper->getError() . "\n";
			echo "Error Code: " . $helper->getErrorCode() . "\n";
			echo "Error Reason: " . $helper->getErrorReason() . "\n";
			echo "Error Description: " . $helper->getErrorDescription() . "\n";
		} else {
			header('HTTP/1.0 400 Bad Request');
			echo 'Bad request';
		}
		exit;
		}

		// Logged in
		echo '<h3>Access Token</h3>';
		var_dump($accessToken->getValue());

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		echo '<h3>Metadata</h3>';
		var_dump($tokenMetadata);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId('{app-id}'); // Replace {app-id} with your app id
		// If you know the user ID this access token belongs to, you can validate it here
		//$tokenMetadata->validateUserId('123');
		$tokenMetadata->validateExpiration();

		if (! $accessToken->isLongLived()) {
		// Exchanges a short-lived access token for a long-lived one
		try {
			$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
			echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
			exit;
		}

		echo '<h3>Long-lived</h3>';
		var_dump($accessToken->getValue());
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;

		// User is logged in with a long-lived access token.
		// You can redirect them to a members-only page.
		//header('Location: https://example.com/members.php');
	}

	function register()
	{
		ini_set('display_errors', '1');
        // ini_set('display_errors', '0');
        // 에러코드 안보이게 함
		// $data = $this->security->xss_clean($email);
		$nickname = $this->db->escape_str($this->security->xss_clean($_POST['nickname']));
        $id = $this->db->escape_str($this->security->xss_clean($_POST['id']));
        $pw = $this->db->escape_str($this->security->xss_clean($_POST['pw']));
        $pwc = $this->db->escape_str($this->security->xss_clean($_POST['pwc']));

        if($nickname==NULL || $id==NULL || $pw==NULL || $pwc==NULL)
        {
          echo("<script>alert('빈칸을 모두 채워주세요.')</script>");
          echo("<script>history.back();</script>");
          exit();
        }
        if($pw!=$pwc)
        {
          echo("<script>alert('비밀번호와 비밀번호 재입력이 다릅니다.')</script>");
          echo("<script>history.back();</script>");
          exit();
        }

        $sql = "SELECT * FROM `auth` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
          echo("<script>alert('이미 있는 아이디입니다.')</script>");
          echo("<script>history.back();</script>");
          exit();
        }

        $pw_hash = strtoupper(hash("sha256", $pw));

        $sql = "
        INSERT INTO auth
        (nickname, id, pw)
        VALUES(
            '$nickname',
            '$id',
            '$pw_hash'
        )
        ";

        $result = $this->db->query($sql);
        if($result == false) {
          echo("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
          echo("<script>history.back();</script>");
          exit();
        }

        session_start();
        $_SESSION['user_id'] = $id;
        $_SESSION['user_nickname'] = $nickname;
        $_SESSION['user_status'] = 1;

        echo("<script>location.href='/';</script>");
        exit();
	}

	function logout()
	{
		session_start();
		session_destroy();
		echo("<script>alert('로그아웃 됬습니다.')</script>");
        echo("<script>location.href='/';</script>");
	}

	function withdrawal()  {
		session_start();
		$user_id = $_SESSION['user_id'];
		
		$sql = "DELETE FROM auth WHERE `id` = $user_id";
		$result = $this->db->query($sql);
        if($result == false) {
          echo("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
          echo("<script>history.back();</script>");
          exit();
		}

		$sql = "DELETE FROM comment WHERE `uploader_id` = $user_id";
		$result = $this->db->query($sql);
        if($result == false) {
          echo("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
          echo("<script>history.back();</script>");
          exit();
		}
		session_destroy();	
		
		echo("<script>alert('계정을 삭제했습니다.')</script>");
        echo("<script>location.href='/';</script>");
	}

	function write() {

		session_start();
		$uploader_id = $_SESSION['user_id'];
		$uploader_nick = $_SESSION['user_nickname'];
		$time = date("Y-m-d H:i:s",time());
		$title = $this->db->escape_str($this->security->xss_clean($_POST['title']));
		$description = $this->db->escape_str($this->security->xss_clean($_POST['description']));

		// echo '<h3>제목 : '.$title.'</h3';
		// echo '<p>'.$description.'</p>';

		$sql = "
        INSERT INTO posts
        (uploader_id, uploader_nickname, time, title, description)
        VALUES(
			'$uploader_id',
			'$uploader_nick',
            '$time',
			'$title',
			'$description'
        )
		";
		$result = $this->db->query($sql);
        if($result == false) {
          echo("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
          echo("<script>history.back();</script>");
          exit();
        }
		
		echo("<script>alert('글을 업로드했습니다.')</script>");
        echo("<script>location.href='/';</script>");

	}

	function edit() {

		session_start();
		$time = date("Y-m-d H:i:s",time());
		$id = $this->db->escape_str($this->security->xss_clean($_POST['id']));
		$title = $this->db->escape_str($this->security->xss_clean($_POST['title']));
		$description = $this->db->escape_str($this->security->xss_clean($_POST['description']));

		echo '<h3>번호 : '.$id.'</h3';
		echo '<h3>제목 : '.$title.'</h3';
		echo '<p>'.$description.'</p>';

		// $sql = "
        // UPDATE posts SET
        // (time, title, description)
        // VALUES(
        //     '$time',
		// 	'$title',
		// 	'$description'
        // )
		// ";
		// $sql = "
		// UPDATE posts SET time = '$time', title = '$title', description = '$description', WHERE id = '$id'
		// ";
		$sql = "
		UPDATE `posts` SET `time` = '$time', `title` = '$title', `description` = '$description' WHERE `id_key` = $id	
		";
		// $sql = "
		// UPDATE posts SET time='$time', time='$time', time='$time' WHERE test='123' LIMIT 10;	
		// ";
		$result = $this->db->query($sql);
        if($result == false) {
          echo("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
          echo("<script>history.back();</script>");
          exit();
        }
		
		echo("<script>alert('글을 수정했습니다.')</script>");
        echo("<script>location.href='/post/$id';</script>");

	}

	function delete($id)  {
		$sql = "DELETE FROM posts WHERE `id_key` = $id";
		$result = $this->db->query($sql);
        if($result == false) {
          echo("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
          echo("<script>history.back();</script>");
          exit();
		}
		
		$sql = "DELETE FROM comment WHERE `id_key_join` = $id";
		$result = $this->db->query($sql);
        if($result == false) {
          echo("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
          echo("<script>history.back();</script>");
          exit();
        }
		
		echo("<script>alert('글을 삭제했습니다.')</script>");
        echo("<script>location.href='/';</script>");
	}

	function comment_write() {

		session_start();
		if (isset($_SESSION['user_id'])) {
			$uploader_id = $_SESSION['user_id'];
		} else {
			$uploader_id = "Guest";
		}
		if (isset($_SESSION['user_nickname'])) {
			$uploader_nick = $_SESSION['user_nickname'];
		} else {
			$uploader_nick = "Guest";
		}
		// $uploader_id = $_SESSION['user_id'];
		// $uploader_nick = $_SESSION['user_nickname'];
		$time = date("Y-m-d H:i:s",time());
		$post_id_join = $this->db->escape_str($this->security->xss_clean($_POST['post_id_join']));
		$description = $this->db->escape_str($this->security->xss_clean($_POST['description']));

		// echo '<h3>제목 : '.$title.'</h3';
		// echo '<p>'.$description.'</p>';

		$sql = "
        INSERT INTO comment
        (id_key_join, uploader_id, uploader_nickname, time, description)
        VALUES(
			'$post_id_join',
			'$uploader_id',
			'$uploader_nick',
            '$time',
			'$description'
        )
		";
		$result = $this->db->query($sql);
        if($result == false) {
          echo("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
          echo("<script>history.back();</script>");
          exit();
        }
		
		echo("<script>alert('댓글을 작성했습니다.')</script>");
        echo("<script>history.back();</script>");

	}
}
