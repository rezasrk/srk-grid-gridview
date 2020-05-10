<?php

namespace SrkGrid\GridView;

class GridView
{
    protected $grid;

    protected $headColumn;

    protected $data;

    protected $indexResultQuery;

    protected $link;

    protected $attrTr;

    protected $validOption = [
        'href', 'class', 'title'
    ];

    public function __construct($data, $structure, $link = array(), $attrTr = array())
    {
        $this->data = $data;
        $this->headColumn = (array_keys($structure));
        array_unshift($this->headColumn, 'ردیف');
        if (count($link) != 0)
            array_push($this->headColumn, "فعالیت");
        $this->indexResultQuery = array_values($structure);
        $this->link = $link;
        $this->attrTr = $attrTr;
    }

    public function startTable()
    {
        $this->grid = "<hr><div class='row'><div class='col-md-12 table-responsive'><table class='table table-bordered table-sm'><thead class='thead-dark'><tr>";

    }

    public function headColumn()
    {
        $headCol = $this->headColumn;
        $this->startTable();

        foreach ($headCol as $item) {
            $this->grid .= "<th>" . $item . "</th>";
        }
        $this->grid .= "</tr></thead>";
    }

    public function isPaginate()
    {
        return method_exists($this->data, 'perPage') && method_exists($this->data, 'currentPage') ? true : false;
    }

    public function setAttrTr($attr, $resultQuery)
    {
        $attribute = "";
        foreach ($attr as $key => $value) {
            if ($key == "color" && $resultQuery->$value != "")
                $attribute .= "style=color:white;background-color:" . $resultQuery->$value . str_repeat(' ', '1');
            else
                $attribute .= $key . "=" . $resultQuery->$value . str_repeat(' ', '1');
        }
        return $attribute;
    }

    public function createChainingProperty($data, $parameter = array())
    {
        foreach ($parameter as $item)
            if(isset($data->$item))
            $data = $data->$item;

        return (is_object($data)) ? null : $data;

    }

    public function body()
    {
        $countColSpan = count($this->headColumn);
        $i = 1;
        $isPaginate = $this->isPaginate();
        if (is_array($this->data))
            $countData = count($this->data);
        else
            $countData = $this->data->count();

        if ($countData != 0) {
            foreach ($this->data as $data) {
                $isPaginate ? $row = (($this->data->perPage()) * ($this->data->currentPage() - 1) + $i) : $row = $i;
                $attrTr = $this->setAttrTr($this->attrTr, $data);
                $this->grid .= "<tr {$attrTr}>";
                $this->grid .= "<td>" . $row . "</td>";
                foreach ($this->indexResultQuery as $item) {
                    if (is_array($item)) {
                        if (strpos($item[0], '|') !== false) {
                            $resQuery = $this->createChainingProperty($data, explode('|', $item[0]));
                        } else {
                            $ss = $item[0];
                            $resQuery = $data->$ss;
                        }
                        (array_key_exists('1', $item)) ? $this->grid .= "<td>" . call_user_func($item[1], $resQuery) . "</td>" : $this->grid .= "<td>" . $resQuery . "</td>";
                    } else {
                        $resQuery = (strpos($item, '|') !== false) ? $this->createChainingProperty($data, explode('|', $item)) : $resQuery = $data->$item;
                        $this->grid .= "<td>" . $resQuery . "</td>";
                    }
                }
                if (count($this->link) != 0)
                    $this->grid .= "<td>" . $this->setLinkActivity($data) . "</td>";
                $this->grid .= "</tr>";
                $i++;
            }
        } else {
            $this->grid .= "<tr class='text-center'><td colspan='{$countColSpan}'>موردی برای نمایش یافت نشد!!</td></tr>";
        }
        $this->endTable();
        if ($isPaginate)
            $this->setPaginate();
    }

    public function setLinkActivity($bind)
    {
        $activities = "";
        $attr = "";
        foreach ($this->link as $item) {
            (array_key_exists('bind', $item)) ? $bnd = $item['bind'] : $bnd = "";
            (array_key_exists('innerHtml', $item)) ? $innerHtml = $item['innerHtml'] : $innerHtml = "";
            foreach ($item as $key => $value) {
                (isset($bind->$bnd)) ? $set = $bind->$bnd : $set = '';
                if (in_array($key, $this->validOption)) {
                    $bindData = explode('?', $value);
                    if ($key == "href" && count($bindData) == 2)
                        $attr .= $key . "='" . str_replace('?', $set, $value) . "'";
                    elseif ($key == "href")
                        $attr .= $key . "='" . str_replace('@', '?', $value) . $set . "'";
                    else
                        $attr .= $key . "='" . $value . "'";
                }

            }
            $activities .= "<a {$attr}>{$innerHtml}</a> ";
            $attr = "";
        }
        return $activities;
    }


    public function setPaginate()
    {
        $this->grid .= $this->data->appends(request()->query())->render();
    }

    public function render()
    {
        $this->headColumn();
        $this->body();
        return $this->grid;
    }

    public function endTable()
    {
        $this->grid .= "</table></div></div>";
    }

}
