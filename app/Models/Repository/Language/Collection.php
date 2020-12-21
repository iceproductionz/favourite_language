<?php

namespace IceProductionz\FavouriteLanguage\App\Models\Repository\Language;

class Collection
{
    /**
     * @var Language[] $list
     */
    private array $list;

    /**
     * @param Language ...$list
     */
    public function __construct(Language ...$list)
    {
        $this->list = $list;
    }

    public function all(): array
    {
        return $this->list;
    }
}
