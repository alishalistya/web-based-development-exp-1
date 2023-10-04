<?php

class User {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($username, $password) {
        $sql = 'SELECT user_id, password_h FROM user WHERE username = :username';

        $this->db->query($sql);
        $this->db->bind('username', $username);

        $user_from_db = $this->db->single();

        if ($user_from_db && $user_from_db['password_h'] === $password) {
            return $user_from_db['user_id'];
        } else {
            throw new Exception();
        }
    }
}