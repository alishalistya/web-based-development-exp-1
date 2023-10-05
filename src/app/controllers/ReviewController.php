<?php

class ReviewController {

    public function index($page) 
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
}