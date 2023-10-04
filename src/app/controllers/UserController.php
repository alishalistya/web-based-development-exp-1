<?php

class UserController
{
    public function login() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':

                    // Validasi Apakah Sudah Login ? 
                    $auth = Utils::middleware("Authentication");
                    try {
                        $auth->isUserLogin();
                        header("Location: http://localhost:8080/home");
                    } catch (Exception $e) {
                        if ($e->getCode() !== STATUS_UNAUTHORIZED) {
                            throw new Exception($e->getMessage(), $e->getCode());
                        }
                    }

                    $data['isLogin'] = true;

                    $loginView = Utils::view("auth", "AuthView", $data);
                    $loginView->render();
                    break;

                case 'POST':
                    $userModel = Utils::model("User");

                    $user_id = $userModel->login($_POST['username'], $_POST['password']);
                    $_SESSION['user_id'] = $user_id;

                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(['redirect' => "http://localhost:8080/home"]);
                    exit;
                    break;
                default:
                    throw new Exception();
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function register() {
        $data['isLogin'] = false;
        $loginView = Utils::view("auth", "AuthView", $data);
        $loginView->render();
    }
}