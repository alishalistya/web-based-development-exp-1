<?php

class AuthController
{
    public function login() {
        $data['isLogin'] = true;
        $loginView = Utils::view("auth", "AuthView", $data);
        $loginView->render();
    }
}