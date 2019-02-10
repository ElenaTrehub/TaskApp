<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 08.02.2019
 * Time: 21:04
 */

namespace Application\Controllers;

use Application\Utils\MySQL;
use Bramus\Router\Router;

class ApplicationController extends BaseController
{

    public function Start(){

        MySQL::$db = new \PDO(
            "mysql:dbname=taskdb;host=127.0.0.1;charset=utf8",
            "admin",
            "123"
        );

        $router = new Router();

        $routes = include_once ('../Application/Models/Routes.php');

        $router->setNamespace('Application\\Controllers');

        $router->set404(function (  ){

            try {

                $template = $this->twig->load('../Templates/ErrorPages/404-not-found.twig');
                echo $template->render( );

            }//try
            catch (\Exception $ex) {

            }//catch

        });

        foreach ($routes as $key => $path ){

            foreach ($path as $subKey => $value){

                $router->$key( $subKey , $value );

            }//foreach

        }//foreach

        $router->run();

    }//Start


}//ApplicationController