<?php

class HomeController
{
    public function index() {

        // var_dump($_SESSION['user_id']);
        
        $data['username'] = "";
        $movieModel = Utils::model('Movie');
        $data["movies"] = $movieModel->getTopMovies();
        $homeView = Utils::view("home", "HomeView", $data);
        $homeView->render();
    }
}