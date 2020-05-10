# srk-grid-gridview

# installation 

` composer require srk-grid/gridview `

# example 
 $data is result queryBuilder or eloquent orm in laravel 
 
 
 A)
```php

$grid = new GridView($data,[
           'عنوان' =>'fst_title',
        ],[
            ['class'=>'btn btn-primary','href'=>route('festivalStartRegister').'@festivalId=','bind'=>'fst_id','innerHtml'=>'ثبت  نام جشنواره']
        ]);
        return $grid->render();

```
result above code 

```html

<table class="table table-bordered table-sm">
  <thead class="thead-dark">
    <tr>
      <th>ردیف</th>
      <th>عنوان</th>
      <th>فعالیت</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>یازدهمین دوره ی جشنوراه نانو</td>
      <td><a class="btn btn-primary" href="http://127.0.0.1:8000/festival/register?festivalId=2">ثبت  نام جشنواره</a> 
      </td>
    </tr>
  </tbody>
</table>

```

B)

```php
  $view = new GridView($data,
            [
                'عنوان جشنواره' => 'fst_title'
            ], [
                ['class' => 'fa fa-calendar text-dark showFestivalTime'],
                ['class' => 'fa fa-pencil text-dark', 'href' => route('festival.edit', '?'), 'bind' => 'fst_id'],
            ], ['data-id' => 'fst_id']
        );
        return $view->render();
```


result above code

```html
<table class="table table-bordered table-sm">
  <thead class="thead-dark">
    <tr>
      <th>ردیف</th>
      <th>عنوان جشنواره</th>
      <th>فعالیت</th>
    </tr>
  </thead>
  <tbody>
    <tr data-id="2">
      <td>1</td>
      <td>یازدهمین دوره ی جشنوراه نانو</td>
      <td>
        <a class="fa fa-calendar text-dark showFestivalTime"></a> 
        <a class="fa fa-pencil text-dark" href="http://127.0.0.1:8000/admin/festival/2/edit"></a> 
      </td>
    </tr>
  </tbody>
</table>

```



