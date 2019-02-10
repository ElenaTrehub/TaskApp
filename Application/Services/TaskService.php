<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 08.02.2019
 * Time: 21:38
 */

namespace Application\Services;

use Application\Utils\MySQL;

class TaskService
{
    public function GetTasks($limit=3, $offset=0){
        $stm = MySQL::$db->prepare("SELECT * FROM tasks LIMIT :offset,:limit");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->execute();

        $tasks = $stm->fetchAll(\PDO::FETCH_OBJ);

        $nRows = MySQL::$db->query('select count(*) from tasks')->fetchColumn();



        $info = array(
            'tasks'=>$tasks,
            'count'=>$nRows
        );
        return $info;
    }//GetTasks

    public function GetTasksSortUserName($limit=3, $offset=0){
        $stm = MySQL::$db->prepare("SELECT * FROM tasks ORDER BY userName LIMIT :offset,:limit");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->execute();

        $tasks = $stm->fetchAll(\PDO::FETCH_OBJ);

        $nRows = MySQL::$db->query('select count(*) from tasks')->fetchColumn();



        $info = array(
            'tasks'=>$tasks,
            'count'=>$nRows
        );
        return $info;
    }//GetTasks

    public function GetTasksSortUserEmail($limit=3, $offset=0){
        $stm = MySQL::$db->prepare("SELECT * FROM tasks ORDER BY userEmail LIMIT :offset,:limit");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->execute();

        $tasks = $stm->fetchAll(\PDO::FETCH_OBJ);

        $nRows = MySQL::$db->query('select count(*) from tasks')->fetchColumn();



        $info = array(
            'tasks'=>$tasks,
            'count'=>$nRows
        );
        return $info;
    }//GetTasks

    public function GetTasksSortIsComp($limit=3, $offset=0){

        $stm = MySQL::$db->prepare("SELECT * FROM tasks WHERE isComp=true LIMIT :offset,:limit");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->execute();

        $tasks = $stm->fetchAll(\PDO::FETCH_OBJ);

        $nRows = MySQL::$db->query('select count(*) from tasks WHERE isComp=true')->fetchColumn();



        $info = array(
            'tasks'=>$tasks,
            'count'=>$nRows
        );
        return $info;
    }//GetTasks

    public function GetTasksSortNoComp($limit=3, $offset=0){

        $stm = MySQL::$db->prepare("SELECT * FROM tasks WHERE isComp=false LIMIT :offset,:limit");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->execute();

        $tasks = $stm->fetchAll(\PDO::FETCH_OBJ);

        $nRows = MySQL::$db->query('select count(*) from tasks WHERE isComp=false')->fetchColumn();



        $info = array(
            'tasks'=>$tasks,
            'count'=>$nRows
        );
        return $info;
    }//GetTasks

    public function AddTask($name, $email, $taskText){

        $isComp = false;

        $stm = MySQL::$db->prepare("INSERT INTO tasks VALUES(DEFAULT, :userName, :userEmail, :taskText, :isComp)");


        $stm->bindParam(':userName', $name, \PDO::PARAM_STR);
        $stm->bindParam(':userEmail', $email, \PDO::PARAM_STR);
        $stm->bindParam(':taskText', $taskText, \PDO::PARAM_STR);
        $stm->bindParam(':isComp', $isComp, \PDO::PARAM_BOOL);
        $stm->execute();


        return  MySQL::$db->lastInsertId();

    }//GetTasks

}//TaskService