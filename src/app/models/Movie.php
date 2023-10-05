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

    public function getByArgs($name, $sort = 1, $category = 'none', $year = 'none', $page = 1)
    {
        // NOTE : TAMBAHIN YEAR
        $sql = "SELECT DISTINCT m.movie_id, m.title, m.description, m.year, m.duration, m.img_path, m.trailer_path
            FROM movie AS m INNER JOIN movie_director AS md ON m.movie_id = md.movie_id
            INNER JOIN director AS d ON md.director_id = d.director_id
            INNER JOIN movie_actor AS ma ON m.movie_id = ma.movie_id
            INNER JOIN actor AS a ON ma.actor_id = a.actor_id
            INNER JOIN movie_category AS mc ON m.movie_id = mc.movie_id
            INNER JOIN category AS c ON mc.category_id = c.category_id
            where (m.title LIKE :name OR d.name LIKE :name OR a.name LIKE :name)";

        if ($category !== "none") {
            $sql .= " AND c.name = :category";
        } 
        if ($year != "none") {
            $sql .= " AND m.year = :year";
        }
        $sql .= " ORDER BY :sort LIMIT :limit OFFSET :offset";
        

        $this->db->query($sql);
        $this->db->bind('name', "%$name%");
        if ($category !== 'none') {
            $this->db->bind('category', $category);
        }
        if ($year !== 'none') {
            $this->db->bind('year', $year);
        }
        $this->db->bind('sort', $sort);
        $this->db->bind('limit', LIMIT_PAGE);
        $this->db->bind('offset', ($page - 1) * LIMIT_PAGE);
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    
    public function getCountPage($name, $category = "none", $year = "none") 
    {
        $sql = "SELECT COUNT(*) count from (SELECT DISTINCT m.movie_id
            FROM movie AS m INNER JOIN movie_director AS md ON m.movie_id = md.movie_id
            INNER JOIN director AS d ON md.director_id = d.director_id
            INNER JOIN movie_actor AS ma ON m.movie_id = ma.movie_id
            INNER JOIN actor AS a ON ma.actor_id = a.actor_id
            INNER JOIN movie_category AS mc ON m.movie_id = mc.movie_id
            INNER JOIN category AS c ON mc.category_id = c.category_id
            where (m.title LIKE :name OR d.name LIKE :name OR a.name LIKE :name)";

        if ($category !== "none") {
            $sql .= " AND c.name = :category";
        } 
        if ($year !== "none") {
            $sql .= " AND m.year = :year";
        }
        $sql .= " ) t";

        $this->db->query($sql);
        $this->db->bind('name', "%$name%");
        if ($category !== 'none') {
            $this->db->bind('category', $category);
        }
        if ($year !== 'none') {
            $this->db->bind('year', $year);
        }
        $count = $this->db->single();
        return ceil($count['count']/LIMIT_PAGE);
    }

    public function getYear() {
        $sql = 'SELECT DISTINCT year FROM movie ORDER BY year';

        $this->db->query($sql);
        return $this->db->resultSet();
    } 
    
    public function getAllMovies()
    {
        $this->db->query("SELECT * FROM movie");
        return $this->db->resultSet();
    }

    public function getMovieByID($id)
    {
        $this->db->query("SELECT * FROM movie WHERE movie_id = :id");
        $this->db->bind("id", $id);
        return $this->db->single();
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

    public function getReviewByMovieID($id)
    {
        $this->db->query("SELECT * FROM movie_review WHERE movie_id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultSet();
    }

    public function getReviewByMovieIDWithLimit($id, $begin, $total)
    {
        $this->db->query("SELECT * FROM movie_review WHERE movie_id = :id LIMIT $begin, $total");
        $this->db->bind("id", $id);
        return $this->db->resultSet();
    }

    public function getCountReviewByMovieID($id)
    {
        $this->db->query("SELECT COUNT(*) count FROM movie_review WHERE movie_id = :id");
        $this->db->bind("id", $id);
        $count = $this->db->single();
        return $count['count'];
    }

    public function addMovie($data)
    {
        // echo 'okey';
        // var_dump($data);
        $query = "INSERT INTO movie(title, description, year, duration, img_path, trailer_path)
                    VALUES
                    (:title, :deskripsi, :rdate, :duration, :img_path, :trailer_path)";

        $this->db->query($query);
        $this->db->bind('title', $data['title']);
        $this->db->bind('deskripsi', $data['description']);
        $this->db->bind('rdate', $data['release-year']);
        $this->db->bind('duration', $data['duration']);
        $this->db->bind('img_path', $data['title']);
        $this->db->bind('trailer_path', $data['title']);

        // echo $query;

        $this->db->execute();

        return $this->db->rowCount();
    }
}