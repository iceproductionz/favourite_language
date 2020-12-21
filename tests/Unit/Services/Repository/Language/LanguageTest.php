<?php

namespace IceProductionzTests\FavouriteLanguage\App\Unit\Services\Repository\Language;

use IceProductionz\FavouriteLanguage\App\Gateway\User\User;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Language\Collection;
use IceProductionz\FavouriteLanguage\App\Services\Repository\Language\Language;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    private $userGateway;

    public function setUp(): void
    {
        $this->userGateway = $this->createMock(User::class);
    }

    public function testConstruction(): void
    {
        $uut = new Language($this->userGateway);

        $this->assertInstanceOf(Language::class, $uut);
    }
    
    public function testGetAll(): void
    {
        $owner      = 'iceproductionz';
        $repository = 'favourite_language';

        $uut = new Language($this->userGateway);
        $result = $uut->getAll($owner, $repository);

        $this->assertInstanceOf(Collection::class, $result);
    }
}
