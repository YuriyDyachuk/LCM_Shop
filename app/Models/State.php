<?php


namespace App\Models;


class State
{
    public static function list()
    {
        return array_column(config('states.usa'), 'name');
    }

}
