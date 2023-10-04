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

    public function getDirectorByID($id)
    {
        $this->db->query("SELECT * FROM director WHERE director_id = :id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function getDirectorByName($name)
    {
        $this->db->query("SELECT * FROM director WHERE name = :name");
        $this->db->bind("name", $name);
        return $this->db->single();
    }

    public function getMovieByDirectorID($id)
    {
        $this->db->query("SELECT * FROM movie_director WHERE director_id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultSet();
    }



}