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

    public function updateActor($data, $image) {
        $oldImage = $data['oldImage'];

        if ($image['imageInput']['error'] === 4) {
            $img_path = $oldImage;
        } else {
            $img_path = $this->uploadActorImg();
        }

        $query = "UPDATE actor SET name = :name, birth_date = :birth_date, description = :description, img_path = :img_path WHERE actor_id = :actor_id";

        $this->db->query($query);
        $this->db->bind('actor_id', $data['idInput']);
        $this->db->bind('name', $data['nameInput']);
        $this->db->bind('birth_date', $data['birthDateInput']);
        $this->db->bind('description', $data['descriptionInput']);
        $this->db->bind('img_path', $img_path);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function uploadActorImg() {
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

        move_uploaded_file($fileTmp, '../public/media/img/actor/' . $fileName);

        return $pictureName;

    }

   
}