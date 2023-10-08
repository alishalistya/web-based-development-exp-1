<?php

class ReviewController {

    public function index() 
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
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

                    $review = Utils::model("Review");
                    if ($isAdmin) {
                        $result = $review->getAllReview(1);
                        $count = $review->getCountPage();
                    } else {
                        $result = $review->getReviewByID($_SESSION['user_id'], 1);
                        $count = $review->getCountPage($_SESSION['user_id']);
                    }

                    $reviewView = Utils::view("review", "ReviewView", ['reviews' => $result, 'isAdmin' => $isAdmin, 'page' => $count]);
                    $reviewView->render();
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

    public function fetch($page)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
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

                    $review = Utils::model("Review");
                    if ($isAdmin) {
                        $result = $review->getAllReview($page);
                        $count = $review->getCountPage();
                    } else {
                        $result = $review->getReviewByID($_SESSION['user_id'], $page);
                        $count = $review->getCountPage($_SESSION['user_id']);
                    }

                    header('Content-Type: application/json');
                    echo json_encode(['review' => $result, 'page' => $count ]);
                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function delete()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']){
                case 'DELETE': 
                    $reviewModel = Utils::model("Review");

                    $reviewModel->deleteReviewByID($_GET['review_id']);

                    header('Content-Type: application/json');
                    echo json_encode(['error' => null ]);
                    exit;
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

    public function insert()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();

                    $movieModel = Utils::model("Movie");
                    $movie = $movieModel->getMovieByID($_GET['movie_id']);

                    $addReviewView = Utils::view("review", "EditReviewView", ['edited' => false, 'movie' => $movie]);
                    $addReviewView->render();
                    break;
                case 'POST':
                    $reviewModel = Utils::model("Review");

                    $reviewModel->insertReview($_POST['rate'], $_POST['comment'], $_POST['blur'], $_POST['movie_id'], $_SESSION['user_id']);

                    header('Content-Type: application/json');
                    echo json_encode(['error' => null ]);
                    exit;
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

    public function update()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();

                    $reviewModel = Utils::model("Review");
                    $review = $reviewModel->getReviewByReviewID($_GET['review_id']);

                    // var_dump($review);

                    $movieModel = Utils::model("Movie");
                    $movie = $movieModel->getMovieByID($review['movie_id']);

                    $addReviewView = Utils::view("review", "EditReviewView", ['edited' => true, 'review' => $review, 'movie' => $movie ]);
                    $addReviewView->render();
                    break;
                case 'POST':
                    $reviewModel = Utils::model("Review");

                    $reviewModel->updateReview($_POST['rate'], $_POST['comment'], $_POST['blur'], $_POST['review_id']);

                    header('Content-Type: application/json');
                    echo json_encode(['error' => null ]);
                    exit;
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
}