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

        // $data['actorName'] = "Ana de Armas";
        // $data['actorBirth'] = "April 30, 1988";
        // $data['actorDescription'] = "Ana de Armas was born in Cuba on April 30, 1988. 
        // At the age of 14 (2002) she began her studies at the National Theatre School of Havana, where she graduated after 4 years. 
        // At the age of 16 (2004) she made her first film, Una rosa de Francia (2006), directed by Manuel Gutiérrez Aragón. 
        // A few titles came after until she moved to Spain, where she continued her film career, and started on TV. 
        // In 2014 she moved to Los Angeles. She has appeared in films such as War Dogs (2016), Hands of Stone (2016) and Blade Runner 2049 (2017).";
        $data['images'] = [
            'Knives Out' => "../../../public/img/Knives Out.jpg",
            'Blade Runner' => "../../../public/img/Blade Runner.jpg",
            'Blonde' => "../../../public/img/Blonde.jpg",
            'Ghosted' => "../../../public/img/Ghosted.jpg",
            'Knock Knock' => "../../../public/img/Knock Knock.jpg",
            'No Time To Die' => "../../../public/img/No Time To Die.jpg"
            // 'Deep Water' => "../../../public/img/Deep Water.jpg",
            // 'The Gray Man' => "../../../public/img/The Gray Man.jpg",
            // 'Overdrive' => "../../../public/img/Overdrive.jpg"
        ];
        

        $actorView = Utils::view("about", "AboutPeopleView", $data);
        $actorView->render();
    }

    public function director() {
        $directorChosen = $_GET['name'];
        $data['title'] = 'Director';
        $data['people'] = Utils::model("Director")->getDirectorByName("$directorChosen");

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
        // $data['movieTitle'] = "Frozen";
        // $data['movieDirector'] = "Chris Buck";
        // $data['movieDescription'] = "When the newly crowned Queen Elsa accidentally 
        //                             uses her power to turn things into ice to curse her home in infinite winter, 
        //                             her sister Anna teams up with a mountain man, his playful reindeer, 
        //                             and a snowman to change the weather condition.";
        // $data['movieYear'] = "2013";
        $data['actorID'] = Utils::model("Movie")->getActorByMovieID("$movieID");
        foreach ($data['actorID'] as $actorID) {
            $actorID = $actorID['actor_id'];
            $data['actor'][] = Utils::model("Actor")->getActorByID("$actorID");
        };


        // $data['movieCast'] = [
        //     'Kristen Bell',
        //     'Idina Menzel',
        //     'Jonathan Groff'
        // ];
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
