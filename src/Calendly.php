<?php

namespace Gentor\Calendly;

use Illuminate\Support\Facades\Facade;

/**
 * Class Calendly
 *
 * @package Gentor\Calendly
 * @see \Gentor\Calendly\CalendlyAPI
 */
class Calendly extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'calendly';
    }
}
