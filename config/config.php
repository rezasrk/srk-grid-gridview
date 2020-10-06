<?php

return [
    /*--------------------------------------------------------
     * Default attribute for table element
     * -------------------------------------------------------
     */
    'table' => [
        /**
         * Set Attribute for div parent of table
         */
        'parentTableAttribute' => ["class" => "table-responsive"],
        /**
         * Set Attribute for table
         */
        'tableAttribute' => ["class" => "table table-striped"],
        /**
         * Set Attribute for thead of table
         */
        'theadAttribute' => [],
        /**
         * Set Attribute for tbody of table
         */
        'tbodyAttribute' => [],

        /**
         * Set Attribute for any tr of table
         */
        'trAttribute' => [],
        /**
         * Set Attribute tr of table
         */
        'thAttribute' => [],
        /**
         * Set Attribute for any th of table
         */
        'tdAttribute' => [],
        /**
         * Set increment number row for table
         */
        'hasRowIndex' => false,
    ],


    /*---------------------------------------------------------------------------
     * Default config for excel
     * --------------------------------------------------------------------------
     */
    'excel' => [
        /**
         * Check create excel or no
         */
        'createExcel' => false,
        /**
         * Default file name for excel file
         */
        'fileName' => 'excel',
        /**
         * Default column excel
         */
        'alphabet' => [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        ],
        /**
         * Default attribute for parent div excel button
         */
        'parentButtonAttr' => ['class' => 'col mt-2 mb-2'],
        /**
         * Default attribute for button excel
         */
        'buttonExcelAttribute' => ['class' => 'btn btn-success'],
        /**
         * Default inner html button export excel
         */
        'innerHtmlButtonExcel' => 'Export excel',
        /**
         * Default direction Excel
         */
        'excelDirection' => 'ltr',
    ],



   /*---------------------------------------------------------------------------
   * Default config for paginate
   * --------------------------------------------------------------------------
   */
   'paginate'=>[
       'increment'=>'1',
       'paginate'=>'20',
       'parentPaginateAttribute'=>['class' => 'ajax-grid mt-2 ml-2'],
   ]

];
