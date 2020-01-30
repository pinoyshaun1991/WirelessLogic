<?php
 namespace WL\Service;

 use Goutte\Client;
 use WL\Common\Service\ScrapeService;

 /**
  * Web service returning web page content
  *
  * Class CurrencyWebservice
  * @package Service
  */
class ContentService extends ScrapeService
{

    /**
     * Get the contents of web page via scraping
     *
     * @param $site
     * @return string
     */
    public function getContent($site)
    {
        $site = 'https://videx.comesconnected.com/';
        $client = new Client();
        $crawler = $client->request('GET', $site);

        $crawler->filter('h2 > a')->each(function ($node) {
            print $node->text()."\n";
        });
        $response     = $this->sendRequest('http://exchangerate.com/api', array('value' => $currency), 'post');
        $returnString = money_format("%i", $response);

        return str_replace('GBP', '(GBP) £', $returnString);
    }
}