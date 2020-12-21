<?php

namespace IceProductionz\FavouriteLanguage\App\Services\Stats;

use IceProductionz\FavouriteLanguage\App\Models\Repository\Collection;
use IceProductionz\FavouriteLanguage\App\Models\Stats\Stats as StatsModel;

class Stats
{
    public function byCount(Collection $repositories): StatsModel
    {
        $stats = new StatsModel([]);

        foreach ($repositories->all() as $repository) {
            foreach ($repository->getLanguages()->all() as $language) {
                $stats->add($language->getName(), 1);
            }
        }

        return $stats;
    }

    public function byByteCode(Collection $repositories): StatsModel
    {
        $stats = new StatsModel([]);

        foreach ($repositories->all() as $repository) {
            foreach ($repository->getLanguages()->all() as $language) {
                $stats->add($language->getName(), $language->getBytesOfCode());
            }
        }

        return $stats;
    }
}
