<?php

declare(strict_types=1);

namespace IceProductionz\FavouriteLanguage\App\Models\Repository\Language;

class Language
{
    private string $name;
    private int $bytesOfCode;

    public function __construct(string $name, int $bytesOfCode)
    {
        $this->name        = $name;
        $this->bytesOfCode = $bytesOfCode;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBytesOfCode(): int
    {
        return $this->bytesOfCode;
    }
}
