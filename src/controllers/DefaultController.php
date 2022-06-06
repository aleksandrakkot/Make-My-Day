<?php

require_once 'AppController.php';

class DefaultController extends AppController {


    public function favourites()
    {
        $this->render('favourites');
    }

    public function search()
    {
        $this->render('search');
    }

    public function createplan()
    {
        $this->render('createplan');
    }

    public function yourplans()
    {
        $this->render('yourplans');
    }

    public function userprofile()
    {
        $this->render('userprofile');
    }
}