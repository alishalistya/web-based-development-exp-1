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


    // need refactor
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

    public function catalog($page) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $movieModel = Utils::model('Movie');
                    $data["movies"] = $movieModel->getPaginate($page);
                    
                    $movieView = Utils::view("lists", "MovieListView", $data);
                    $movieView->render();
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
                    $movieModel = Utils::model('Movie');
                    $data["movies"] = $movieModel->getAllMovies();
                    $data["datatype"] = "movies";
                    
                    $actorModel = Utils::model('Actor');
                    $data["actors"] = $actorModel->getAllActor();

                    $directorModel = Utils::model('Director');
                    $data["directors"] = $directorModel->getAllDirectors();

                    $addMovieView = Utils::view("addData", "AddDataView", $data);
                    $addMovieView->render();
                    break;
                case 'POST':
                    $movieModel = Utils::model('Movie');
                    // var_dump();
                    if ($movieModel -> addMovie($_POST) > 0){
                        // var_dump($_POST);
                        header('Location: ' ."http://$_SERVER[HTTP_HOST]".  '/home');
                    }
                    break;
                    exit;
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
                    $movieChosen = $_GET['title'];
                    $data['movie'] = Utils::model("Movie")->getMovieByTitle("$movieChosen");
            
                    $movieID = $data['movie']['movie_id'];
            
                    $data['directorID'] = Utils::model("Movie")->getDirectorByMovieID("$movieID");
                    $directorID = $data['directorID']['director_id'];
                    $data['director'] = Utils::model("Director")->getDirectorByID("$directorID");
            
                    $data['actorID'] = Utils::model("Movie")->getActorByMovieID("$movieID");
                    foreach ($data['actorID'] as $actorID) {
                        $actorID = $actorID['actor_id'];
                        $data['actor'][] = Utils::model("Actor")->getActorByID("$actorID");
                    };
            
                  
                    //pagination for reviews
                    $reviewPerPage = 10;
                    $data['totalPage'] = ceil(Utils::model("Movie")->getCountReviewByMovieID($movieID)/$reviewPerPage);
                    $currentPage = $_GET['page'] ?? 1;
                    $data['page'] = $currentPage;
                    $initialReview = ($reviewPerPage * $currentPage) - $reviewPerPage;
            
                    $data['reviewID'] = Utils::model("Movie")->getReviewByMovieIDWithLimit("$movieID", $initialReview, $reviewPerPage);
                    foreach ($data['reviewID'] as $reviewID) {
                        $reviewID = $reviewID['review_id'];
                        $data['reviews'][] = Utils::model("Review")->getReviewByReviewID("$reviewID");
                    };
            
            
            
                    // $data['reviews'] = [
                    //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
                    //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
                    //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
                    //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
                    //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
                    //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
                    //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
                    //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
                    //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time."
                    // ];
                     
            
                    $movieView = Utils::view("about", "AboutMovieView", $data);
                    $movieView->render();
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}