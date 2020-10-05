<?php

namespace SrkGrid\GridView\ProcessData;


trait Sort
{
    /**
     * for store sort able columns index number
     *
     * @var array
     */
    protected $sortAbleColumns = [];

    /**
     * sort able columns index
     *
     * @param $value
     * @param $index
     */
    protected function sortAbleColumns($value, $index)
    {
        if (isset($value['sortAble']))
            $this->sortAbleColumns[] = [$index => $value['sortAble']];
    }

    /**
     * set sort data query
     */
    protected function setSortData()
    {
        if (request()->has('sort_able') && request()->has('sort_type'))
            $this->data->orderBy(request('sort_able'), request('sort_type'));
    }

    /**
     * create link for header
     *
     * @param $name
     * @param $index
     */
    protected function setHeaderLinkSort(&$name,$index)
    {
        collect($this->sortAbleColumns)->each(function ($value) use (&$name, $index) {
            collect($value)->each(function ($v, $k) use (&$name, $index) {
                if ($k == $index) {

                    if (!request()->has('sort_type'))
                        $sortType = 'desc';

                    elseif (request()->has('sort_type') && request('sort_type') == 'desc')
                        $sortType = 'asc';

                    elseif (request()->has('sort_type') && request('sort_type') == 'asc')
                        $sortType = 'desc';

                    $name = "<a href='?sort_able={$v}&sort_type={$sortType}'>{$name}</a>";
                }

            });
        });
    }
}
