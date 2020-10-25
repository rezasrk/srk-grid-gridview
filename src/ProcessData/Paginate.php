<?php

namespace SrkGrid\GridView\ProcessData;


use SrkGrid\GridView\Factory;
use SrkGrid\GridView\Html\RawHtml;

trait Paginate
{
    /**
     * increment row number
     *
     * @var int
     */
    protected $increment;
    /**
     * number paginate
     *
     * @var int
     */
    protected $paginate;
    /**
     * @var bool
     */
    protected $isTerminateGet = false;

    /**
     * Default parent attribute for paginate link
     *
     * @var array
     */
    protected $parentPaginateAttribute;

    /**
     * get number increment in any row
     *
     */
    protected function incrementRow()
    {
        if ($this->hasRowIndex && !$this->isTerminateGet)
            array_unshift($this->bodyTable,
                ["incrementRow" => $this->data->perPage() * ($this->data->currentPage() - 1)]);
    }

    /**
     * create link paginate
     *
     * @return string
     */
    protected function linkPage()
    {
        /** @var RawHtml $rawHtml */
        $rawHtml = Factory::make(RawHtml::class);
        $links = "";
        if (!$this->isTerminateGet)
            $links = $rawHtml->startDiv($this->parentPaginateAttribute, $this->data->appends(request()->query()))->endDiv()->getHtml();

        return $links;
    }

    /**
     * default paginate
     */
    protected function paginate()
    {
        $this->isTerminateGet ?
            $this->data = $this->data->get() :
            $this->data = $this->data->paginate($this->paginate);
    }

    /**
     * set number paginate
     *
     * @param $num
     * @return $this
     */
    public function setPaginateNumber($num)
    {
        $this->paginate = $num;

        return $this;
    }

    /**
     * @param array $attribute
     * @return $this
     */
    public function setParentPaginateAttribute($attribute)
    {
        $this->parentPaginateAttribute = $attribute;

        return $this;
    }

    /**
     * Add attribute for parent paginate
     *
     * @param $attribute
     * @return $this
     */
    public function addParentPaginateAttribute($attribute)
    {
        $this->parentPaginateAttribute = collect($this->parentPaginateAttribute)->merge($attribute)->toArray();

        return $this;
    }

    protected function setPaginateConf()
    {
        $this->increment = config('srkgridview.paginate.increment');

        $this->paginate = config('srkgridview.paginate.paginate');

        $this->parentPaginateAttribute = config('srkgridview.paginate.parentPaginateAttribute');

    }

    /**
     * Set get() method for terminate
     *
     * @return $this
     */
    public function setTerminateGet()
    {
        $this->isTerminateGet = true;

        return $this;
    }
}
