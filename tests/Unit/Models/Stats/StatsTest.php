<?php

namespace IceProductionzTests\FavouriteLanguage\App\Unit\Models\Stats;

use IceProductionz\FavouriteLanguage\App\Models\Stats\Stats;
use PHPUnit\Framework\TestCase;

class StatsTest extends TestCase
{
    public function testConstruction(): void
    {
        $uut = new Stats([]);

        $this->assertInstanceOf(Stats::class, $uut);
    }

    public function testSuccessfullyAdd(): void
    {
        $map = [
            'PHP'   => 1000,
         ];

        $uut = new Stats($map);
        $this->assertSame(
            'PHP',
            $uut->mostPopular(),
        );

        $uut->add('Dockerfile', 3000);
        $this->assertSame(
            'Dockerfile',
            $uut->mostPopular(),
        );

    }

    public function testAsArray(): void
    {
        $map = [
            'C'     => 100,
            'PHP'   => 1000,
            'F'     => 300,
            'ASP'   => 10,
            'MD'    => 30,
        ];

        $uut = new Stats($map);
        $this->assertSame(
            [
                ['C', 100],
                ['PHP', 1000],
                ['F', 300],
                ['ASP', 10],
                ['MD', 30],
            ],
            $uut->asArray(),
        );
    }

    public function testMostPopular(): void
    {
        $map = [
            'C'     => 100,
            'PHP'   => 1000,
            'F'     => 300,
            'ASP'   => 10,
            'MD'    => 30,
        ];

        $uut = new Stats($map);
        $this->assertSame(
            'PHP',
            $uut->mostPopular(),
        );
    }
}
