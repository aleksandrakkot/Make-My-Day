<?php

require_once 'AppController.php';

class DefaultController extends AppController {


    public function search()
    {
        $this->render('search');
    }

    public function createplan()
    {
        $this->render('createplan');
    }
}