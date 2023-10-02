<?php

class HomeController
{
    public function index() {
        $data['username'] = "";
        $movieModel = Utils::model('Movie');
        $data["movies"] = $movieModel->getTopMovies();
        $homeView = Utils::view("home", "HomeView", $data);
        $homeView->render();
    }
}