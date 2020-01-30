<?php

namespace WL\Common\Service;

use Goutte\Client;
/**
 * A generic class to handle all scraping requests
 *
 * Class ApiAbstract
 * @package Common\Service
 */
abstract class ApiAbstractService
{
    /**
     * Requests contents of a web page via Goutte web scraper
     *
     * @param $site
     * @return float
     */
    public function getContents($site)
    {
        $site = 'https://videx.comesconnected.com/';
        $client = new Client();
        $crawler = $client->request('GET', $site);

        $crawler->filter('h2 > a')->each(function ($node) {
            print $node->text()."\n";
        });


    }
}