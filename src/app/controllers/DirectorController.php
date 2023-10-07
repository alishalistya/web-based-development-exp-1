<?php

class DirectorController
{
    public function catalog() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $directorModel = Utils::model('Director');
                    $data["director"] = $directorModel->getAllDirectors();
                    $loginView = Utils::view("lists", "DirectorListView", $data);
                    $loginView->render();
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
    
    public function insert() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $directorModel = Utils::model('Director');
                    $data["director"] = $directorModel->getAllDirectors();
                    $data["datatype"] = "director";

                    $addDirectorView = Utils::view("addData", "AddDataView", $data);
                    $addDirectorView->render();
                    break;
                case 'POST':
                    $directorModel = Utils::model('Director');
                    // var_dump($_POST);
                    if ($directorModel -> addDirector($_POST) > 0){
                        // var_dump($_POST);
                        header('Location: ' ."http://$_SERVER[HTTP_HOST]".  '/home');
                    }
                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function detail() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $directorChosen = $_GET['name'];
                    $data['title'] = 'Director';
                    $data['people'] = Utils::model("Director")->getDirectorByName("$directorChosen");
            
                    //pagination for movies
                    $moviePerPage = 6;
                    $data['totalPage'] = ceil(Utils::model("Director")->getCountMovieByDirectorID($data['people']['director_id'])/$moviePerPage);
                    $currentPage = $_GET['page'] ?? 1;
                    $data['page'] = $currentPage;
                    $initialMovie = ($moviePerPage * $currentPage) - $moviePerPage;
            
                    $data['movieID'] = Utils::model("Director")->getMovieByDirectorIDWithLimit($data['people']['director_id'], $initialMovie, $moviePerPage);
                    foreach ($data['movieID'] as $movieID) {
                        $movieID = $movieID['movie_id'];
                        $data['movie'][] = Utils::model("Movie")->getMovieByID("$movieID");
                    };
            
                    $directorView = Utils::view("about", "AboutPeopleView", $data);
                    $directorView->render();
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}