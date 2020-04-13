<?php
define('ROOT', dirname(__FILE__));
include_once ROOT . '/../../models/Task.php';

if ( count($_POST) != 0 ) {
    // print_r($_POST);
    $status = $_POST['checked'];
    $id = $_POST['data_id'];

    echo ROOT;

    Task::changeStatus($status, $id);
}