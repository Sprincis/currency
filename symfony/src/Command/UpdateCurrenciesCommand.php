<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;

class UpdateCurrenciesCommand extends Command
{
    protected static $defaultName = 'update-currencies';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $currencies = simplexml_load_string( file_get_contents('https://www.bank.lv/vk/ecb_rss.xml'), 'SimpleXMLElement', LIBXML_NOCDATA );

        foreach ($currencies->channel->item as $currency) {
            preg_match_all('/([A-Z]+ [0-9.]+) /m', $currency->description, $matches, PREG_SET_ORDER, 0);
            if ( !empty($matches) ) {
                foreach ($matches as $matche) {
                    $parsedCurrency = explode(' ', $matche['1']);

                    $product = new Currency();
                    $product->setCurrencyName($parsedCurrency['0']);
                    $product->setCurrencyValue($parsedCurrency['1']);
                    $product->setPublishedAt(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s', strtotime($currency->pubDate))));
                    $this->entityManager->persist($product);
                }

                $this->entityManager->flush();
            }
        }

        $io->success('Dati par valūtām ir atjaunoti.');

        return 0;
    }
}
