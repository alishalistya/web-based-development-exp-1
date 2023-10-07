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

    public function updateDirector($data, $image) {
        $oldImage = $data['oldImage'];

        if ($image['imageInput']['error'] === 4) {
            $img_path = $oldImage;
        } else {
            $img_path = $this->uploadDirectorImg();
        }

        $query = "UPDATE director SET name = :name, birth_date = :birth_date, description = :description, img_path = :img_path WHERE director_id = :director_id";

        $this->db->query($query);
        $this->db->bind('director_id', $data['idInput']);
        $this->db->bind('name', $data['nameInput']);
        $this->db->bind('birth_date', $data['birthDateInput']);
        $this->db->bind('description', $data['descriptionInput']);
        $this->db->bind('img_path', $img_path);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function uploadDirectorImg() {
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

        move_uploaded_file($fileTmp, '../public/media/img/director/' . $fileName);

        return $pictureName;
    }

}