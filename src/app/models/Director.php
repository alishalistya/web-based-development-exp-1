<?php

class Director {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDirectors()
    {
        $this->db->query("SELECT * FROM director");
        return $this->db->resultSet();
    }

}