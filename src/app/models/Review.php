<?php

class Review
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllReviews()
    {
        $this->db->query("SELECT * FROM review");
        return $this->db->resultSet();
    }

    public function getReviewByID($id)
    {
        $this->db->query("SELECT * FROM review WHERE review_id = :id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

}