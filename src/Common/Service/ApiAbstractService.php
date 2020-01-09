<?php

namespace Awin\Common\Service;
/**
 * A generic class to handle all API requests
 *
 * Class ApiAbstract
 * @package Common\Service
 */
abstract class ApiAbstractService
{
    /**
     * Sends the API request via cURL
     *
     * @param $url
     * @param array $params
     * @param string $method
     * @return float
     */
    public function sendRequest($url, $params = array(), $method = '')
    {
        return $params['value']*0.25;
    }
}