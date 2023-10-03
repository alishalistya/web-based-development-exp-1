<?php

class AboutMovieController {
    public function index() {
        $data['movieTitle'] = "Frozen";
        $data['movieDirector'] = "Chris Buck";
        $data['movieDescription'] = "When the newly crowned Queen Elsa accidentally 
                                    uses her power to turn things into ice to curse her home in infinite winter, 
                                    her sister Anna teams up with a mountain man, his playful reindeer, 
                                    and a snowman to change the weather condition.";
        $data['movieYear'] = "2013";
        $data['movieCast'] = [
            'Kristen Bell',
            'Idina Menzel',
            'Jonathan Groff'
        ];
        // $data['images'] = [
        //     'Knives Out' => "../../../public/img/Knives Out.jpg",
        //     'Blade Runner' => "../../../public/img/Blade Runner.jpg",
        //     'Blonde' => "../../../public/img/Blonde.jpg",
        //     'Ghosted' => "../../../public/img/Ghosted.jpg",
        //     'Knock Knock' => "../../../public/img/Knock Knock.jpg",
        //     'No Time To Die' => "../../../public/img/No Time To Die.jpg"
        //     // 'Deep Water' => "../../../public/img/Deep Water.jpg",
        //     // 'The Gray Man' => "../../../public/img/The Gray Man.jpg",
        //     // 'Overdrive' => "../../../public/img/Overdrive.jpg"
        // ];
        

        $movieView = Utils::view("about", "AboutMovieView", $data);
        $movieView->render();
    }
}