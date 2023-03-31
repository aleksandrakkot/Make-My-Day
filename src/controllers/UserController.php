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

    public function userprofile()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            $user = $this->userRepository->getUser($_SESSION['user']);
            return $this->render('userprofile', ['user' => $user]);
        }
        else {
            return $this->render('login');
        }
    }

    public function changePassword(){
            session_start();


            if (!$this->isPost()) {
                return $this->render('userprofile');
            }

            $pass = $_POST["old_password"];
            $newpass = $_POST["password"];
            $confnewpass = $_POST["confirm_password"];

            $user = $this->userRepository->getUser($_SESSION['user']);

            if (!password_verify($pass, $user->getPassword())) {
                return $this->render('userprofile', ['messages' => ['You entered the wrong password!'], 'user'=> $user]);
            }
            if ($newpass !== $confnewpass) {
                return $this->render('userprofile', ['messages' => ['Please provide proper password!'], 'user'=> $user]);
            }
            if (strlen($newpass) < 8) {
                return $this->render('userprofile', ['messages' => ['Your new password should contain more than 8 characters'], 'user'=> $user]);
            }

            $npassword = password_hash($newpass, PASSWORD_BCRYPT);
            $this->userRepository->updatePassword($npassword);

            return $this->render('userprofile', ['messages' => ['Password changed'], 'user'=> $user]);
    }
}