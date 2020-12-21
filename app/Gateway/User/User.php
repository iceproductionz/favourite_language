<?php

namespace IceProductionz\FavouriteLanguage\App\Gateway\User;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Middleware;

class User
{
    private Client $client;

    private int $rateLimit;

    private int $rateLimitRemaining;

    private int $rateLimitResetTime;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function listRepositories(string $owner): array
    {
        $response = $this->client
            ->request(
                'GET',
                sprintf('/users/%s/repos', $owner)
            );

        $body = (string)$response->getBody();
        
        return json_decode($body, true);
    }

    public function listLanguages(string $owner, string $repository): array
    {
        $response = $this->client
            ->request(
                'GET',
                sprintf('/repos/%s/%s/languages', $owner, $repository)
            );

        $body = (string)$response->getBody();
        
        return json_decode($body, true);
    }
}
