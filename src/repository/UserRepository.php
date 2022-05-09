<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository{
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user u
            LEFT JOIN public.user_detail ud ON u.user_id = ud.user_id
            LEFT JOIN public.country c ON ud.country_id = c.country_id
            WHERE email = :email
        ');
        
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user == false) {
            return null;
        }

        $cookie_name = 'logUser';
        $cookie_value = json_encode($user);
        setcookie($cookie_name, $cookie_value, time() + (3600 * 24 * 30), "/");

        $new_user = new User(
            $user['email'],
            $user['password'],
            $user['nick']
        );
        $new_user->setName($user['name']);
        $new_user->setSurname($user['surname']);
        $new_user->setUserPhoto($user['user_photo']);
        $new_user->setCountry($user['country_name']);

        return $new_user;
    }
}