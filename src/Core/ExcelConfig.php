<?php

namespace SrkGrid\GridView\Core;


trait ExcelConfig
{
    /**
     * check create excel or no
     *
     * @var bool
     */
    protected $createExcel = false;
    /**
     * Store file name excel
     *
     * @var string
     */
    protected $fileName = 'sample';

    /**
     * alphabet english for fill  excel cell
     *
     * @var array
     */
    protected $alphabet = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
    ];

    /**
     * attribute for parent button export excel
     *
     * @var array
     */
    protected $parentButtonAttr = ['class' => 'col mt-2 mb-2'];


    /**
     * Default attribute for button excel
     *
     * @var array
     */
    protected $buttonExcelAttribute = ['class' => 'btn btn-success'];

    /**
     * inner html button export excel
     *
     * @var string
     */
    protected $innerHtmlButtonExcel = "Export excel";

    /**
     * set direction excel file
     *
     * @var string
     */
    protected $excelDirection = 'ltr';

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
}
