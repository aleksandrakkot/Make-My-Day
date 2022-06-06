<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::get('logout', 'SecurityController');

Router::post('registration', 'DefaultController');

Router::get('rankings', 'DayPlanController');
Router::get('dayplan', 'DayPlanController');

Router::get('milestone', 'MilestoneController');

Router::get('favourites', 'DefaultController');
Router::get('search', 'DefaultController');
Router::post('searchPlans', 'DayPlanController');
Router::get('createplan', 'DefaultController');
Router::get('yourplans', 'DayPlanController');
Router::get('userprofile', 'DefaultController');
Router::run($path);