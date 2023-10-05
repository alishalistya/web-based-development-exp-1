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

        //pagination for movies
        $moviePerPage = 6;
        $data['totalPage'] = ceil(Utils::model("Actor")->getCountMovieByActorID($data['people']['actor_id'])/$moviePerPage);
        $currentPage = $_GET['page'] ?? 1;
        $data['page'] = $currentPage;
        $initialMovie = ($moviePerPage * $currentPage) - $moviePerPage;

        $data['movieID'] = Utils::model("Actor")->getMovieByActorIDWithLimit($data['people']['actor_id'], $initialMovie, $moviePerPage);
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

        //pagination for movies
        $moviePerPage = 6;
        $data['totalPage'] = ceil(Utils::model("Director")->getCountMovieByDirectorID($data['people']['director_id'])/$moviePerPage);
        $currentPage = $_GET['page'] ?? 1;
        $data['page'] = $currentPage;
        $initialMovie = ($moviePerPage * $currentPage) - $moviePerPage;

        $data['movieID'] = Utils::model("Director")->getMovieByDirectorIDWithLimit($data['people']['director_id'], $initialMovie, $moviePerPage);
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

      
        //pagination for reviews
        $reviewPerPage = 10;
        $data['totalPage'] = ceil(Utils::model("Movie")->getCountReviewByMovieID($movieID)/$reviewPerPage);
        $currentPage = $_GET['page'] ?? 1;
        $data['page'] = $currentPage;
        $initialReview = ($reviewPerPage * $currentPage) - $reviewPerPage;

        $data['reviewID'] = Utils::model("Movie")->getReviewByMovieIDWithLimit("$movieID", $initialReview, $reviewPerPage);
        foreach ($data['reviewID'] as $reviewID) {
            $reviewID = $reviewID['review_id'];
            $data['reviews'][] = Utils::model("Review")->getReviewByID("$reviewID");
        };



        // $data['reviews'] = [
        //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
        //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
        //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
        //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
        //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
        //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
        //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
        //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time.",
        //     "I love this movie. It's so good. I love the songs and the characters. I love the story and the animation. I love the voice acting. I love everything about it. It's one of my favorite movies of all time."
        // ];
         

        $movieView = Utils::view("about", "AboutMovieView", $data);
        $movieView->render();
    }
    }
