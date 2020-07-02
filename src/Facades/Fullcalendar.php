<?php

namespace SMPT\Fullcalendar\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Fullcalendar
 * @package SMPT\Fullcalendar\Facades
 */
class Fullcalendar extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-fullcalendar';
    }
}