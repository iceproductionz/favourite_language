<?php

namespace IceProductionzTests\FavouriteLanguage\App\Unit\Models\Repository\Language;

use IceProductionz\FavouriteLanguage\App\Models\Repository\Language\Collection;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Language\Language;
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
            $this->createMock(Language::class),
            $this->createMock(Language::class),
            $this->createMock(Language::class),
        ];

        $uut = new Collection(...$list);

        $this->assertSame($list, $uut->all());
    }
}
