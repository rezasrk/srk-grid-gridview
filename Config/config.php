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
    ]
];
