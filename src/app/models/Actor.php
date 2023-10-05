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

    public function getMovieByActorIDWithLimit($id, $begin, $total)
    {
        $this->db->query("SELECT * FROM movie_actor WHERE actor_id = :id LIMIT :begin, :total");
        $this->db->bind("id", $id);
        $this->db->bind("begin", $begin);
        $this->db->bind("total", $total);
        return $this->db->resultSet();
    }

    public function getCountMovieByActorID($id)
    {
        $this->db->query("SELECT COUNT(*) count FROM movie_actor WHERE actor_id = :id");
        $this->db->bind("id", $id);
        $count = $this->db->single();
        return $count['count'];
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