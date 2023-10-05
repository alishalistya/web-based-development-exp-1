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

    public function getMovieByDirectorIDWithLimit($id, $begin, $total)
    {
        $this->db->query("SELECT * FROM movie_director WHERE director_id = :id LIMIT :begin, :total");
        $this->db->bind("id", $id);
        $this->db->bind("begin", $begin);
        $this->db->bind("total", $total);
        return $this->db->resultSet();
    }

    public function getCountMovieByDirectorID($id)
    {
        $this->db->query("SELECT COUNT(*) count FROM movie_director WHERE director_id = :id");
        $this->db->bind("id", $id);
        $count = $this->db->single();
        return $count['count'];
    }

    public function addDirector($data)
    {
        // echo 'okey';
        // var_dump($data);
        $query = "INSERT INTO director(name, birth_date,description, img_path)
                    VALUES
                    (:name, :birth_date, :description, :img_path)";

        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('birth_date', $data['birth_date']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('img_path', $data['name']);

        // echo $query;

        $this->db->execute();

        return $this->db->rowCount();
    }

}