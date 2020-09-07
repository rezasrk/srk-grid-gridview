# srk-grid-gridview

# Requirements
    bootstrap >=3
    laravel >= 5.x
    php >= 7.x
    
# Installation

` composer require srk-grid/gridview `

# Usage
this package support eloquent and query builder of laravel 

create object from GridView and pass query builder or eloquent of laravel without terminate method like paginate , get , first .

```php
$date = new GridView(User::query())

$data->headerColumns([
    ['head'=>'name],
    ['head'=>'username'],
])
->addColumns('name')
->addColumns('username')
->renderGrid();

```

### custom number paginate
by default number of paginate for gird equal 20
but if you need to change it use  
```php 
setPaginateNumber(customNumber) 
``` 


### use closure in method addColumns
if use eloquent relation you  need to use closure in method addColumns for show result 
```php
->addColumns(function($query){
    $query->person->national_code;
})
``` 


### disable column
if you need to disable column can use 
```php
disable=>false 
```
in headColumns method

```php
->headerColumns([
    ['head'=>'name],
    ['head'=>'username','disable'=>false],
    ['head'=>'national code'],
])
```


### use row increment
if you need to use row increment can you use 
```php
->rowIndex()
```


### set attribute for any row 

if you need to set attribute for any row can use 

```php
->anyRowAttribute(function($query){
    if($query->email == 'admin')
        return "style='background-color:red'";
})
```
the result above code any row to email equal admin  set background color red 


### add attribute for thead tbody table
 
set attribute for table
```php
setTableAttribute(['class'=>'class-name','id'=>'id-name'])
```
 
set attribute for thead 
```php
->setTrAttribute(['class' => 'class-name','id'='id-name'])
``` 

set attribute for tbody
```php
->setTheadAttribute(['class' => 'class-name','id'=>'id-name'])
```







