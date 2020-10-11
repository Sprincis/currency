<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CurrencyController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return new JsonResponse(array('status' => 'error', 'message' => 'Unknown method'));
    }

    /**
     * @Route("/api/currency/latest", name="api_currency_latest")
     */
    public function getCurrency()
    {
        $dm = $this->getdoctrine()->getManager();

        $uniqueCurrencies = $dm->createQuery('SELECT distinct c.currency_name FROM App\Entity\Currency c')->getResult();
        
        $currencies = array();
        foreach ($uniqueCurrencies as $uniqueCurrencie) {
            $latestValue = $this->getDoctrine()->getRepository(Currency::class)->findBy(
                ['currency_name' => $uniqueCurrencie['currency_name']],
                ['published_at' => 'DESC'],
                1
            );

            foreach ($latestValue as $currencyValue) {
                $currencies[] = [
                    'name' => $currencyValue->getCurrencyName(),
                    'value' => $currencyValue->getCurrencyValue(),
                    'date' => $currencyValue->getPublishedAt()->format('d.m.Y H:i')
                ];
            }
        }

        return new JsonResponse($currencies);
    }

     /**
     * @Route("/api/currency/single/{name}", name="api_currency_single")
     */
    public function getSingleCurrency( $name )
    {
        $singleCurrency = $this->getDoctrine()->getRepository(Currency::class)->findBy(
            ['currency_name' => strtoupper($name)]
        );

        if ( !$singleCurrency ) return new JsonResponse(array());
        
        $currencies = array();
        foreach ($singleCurrency as $currencyValue) {
            $currencies[] = [
                'name' => $currencyValue->getCurrencyName(),
                'value' => $currencyValue->getCurrencyValue(),
                'date' => $currencyValue->getPublishedAt()->format('d.m.Y')
            ];
        }

        return new JsonResponse($currencies);
    }
}
