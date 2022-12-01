<?php

namespace BrandonDetty\DynamicPropPitfall;

class MunicipalityDataGenerator
{
    private static $id = 0;

    public static function getObject()
    {
        $city = new MunicipalityData();
        $city->id = ++static::$id;
        $city->name = 'Name';
        $city->type = 'City';

        return $city;
    }
}
