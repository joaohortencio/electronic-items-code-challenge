<?php
namespace App;

use App\Electronics\ElectronicItem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class RunAnswersToQuestionsTerminalCommands extends Command
{
    protected function configure()
    {
        $this->setName('answers-to-questions-1-2');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $scenario = new ScenarioLoader('src/scenarios/1.yaml');
        $items = $scenario->load();

        $sortedWithoutExtras = $items->getSortedItems(SORT_NUMERIC,SORT_DESC,false);
        $sortedWithExtras = $items->getSortedItems();

        print "Answer to Question 1:\n";
        foreach ($sortedWithExtras as $electronicItem)
        {
            print "Electronic: {$electronicItem->getType()}\tPrice: {$electronicItem->getPrice()}\tExtras:".( $electronicItem->getTotalPrice() - $electronicItem->getPrice() )."\tTotal Price: {$electronicItem->getTotalPrice()}\n";
        }


        print "\n\nAnswer to Question 2\n";
        $console = current($items->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_CONSOLE));
        print "Console Price: {$console->getPrice()}\tControllers' Price:".( $console->getTotalPrice() - $console->getPrice() )."\tTotal Price: {$console->getTotalPrice()}\n";

        return 1;
    }
}