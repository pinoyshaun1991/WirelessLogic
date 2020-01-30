<?php
 namespace WL\Service;

 use WL\Common\Service\ScrapeService;

 /**
  * Service returning web page content
  *
  * Class ContentService
  * @package WL\Service
  */
class ContentService extends ScrapeService
{
    public $responseArray = array(
        'optionTitle' => 'section .header',
        'description' => 'section .package-name',
        'price'       => 'section .price-big',
        'discount'    => 'section .package-price p'
    );

    /**
     * Get the contents of web page via scraping
     *
     * @param $site
     * @return array
     */
    public function getContent($site)
    {
        $response = array();

        foreach ($this->responseArray as $key => $selector) {
            $response = $this->getContents($site, $selector, $key);
        }

        return $response;
    }
}