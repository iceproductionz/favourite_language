<?php

namespace IceProductionzTests\FavouriteLanguage\App\Unit\Command;

use IceProductionz\FavouriteLanguage\App\Command\FavouriteLanguage;
use IceProductionz\FavouriteLanguage\App\Services\Repository\Language\Language;
use IceProductionz\FavouriteLanguage\App\Services\Repository\Repository;
use IceProductionz\FavouriteLanguage\App\Services\Stats\Stats;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FavouriteLanguageTest extends TestCase
{
    private $stats;
    private $repository;
    private $language;

    public function setUp(): void
    {
        $this->stats      = $this->createMock(Stats::class);
        $this->repository = $this->createMock(Repository::class);
        $this->language   = $this->createMock(Language::class);
    }

    public function testConstuction(): void
    {
        $uut = new FavouriteLanguage(
            $this->stats,
            $this->repository,
            $this->language
        );

        $this->assertInstanceOf(FavouriteLanguage::class, $uut);
    }
    
    public function testSuccessfullyExecute(): void
    {
        $uut = new FavouriteLanguage(
            $this->stats,
            $this->repository,
            $this->language
        );
        $outputFormatter = $this->createMock(OutputFormatterInterface::class);
        $outputFormatter->method('isDecorated')->willReturn(true);
        $output = $this->createMock(OutputInterface::class);
        $output->expects($this->exactly(5))
            ->method('getFormatter')
            ->willReturn($outputFormatter);
        $output->expects($this->once())
            ->method('getVerbosity')
            ->willReturn(OutputInterface::VERBOSITY_QUIET);
        $output->expects($this->exactly(8))
            ->method('writeLn')
            ->withConsecutive(
                [
                    'Fetching user repositories' . FavouriteLanguage::NEW_LINE
                ],
                [
                    'Fetching user repositories languages' . FavouriteLanguage::NEW_LINE
                ],
                [
                    FavouriteLanguage::NEW_LINE
                ],
                [
                    'Languages' . FavouriteLanguage::NEW_LINE
                ],
                [
                    '+--+--+'
                ],
                [
                    '|<info> Language </info>|<info> Bytes Of Code </info>|'
                ],
                [
                    '+--+--+'
                ],
            );



        $uut->execute($this->mockInput(), $output);
    }

    private function mockInput(): InputInterface
    {
        $input = $this->createMock(InputInterface::class);

        $input->expects($this->once())
            ->method('getArgument')
            ->with('user')
            ->willReturn('iceproductionz');

        $input
            ->method('getOption')
            ->with('useByteCodeCount')
            ->willReturn(true);

        return $input;
    }
}
