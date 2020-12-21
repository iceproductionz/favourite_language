<?php

namespace IceProductionzTests\FavouriteLanguage\App\Unit\Services\Repository;

use IceProductionz\FavouriteLanguage\App\Gateway\User\User;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Collection;
use IceProductionz\FavouriteLanguage\App\Services\Repository\Repository;
use PHPUnit\Framework\TestCase;

class RepositoryTest extends TestCase
{
    private $userGateway;

    public function setUp(): void
    {
        $this->userGateway = $this->createMock(User::class);
    }

    public function testConstruction(): void
    {
        $uut = new Repository($this->userGateway);

        $this->assertInstanceOf(Repository::class, $uut);
    }
    
    public function testGetAll(): void
    {
        $owner      = 'iceproductionz';

        $uut = new Repository($this->userGateway);
        $result = $uut->getAll($owner);

        $this->assertInstanceOf(Collection::class, $result);
    }
}
