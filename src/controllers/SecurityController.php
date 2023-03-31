<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/CountryRepository.php';

class SecurityController extends AppController
{

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->countryRepository = new CountryRepository();
    }

    public function login()
    {
        session_start();


        if (isset($_SESSION['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/rankings");
        }else if(isset($_COOKIE['logUser'])){
            setcookie('logUser', '', 1);
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

    public function register()
    {

        session_start();


        if (isset($_SESSION['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/rankings");
        }else if(isset($_COOKIE['logUser'])){
            setcookie('logUser', '', 1);
        }

        $countries = $this->countryRepository->getCountries();
        if (!$this->isPost()) {
            return $this->render('registration', ['country' => $countries]);
        }

        $nick = $_POST['nick'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirm_password'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $country = $_POST['country'];


        if ($password !== $confirmedPassword) {
            return $this->render('registration', ['messages' => ['Please provide proper password'], 'country' => $countries]);
        }

        if (strlen($password) < 8) {
            return $this->render('registration', ['messages' => ['Your password should contain more than 8 characters'], 'country' => $countries]);
        }

        $npassword = password_hash($password, PASSWORD_BCRYPT);

        $user = new User($email, $npassword, $nick);
        $user->setName($imie);
        $user->setSurname($nazwisko);
        $user->setCountry($country);

        $info = $this->validateEmailNick($user, 'registration', $countries);

        $this->userRepository->addUser($user);

        if ($info == null) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        }

    }

    public function logout(){
        session_start();

        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        session_destroy();

        if(isset($_COOKIE['logUser'])){
            setcookie('logUser', '', 1);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }

    private function validateEmailNick(User $user, $tmp, $countries)
    {
        if ($this->userRepository->isEmailAlreadyExist($user->getEmail())) {
            $this->render($tmp, ['messages' => ['User with this email already exist!'],  'country' => $countries]);
            die();
        }
        if ($this->userRepository->isNickAlreadyExist($user->getNick())) {
            $this->render($tmp, ['messages' => ['User with this nick already exist!'], 'country' => $countries]);
            die();
        }

    }
}