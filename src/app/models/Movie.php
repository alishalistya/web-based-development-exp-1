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

    public function getAllMovies()
    {
        $this->db->query("SELECT * FROM movie");
        return $this->db->resultSet();
    }

    public function getMovieByTitle($title)
    {
        $this->db->query("SELECT * FROM movie WHERE title = :title");
        $this->db->bind("title", $title);
        return $this->db->single();
    }

    public function getActorByMovieID($id)
    {
        $this->db->query("SELECT * FROM movie_actor WHERE movie_id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultSet();
    }

    public function getDirectorByMovieID($id)
    {
        $this->db->query("SELECT * FROM movie_director WHERE movie_id = :id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }
}