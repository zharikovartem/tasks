<?php
include_once ROOT . '/components/Db.php';
class User {

    public static function checkName($name) {
        if (strlen($name)>=2) {
            return true;
        }
        return false;
    }

    public static function checkDescriptions($descriptions) {
        if (strlen($descriptions)>=5) {
            return true;
        }
        return false;
    }
    
    public static function checkPassword($password) {
        if (strlen($password)>=3) {
            return true;
        }
        return false;
    }

    public static function checkUserData($login, $password) {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE login = :login AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $user = $result->fetch();
        if($user) {
            return $user;
        } else {
            return false;
        }
    }

    public static function auth($user) {
        //session_start();
        $_SESSION['user'] = $user;
    }

    public static function checkLogged() {
        //session_start();
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        // header('Location: ');
    }

    public static function isGuest() {
        //session_start();
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function checkXSS($data) {
        $data = strip_tags($data);
        $data = htmlentities($data, ENT_QUOTES, "UTF-8");
        $data = htmlspecialchars($data, ENT_QUOTES);

        return $data;
    }
}