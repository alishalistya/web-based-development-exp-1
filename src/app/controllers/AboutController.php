<?php

class AboutController {

    public function index() {
        
        $notFound = Utils::view("notfound", "NotFoundView");
        $notFound->render();
    }

    public function actor() {
        if (!isset($_GET['name'])) {
            $notFound = Utils::view("notfound", "NotFoundView");
            $notFound->render();
            exit;
        }

        $actorChosen = $_GET['name'];
        $data['title'] = 'Actor';
        $data['people'] = Utils::model("Actor")->getActorByName("$actorChosen");

        if ($data['people'] == null) {
            $notFound = Utils::view("notfound", "NotFoundView");
            $notFound->render();
            exit;
        }

        $data['peopleID'] = $data['people']['actor_id'];

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

    public function editActor() {
        echo json_encode(Utils::model("Actor")->getActorByID($_GET['id']));
    }

    public function updateActor() {
       $actorChosen = $_POST['nameInput'];
       if(Utils::model("Actor")->updateActor($_POST, $_FILES) > 0) {
            header('Location: actor?name='.$actorChosen);
            exit;
        } else {
            header('Location: home');
            exit;
        }
    }

    public function director() {
        if (!isset($_GET['name'])) {
            $notFound = Utils::view("notfound", "NotFoundView");
            $notFound->render();
            exit;
        }

        $directorChosen = $_GET['name'];
        $data['title'] = 'Director';
        $data['people'] = Utils::model("Director")->getDirectorByName("$directorChosen");

        if ($data['people'] == null) {
            $notFound = Utils::view("notfound", "NotFoundView");
            $notFound->render();
            exit;
        }

        $data['peopleID'] = $data['people']['director_id'];

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

    public function editDirector() {
        echo json_encode(Utils::model("Director")->getDirectorByID($_GET['id']));
    }

    public function updateDirector() {
       $directorChosen = $_POST['nameInput'];
       if(Utils::model("Director")->updateDirector($_POST, $_FILES) > 0) {
            header('Location: director?name='.$directorChosen);
            exit;
        } else {
            header('Location: home');
            exit;
        }
    }

    public function movie() {

        if (!isset($_GET['title'])) {
            $notFound = Utils::view("notfound", "NotFoundView");
            $notFound->render();
            exit;
        }

        $movieChosen = $_GET['title'];
        $data['movie'] = Utils::model("Movie")->getMovieByTitle("$movieChosen");

        if ($data['movie'] == null) {
            $notFound = Utils::view("notfound", "NotFoundView");
            $notFound->render();
            exit;
        }

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
            $data['reviews'][] = Utils::model("Review")->getReviewAndUserNameByReviewID("$reviewID");
        };

        $movieView = Utils::view("about", "AboutMovieView", $data);
        $movieView->render();
    }

    public function editMovie() {
        echo json_encode(Utils::model("Movie")->getMovieByID($_GET['id']));
    }

    public function updateMovie() {
       $movieChosen = $_POST['titleInput'];
       if(Utils::model("Movie")->updateMovie($_POST, $_FILES) > 0) {
            header('Location: movie?title='.$movieChosen);
            exit;
        } else {
            header('Location: home');
            exit;
        }
    }
}

 

