<?php

namespace SrkGrid\GridView\Core;


trait CoreProcessElement
{
    /**
     * elements of header table
     *
     * @var array
     */
    protected $headerTables = [];

    /**
     * store head name column
     *
     * @var array
     */
    protected $headNameColumns = [];

    /**
     * header column excel
     *
     * @var array
     */
    protected $headerExcelName = [];

    /**
     * for store disable column index number
     *
     * @var array
     */
    protected $disableColumns = [];

    /**
     * for store disable column index number for excel
     *
     * @var array
     */
    protected $disableExcelColumn = [];
    /**
     * elements of body table
     *
     * @var array
     */
    protected $bodyTable = [];

    /**
     * elements of body excel
     *
     * @var array
     */
    protected $bodyExcel = [];

    /**
     * create <th>value</th>
     *
     * @param $headerTables
     * @return $this
     */
    public function headerColumns($headerTables)
    {
        $this->headerTables = $headerTables;

        return $this;
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

        $this->bodyExcel[] = $column;
        return $this;
    }

    /**
     * get header name columns and store in headNameColumns property for table
     *
     * @param $value
     */
    protected function headerNameColumns($value)
    {
        if (isset($value['head']) && $value['head']) {

            $this->headerExcelName[] = $value['head'];

            $this->headNameColumns[] = $value['head'];
        }

    }

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

        if (isset($value['disableExcel']) && $value['disableExcel'] == false)
            $this->disableExcelColumn[] = $index;
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


        collect($this->disableExcelColumn)->each(function($index){
            unset($this->headerExcelName[$index]);

            unset($this->bodyExcel[$index]);
        });
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
     * process table
     */
    protected function coreProcess()
    {
        $this->processHeaderColumns();

        $this->removeElement();

    }
}
