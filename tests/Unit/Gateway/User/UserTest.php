<?php

namespace IceProductionzTests\FavouriteLanguage\App\Unit\Gateway\User;

use GuzzleHttp\Client;
use IceProductionz\FavouriteLanguage\App\Gateway\User\User;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = $this->createMock(Client::class);
    }

    public function testConstruction(): void
    {
        $uut = new User($this->client);

        $this->assertInstanceOf(User::class, $uut);
    }
    
    public function testListRepositories(): void
    {
        $data = file_get_contents(__DIR__ . '/../../../Stubs/listRepositories.json');
        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')->willReturn($data);

        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', '/users/iceproductionz/repos')
            ->willReturn($response);
        $expected = json_decode($data, true);

        $owner = 'iceproductionz';

        $uut = new User($this->client);
        $result = $uut->listRepositories($owner);

        $this->assertSame($expected, $result);
    }
    
    public function testListLanguages(): void
    {
        $owner = 'iceproductionz';
        $repo = 'favourite_language';

        $data = file_get_contents(__DIR__ . '/../../../Stubs/listLanguages.json');
        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')->willReturn($data);

        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', '/repos/' . $owner . '/' . $repo . '/languages')
            ->willReturn($response);
        $expected = json_decode($data, true);


        $uut = new User($this->client);
        $result = $uut->listLanguages($owner, $repo);

        $this->assertSame($expected, $result);
    }
}
