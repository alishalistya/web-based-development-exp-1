<?php

class Controller
{
    public function view($folder, $view, $data = []): void
    {
        require_once __DIR__ . "/../views/$folder/$view.php";
    }
}