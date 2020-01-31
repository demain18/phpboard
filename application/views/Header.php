<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>게시판</title>
    <link rel="stylesheet" href="/public/css/all.css?ver=10">

    <!-- plugins -->
    <script src="/public/js/ckeditor2/ckeditor.js"></script>
    

</head>

<!-- <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '447460529297698',
      xfbml      : true,
      version    : 'v5.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script> -->


<body>

    <h3><a href="/">Boardcopy</a>의 게시판에 오신걸 환영합니다.</h3>
    <!-- <div
    class="fb-like"
    data-share="true"
    data-width="450"
    data-show-faces="true">
    </div>
    <div class="user"> -->
        <p>
            <?php

                /*

                기본 게시판 스펙
                - 로그인(완), 소셜 로그인, 회원가입(완), 비밀번호 변경, 비밀번호 찾기, 회원탈퇴
                - 게시판 글 작성(완), 수정(완), 삭제(완), 검색(완), 댓글(완)
                - 관리자 기능(사용자 관리, 글 관리)

                디럭스 게시판
                - 기본 게시판
                + 글 추천, 공유, 공지, 카테고리, 인기&최신 정렬, 게시판 추가 및 편집 기능
                + SNS연동 로그인 기능
                
                */
            
                $url = uri_string();
                $url_string = explode('/', $url);
                $url = $url_string[0];
                // echo $url.'<br />';

                // session_start();

                if (isset($_SESSION['user_status']))
                {
                    if ($_SESSION['user_status'])
                    {
                        $user_print = '<p><a href="/info">'.$_SESSION['user_nickname'].'</a> <a href="/write">글쓰기</a></p>';
                        $auth_print = 0;
                    }
                    else
                    {
                        $user_print = '';
                        $auth_print = 1;
                    }
                }
                else
                {
                    $user_print = '';
                    $auth_print = 1;
                }

                if ($url == '')
                {
                    echo $user_print;
                    if ($auth_print)
                    {
                        echo '
                        <a href="/login">로그인</a>
                        <a href="/fb-login">페이스북 로그인</a>
                        <a href="/register">회원가입</a>
                        ';
                    }
                    else 
                    {
                        echo '';
                    }

                }
                else if ($url == 'login')
                {
                    echo $user_print;
                    if ($auth_print)
                    {
                        echo '
                        <a href="/register">회원가입</a>
                        <a href="/">목록보기</a>
                        ';
                    } else
                    {
                        echo '<a href="/">목록보기</a>';
                    }
                }
                else if ($url == 'register')
                {
                    echo $user_print;
                    if ($auth_print)
                    {
                        echo '
                        <a href="/login">로그인</a>
                        <a href="/">목록보기</a>
                        ';
                    }
                    else
                    {
                        echo '<a href="/">목록보기</a>';
                    }
                }
                else if ($url == 'info')
                {
                    echo $user_print;
                    echo '
                    <a href="/">목록보기</a> <a href="/process/logout">로그아웃</a> <a href="/process/withdrawal">회원탈퇴</a>
                    ';
                }
                else if ($url == 'post')
                {
                    echo $user_print;
                    echo '
                    <a href="/">목록보기</a>
                    ';
                }
                else if ($url == 'write')
                {
                    echo $user_print;
                    echo '
                    <a href="/">목록보기</a>
                    ';
                }
                else if ($url == 'edit')
                {
                    echo $user_print;
                    echo '
                    <a href="/">목록보기</a>
                    ';
                }
            
            ?>
        </p>
    </div>