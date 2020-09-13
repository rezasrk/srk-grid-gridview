<?php

namespace SrkGrid\GridView\ProcessElement;
use SrkGrid\GridView\ProcessData\Sort;

trait ProcessElement
{
    use Sort;
    /**
     * for store disable column index number
     *
     * @var array
     */
    protected $disableColumns = [];

    /**
     * store head name column
     *
     * @var array
     */
    protected $headNameColumns = [];

    /**
     * elements of body table
     * @var array
     */
    protected $bodyTable = [];



    /**
     * get disable column index and store in disableColumns property
     *
     * @param $value
     * @param $index
     */
    protected function disableColumns($value, $index)
    {
        if (isset($value['disable']) && $value['disable'] == false)
            $this->disableColumns[] = $index;
    }

    /**
     * get header name columns and store in headNameColumns property
     *
     * @param $value
     */
    protected function headerNameColumns($value)
    {
        if (isset($value['head']) && $value['head'])
            $this->headNameColumns[] = $value['head'];
    }

    /**
     * get all option exists in header table
     */
    protected function processHeaderColumns()
    {
        collect($this->headerTables)->each(function ($value, $index) {

            $this->disableColumns($value, $index);

            $this->sortAbleColumns($value, $index);

            $this->headerNameColumns($value);

        });
    }

    /**
     * remove disable columns
     */
    protected function removeElement()
    {
        collect($this->disableColumns)->each(function ($index) {

            unset($this->headNameColumns[$index]);

            unset($this->bodyTable[$index]);
        });
    }

    /**
     * add column for table
     *
     * @param $column
     * @return $this
     */
    public function addColumns($column)
    {
        $this->bodyTable[] = $column;

        return $this;
    }

    /**
     * process table
     */
    protected function processTable()
    {
        $this->processHeaderColumns();

        $this->removeElement();
    }
}
