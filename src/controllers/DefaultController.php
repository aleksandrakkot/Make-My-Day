<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function rankings()
    {
        $this->render('rankings');
    }

    public function favourites()
    {
        $this->render('favourites');
    }
}