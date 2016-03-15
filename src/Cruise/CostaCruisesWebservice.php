<?php
namespace SmsOrange\Cruise;

use SmsOrange\Main;

class CostaCruisesWebservice extends Main
{
    private $apiUrl;
    private $apiParams;

    public function __construct($apiUrl, $apiParams)
    {
        parent::__construct();

        $this->apiUrl = $apiUrl;
        $this->apiParams = $apiParams;
    }

    public function getComponents($parameters = false)
    {
        $method = $this->getApiMethod('Cruise', __FUNCTION__);

        parse_str($parameters['data'], $params);

        $selectUrl = 'CostaCruisesWebservice/' . $params['cruise-code'] . '/';

        $body = array_merge($this->apiParams, $params);

        $resp = $this->executeRequest($this->apiUrl . $selectUrl, $method, $body);

        return $resp;
    }

    public function getAvailableCategories($parameters = false)
    {
        $method = $this->getApiMethod('Cruise', __FUNCTION__);

        parse_str($parameters['data'], $components);

        $selectUrl = 'CostaCruisesWebservice/' . $components['cruise-code'] . '/';

        $params['guests'] = json_decode($_COOKIE['cruise-guests']);

        $params['components'] = $components;

        $body = array_merge($this->apiParams, $params);
        //exit(var_dump( $body ));
        $resp = $this->executeRequest($this->apiUrl . $selectUrl, $method, $body);

        exit(var_dump( $resp ));

        return $resp;
    }

    public function getCabins()
    {

    }

}
