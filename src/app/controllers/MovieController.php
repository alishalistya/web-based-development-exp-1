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
                    $categoryModel = Utils::model('Category');
                    $movieModel = Utils::model('Movie');
                    $category = $categoryModel->getAllCategory();
                    $year = $movieModel->getYear();

                    $result = null;
                    $searchView = Utils::view("search", "SearchView", ['category' => $category, 'movies' => $result, 'years' => $year]);
                    $searchView->render();                    
                    break;
                default:
                    throw new Exception();
            }
        } catch (Exception $e) {
            http_response_code(405);
        }

    }

    public function fetch($page) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $movieModel = Utils::model("Movie");
                    
                    $movies = $movieModel->getByArgs($_GET['q'], $_GET['sort'], $_GET['category'], $page);
                    $count = $movieModel->getCountPage($_GET['q'], $_GET['category']);

                    header('Content-Type: application/json');
                    echo json_encode(['movies' => $movies, 'page' => $count]);
                    
                    exit;
                    break;
                default:
                    throw new Exception();
            }
        } catch (Exception $e) {
            http_response_code(405);
        }
    }

}