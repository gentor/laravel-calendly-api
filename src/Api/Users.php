<?php

namespace Gentor\Calendly\Api;

/**
 * Class Users
 * @package Gentor\Calendly\Api
 */
class Users extends Resource
{
    /**
     * @var string
     */
    protected $endPoint = '/users/';

    public function me()
    {
        return $this->get('me');
    }
}