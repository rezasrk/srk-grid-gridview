<?php

namespace SrkGrid\GridView\ProcessData;


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
     * get number increment in any row
     *
     */
    protected function incrementRow()
    {
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
        return $this->data->appends(request()->query());
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
}
