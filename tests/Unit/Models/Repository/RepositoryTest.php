<?php

namespace IceProductionzTests\FavouriteLanguage\App\Unit\Models\Repository;

use IceProductionz\FavouriteLanguage\App\Models\Repository\Repository as RepositoryModel;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Language\Collection;
use PHPUnit\Framework\TestCase;

class RepositoryTest extends TestCase
{
    private $languages;

    public function setUp(): void
    {
        $this->languages = $this->createMock(Collection::class);
    }

    public function testConstruction(): void
    {
        $uut = new RepositoryModel(
            'owner-identifier',
            'owner-name',
            $this->languages,
        );

        $this->assertInstanceOf(RepositoryModel::class, $uut);
    }
    
    public function testGetOwner(): void
    {
        $owner = 'owner';
        $name  = 'name';

        $uut = new RepositoryModel(
            $owner,
            $name,
            $this->languages,
        );

        $this->assertSame($owner, $uut->getOwner());
    }
    
    public function testGetName(): void
    {
        $owner = 'owner';
        $name  = 'name';

        $uut = new RepositoryModel(
            $owner,
            $name,
            $this->languages,
        );

        $this->assertSame($name, $uut->getName());
    }
    
    public function testGetLanguages(): void
    {
        $owner = 'owner';
        $name  = 'name';

        $uut = new RepositoryModel(
            $owner,
            $name,
            $this->languages,
        );

        $this->assertSame($this->languages, $uut->getLanguages());
    }
}
