<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const NUMBER_OF_TYPES = 16;
    const PREFIX_PRODUCT_NAME = 'A';
    const NUMBER_OF_DIGITS = 3;

    public static function getTypes()
    {
        foreach(range(1, self::NUMBER_OF_TYPES) as $number)
        {
            $types[] = self::PREFIX_PRODUCT_NAME.str_pad($number, self::NUMBER_OF_DIGITS, '0', STR_PAD_LEFT);
        }
        return $types;
    }
}
