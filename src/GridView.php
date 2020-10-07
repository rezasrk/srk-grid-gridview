<?php

namespace SrkGrid\GridView;

use SrkGrid\GridView\Excel\ExportExcel;
use SrkGrid\GridView\Html\RawHtml;
use SrkGrid\GridView\Options\Options;
use SrkGrid\GridView\Table\Table;

class GridView
{
    use  Table, Options, ExportExcel;

    /**
     * store result query from eloquent or query builder
     *
     * @var object
     */
    protected $data;

    /**
     * create GridView.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;

        $this->setDefaultConfigGrid();
    }

    /**
     * render grid
     *
     * @return string
     */
    public function renderGrid()
    {
        return $this->makeGrid();
    }


    /**
     * create table
     *
     * @return string
     */
    protected function makeGrid()
    {
        $this->coreProcess();

        $this->downloadExcel();

        return $this->setParentTable();
    }

    /**
     * set Parent for grid
     *
     * @return string
     */
    protected function setParentTable()
    {
        /** @var RawHtml $rawHtml */
        $rawHtml = Factory::make(RawHtml::class);

        $table = $this->createButtonExcel() . $this->createTable();

        return $rawHtml->startDiv($this->parentTableAttribute, $table)->endDiv()->getHtml();
    }

    protected function setDefaultConfigGrid()
    {
        $this->setTableConf();

        $this->setExcelConf();

        $this->setPaginateConf();
    }
}
