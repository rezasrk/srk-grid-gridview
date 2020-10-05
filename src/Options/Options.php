<?php


namespace SrkGrid\GridView\Options;


trait Options
{
    /**
     * set default header
     *
     * @var array
     */
    protected $headerRowIndex = [];

    /**
     * when data not result
     *
     * @return mixed
     */
    protected function emptyTd()
    {
        $count = count($this->bodyTable);
        return $this->tr($this->td($this->messageEmpty(), "colspan={$count}"));
    }


}
