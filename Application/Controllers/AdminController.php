<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 10.02.2019
 * Time: 12:48
 */

namespace Application\Controllers;

use Application\Services\AdminService;
use Application\Services\TaskService;

class AdminController extends BaseController
{
    public function indexAdminAction(){

        $template = $this->twig->load('Admin/admin_autorise.twig');

        echo $template->render();


    }//indexAction

    public function GeAdminPanelAction(){

        $taskService = new TaskService();

        $template = $this->twig->load('Admin/admin_panel.twig');

        $tasks = $taskService->GetTasks();

        if($tasks['count']!==0){
            echo $template->render( [
                'tasks' => $tasks['tasks'],
                'count' => $tasks['count']
            ] );
        }//if
        else{
            echo $template->render( [
                'tasks' => null,
                'count' => null
            ] );
        }//else


    }//indexAction

    public function ChangeTaskAction(){

        $id = $this->request->GetPostValue('id');
        $isComp = $this->request->GetPostValue('isComp');
        $taskText = $this->request->GetPostValue('taskText');

        $adminService = new AdminService();

       $result = $adminService->ChangeTask(+$id, $isComp, $taskText);

        if($result===true){
            $this->json( 200, array(
                'status' => '200',
                'taskID' => $id,
            ) );
        }//if
        else{
            $this->json( 200, array(
                'status' => '400',
                'taskID' => null,
            ) );
        }//if


    }//ChangeTaskAction

}//AdminController