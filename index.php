<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('registration', 'DefaultController');

Router::get('rankings', 'DefaultController');
Router::get('favourites', 'DefaultController');
Router::get('dayplan', 'DefaultController');
Router::run($path);