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
    
    public function addActor($data)
    {
        // echo 'okey';
        // var_dump($data);
        $query = "INSERT INTO actor(name, birth_date,description, img_path)
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