<?php

namespace IceProductionzTests\FavouriteLanguage\App\Unit\Services\Stats;

use IceProductionz\FavouriteLanguage\App\Models\Repository\Collection;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Repository;
use IceProductionz\FavouriteLanguage\App\Models\Stats\Stats as StatsModel;
use IceProductionz\FavouriteLanguage\App\Services\Stats\Stats;
use PHPUnit\Framework\TestCase;

class StatsTest extends TestCase
{
    private $repositories;

    public function setUp(): void
    {
        $this->repositories = $this->mockRepositoryCollection();
    }

    public function testByCount(): void
    {
        $uut = new Stats();
        $result = $uut->byCount($this->repositories);

        $this->assertInstanceOf(StatsModel::class, $result);
    }

    public function testByteCode(): void
    {
        $uut = new Stats();
        $result = $uut->byByteCode($this->repositories);

        $this->assertInstanceOf(StatsModel::class, $result);
    }

    private function mockRepositoryCollection(): Collection
    {
        $collection = [
            $this->mockRepository(),
            $this->mockRepository(),
            $this->mockRepository(),
            $this->mockRepository(),
            $this->mockRepository(),
        ];

        return new Collection(...$collection);
    }

    private function mockRepository(): Repository
    {
        return $this->createMock(Repository::class);
    }
}
