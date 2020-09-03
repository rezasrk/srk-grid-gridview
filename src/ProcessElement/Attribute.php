<?php

namespace SrkGrid\GridView\ProcessElement;


use SrkGrid\GridView\Helper;

trait Attribute
{
    /**
     * attribute for table tag
     *
     * @var string
     */
    protected $tableAttribute = "class='table table-bordered'";
    /**
     * attribute for thead tag
     *
     * @var string
     */
    protected $theadAttribute;
    /**
     * attribute for tbody tag
     *
     * @var array
     */
    protected $tbodyAttribute;
    /**
     * attribute for tr tag
     *
     * @var array
     */
    protected $trAttribute;
    /**
     * attribute for th tag
     *
     * @var string
     */
    protected $thAttribute;
    /**
     * attribute for td tag
     *
     * @var string
     */
    protected $tdAttribute;
    /**
     * set condition or attribute for any row
     *
     * @var
     */
    protected $anyRowAttribute = null;

    /**
     * set attribute for table
     *
     * @param $attributes array
     * @return $this
     */
    public function setTableAttribute($attributes)
    {
        $this->tableAttribute = Helper::getAttribute($attributes);
        return $this;
    }

    /**
     * set attribute for thead
     *
     * @param $attributes
     * @return $this
     */
    public function setTheadAttribute($attributes)
    {
        $this->theadAttribute = Helper::getAttribute($attributes);
        return $this;
    }

    /**
     * set attribute for tbody
     *
     * @param $attributes
     * @return $this
     */
    public function setTbodyAttribute($attributes)
    {
        $this->tbodyAttribute = Helper::getAttribute($attributes);
        return $this;
    }

    /**
     * set attribute for tr
     *
     * @param $attributes
     * @return $this
     */
    public function setTrAttribute(array $attributes)
    {
        $this->trAttribute = Helper::getAttribute($attributes);
        return $this;
    }

    /**
     * set any row attribute
     *
     * @param $fallback
     * @return $this
     */
    public function anyRowAttribute(\Closure $fallback)
    {
        $this->anyRowAttribute = $fallback;
        return $this;
    }
}
