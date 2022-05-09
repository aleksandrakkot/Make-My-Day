<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->cookieName = 'user';
    }

    public function login()
    {
        session_start();


        if (isset($_SESSION['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/rankings");
        }

        if (!$this->isPost()) {
            return $this->render('login');
        }


        $email = $_POST["email"];
        $password = $_POST["password"];

        try {
            $user = $this->userRepository->getUser($email);
        } catch (InvalidArgumentException $exception) {
            return $this->render('login', ['messages' => $exception->getMessage()]);
        }
        if (!$user) {
            return $this->render('login', ['messages' => ['User does not exist!']]);
        }
        if ($user->getEmail() !== $email && $user->getNick()) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }
        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        if (password_verify($_POST["password"], $user->getPassword())) {
            $_SESSION['user'] = ($_POST['email']);
        }


        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/rankings");
    }
}