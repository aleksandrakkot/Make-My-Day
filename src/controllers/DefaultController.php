<?php

require_once 'AppController.php';

class DefaultController extends AppController {


    public function favourites()
    {
        $this->render('favourites');
    }

    public function dayplan()
    {
        $this->render('dayplan');
    }

    public function createplan()
    {
        $this->render('createplan');
    }
}