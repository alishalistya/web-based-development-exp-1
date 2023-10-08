<?php

class ActorController
{
    public function catalog() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Authetication
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    
                    $isAdmin = false; 
                    try {
                        $auth->isAdminLogin();
                        $isAdmin = true;
                    } catch (Exception $e) {
                        if ($e-> getCode() !== STATUS_UNAUTHORIZED) {
                            throw new Exception($e->getMessage(), $e->getCode());
                        }
                    }

                    // Model
                    $actorModel = Utils::model('Actor');
                    $data["actor"] = $actorModel->getAllActor();
                    $data["isAdmin"] = $isAdmin;
                    $data["datatype"] = "actor";
                    $loginView = Utils::view("lists", "ActorListView", $data);
                    $loginView->render();
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
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
    
    public function insert() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Authentication
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();

                    // Actor model
                    $actorModel = Utils::model('Actor');
                    $data["actor"] = $actorModel->getAllActor();
                    $data["datatype"] = "actor";

                    $data['isEdit'] = false;
                    
                    $addActorView = Utils::view("addData", "AddDataView", $data);
                    $addActorView->render();
                    break;
                case 'POST':
                    $actorModel = Utils::model('Actor');

                    // Copy file to directory
                    if (isset($_FILES["photo"])) {
                        $file = $_FILES["photo"];

                        if ($file["error"] == UPLOAD_ERR_OK) {
                            $uploadDir = "media/img/actor";
                            $name = basename($file["name"]);

                            $uploadFile = $uploadDir .'/'. $name;
                            // var_dump($uploadFile);
                
                            if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
                                // echo "File is valid and was successfully uploaded.";

                                // Add Actor
                                if ($actorModel -> addActor($_POST, $name) > 0){
                                header('Location: ' ."http://$_SERVER[HTTP_HOST]".  '/home');
                                exit;
                                break;
                    }

                            } else {
                                echo "Error uploading the file.";
                            }
                        } else {
                            echo "Upload error: " . $file["error"];
                        }
                    }
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8080/user/login");
            } else {
                http_response_code($e->getCode());
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function update() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Authentication
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();

                    // Model
                    $actorModel = Utils::model('Actor');
                    $data["actor"] = $actorModel->getActorByID($_GET['actor_id']);
                    $data["datatype"] = "actor";

                    $data['isEdit'] = true;

                    $addActorView = Utils::view("addData", "AddDataView", $data);
                    $addActorView->render();
                    break;
                case 'POST':
                    $actorModel = Utils::model('Actor');

                    // Copy file to directory
                    if (isset($_FILES["photo"])) {
                        $file = $_FILES["photo"];

                        if ($file["error"] == UPLOAD_ERR_OK) {
                            $uploadDir = "media/img/actor";
                            $name = basename($file["name"]);

                            $uploadFile = $uploadDir .'/'. $name;
                            // var_dump($uploadFile);
                
                            if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
                                // echo "File is valid and was successfully uploaded.";

                                // Add Actor
                                if ($actorModel -> addActor($_POST, $name) > 0){
                                header('Location: ' ."http://$_SERVER[HTTP_HOST]".  '/home');
                                exit;
                                break;
                    }

                            } else {
                                echo "Error uploading the file.";
                            }
                        } else {
                            echo "Upload error: " . $file["error"];
                        }
                    }
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8080/user/login");
            } else {
                http_response_code($e->getCode());
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function detail() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Authentication
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();

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
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8080/user/login");
            } else {
                http_response_code($e->getCode());
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}