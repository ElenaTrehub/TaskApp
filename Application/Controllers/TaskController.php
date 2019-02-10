<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 09.02.2019
 * Time: 17:13
 */

namespace Application\Controllers;

use Application\Services\TaskService;
class TaskController extends BaseController
{
    public function indexAction(){

        $template = $this->twig->load('Task/add_task.twig');

        echo $template->render();


    }//indexAction

    public function addTaskAction(){

        $name = $this->request->GetPostValue('userName');
        $email = $this->request->GetPostValue('userEmail');
        $text = $this->request->GetPostValue('taskText');

        $taskService = new TaskService();

        $result = $taskService->AddTask($name, $email, $text);

        if($result){
            $this->json( 200, array(
                'status' => '200',
                'taskID' => $result,
            ) );
        }//if
        else{
            $this->json( 400, array(
                'status' => '400',
                'taskID' => null,
            ) );
        }//else

    }//indexAction

    public function GetNextTaskAction(){

        $limit = $this->request->GetGetValue('limit');
        $offset = $this->request->GetGetValue('offset');
        $filter = $this->request->GetGetValue('filterToken');

        $taskService = new TaskService();

        $info = null;

        switch ($filter){
            case 'date':
                global $info;
                $info = $taskService->GetTasks($limit, $offset);
                break;
            case 'userName':
                global $info;
                $info = $taskService->GetTasksSortUserName($limit, $offset);
                break;
            case 'userEmail':
                global $info;
                $info = $taskService->GetTasksSortUserEmail($limit, $offset);
                break;
            case 'taskIsComp':
                global $info;
                $info = $taskService->GetTasksSortIsComp($limit, $offset);
                break;
            case 'taskNoComp':
                global $info;
                $info = $taskService->GetTasksSortNoComp($limit, $offset);
                break;

        }//switch


        if($info){
            $this->json( 200, array(
                'status' => '200',
                'tasks' =>  $info['tasks'],
                'countTask' => $info['count']
            ) );
        }//if
        else{
            $this->json( 400, array(
                'status' => '400',
                'tasks' => null,
                'countTask' => 0
            ) );
        }//else

    }//GetNextTaskAction

    public function GetTaskFilterAction(){

        $filter = $this->request->GetGetValue('filterToken');

        $taskService = new TaskService();

        $info = null;

        switch ($filter){
            case 'date':
                global $info;
                $info = $taskService->GetTasks();
                break;
            case 'userName':
                global $info;
                $info = $taskService->GetTasksSortUserName();
                break;
            case 'userEmail':
                global $info;
                $info = $taskService->GetTasksSortUserEmail();
                break;
            case 'taskIsComp':
                global $info;
                $info = $taskService->GetTasksSortIsComp();
                break;
            case 'taskNoComp':
                global $info;
                $info = $taskService->GetTasksSortNoComp();
                break;

        }//switch

        if($info){
            $this->json( 200, array(
                'status' => '200',
                'tasks' =>  $info['tasks'],
                'countTask' => $info['count']
            ) );
        }//if
        else{
            $this->json( 400, array(
                'status' => '400',
                'tasks' => null,
                'countTask' => 0
            ) );
        }//else
    }//GetTaskFilter



}//TaskController