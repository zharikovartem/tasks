<?php
include_once ROOT . '/components/Db.php';

class Task {
    const SHOW_BY_DEFAULT = 3;

    public static function getTaskItemById($id) {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * from tasks WHERE id='.$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $TaskItem = $result->fetch();

            return $TaskItem;
        }
    }

    public static function getTaskCount($page=0) {
        $db = Db::getConnection();
        $result = $db->query('  SELECT COUNT(*) FROM tasks');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $TaskCount = $result->fetch();
        // return ceil($TaskCount['COUNT(*)']/3);
        return $TaskCount['COUNT(*)'];
    }

    public static function getTaskList($page=1) {
        $db = Db::getConnection();
        $TaskList = array();
        $offsetValue = ($page-1)*3;

        if (isset($_SESSION['sort']['field'])) {
            $field = $_SESSION['sort']['field'];
        } else {
            $field = 'id';
        }
        if (isset($_SESSION['sort']['direction'])) {
            $direction = $_SESSION['sort']['direction'];
        } else {
            $direction = 'DESC';
        }
        
        $sql = 'SELECT id, userName, email, discriptions, completed
                FROM tasks 
                ORDER BY '.$field.' '.$direction.' 
                LIMIT 3 
                OFFSET '.$offsetValue;

        $result = $db->query( $sql );

        $i = 0;
        while ($row = $result->fetch()) {
            // if ($row['id'] != '') {
                $TaskList[$i]['id'] = $row['id'];
                $TaskList[$i]['userName'] = $row['userName'];
                $TaskList[$i]['email'] = $row['email'];
                $TaskList[$i]['discriptions'] = $row['discriptions'];
                $TaskList[$i]['completed'] = $row['completed'];
                $i++;
            // }
        }

        return $TaskList;
    }

    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } 
        return false;
    }

    public static function createNewTask($userName, $email, $discriptions) {
        $db = Db::getConnection();
        $sql = 'INSERT INTO task (userName, email, discriptions, completed) 
        VALUES (:userName, :email, :discriptions, 0);';

        $result = $db->prepare($sql);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':discriptions', $discriptions, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function editTask($id, $discriptions) {
        $db = Db::getConnection();
        $sql = 'UPDATE tasks SET discriptions = :discriptions, completed = 1 WHERE id = :id;';

        $result = $db->prepare($sql);
        $result->bindParam(':discriptions', $discriptions, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function sort($field) {
        //session_start();
        
        if ($_SESSION['sort']['field'] == $field) {
            if (!isset($_SESSION['sort']['direction'])) {
                $_SESSION['sort']['direction'] = 'DESC';
            }
            if ( $_SESSION['sort']['direction'] == 'ASC' ) {
                $_SESSION['sort']['direction'] = 'DESC';
            } else {
                $_SESSION['sort']['direction'] = 'ASC';
            }
        } else {
            $_SESSION['sort']['direction'] = 'DESC';
        }
        
        $_SESSION['sort']['field'] = $field;
        
    }

    public static function checkSort() {
        if (isset($_SESSION['sort'])) {
            return $_SESSION['sort'];
        }
    }

    // public static function setToasts($user) {
    //     //session_start();
    //     $_SESSION['user'] = $user;
    // }

    public static function getToasts() {
        if (isset($_SESSION['toasts'])) {
            return $_SESSION['toasts'];
        }
        return false;
    }

    public static function cleareToasts() {
            unset( $_SESSION['toasts'] );
            return true;
    }

    public static function createNewToast($value) {
        return $_SESSION['toasts'] = $value;
    }
}