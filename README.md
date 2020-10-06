# srk-grid-gridview

this package help you to create dynamic html table by php language in framework laravel  

# Requirements
    laravel >= 5.6
    php >= 7.x
    phpspreadsheet >= 1.14
    
# Installation

` composer require srk-grid/gridview `

` php artisan vendor:publish --provider="SrkGrid\GridView\SrkGridViewProvider" `

# Quick Start

create table by blow code 

```php 
$grid = new GridView(User::query())

$table = $grid->headerColumns([
    ['head'=>'name],
    ['head'=>'username'],
])
->addColumns('name')
->addColumns('username')
->renderGrid();

```


and put $table yourself view

```php
{!! $table !!}
```

# Introduction

this package compatible by eloquent and query builder of laravel 

by default next run command vendor:publish  automatic create srkgridview.php in directory config in laravel
all table config exists in php file and you can customize default config  

this config include three part  (table - excel - paginate) for set attribute on html element of table
and excel element and paginate element and  set paginate number for result query and etc 

also for any table you can change all config exists in file srkgridview.php


# Instructions

you must call three method to create table ` ->headerColumns() ` and ` ->addColumns() ` and final ` ->renderGrid() `

### ->headerColumns()

this method  create header of table its received array inside another array as input 
 
at the moment internal array has three key 

` head ` and ` disbale ` and ` disableExcel `

#### head

this key for create name of column 

#### disable

this key for hidden column if `  ['disable'=>false] `

#### disableExcel 

this key for hidden column if  ` ['disableExcel'=>false] `


### ->addColumns()
 
this method create body of table and it takes tow type value  ` string ` and ` closure `  as input


### ->renderGrid()

this method terminate create table 



