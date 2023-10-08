<?php

class HomeController
{
    public function index() {
        try {
            $auth = Utils::middleware("Authentication");
        $auth->isUserLogin();
    
        $movieModel = Utils::model('Movie');
        $data["movies"] = $movieModel->getTopMovies();
        $homeView = Utils::view("home", "HomeView", $data);
        $homeView->render();

        } catch (Exception $e) {
        if ($e->getCode() === STATUS_UNAUTHORIZED) {
            header("Location: http://localhost:8080/user/login");
        } else {
            http_response_code($e->getCode());
        }
    }
    }
}