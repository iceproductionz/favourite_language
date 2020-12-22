<?php

declare(strict_types=1);

namespace IceProductionz\FavouriteLanguage\App\Command;

use IceProductionz\FavouriteLanguage\App\Services\Repository\Language\Language;
use IceProductionz\FavouriteLanguage\App\Services\Repository\Repository;
use IceProductionz\FavouriteLanguage\App\Services\Stats\Stats;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FavouriteLanguage extends Command
{
    const NEW_LINE = "\n";

    private $requireGithubUser = true;

    private string $name = 'github:favourite_language';

    private Repository $repository;

    private $byByteCodeType;

    public function __construct(
        Stats $stats,
        Repository $repository,
        Language $language
    ) {
        parent::__construct($this->name);

        $this->stats      = $stats;
        $this->repository = $repository;
        $this->language   = $language;
        $this->byByteCodeType = false;
    }

    protected function configure()
    {
        $this->addArgument(
            'user',
            $this->requireGithubUser ? InputArgument::REQUIRED : InputArgument::OPTIONAL,
            'GitHub User'
        );
        
        $this->addOption('useByteCodeCount', 'b', InputOption::VALUE_OPTIONAL, '', false);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $owner = $input->getArgument('user');
        $this->byByteCodeType = $input->getOption('useByteCodeCount');


        $output->writeln('Fetching user repositories' . self::NEW_LINE);
        $repositories = $this->repository->getAll($owner);

        $output->writeln('Fetching user repositories languages' . self::NEW_LINE);
        $progressBar = new ProgressBar($output, $repositories->count());

        $progressBar->start();
        foreach ($repositories->all() as $repository) {
            $languages = $this->language->getAll($repository->getOwner(), $repository->getName());
            $repository->addLanguages($languages);

            $progressBar->advance();
        }
        $progressBar->finish();
        $output->writeln(self::NEW_LINE);

        $output->writeln('Languages' . self::NEW_LINE);
        if ($this->byByteCodeType) {
            $stats = $this->stats->byByteCode($repositories);
            $headers = ['Language', 'Bytes Of Code'];
        } else {
            $stats = $this->stats->byCount($repositories);
            $headers = ['Language', 'Count'];
        }
        

        $table = new Table($output);
        $table
            ->setHeaders($headers)
            ->setRows($stats->asArray());
        $table->render();

        $output->writeln('Your favourite language is ' . $stats->mostPopular() . self::NEW_LINE);

        return Command::SUCCESS;
    }
}
