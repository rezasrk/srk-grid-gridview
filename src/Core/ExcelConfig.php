<?php

namespace SrkGrid\GridView\Core;


trait ExcelConfig
{
    /**
     * check create excel or no
     *
     * @var bool
     */
    protected $createExcel;
    /**
     * Store file name excel
     *
     * @var string
     */
    protected $fileName;

    /**
     * alphabet english for fill  excel cell
     *
     * @var array
     */
    protected $alphabet;

    /**
     * attribute for parent button export excel
     *
     * @var array
     */
    protected $parentButtonAttr;


    /**
     * Default attribute for button excel
     *
     * @var array
     */
    protected $buttonExcelAttribute;

    /**
     * inner html button export excel
     *
     * @var string
     */
    protected $innerHtmlButtonExcel;

    /**
     * set direction excel file
     *
     * @var string
     */
    protected $excelDirection;

    /**
     * set header column for excel if change priority fill excel column
     *
     * @param $header
     * @return $this
     */
    public function setHeaderColumnExcel($header)
    {
        $this->alphabet = $header;

        return $this;
    }

    /**
     * add header column for excel  if number column more than 26
     *
     * @param array $header
     * @return $this
     */
    public function addHeaderColumnExcel($header)
    {
        $this->alphabet = collect($this->alphabet)->merge($header)->toArray();

        return $this;
    }

    /**
     * @param array $attribute
     * @return $this
     */
    public function setParentButtonExcelAttribute($attribute)
    {
        $this->parentButtonAttr = $attribute;

        return $this;
    }

    /**
     * @param array $attribute
     * @return $this
     */
    public function setButtonExcelAttribute($attribute)
    {
        $this->buttonExcelAttribute = $attribute;

        return $this;
    }

    /**
     * set inner html for excel button
     *
     * @param $innerHtml
     * @return $this
     */
    public function setInnerHtmlButtonExcel($innerHtml)
    {
        $this->innerHtmlButtonExcel = $innerHtml;

        return $this;
    }

    /**
     * change direction excel file
     *
     * @param $direction
     * @return $this
     */
    public function setExcelDirection($direction)
    {
        $this->excelDirection = $direction;

        return $this;
    }


    protected function setExcelConf()
    {
        $this->createExcel = config('srkgridview.excel.createExcel');

        $this->fileName = config('srkgridview.excel.fileName');

        $this->alphabet = config('srkgridview.excel.alphabet');

        $this->parentButtonAttr = config('srkgridview.excel.parentButtonAttr');

        $this->buttonExcelAttribute = config('srkgridview.excel.buttonExcelAttribute');

        $this->innerHtmlButtonExcel = config('srkgridview.excel.innerHtmlButtonExcel');

        $this->excelDirection = config('srkgridview.excel.excelDirection');
    }
}
