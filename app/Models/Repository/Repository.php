<?php

namespace IceProductionz\FavouriteLanguage\App\Models\Repository;

use IceProductionz\FavouriteLanguage\App\Models\Repository\Language\Collection;

class Repository
{
    private string $owner;
    private string $name;
    private Collection $languages;

    /**
     * @param string $username
     * @param string $name
     * @param string $languagesUrl
     */
    public function __construct(string $owner, string $name, Collection $languages)
    {
        $this->owner        = $owner;
        $this->name         = $name;
        $this->languages    = $languages;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function addLanguages(Collection $languages): void
    {
        $this->languages = $languages;
    }

    public function getLanguages(): Collection
    {
        return $this->languages;
    }
}
