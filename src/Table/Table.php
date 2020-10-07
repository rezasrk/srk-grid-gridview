<?php

namespace SrkGrid\GridView\Table;

use SrkGrid\GridView\Core\TableConfig;
use SrkGrid\GridView\ProcessData\Paginate;
use SrkGrid\GridView\ProcessElement\ProcessElement;

trait Table
{
    use Paginate, ProcessElement,TableConfig;

    /**
     * store string html tag table
     *
     * @var string
     */
    protected $table = "";

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

        collect($this->headNameColumns)->each(function ($name, $index) use (&$th) {

            $this->setHeaderLinkSort($name, $index);

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
                $td .= $this->td($tdTbl instanceof \Closure ? call_user_func($tdTbl, $data) : ($data->$tdTbl));
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
     * completed create html table
     *
     * @return string
     */
    protected function createTable()
    {
        /** sort data  */
        $this->setSortData();

        /** terminate data  */
        $this->paginate();

        /** create header table ( columns ) */
        $this->table .= $this->createHeadTable();

        /** add row increment  */
        $this->incrementRow();

        /** create body table  ( rows )*/
        $this->table .= $this->data->count() > 0 ? $this->createBodyTable() : $this->emptyTd();

        /** final create table */
        $table = $this->table($this->table) . $this->linkPage();

        return $table;
    }


}
