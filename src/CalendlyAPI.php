<?php

namespace Gentor\Calendly;

use Gentor\Calendly\Api\Client;
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
     * @var Client
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
     * @return Client
     */
    public function client()
    {
        return $this->client;
    }

    /**
     * @return \Gentor\Calendly\Api\Users
     */
    public function users()
    {
        return new Users($this->client);
    }

    /**
     * @return \Gentor\Calendly\Api\ScheduledEvents
     */
    public function scheduledEvents()
    {
        return new ScheduledEvents($this->client);
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