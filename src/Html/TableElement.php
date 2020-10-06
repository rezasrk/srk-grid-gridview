<?php


namespace SrkGrid\GridView\Html;


use SrkGrid\GridView\Core\TableConfig;
use SrkGrid\GridView\Helper;


class TableElement
{
    use TableConfig;

    /**
     * create table html tag
     *
     * @param $innerHtml string
     * @return string
     */
    protected function table($innerHtml)
    {

        $attr = Helper::getAttribute($this->tableAttribute);

        return "<table {$attr}> " . $innerHtml . "</table>";
    }

    /**
     * create thead html tag
     *
     * @param $innerHtml
     * @return string
     */
    protected function thead($innerHtml)
    {
        $attr = Helper::getAttribute($this->theadAttribute);

        return "<thead {$attr}>" . $innerHtml . "</thead>";
    }

    /**
     * create tbody html tag
     *
     * @param $innerHtml
     * @return string
     */
    protected function tbody($innerHtml)
    {
        $attr = Helper::getAttribute($this->tbodyAttribute);

        return "<tbody {$attr}>" . $innerHtml . "</tbody>";
    }

    /**
     * create tr html tag
     *
     * @param $innerHtml
     * @return string
     */
    protected function tr($innerHtml)
    {
        $attr = Helper::getAttribute($this->trAttribute);

        return "<tr {$attr}>" . $innerHtml . "</tr>";
    }

    /**
     * create th html tag
     *
     * @param $innerHtml
     * @return string
     */
    protected function th($innerHtml)
    {
        $attr = Helper::getAttribute($this->thAttribute);

        return "<th {$attr}>" . $innerHtml . "</th>";
    }

    /**
     * create td html tag
     *
     * @param $innerHtml
     * @return string
     */
    protected function td($innerHtml)
    {
        $attr = Helper::getAttribute($this->tdAttribute);

        return "<td  {$attr}>" . $innerHtml . "</td>";
    }

}
