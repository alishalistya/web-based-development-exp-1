<?php
// NOT FINAL
class Actor
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllActor()
    {
        $this->db->query("SELECT * FROM actor");
        return $this->db->resultSet();
    }

    public function getActorByID($id)
    {
        $this->db->query("SELECT * FROM actor WHERE actor_id = :id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function getActorByName($name)
    {
        $this->db->query("SELECT * FROM actor WHERE name = :name");
        $this->db->bind("name", $name);
        return $this->db->single();
    }

    public function getMovieByActorID($id)
    {
        $this->db->query("SELECT * FROM movie_actor WHERE actor_id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultSet();
    }
}