<?php

class AboutController {

    

    public function index() {
        
        $notFound = Utils::view("notfound", "NotFoundView");
        $notFound->render();
    }

    public function actor() {
        $actorChosen = $_GET['name'];
        $data['title'] = 'Actor';
        $data['people'] = Utils::model("Actor")->getActorByName("$actorChosen");

        $data['movieID'] = Utils::model("Actor")->getMovieByActorID($data['people']['actor_id']);
        foreach ($data['movieID'] as $movieID) {
            $movieID = $movieID['movie_id'];
            $data['movie'][] = Utils::model("Movie")->getMovieByID("$movieID");
        };


        $actorView = Utils::view("about", "AboutPeopleView", $data);
        $actorView->render();
    }

    public function director() {
        $directorChosen = $_GET['name'];
        $data['title'] = 'Director';
        $data['people'] = Utils::model("Director")->getDirectorByName("$directorChosen");

        $data['movieID'] = Utils::model("Director")->getMovieByDirectorID($data['people']['director_id']);
        foreach ($data['movieID'] as $movieID) {
            $movieID = $movieID['movie_id'];
            $data['movie'][] = Utils::model("Movie")->getMovieByID("$movieID");
        };

        $directorView = Utils::view("about", "AboutPeopleView", $data);
        $directorView->render();
    }

    public function movie() {

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

        $data['reviews'] = [
            "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
            "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
            "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
            "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
            "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
            "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
            "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
            "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
            "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time."
        ];
         

        $movieView = Utils::view("about", "AboutMovieView", $data);
        $movieView->render();
    }
    }
