<?php

namespace BrandonDetty\DynamicPropPitfall;

class PersonDataGenerator
{
    private static $id = 0;

    public static function getObject()
    {
        $person = new PersonData();
        $person->id = ++static::$id;
        $person->first_name = 'First';
        $person->middle_initial =  'M';
        $person->last_name = 'Last';
        $person->date_of_birth = '1970-01-01';
        $person->country = 'BE';

        $person->field_a = 'a';
        $person->field_b = 'b';
        $person->field_c = 'c';
        $person->field_d = 'd';
        $person->field_e = 'e';
        $person->field_f = 'f';
        $person->field_g = 'g';
        $person->field_h = 'h';
        $person->field_i = 'i';
        $person->field_j = 'j';
        $person->field_k = 'k';
        $person->field_l = 'l';
        $person->field_m = 'm';
        $person->field_n = 'n';
        $person->field_o = 'o';
        $person->field_p = 'p';
        $person->field_q = 'q';
        $person->field_r = 'r';
        $person->field_s = 's';
        $person->field_t = 't';
        $person->field_u = 'u';
        $person->field_v = 'v';
        $person->field_w = 'w';
        $person->field_x = 'x';
        $person->field_y = 'y';
        $person->field_z = 'z';

        return $person;
    }
}
