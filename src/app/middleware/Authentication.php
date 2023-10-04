<?php

class Authentication {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function isLogin() 
    {
        if (!isset($_SESSION['user_id']))
        {
            throw new Exception('Unauthorized', );
        }
        
        $sql = 'SELECT user_id FROM user WHERE user_id = :user_id'
    
        $this->db->query($sql);
        $this->db->bind('user_id', $_SESSION['user_id']);

        if (!$this->db->single()) {
            throw new Exception();
        }
    }
}