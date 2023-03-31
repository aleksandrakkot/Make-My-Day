<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository{
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.nick, u.password, u.email, u.is_admin, ud.name, ud.surname, ud.user_photo, ud.date_of_birth, c.country_name FROM public.user u
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

        $new_user = new User(
            $user['email'],
            $user['password'],
            $user['nick']
        );
        $new_user->setName($user['name']);
        $new_user->setSurname($user['surname']);
        $new_user->setUserPhoto($user['user_photo']);
        $new_user->setCountry($user['country_name']);

        $cookie_name = 'logUser';
        unset($user['password']);
        $cookie_value = json_encode($user);
        setcookie($cookie_name, $cookie_value, time() + (3600 * 24 * 30), "/");

        return $new_user;
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.user (nick, email, password)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getNick(),
            $user->getEmail(),
            $user->getPassword(),
        ]);

        $this->addUserDetails($user);

    }

    public function addUserDetails(User $user)
    {
        $id = $this->getUserId($user->getEmail());
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.user_detail (user_id, name, surname, country_id)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $id,
            $user->getName(),
            $user->getSurname(),
            $user->getCountry()
        ]);
    }

    public function updatePassword($npass){
        $id = $this->getUserId($_SESSION['user']);
        $stmt = $this->database->connect()->prepare('
            UPDATE public.user 
            SET password = :npass
            WHERE user_id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':npass', $npass, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getUserId(string $email): int
    {

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['user_id'];
    }

    public function isEmailAlreadyExist(string $email): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user 
            WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        $info = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($info == false) {
            return false;
        }
        return true;
    }

    public function isNickAlreadyExist(string $nick): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user
            WHERE nick = :nick
        ');
        $stmt->bindParam(':nick', $nick, PDO::PARAM_STR);

        $stmt->execute();

        $info = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($info == false) {
            return false;
        }
        return true;
    }

    public function isAdmin($id){
        $stmt = $this->database->connect()->prepare('
            SELECT is_admin FROM public.user
            WHERE user_id = :userid;
        ');

        $stmt->bindParam(':userid', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['is_admin'];
    }
}