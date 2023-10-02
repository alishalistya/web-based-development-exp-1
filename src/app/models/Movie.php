<?php

class Movie {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTopMovies() {
        $sql = 'SELECT * FROM movie LIMIT 5';
        $this->db->query($sql);

        return $this->db->resultSet();
    }
}