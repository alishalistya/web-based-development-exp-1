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

    public function getByArgs($name, $sort = 1, $category = 'all', $page = 1)
    {
        // NOTE : TAMBAHIN YEAR
        if ($category !== "all") {
            $sql = "SELECT DISTINCT m.movie_id, m.title, m.description, m.release_date, m.duration, m.img_path, m.trailer_path
            FROM movie AS m INNER JOIN movie_director AS md ON m.movie_id = md.movie_id
            INNER JOIN director AS d ON md.director_id = d.director_id
            INNER JOIN movie_actor AS ma ON m.movie_id = ma.movie_id
            INNER JOIN actor AS a ON ma.actor_id = a.actor_id
            INNER JOIN movie_category AS mc ON m.movie_id = mc.movie_id
            INNER JOIN category AS c ON mc.category_id = c.category_id
            where (m.title LIKE :name OR d.name LIKE :name OR a.name LIKE :name) 
            AND c.name = :category ORDER BY :sort LIMIT 10 OFFSET :offset";
        } else {
            $sql = "SELECT DISTINCT m.movie_id, m.title, m.description, m.release_date, m.duration, m.img_path, m.trailer_path
            FROM movie AS m INNER JOIN movie_director AS md ON m.movie_id = md.movie_id
            INNER JOIN director AS d ON md.director_id = d.director_id
            INNER JOIN movie_actor AS ma ON m.movie_id = ma.movie_id
            INNER JOIN actor AS a ON ma.actor_id = a.actor_id
            INNER JOIN movie_category AS mc ON m.movie_id = mc.movie_id
            INNER JOIN category AS c ON mc.category_id = c.category_id
            where (m.title LIKE :name OR d.name LIKE :name OR a.name LIKE :name) 
            ORDER BY :sort LIMIT :limit OFFSET :offset";
        }

        $this->db->query($sql);
        $this->db->bind('name', "%$name%");
        if ($category) {
            $this->db->bind('category', $category);
        }
        $this->db->bind('sort', $sort);
        $this->db->bind('limit', 5);
        $this->db->bind('offset', ($page - 1) * 5);
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    
    public function getCountPage($name, $category = "all") 
    {
        if ($category !== "all") {
            $sql = "SELECT COUNT(*) count from (SELECT DISTINCT m.movie_id
            FROM movie AS m INNER JOIN movie_director AS md ON m.movie_id = md.movie_id
            INNER JOIN director AS d ON md.director_id = d.director_id
            INNER JOIN movie_actor AS ma ON m.movie_id = ma.movie_id
            INNER JOIN actor AS a ON ma.actor_id = a.actor_id
            INNER JOIN movie_category AS mc ON m.movie_id = mc.movie_id
            INNER JOIN category AS c ON mc.category_id = c.category_id
            where (m.title LIKE :name OR d.name LIKE :name OR a.name LIKE :name)  AND c.name = :category) t";
        } else {
            $sql = "SELECT COUNT(*) count from (SELECT DISTINCT m.movie_id
            FROM movie AS m INNER JOIN movie_director AS md ON m.movie_id = md.movie_id
            INNER JOIN director AS d ON md.director_id = d.director_id
            INNER JOIN movie_actor AS ma ON m.movie_id = ma.movie_id
            INNER JOIN actor AS a ON ma.actor_id = a.actor_id
            INNER JOIN movie_category AS mc ON m.movie_id = mc.movie_id
            INNER JOIN category AS c ON mc.category_id = c.category_id
            where (m.title LIKE :name OR d.name LIKE :name OR a.name LIKE :name)) t";
        }
        $this->db->query($sql);
        $this->db->bind('name', "%$name%");
        if ($category) {
            $this->db->bind('category', $category);
        }
        $count = $this->db->single();
        return ceil($count['count']/5);
    }

    public function getYear() {
        $sql = 'SELECT DISTINCT year(release_date) year FROM movie ORDER BY year';

        $this->db->query($sql);

        return $this->db->resultSet();
    }
}