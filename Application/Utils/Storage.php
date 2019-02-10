<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 08.02.2019
 * Time: 20:58
 */

namespace Application\Utils;


class Storage
{
    private $storage = [];

    public function __get($name)
    {
        if(isset($this->storage[$name])){
            return $this->storage[$name];
        }//if

        return null;
    }//__get

    public function __set($name, $value)
    {
        $this->storage[$name]=$value;

    }//__set

    function getRawStorage(){
        return $this->storage;
    }//getRawStorage

}//Storage