<?php

namespace SrkGrid\GridView;


interface BaseGrid
{
    /**
     * Render method for get html view result
     *
     * @param GridView $grid
     * @param $data
     * @param $localization
     * @return mixed
     */
    public function render($grid,$data, $localization = null);
}
