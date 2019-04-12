<?php

namespace App;

class Product
{
    public static function getTypes($prefix_name, $types_number = 16, $type_digits = 3)
    {
        foreach(range(1, $types_number) as $type)
        {
            $format = "%0{$type_digits}d";
            $types[] = $prefix_name.sprintf($format, $type);
        }
        return $types;
    }
}
