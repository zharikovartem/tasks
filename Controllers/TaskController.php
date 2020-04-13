<?php
include_once ROOT . '/models/Task.php';
include_once ROOT . '/models/User.php';
include_once ROOT . '/components/Pagination.php'; 
class TaskController {

    public function actionIndex($page=1) {
        
        if ( count($_POST) != 0 ) {
            Task::sort($_POST['sort']);
        }

        $sort = Task::checkSort();
        $toasts = Task::getToasts();
        $newsList = array();
        $newsList = Task::getTaskList($page);
        $total = Task::getTaskCount();

        $pagination = new Pagination($total, $page, Task::SHOW_BY_DEFAULT, 'page-');

        $user = User::checkLogged();

        require_once(ROOT . '/views/tasks/index.php');

        return true;
    }

}