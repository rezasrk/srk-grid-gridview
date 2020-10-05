<?php

namespace SrkGrid\GridView;


class Grid
{
    /**
     * Make GridView class and render
     *
     * @param $class
     * @param $data
     * @param null $localization
     * @return string
     */
    public static function make($class, $data, $localization = null)
    {
        $grid = new GridView($data);

        $object = new $class();

        return $object->render($grid, $data, $localization);
    }
}
