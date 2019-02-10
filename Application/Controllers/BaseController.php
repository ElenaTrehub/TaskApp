<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 08.02.2019
 * Time: 20:45
 */

namespace Application\Controllers;


use Application\Utils\Request;
use Application\Utils\Storage;
use Twig_Loader_Filesystem;
use Twig_Environment;

abstract class BaseController
{
    protected $request;
    protected $storage;

    protected $loader;
    protected $twig;

    public function __construct()
    {
        $this->request = new Request();
        $this->storage = new Storage();

        $this->loader = new Twig_Loader_Filesystem('../Application/Templates');
        $this->twig = new Twig_Environment($this->loader);

    }//__construct

    protected function getStorage()
    {
        return $this->storage;
    }


    protected  function setStorage($storage){
        $this->storage = $storage;
    }//setStorage


    protected function json( $code , $data ){

        http_response_code($code);
        header('Content-type: application/json');
        echo json_encode($data); //  res.send();
        exit();

    }//json
}//BaseController