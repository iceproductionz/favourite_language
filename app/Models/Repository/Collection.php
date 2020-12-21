<?php

namespace IceProductionz\FavouriteLanguage\App\Models\Repository;

class Collection
{
    /**
     * @var Repository[] $list
     */
    private array $list;

    /**
     * @param Repository ...$list
     */
    public function __construct(Repository ...$list)
    {
        $this->list = $list;
    }

    public function all(): array
    {
        return $this->list;
    }

    public function count(): int
    {
        return \count($this->list);
    }
}
