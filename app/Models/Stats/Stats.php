<?php

namespace IceProductionz\FavouriteLanguage\App\Models\Stats;

class Stats
{
    private array $map;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public function add($name, int $value): void
    {
        if (!isset($this->map[$name])) {
            $this->map[$name] = $value;
        } else {
            $this->map[$name] += $value;
        }
    }

    public function asArray(): array
    {
        $list = [];
        foreach ($this->map as $key => $value) {
            $list[] = [
                $key,
                $value
            ];
        }
        return $list;
    }

    public function mostPopular(): string
    {
        $popLangauge = '';
        $popCount    = 0;

        foreach ($this->map as $key => $value) {
            if ($value > $popCount) {
                $popLangauge = $key;
                $popCount = $value;
            }
        }
        
        return $popLangauge;
    }
}
