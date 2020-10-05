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
    protected $increment = 1;
    /**
     * number paginate
     *
     * @var int
     */
    protected $paginate = 20;

    /**
     * Default parent attribute for paginate link
     *
     * @var array
     */
    protected $parentPaginateAttribute = ['class' => 'ajax-grid mt-2 ml-2'];

    /**
     * get number increment in any row
     *
     */
    protected function incrementRow()
    {
        if ($this->hasRowIndex)
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

        $links = $rawHtml->startDiv($this->parentPaginateAttribute, $this->data->appends(request()->query()))->endDiv()->getHtml();

        return $links;
    }

    /**
     * default paginate
     */
    protected function paginate()
    {
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
}
