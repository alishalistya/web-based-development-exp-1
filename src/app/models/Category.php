<?php

class Category {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllCategory() {
        $sql = 'SELECT DISTINCT name FROM category';
        $this->db->query($sql);

        return $this->db->resultSet();
    }
}