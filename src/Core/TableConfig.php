<?php

namespace SrkGrid\GridView\Core;

trait TableConfig
{
    /**
     * @var array
     */
    protected $parentTableAttribute;
    /**
     * attribute for table tag
     *
     * @var array
     */
    protected $tableAttribute;

    /**
     * attribute for thead tag
     *
     * @var array
     */
    protected $theadAttribute;

    /**
     * attribute for tbody tag
     *
     * @var array
     */
    protected $tbodyAttribute;

    /**
     * attribute for tr tag
     *
     * @var array
     */
    protected $trAttribute;

    /**
     * attribute for th tag
     *
     * @var array
     */

    protected $thAttribute;
    /**
     * attribute for td tag
     *
     * @var array
     */

    protected $tdAttribute;
    /**
     * set condition or attribute for any row
     *
     * @var
     */

    protected $anyRowAttribute = null;
    /**
     * use increment row
     *
     * @var bool
     */
    protected $hasRowIndex = false;

    /**
     * @param array $attribute
     * @return $this
     */
    public function setParentTableAttribute($attribute)
    {
        $this->parentTableAttribute = $attribute;

        return $this;
    }

    /**
     * set increment row
     *
     * @return $this
     */
    public function rowIndex()
    {
        $this->headerRowIndex = ['head' => '#'];

        $this->hasRowIndex = true;

        return $this;
    }

    /**
     * message empty  data
     *
     * @return string
     */
    protected function messageEmpty()
    {
        return "empty data!";
    }


    /**
     * set attribute for table
     *
     * @param $attributes array
     * @return $this
     */
    public function setTableAttribute($attributes)
    {
        $this->tableAttribute = $attributes;

        return $this;
    }

    /**
     * set attribute for thead
     *
     * @param $attributes
     * @return $this
     */
    public function setTheadAttribute($attributes)
    {
        $this->theadAttribute = $attributes;

        return $this;
    }

    /**
     * set attribute for tbody
     *
     * @param $attributes
     * @return $this
     */
    public function setTbodyAttribute($attributes)
    {
        $this->tbodyAttribute = $attributes;

        return $this;
    }

    /**
     * set attribute for tr
     *
     * @param $attributes
     * @return $this
     */
    public function setTrAttribute(array $attributes)
    {
        $this->trAttribute = $attributes;

        return $this;
    }

    /**
     * set any row attribute
     *
     * @param $fallback
     * @return $this
     */
    public function anyRowAttribute(\Closure $fallback)
    {
        $this->anyRowAttribute = $fallback;

        return $this;
    }


    /**
     *
     */
    protected function setTableConf()
    {
        $this->parentTableAttribute = config('srkgridview.table.parentTableAttribute');

        $this->tableAttribute = config('srkgridview.table.tableAttribute');

        $this->theadAttribute = config('srkgridview.table.theadAttribute');

        $this->tbodyAttribute = config('srkgridview.table.tbodyAttribute');

        $this->trAttribute = config('srkgridview.table.trAttribute');

        $this->thAttribute = config('srkgridview.table.thAttribute');

        $this->tdAttribute = config('srkgridview.table.tdAttribute');

        $this->hasRowIndex = config('srkgridview.table.hasRowIndex');
    }

}
