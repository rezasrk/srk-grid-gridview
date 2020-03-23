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
        'href', 'class'
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
        $this->grid = "<div class='row'><div class='col-md-12 table-responsive'><table class='table table-bordered table-sm'><thead class='thead-dark'><tr>";

    }

    public function headColumn()
    {
        $headCol = $this->headColumn;
        $this->startTable();

        foreach ($headCol as $item) {
            $this->grid .= "<th>" . $item . "</th>";
        }
        $this->grid .= "</tr>.</thead>";
    }

    public function isPaginate()
    {
        return method_exists($this->data, 'perPage') && method_exists($this->data, 'currentPage') ? true : false;
    }

    public function setAttrTr($attr, $resultQuery)
    {
        $attribute = "";
        foreach ($attr as $key => $value) {
            if ($key == "color")
                $attribute .= "style=background-color:" . $resultQuery->$value.str_repeat(' ','1');
            else
                $attribute .= $key . "=" . $resultQuery->$value.str_repeat(' ','1');
        }
        return $attribute;
    }

    public function body()
    {
        $countColSpan = count($this->headColumn);
        $i = 1;
        $isPaginate = $this->isPaginate();
        if ($this->data->count() != 0) {
            foreach ($this->data as $data) {
                $isPaginate ? $row = (($this->data->perPage()) * ($this->data->currentPage() - 1) + $i) : $row = $i;
                $attrTr = $this->setAttrTr($this->attrTr, $data);
                $this->grid .= "<tr {$attrTr}>";
                $this->grid .= "<td>" . $row . "</td>";
                foreach ($this->indexResultQuery as $item) {
                    $this->grid .= "<td>" . $data->$item . "</td>";
                }
                if (count($this->link) != 0)
                    $this->grid .= "<td>" . $this->setLinkActivity($data) . "</td>";
                $this->grid .= "</tr>";
                $i++;
            }
        } else {
            $this->grid .= "<tr class='text-center'><td colspan='{$countColSpan}'>موردی برای نمایش بافت نشد!!</td></tr>";
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
            foreach ($item as $key => $value) {
                (isset($bind->$bnd)) ? $set = $bind->$bnd : $set = '';
                if (in_array($key, $this->validOption))
                    $attr .= $key . "='" . str_replace('?', $set, $value) . "'";
            }
            $activities .= "<a {$attr}></a> ";
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
