<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		session_start();
	}

	function login()
	{
		$this->load->view('Header');
		$this->load->view('Login');
	}

	function fb_login()
	{
		$this->load->view('Header');
		$this->load->view('Login');
	}

	function register()
	{
		$this->load->view('Header');
		$this->load->view('Register');
	}

	function info()
	{
		// session_start();
		$id = $_SESSION['user_id'];
		// session_destroy();

		$this->load->model('Process_model');
		$posts_user = $this->Process_model->posts_require_user($id);
		$this->load->view('Header');
		$this->load->view('Info', array('posts_user'=>$posts_user));
	}

	function board()
	{
		//session_start();
		$this->load->model('Process_model');
		$posts_all = $this->Process_model->posts_require_all();
		$this->load->view('Header');
		$this->load->view('Board', array('posts_all'=>$posts_all));
	}

	function write()
	{
		$this->load->view('Header');
		$this->load->view('Write');
	}

	function edit($id)
	{
		$this->load->model('Process_model');
		$data = $this->Process_model->posts_require($id);
		$this->load->view('Header');
		$this->load->view('Edit', array('data'=>$data));
	}

	function post($id)
	{
		$this->load->model('Process_model');
		$post = $this->Process_model->posts_require($id);
		$comment = $this->Process_model->posts_require_comment($id);
		$this->load->view('Header');
		// $this->load->view('Post', array('post'=>$post));
		$this->load->view
        ('Post',
          array(
            'post'=>$post,
            'comment'=>$comment
          )
        );
	}

}
