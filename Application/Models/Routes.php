<?php
return array(
    "get"=>[
        '/home' => 'HomeController@indexAction',
        '/add' => 'TaskController@indexAction',
        '/get_next_task' => 'TaskController@GetNextTaskAction',
        '/get_task_filter' => 'TaskController@GetTaskFilterAction',
        '/admin' => 'AdminController@indexAdminAction',
        '/get_admin_panel' => 'AdminController@GeAdminPanelAction',
    ],
    "post"=>[
        '/add' => 'TaskController@addTaskAction',
        'change_task' => 'AdminController@ChangeTaskAction',
    ],

);

