<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 08.02.2019
 * Time: 20:49
 */

namespace Application\Utils;


class Request
{
    public function GetGetValue($key){

        if(isset($_GET[$key])){
            return $_GET[$key];
        }//if

        return null;

    }//GetGetValue

    public function GetPostValue($key){

        if(isset($_POST[$key])){
            return $_POST[$key];
        }//if

        return null;

    }//GetPostValue

    public function GetPutValue($key){

        $params = [];

        parse_str(
            file_get_contents("php://input") ,
            $params
        );

        if( isset($params[$key]) ){
            return $params[$key];
        }//if
        else {
            return null;
        }//else

    }//GetPutValue

}//Request