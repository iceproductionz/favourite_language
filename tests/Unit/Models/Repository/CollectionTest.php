<?php

namespace IceProductionzTests\FavouriteLanguage\App\Unit\Models\Repository;

use IceProductionz\FavouriteLanguage\App\Models\Repository\Collection;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Repository;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testConstruction(): void
    {
        $uut = new Collection();

        $this->assertInstanceOf(Collection::class, $uut);
    }

    public function testAll(): void
    {
        $list = [
            $this->createMock(Repository::class),
            $this->createMock(Repository::class),
            $this->createMock(Repository::class),
        ];

        $uut = new Collection(...$list);

        $this->assertSame($list, $uut->all());
    }
}
