<?php

namespace Gentor\Calendly;

use Gentor\Calendly\Api\Client;
use Gentor\Calendly\Api\EventTypes;
use Gentor\Calendly\Api\Memberships;
use Gentor\Calendly\Api\ScheduledEvents;
use Gentor\Calendly\Api\Users;
use Gentor\Calendly\Api\Webhooks;

/**
 * Class CalendlyAPI
 *
 * @package Gentor\Calendly
 */
class CalendlyAPI
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var \Gentor\Calendly\Api\Client
     */
    protected $client;

    /**
     * CalendlyAPI constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
        $this->client = new Client($config);
    }

    /**
     * @return \Gentor\Calendly\Api\Client
     */
    public function client()
    {
        return $this->client;
    }

    /**
     * @param $personalToken
     * @param $organizationUri
     * @return \Gentor\Calendly\CalendlyAPI
     */
    public function changeCredentials($personalToken, $organizationUri)
    {
        $config = [
            'personal_token' => $personalToken,
            'organization_uri' => $organizationUri,
        ];

        $this->config = $config;
        $this->client = new Client($config);

        return $this;
    }

    /**
     * @return \Gentor\Calendly\Api\Users
     */
    public function users()
    {
        return new Users($this->client);
    }

    /**
     * @return \Gentor\Calendly\Api\EventTypes
     */
    public function eventTypes()
    {
        return new EventTypes($this->client);
    }

    /**
     * @return \Gentor\Calendly\Api\ScheduledEvents
     */
    public function scheduledEvents()
    {
        return new ScheduledEvents($this->client);
    }

    /**
     * @return \Gentor\Calendly\Api\Memberships
     */
    public function memberships()
    {
        return new Memberships($this->client);
    }

    /**
     * @return \Gentor\Calendly\Api\Webhooks
     */
    public function webhooks($organizationUri = null)
    {
        if (is_null($organizationUri)) {
            $organizationUri = $this->config['organization_uri'];
        }

        return new Webhooks($this->client, $organizationUri);
    }
}