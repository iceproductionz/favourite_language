<?php

namespace IceProductionz\FavouriteLanguage\App\Services\Repository\Language;

use IceProductionz\FavouriteLanguage\App\Gateway\User\User;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Language\Language as LanguageModel;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Language\Collection;

class Language
{
    private User $userGateway;

    public function __construct(User $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function getAll(string $owner, string $repository): Collection
    {
        $list = [];

        foreach ($this->userGateway->listLanguages($owner, $repository) as $langauge => $bytes) {
            $list[] = new LanguageModel(
                $langauge,
                $bytes,
            );
        }

        return new Collection(...$list);
    }
}
