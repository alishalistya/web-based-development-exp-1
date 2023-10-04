<?php

class AddDataController
{
    public function movie() {
        $movieModel = Utils::model('Movie');
        $data["movies"] = $movieModel->getAllMovies();
        $data["datatype"] = "movies";
        $addMovieView = Utils::view("addData", "AddDataView", $data);
        $addMovieView->render();
    }

    public function director() {
        $directorModel = Utils::model('Director');
        $data["director"] = $directorModel->getAllDirectors();
        $data["datatype"] = "director";
        // print_r($data);
        // exit();
        $addDirectorView = Utils::view("addData", "AddDataView", $data);
        $addDirectorView->render();
    }

    public function actor() {
        $actorModel = Utils::model('Actor');
        $data["actor"] = $actorModel->getAllActor();
        $data["datatype"] = "actor";
        $addActorView = Utils::view("addData", "AddDataView", $data);
        $addActorView->render();
    }
}