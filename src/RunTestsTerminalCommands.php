<?php

namespace App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PHPUnit\TextUI\TestRunner;

class RunTestsTerminalCommands extends Command
{
    protected function configure()
    {
        $this->setName('run-unit-tests');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $phpunit = new TestRunner();
        $phpunit->run($phpunit->getTest(TESTS_PATH, '', 'Test.php'));
    }
}