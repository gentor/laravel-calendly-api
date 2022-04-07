<?php

namespace Gentor\Calendly\Api;

/**
 * Class Memberships
 * @package Gentor\Calendly\Api
 */
class Memberships extends Resource
{
    /**
     * @var string
     */
    protected $endPoint = '/organization_memberships/';

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