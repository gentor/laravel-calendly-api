<?php

namespace Gentor\Calendly\Api;

/**
 * Class Webhooks
 * @package Gentor\Calendly\Api
 */
class Webhooks extends Resource
{
    /**
     * @var string
     */
    protected $endPoint = '/webhook_subscriptions/';

    protected $organizationUri;

    /**
     * Resource constructor.
     * @param Client $client
     * @param $organizationUri
     */
    public function __construct(Client $client, $organizationUri)
    {
        $this->organizationUri = $organizationUri;
        $this->client = $client;
    }

    public function list($count = 100)
    {
        return $this->client->request('get', $this->endPoint, [
            'organization' => $this->organizationUri,
            'count' => $count,
            'scope' => 'organization',
        ]);
    }

    public function subscribe($url, $signingKey = null)
    {
        $params = [
            'url' => $url,
            'organization' => $this->organizationUri,
            'scope' => 'organization',
            'events' => [
                "invitee.created",
                "invitee.canceled"
            ]
        ];

        if (!is_null($signingKey)) {
            $params['signing_key'] = $signingKey;
        }

        return $this->client->request('post', $this->endPoint, $params)->resource;
    }

    public function unsubscribe($uuid)
    {
        $uuid = $this->client->uriToUuid($uuid);

        return $this->client->request('delete', $this->endPoint . $uuid);
    }
}