<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class UserController extends AppController
{

    private $userRepository;
    private $user_array;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->user_array = json_decode($_COOKIE['logUser'], true);
    }

    public function ifCookieExists(): bool
    {
        if (!isset($_COOKIE['logUser'])) {
            return false;
        }
        return true;
    }
}