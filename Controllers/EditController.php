<?php 
include_once ROOT . '/models/Task.php';
class EditController {

    public function actionEdit($id) {
        $task = Task::getTaskItemById($id);

        $errors = false;
        if ( count($_POST) != 0 ) {
            $discriptions = '';

            if (isset($_POST['discriptions'])) {
                $discriptions = strip_tags($_POST['discriptions']);
            }
            $newDiscriptions = Task::editTask($id, $discriptions);
            $toasts = Task::createNewToast('Текст задачи был изменен!');

            header('Location: /');
        }

        require_once(ROOT . '/views/edit/index.php');
        return true;
    }
}