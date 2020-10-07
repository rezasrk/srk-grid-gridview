# srk-grid-gridview

this package help you to create dynamic html table by php language in framework laravel  

# Requirements
    laravel >= 5.6
    php >= 7.x
    phpspreadsheet >= 1.14
    
# Introduction

this package compatible by eloquent and query builder of laravel 

**you must write query by eloquent or query builder without terminate method like ` paginate() ` or ` get() ` or ` all() `  or etc**
 
by default next run command
 
` php artisan vendor:publish --provider="SrkGrid\GridView\SrkGridViewProvider" `
  
create automatic artisan command ` php artisan make:grid  GridName ` 
and  srkgridview.php in directory config in laravel
all table config exists in php file and you can customize default config  


this config include three part  (table - excel - paginate) for set attribute on html element of table
and excel element and paginate element and  set paginate number for result query and etc 

also for any table you can change all config exists in file srkgridview.php
    
# Installation

` composer require srk-grid/gridview `

` php artisan vendor:publish --provider="SrkGrid\GridView\SrkGridViewProvider" `


# Quick Start

run command 
`
php artisan make:gird UserGrid 
`
next run command is created class **UserGrid** in app/Grid directory

```php 
namespace App\Grid;

use SrkGrid\GridView\BaseGrid;
use SrkGrid\GridView\GridView;

class UserGrid implements BaseGrid
{
    /**
     * Render method for get html view result
     *
     * @param GridView $grid
     * @param $data
     * @param $parameters
     * @return mixed
     */
    public function render($grid, $data, $parameters = null)
    {
        return $grid->headerColumns([
                   ['head'=>'name],
                   ['head'=>'username'],
               ])
               ->addColumns('name')
               ->addColumns('username')
               ->renderGrid();
    }
}
``` 

call blow method in self controller  

```php 
$data = User::query()

$view = Grid::make($data,\App\Grid\UserGrid::class);

```

and render ` $view ` in blade view 

```php 
{!! $view !!}
``` 


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



