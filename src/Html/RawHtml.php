<?php

namespace SrkGrid\GridView\Html;


use SrkGrid\GridView\Helper;

class RawHtml
{
    protected $rawHtml = '';

    /**
     * create button html tag
     *
     * @param $attribute
     * @param $html
     * @return $this
     */
    public function a($attribute, $html)
    {
        $attr = Helper::getAttribute($attribute);

        $this->rawHtml .= " <a {$attr}>{$html}</a> ";

        return $this;
    }

    /**
     * create start div html tag
     *
     * @param array $attribute
     * @param null $innerHtml
     * @return $this
     */
    public function startDiv($attribute = array(), $innerHtml = null)
    {
        $attr = Helper::getAttribute($attribute);

        $this->rawHtml = " <div $attr>" . $innerHtml;

        return $this;
    }


    /**
     * create end div html tag
     *
     * @return $this
     */
    public function endDiv()
    {
        $this->rawHtml .= " </div>";

        return $this;
    }

    /**
     * @param array $attribute
     * @return $this
     */
    public function hr($attribute = array())
    {
        $attr = Helper::getAttribute($attribute);

        $this->rawHtml .= " <hr {$attr}>";

        return $this;
    }

    /**
     * @param array $attribute
     * @return $this
     */
    public function br($attribute = array())
    {
        $attr = Helper::getAttribute($attribute);

        $this->rawHtml .= "<br {$attr}>";

        return $this;
    }

    /**
     * create row html
     *
     * @return mixed
     */
    public function getHtml()
    {
        $html = $this->rawHtml;

        return $html;
    }
}
