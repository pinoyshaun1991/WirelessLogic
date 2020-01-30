<?php

namespace WL\Common\Service;

use Goutte\Client;

/**
 * A generic class to handle all scraping requests
 *
 * Class ScrapeService
 * @package WL\Common\Service
 */
abstract class ScrapeService
{
    /**
     * @var array
     */
    public $data;

    /**
     * ScrapeService constructor.
     */
    public function __construct()
    {
        $this->data = array();
    }

    /**
     * Requests contents of a web page via Goutte web scraper
     *
     * @param $site
     * @param $selector
     * @param $key
     * @return array
     */
    public function getContents($site, $selector, $key)
    {
        $client  = new Client();
        $crawler = $client->request('GET', $site);

        $crawler->filter($selector)->each(function ($node) use ($key) {
            $this->data[$key][] = $node->text();
        });

        $data = $this->prepareData($this->data);

        return $data;
    }

    /**
     * Prepare raw data array
     *
     * @param $dataArray
     * @return array
     */
    private function prepareData($dataArray)
    {
        $returnedData = array();

        foreach ($dataArray as $key => $rawData) {
            foreach ($rawData as $dataKey => $data) {

                if ($key === 'discount') {
                    $dataKey += 3;
                }

                $returnedData[$dataKey][$key] = $data;
            }
        }

        return $returnedData;
    }
}