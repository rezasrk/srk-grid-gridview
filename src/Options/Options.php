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
     * use increment row
     *
     * @var bool
     */
    protected $hasRowIndex = false;

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
        return "موردی برای نمایش یافت نشد .";
    }

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
