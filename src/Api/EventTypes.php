<?php

namespace Gentor\Calendly\Api;

/**
 * Class EventTypes
 * @package Gentor\Calendly\Api
 */
class EventTypes extends Resource
{
    /**
     * @var string
     */
    protected $endPoint = '/event_types/';

    public function forOrganization($uri, $count = 100)
    {
        return $this->client->request('get', $this->endPoint, [
            'organization' => $uri,
            'count' => $count,
        ]);
    }

    public function forUser($uri, $count = 100)
    {
        return $this->client->request('get', $this->endPoint, [
            'user' => $uri,
            'count' => $count,
        ]);
    }
}