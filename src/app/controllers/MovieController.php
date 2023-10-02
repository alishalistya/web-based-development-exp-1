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
                    $category = $categoryModel->getAllCategory(); 

                    $searchView = Utils::view("search", "SearchView", ['category' => $category, 'movies' => $result]);
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
                    var_dump($_SERVER['QUERY_STRING']);
                    $movieModel = Utils::model("Movie");
                    $result = $movieModel->getByArgs($_GET['q'], $_GET['sort'], $_GET['category'], $page);

                    header('Content-Type: application/json');
                    echo json_encode($result);
                    
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