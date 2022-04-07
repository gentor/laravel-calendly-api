<?php

namespace Gentor\Calendly\Api;

/**
 * Class ScheduledEvents
 * @package Gentor\Calendly\Api
 */
class ScheduledEvents extends Resource
{
    /**
     * @var string
     */
    protected $endPoint = '/scheduled_events/';

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

    public function invitees($uuid)
    {
        $uuid = $this->client->uriToUuid($uuid);

        return $this->client->request('get', $this->endPoint . $uuid . '/invitees');
    }

    public function invitee($eventUuid, $inviteeUuid)
    {
        $eventUuid = $this->client->uriToUuid($eventUuid);
        $inviteeUuid = $this->client->uriToUuid($inviteeUuid);

        return $this->client
            ->request('get', $this->endPoint . $eventUuid . '/invitees/' . $inviteeUuid)
            ->resource;
    }
}