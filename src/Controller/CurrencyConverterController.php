<?php
namespace Awin\Controller;

use Awin\Service\CurrencyWebservice;

/**
 * Class CurrencyConverter
 * @package Controller
 */
class CurrencyConverterController extends CurrencyWebservice
{
    /**
     * Get the converted currency
     *
     * @param $amount
     * @return string
     */
    public function convert($amount)
    {
        return $this->getExchangeRate($amount);
    }
}