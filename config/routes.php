<?php
return array(
    'create' => 'create/index',
    'edit/([0-9]+)' => 'edit/edit/$1',
    // 'login' => 'login/login',
    'user/login' => 'login/login',
    'user/logout' => 'login/logout',
    'index'=>'task/index',
    'page-([0-9]+)' => 'task/index/$1',
    '' => 'task/index',
    // 'page-([0-9]+)/sort-([a-z]+)' => 'Task/index/$1/$2'
);