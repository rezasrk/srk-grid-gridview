<?php

namespace SrkGrid\GridView;


class Factory
{
    /**
     * @param $class
     * @return mixed
     */
    public static function make($class)
    {
        $object =  new $class();

        return $object;
    }
}
