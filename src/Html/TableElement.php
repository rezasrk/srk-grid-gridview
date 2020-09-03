<?php


namespace SrkGrid\GridView\Html;


use App\Library\GridView\ProcessElement\Attribute;

class TableElement
{
    use Attribute;

    /**
     * create table html tag
     *
     * @param $innerHtml string
     * @return string
     */
    protected function table($innerHtml)
    {
        return "<table {$this->tableAttribute}> " . $innerHtml . "</table>";
    }

    /**
     * create thead html tag
     *
     * @param $innerHtml
     * @return string
     */
    protected function thead($innerHtml)
    {
        return "<thead {$this->theadAttribute}>" . $innerHtml . "</thead>";
    }

    /**
     * create tbody html tag
     *
     * @param $innerHtml
     * @return string
     */
    protected function tbody($innerHtml)
    {
        return "<tbody {$this->tbodyAttribute}>" . $innerHtml . "</tbody>";
    }

    /**
     * create tr html tag
     *
     * @param $innerHtml
     * @return string
     */
    protected function tr($innerHtml)
    {
        return "<tr {$this->trAttribute}>" . $innerHtml . "</tr>";
    }

    /**
     * create th html tag
     *
     * @param $innerHtml
     * @return string
     */
    protected function th($innerHtml)
    {
        return "<th {$this->thAttribute}>" . $innerHtml . "</th>";
    }

    /**
     * create td html tag
     *
     * @param $innerHtml
     * @param $attribute
     * @return string
     */
    protected function td($innerHtml, $attribute = null)
    {
        $attribute = empty($attribute) ? $this->tdAttribute : $attribute;
        return "<td  {$attribute}>" . $innerHtml . "</td>";
    }

}
