<?php

class MovieController
{
    public function index() {
        $data['username'] = "";

        $homeView = Utils::view("home", "HomeView", $data);
        $homeView->render();
    }

    public function search() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();

                    $categoryModel = Utils::model('Category');
                    $movieModel = Utils::model('Movie');
                    $category = $categoryModel->getAllCategory();
                    $year = $movieModel->getYear();

                    $result = null;
                    $searchView = Utils::view("search", "SearchView", ['category' => $category, 'movies' => $result, 'years' => $year]);
                    $searchView->render();                    
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8080/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }
    }

    public function fetch($page) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $movieModel = Utils::model("Movie");
                    
                    $movies = $movieModel->getByArgs($_GET['q'], $_GET['sort'], $_GET['category'], $_GET['year'],$page);
                    $count = $movieModel->getCountPage($_GET['q'], $_GET['category']);

                    header('Content-Type: application/json');
                    echo json_encode(['movies' => $movies, 'page' => $count]);
                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function getAllMovies($page) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $movieModel = Utils::model("Movie");
                    
                    $movies = $movieModel->getPaginate($page);
                    $count = $movieModel->getCountAll();

                    header('Content-Type: application/json');
                    echo json_encode(['movies' => $movies, 'page' => $count]);
                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

}