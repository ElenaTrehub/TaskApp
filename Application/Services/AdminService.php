<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 10.02.2019
 * Time: 14:42
 */

namespace Application\Services;
use Application\Utils\MySQL;

class AdminService
{
    public function ChangeTask($id, $isComp, $taskText){


        $stm = MySQL::$db->prepare("UPDATE tasks SET isComp=:isComp, taskText=:taskText  WHERE taskID=:id");

        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':taskText', $taskText, \PDO::PARAM_STR);
        $stm->bindParam(':isComp', $isComp, \PDO::PARAM_BOOL);
        $result = $stm->execute();


        return $result;

    }//GetTasks


}//AdminService