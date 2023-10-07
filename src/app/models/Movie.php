<?php

class Movie {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllMovies()
    {
        $this->db->query("SELECT * FROM movie");
        return $this->db->resultSet();
    }

    public function getTopMovies() {
        $sql = 'SELECT * FROM movie LIMIT 5';
        $this->db->query($sql);

        return $this->db->resultSet();
    }

    public function getPaginate($page = 1){
        $sql = 'SELECT * FROM movie';
        $sql .= " LIMIT :limit OFFSET :offset";

        $this->db->query($sql);
        $this->db->bind('limit', LIMIT_PAGE);
        $this->db->bind('offset', ($page - 1) * LIMIT_PAGE);
        
        $result = $this->db->resultSet();
        return $result;
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

    public function getCountAll() {
        $sql = "SELECT COUNT(*) count from movie";
        $this->db->query($sql);
        
        $count = $this->db->single();
        return ceil($count['count']/LIMIT_PAGE);
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
        return $this->db->resultSet();
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

    public function updateMovie($data, $path) {
        $oldImage = $data['oldImage'];
        $oldTrailer = $data['oldTrailer'];

        if ($path['imageInput']['error'] === 4) {
            $img_path = $oldImage;
        } else {
            $img_path = $this->uploadMovieImg();
        }

        if ($path['trailerInput']['error'] === 4) {
            $trailer_path = $oldTrailer;
        } else {
            $trailer_path = $this->uploadMovieTrailer();
        }


        $query = "UPDATE movie SET title = :title, description = :description, year = :year, duration = :duration, img_path = :img_path, trailer_path = :trailer_path WHERE movie_id = :movie_id";

        $this->db->query($query);
        $this->db->bind('movie_id', $data['idInput']);
        $this->db->bind('title', $data['titleInput']);
        $this->db->bind('description', $data['descriptionInput']);
        $this->db->bind('year', $data['yearInput']);
        $this->db->bind('duration', $data['durationInput']);
        $this->db->bind('img_path', $img_path);
        $this->db->bind('trailer_path', $trailer_path);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function uploadMovieImg() {
        $fileName = $_FILES['imageInput']['name'];
        $fileTmp = $_FILES['imageInput']['tmp_name'];

        $validPictureExtension = ['jpg', 'jpeg', 'png'];
        $pictureExtension = explode('.', $fileName);
        $pictureExtension = strtolower(end($pictureExtension));
        $pictureName = explode('.', $fileName);
        $pictureName = strtolower($pictureName[0]);

        if (!in_array($pictureExtension, $validPictureExtension)) {
            echo "<script>
                    alert('Please upload a picture!');
                </script>";
            return false;
        }

        move_uploaded_file($fileTmp, '../public/media/img/movie/' . $fileName);

        return $pictureName;
    }

    public function uploadMovieTrailer() {
        $fileName = $_FILES['trailerInput']['name'];
        $fileSize = $_FILES['trailerInput']['size'];
        $fileTmp = $_FILES['trailerInput']['tmp_name'];

        $validVideoExtension = ['mp4'];
        $videoExtension = explode('.', $fileName);
        $videoExtension = strtolower(end($videoExtension));
        $videoName = explode('.', $fileName);
        $videoName = strtolower($videoName[0]);

        if ($fileSize > 8000000) {
            echo "<script>
                    alert('File is too large!');
                </script>";
            return false;
        }

        if (!in_array($videoExtension, $validVideoExtension)) {
            echo "<script>
                    alert('Please upload a video!');
                </script>";
            return false;
        }

        move_uploaded_file($fileTmp, '../public/media/img/trailer/' . $fileName);

        return $videoName;
    }
}