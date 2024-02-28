<?php

namespace App\Trait;

trait ProccessSystem
{
    public static function Date($date): string
    {
        return \Carbon\Carbon::parse($date)->format('d-m-Y g:i:s');
    }
}

