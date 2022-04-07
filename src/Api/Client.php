<?php


namespace Gentor\Calendly\Api;

use Exception;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Client as GuzzleHttpClient;

/**
 * Class Client
 * @package Gentor\Calendly\Api
 */
class Client
{
    const BASE_URI = 'https://api.calendly.com';

    /**
     * @var GuzzleHttpClient
     */
    protected $client;

    /**
     * Client constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->client = new GuzzleHttpClient(
            [
                'base_uri' => self::BASE_URI,
                'headers' => [
                    'Authorization' => "Bearer " . $config['personal_token'],
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }

    /**
     * @param string $method
     * @param string $path
     * @param array|null $params
     * @return mixed
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, string $path, array $params = null)
    {
        $uri = $this->getBaseUri()->withPath($path);

        // Build the request parameters for Guzzle
        $options = [];
        if ($params !== null) {
            $options[strtoupper($method) === 'GET' ? 'query' : 'json'] = $params;
        }

        /** @var ResponseInterface $response */
        $response = $this->client->request($method, $uri, $options);

        return $this->response($response);
    }

    /**
     * @return \GuzzleHttp\Psr7\Uri
     */
    public function getBaseUri()
    {
        return new Uri($this->client->getConfig('base_uri'));
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function response(ResponseInterface $response)
    {
        return json_decode($response->getBody());
    }

    public function uriToUuid($uri)
    {
        if (strpos($uri, self::BASE_URI) !== false) {
            $arr = explode('/', $uri);
            $uri = end($arr);
        }

        return $uri;
    }
}