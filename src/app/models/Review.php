<?php

class Review {
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

    public function getReviewByReviewID($id)
    {
        $this->db->query("SELECT * FROM review WHERE review_id = :id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function getReviewByID($userID)
    {
        $sql = 'SELECT m.movie_id, m.title, m.img_path, r.comment, r.rate, r.review_id, r.created_at, r.update_at
        FROM movie m INNER JOIN movie_review mr ON m.movie_id = mr.movie_id
        INNER JOIN review r ON mr.review_id = r.review_id
        INNER JOIN user_review ur ON r.review_id = ur.review_id
        WHERE ur.user_id = :user_id ORDER BY r.update_at DESC';

        $this->db->query($sql);

        $this->db->bind('user_id', $userID);

        return $this->db->resultSet();
    }
}