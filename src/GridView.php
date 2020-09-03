<?php

namespace SrkGrid\GridView;

use SrkGrid\GridView\Html\TableElement;
use SrkGrid\GridView\Options\Options;
use SrkGrid\GridView\ProcessData\Paginate;
use SrkGrid\GridView\ProcessElement\ProcessElement;

class GridView extends TableElement
{
    use Options, Paginate, ProcessElement;

    /**
     * elements of header table
     *
     * @var array
     */

    protected $headerTables = [];

    /**
     * store string html tag table
     *
     * @var string
     */
    protected $table = "";

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
     * create header table
     *
     * @return string
     */
    protected function createHeadTable()
    {
        if (!empty($this->headerRowIndex))
            $this->headNameColumns = array_merge($this->headerRowIndex, $this->headNameColumns);

        $th = "";
        collect($this->headNameColumns)->each(function ($name) use (&$th) {
            $th .= $this->th($name);
        });

        return $this->thead($this->tr($th));
    }

    /**
     * create td tag table
     * @param $data
     * @return string
     */
    protected function createTdTable($data)
    {
        $td = "";
        foreach ($this->bodyTable as $tdTbl) {
            if (is_array($tdTbl) && isset($tdTbl['incrementRow']))
                $td .= $this->td($tdTbl['incrementRow'] + $this->increment);
            else
                $td .= $this->td($tdTbl instanceof \Closure ? $tdTbl->call($data, $data) : ($data->$tdTbl));
        }
        return $td;
    }

    /**
     * create body table
     *
     * @return string
     */
    protected function createBodyTable()
    {
        $tr = "";
        foreach ($this->data as $data) {
            if (!empty($this->anyRowAttribute))
                $this->trAttribute = $this->anyRowAttribute->call($data, $data);

            $tr .= $this->tr($this->createTdTable($data));

            $this->increment++;
        }

        return $this->tbody($tr);
    }

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
    }

    /**
     * render grid
     *
     * @return string
     */
    public function renderGrid()
    {
        $this->paginate();
        return $this->makeTable() . $this->linkPage();
    }

    /**
     * create table
     *
     * @return string
     */
    protected function makeTable()
    {
        $this->processTable();

        /** create header table ( columns ) */
        $this->table .= $this->createHeadTable();

        /** add row increment  */
        if ($this->hasRowIndex)
            $this->incrementRow();

        /** create body table  ( rows )*/
        $this->table .= $this->data->count() > 0 ? $this->createBodyTable() : $this->emptyTd();

        return $this->table($this->table);
    }

}
