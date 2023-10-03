<?php

class AboutActorController {
    public function index() {
        $data['actorName'] = "Ana de Armas";
        $data['actorBirth'] = "April 30, 1988";
        $data['actorDescription'] = "Ana de Armas was born in Cuba on April 30, 1988. 
        At the age of 14 (2002) she began her studies at the National Theatre School of Havana, where she graduated after 4 years. 
        At the age of 16 (2004) she made her first film, Una rosa de Francia (2006), directed by Manuel Gutiérrez Aragón. 
        A few titles came after until she moved to Spain, where she continued her film career, and started on TV. 
        In 2014 she moved to Los Angeles. She has appeared in films such as War Dogs (2016), Hands of Stone (2016) and Blade Runner 2049 (2017).";

        $actorView = Utils::view("about", "AboutActorView", $data);
        $actorView->render();
    }
}