<?php

namespace Gentor\Calendly\Api;

/**
 * Class Resource
 * @package Gentor\Calendly\Api
 */
abstract class Resource
{
    /**
     * @var string
     */
    protected $endPoint;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Resource constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $uuid
     * @return mixed
     * @throws \Exception
     */
    public function get($uuid)
    {
        $uuid = $this->client->uriToUuid($uuid);

        return $this->client->request('get', $this->endPoint . $uuid)->resource;
    }
}