<?php 
include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Task.php';

class CreateController {
    public function actionIndex($page=1) {
        $login = '';
        $email = '';
        $descriptions = '';

        $errors = false;
        if ( count($_POST) != 0 ) {
            if (isset($_POST['login'])) {
                $login = strip_tags($_POST['login']);
            }
            if (isset($_POST['email'])) {
                $email = strip_tags($_POST['email']);
            }
            if (isset($_POST['descriptions'])) {
                $descriptions = strip_tags($_POST['descriptions']);
            }
            

            if (!User::checkName($login)) {
                $errors[] = 'Логин должен быть более 2-х символов';
            }
            if (!User::checkDescriptions($descriptions)) {
                $errors[] = 'Текст должен иметь более 5-и символов';
            }
            if (!Task::checkEmail($email)) {
                $errors[] = 'Email должен иметь вид 111@222.33';
            }

            if ($errors == false) {
                $newTask = Task::createNewTask($login, $email, $descriptions);

                $toasts = Task::createNewToast('Создана новая задача!');

                header('Location: /');
            }

        }

        require_once(ROOT . '/views/create/index.php');
        return true;
    }
}