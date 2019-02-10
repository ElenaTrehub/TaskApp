<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 08.02.2019
 * Time: 21:35
 */

namespace Application\Controllers;


use Application\Services\TaskService;

class HomeController extends BaseController
{
    public function indexAction(){

        $taskService = new TaskService();

        $template = $this->twig->load('Home/home.twig');

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


}//HomeController