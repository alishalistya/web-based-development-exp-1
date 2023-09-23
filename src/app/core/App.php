<?php

use app\controllers\NotFoundControllers;

class App
{
    protected $controller;
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        require_once __DIR__ . '/../controllers/NotFoundController.php';
        $this->controller = new NotFoundController();

        $url = $this->parseURL();

        $controllerUrl = $url[0] ?? null;
        if (isset($controllerUrl) && file_exists(__DIR__ . '/../controllers/' . $controllerUrl . 'Controller.php')) {
            require_once __DIR__ . '/../controllers/' . $controllerUrl . 'Controller.php';
            $controllerClass = $controllerUrl . "Controller";
            $this->controller = new $controllerClass();
            unset($url[0]);
        }

        $methodUrl = $url[1] ?? null;
        if (isset($methodUrl) && method_exists($this->controller, $methodUrl)) {
            $this->method = $methodUrl;
            unset($url[1]);
        }

        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL(): ?array
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return null;
    }
}