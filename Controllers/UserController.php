<?php
class UserController {
    public function actionRegister() {
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            if (isset($login)) {
                echo '<br> Login: '.$login;
            }
        }
    }
}