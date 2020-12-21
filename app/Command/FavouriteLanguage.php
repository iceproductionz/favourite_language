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
use Symfony\Component\Console\Output\OutputInterface;

class FavouriteLanguage extends Command
{
    private $requireGithubUser = true;

    private string $name = 'github:favourite_langugage';

    private Repository $repository;

    public function __construct(
        Stats $stats,
        Repository $repository,
        Language $language
    ) {
        parent::__construct($this->name);

        $this->stats      = $stats;
        $this->repository = $repository;
        $this->language   = $language;
    }

    protected function configure()
    {
        $this->addArgument(
            'user',
            $this->requireGithubUser ? InputArgument::REQUIRED : InputArgument::OPTIONAL,
            'GitHub User'
        );

        $this->byType = 'byteCode';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $owner = $input->getArgument('user');

        $output->writeln('Fetching user repositories');
        $output->writeln('');
        $repositories = $this->repository->getAll($owner);

        $output->writeln('Fetching user repositories languages');
        $output->writeln('');
        $progressBar = new ProgressBar($output, $repositories->count());

        $progressBar->start();
        foreach ($repositories->all() as $repository) {
            $languages = $this->language->getAll($repository->getOwner(), $repository->getName());
            $repository->addLanguages($languages);

            $progressBar->advance();
        }
        $progressBar->finish();
        $output->writeln('');
        $output->writeln('');

        $output->writeln('Languages');
        $output->writeln('');
        if ($this->byType === 'byteCode') {
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

        $output->writeln('Your favourite language is ' . $stats->mostPopular());
        $output->writeln('');

        return Command::SUCCESS;
    }
}
