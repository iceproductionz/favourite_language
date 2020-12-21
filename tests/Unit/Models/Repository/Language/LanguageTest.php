<?php

namespace IceProductionzTests\FavouriteLanguage\App\Unit\Models\Repository\Language;

use IceProductionz\FavouriteLanguage\App\Models\Repository\Language\Language as LanguageModel;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    public function testConstruction(): void
    {
        $uut = new LanguageModel(
            'c',
            0,
        );

        $this->assertInstanceOf(LanguageModel::class, $uut);
    }
    
    public function testGetName(): void
    {
        $name = 'PHP';
        $bytes = 0;

        $uut = new LanguageModel(
            $name,
            $bytes,
        );

        $this->assertSame($name, $uut->getName());
    }
    
    public function testGetBytes(): void
    {
        $lang = 'PHP';
        $bytes = 0;

        $uut = new LanguageModel(
            $lang,
            $bytes,
        );

        $this->assertSame($bytes, $uut->getBytesOfCode());
    }
}
