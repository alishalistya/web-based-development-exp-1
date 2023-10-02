<?php

class ListsController
{
    public function movies() {
        $movieModel = Utils::model('Movie');
        $data["movies"] = $movieModel->getAllMovies();
        $movieView = Utils::view("lists", "MovieListView", $data);
        $movieView->render();
    }

    public function directors() {
        $directorModel = Utils::model('Director');
        $data["director"] = $directorModel->getAllDirectors();
        $loginView = Utils::view("lists", "DirectorListView", $data);
        $loginView->render();
    }

    public function actors() {
        $loginView = Utils::view("lists", "ActorListView", []);
        $loginView->render();
    }
}