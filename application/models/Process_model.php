<?php

  class Process_model extends CI_Model
  // 클래스명은 대문자로만 시작되어야 한다
  {

    function __construct()
    {
      parent::__construct();
    }

    public function posts_require_all()
    {

      return $this->db->query("SELECT * FROM `posts` ORDER BY id_key DESC")->result();

    }

    public function posts_require($id)
    {

      return $this->db->query("SELECT * FROM `posts` WHERE id_key = '$id'")->result();

    }

    public function posts_require_comment($id)
    {

      return $this->db->query("SELECT * FROM `comment` WHERE id_key_join=$id")->result();

    }
    
    public function posts_require_user($id)
    {

      return $this->db->query("SELECT * FROM `posts` WHERE uploader_id = '$id'")->result();

    }

  }

?>
