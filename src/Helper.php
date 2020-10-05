<?php

namespace SrkGrid\GridView;


class Helper
{
    /**
     * get attribute and set $key=$value example class=className
     *
     * @param $attributes
     * @return string
     */
    public static function getAttribute($attributes)
    {
        if(is_array($attributes)){
            $attr = '';
            foreach ($attributes as $key => $value)
                $attr .= $key . '="' . $value . '" ';
            return $attr;
        }

    }
}
