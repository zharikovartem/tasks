<?php 
include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Task.php';

class LoginController {

    public function actionLogin() {       
        $login = '';
        $password = '';

        $errors = false;
        if ( count($_POST) != 0 ) {
            if (isset($_POST['login'])) {
                $login = $_POST['login'];
            }
            if (isset($_POST['password'])) {
                $password = $_POST['password'];
            }

            if (!User::checkName($login)) {
                $errors[] = 'Логин должен быть более 2-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль должен быть более 3-х символов';
            }

            if ($errors == false) {
                $user = User::checkUserData($login, $password);
    
                if ($user == false) {
                    $errors[] = 'Нeправильные данные для входа на сайт';
                } else {
                    User::auth($user);
                    $toasts = Task::createNewToast('Вы вошли в учетную запись!');
                    header('Location: /');
                }
            }
        }

        require_once(ROOT . '/views/login/index.php');
        return true;
    }

    public function actionLogout() {
        session_start();
        unset($_SESSION['user']);
        header('Location: /');
    }
}