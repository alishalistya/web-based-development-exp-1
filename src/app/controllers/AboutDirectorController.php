<?php

class AboutDirectorController {
    public function index() {
        $data['directorName'] = "Christopher Nolan";
        $data['directorBirth'] = "July 30, 1970";
        $data['directorDescription'] = "Best known for his cerebral, often nonlinear, storytelling, 
                                    acclaimed writer-director Christopher Nolan was born on July 30, 1970, in London, England. 
                                    Over the course of 15 years of filmmaking, 
                                    Nolan has gone from low-budget independent films to working on some of the biggest blockbusters ever made.";
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
        

        $directorView = Utils::view("about", "AboutDirectorView", $data);
        $directorView->render();
    }
}