<?php

class ActorController
{
    public function catalog() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $actorModel = Utils::model('Actor');
                    $data["actor"] = $actorModel->getAllActor();
                    $loginView = Utils::view("lists", "ActorListView", $data);
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
                    $actorModel = Utils::model('Actor');
                    $data["actor"] = $actorModel->getAllActor();
                    $data["datatype"] = "actor";
                    $addActorView = Utils::view("addData", "AddDataView", $data);
                    $addActorView->render();
                    break;
                case 'POST':
                    $actorModel = Utils::model('Actor');
                    // var_dump();
                    if ($actorModel -> addActor($_POST) > 0){
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
                    $actorChosen = $_GET['name'];
                    $data['title'] = 'Actor';
                    $data['people'] = Utils::model("Actor")->getActorByName("$actorChosen");
            
                    //pagination for movies
                    $moviePerPage = 6;
                    $data['totalPage'] = ceil(Utils::model("Actor")->getCountMovieByActorID($data['people']['actor_id'])/$moviePerPage);
                    $currentPage = $_GET['page'] ?? 1;
                    $data['page'] = $currentPage;
                    $initialMovie = ($moviePerPage * $currentPage) - $moviePerPage;
            
                    $data['movieID'] = Utils::model("Actor")->getMovieByActorIDWithLimit($data['people']['actor_id'], $initialMovie, $moviePerPage);
                    foreach ($data['movieID'] as $movieID) {
                        $movieID = $movieID['movie_id'];
                        $data['movie'][] = Utils::model("Movie")->getMovieByID("$movieID");
                    };
            
                    $actorView = Utils::view("about", "AboutPeopleView", $data);
                    $actorView->render();
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}