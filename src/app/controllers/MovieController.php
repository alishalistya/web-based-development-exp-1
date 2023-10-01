<?php

class MovieController
{
    public function index() {
        $data['username'] = "";

        $homeView = Utils::view("home", "HomeView", $data);
        $homeView->render();
    }

    public function search() {
        
        $categoryModel = Utils::model('Category');
        $category = $categoryModel->getAllCategory(); 

        $searchView = Utils::view("search", "SearchView", ['category' => $category]);
        $searchView->render();
    }

}