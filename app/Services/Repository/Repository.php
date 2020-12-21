<?php

namespace IceProductionz\FavouriteLanguage\App\Services\Repository;

use IceProductionz\FavouriteLanguage\App\Gateway\User\User;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Collection;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Repository as RepositoryModel;
use IceProductionz\FavouriteLanguage\App\Models\Repository\Language\Collection as CollectionLanguage;
use Symfony\Component\Console\Helper\Dumper;

class Repository
{
    private User $userGateway;

    public function __construct(User $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function getAll(string $owner): Collection
    {
        $list = [];

        foreach ($this->userGateway->listRepositories($owner) as $repository) {
            $list[] = new RepositoryModel(
                $repository["owner"]["login"],
                $repository["name"],
                new CollectionLanguage(),
            );
        }

        return new Collection(...$list);
    }
}
