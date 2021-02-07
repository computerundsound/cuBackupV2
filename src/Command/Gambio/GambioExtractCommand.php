<?php

namespace App\Command\Gambio;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GambioExtractCommand extends Command
{
    protected static $defaultName = 'cu:gambio:extract';

    protected function configure()
    {

        $this->setDescription('Extract an Gambio Shop to this Dir');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
