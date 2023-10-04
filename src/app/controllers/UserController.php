<?php

class UserController
{
    public function login() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // if (post) {
                    //     $_POST["email"]
                    //     $_POST["password"]
                            // $_SESSION["user_id"] 
                    // }
                    $data['isLogin'] = true;
                    // $data["errors"] = [
                    //     "password" => "Email atau password salah."
                    // ];
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
            http_response_code(405);
        }
    }

    public function register() {
        $data['isLogin'] = false;
        $loginView = Utils::view("auth", "AuthView", $data);
        $loginView->render();
    }
}