<?php

class AuthController
{
    public function login() {
        // if (post) {
        //     $_POST["email"]
        //     $_POST["password"]
                // $_SESSION["user_id"] 
        // }
        $data['isLogin'] = true;
        $data["errors"] = [
            "password" => "Email atau password salah."
        ];
        $loginView = Utils::view("auth", "AuthView", $data);
        $loginView->render();
    }

    public function register() {
        $data['isLogin'] = false;
        $loginView = Utils::view("auth", "AuthView", $data);
        $loginView->render();
    }
}