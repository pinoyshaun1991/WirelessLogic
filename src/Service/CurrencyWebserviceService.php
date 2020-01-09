<?php
 namespace Awin\Service;

 use Awin\Common\Service\ApiAbstractService;

 /**
  * Dummy web service returning random exchange rates
  *
  * Class CurrencyWebservice
  * @package Service
  */
class CurrencyWebserviceService extends ApiAbstractService
{
    public function __construct()
    {
        setlocale(LC_MONETARY,"en_GB");
    }

    /**
     * Get the GBP exchange rate from given value
     *
     * @param $currency
     * @return string
     */
    public function getExchangeRate($currency)
    {
        $response     = $this->sendRequest('http://exchangerate.com/api', array('value' => $currency), 'post');
        $returnString = money_format("%i", $response);

        return str_replace('GBP', '(GBP) £', $returnString);
    }
}