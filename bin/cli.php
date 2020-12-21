<?php
// application.php

require __DIR__.'/../vendor/autoload.php';

use IceProductionz\FavouriteLanguage\App\Command\FavouriteLanguage;
use IceProductionz\FavouriteLanguage\App\Gateway\User\User;
use IceProductionz\FavouriteLanguage\App\Services\Repository\Language\Language;
use IceProductionz\FavouriteLanguage\App\Services\Repository\Repository;
use IceProductionz\FavouriteLanguage\App\Services\Stats\Stats;
use Symfony\Component\Console\Application;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Middleware;

$stack = new HandlerStack();
$stack->setHandler(new CurlHandler());
$stack->push(Middleware::mapRequest(function (\GuzzleHttp\Psr7\Request $request) {
    $token = file_get_contents(__DIR__ . '/../token');

    $request = $request->withHeader('Authorization', 'token ' . $token);
    $request = $request->withHeader('Accept', 'application/vnd.github.v3+json');

    return $request;
}));

$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://api.github.com',
    // You can set any number of default request options.
    'timeout'  => 2.0,
    //
    'handler' => $stack
]);


$userGateway = new User($client);
$stats = new Stats();
$repository = new Repository($userGateway);
$language = new Language($userGateway);


$application = new Application();
// ... register commands
$application->add(new FavouriteLanguage($stats, $repository, $language));

$application->run();
