<?php
namespace SmsOrange;

/**
 * Class Dispatcher
 *
 * Router for the booking service requests.
 *
 * @package SmsOrange
 */
class Dispatcher
{
    private $service;

    /**
     * Dispatcher constructor.
     *
     * @param Bookable $service instance of Cruise or Tour
     */
    public function __construct(Bookable $service)
    {
        $this->service = $service;
    }

    /**
     * Calls the injected service's search method.
     *
     * @param array $parameters search form
     * @return mixed (\Unirest\Response object)
     */
    public function search( $parameters )
    {
        return $this->service->search( $parameters );
    }

    /**
     * Handles package selection by service.
     *
     * @param array $parameters
     * @return mixed (\Unirest\Response object)
     */
    public function select( $parameters )
    {
        return $this->service->select( $parameters );
    }

    public function getComponents($parameters = false)
    {
        return $this->service->getComponents( $parameters );
    }

    public function getAvailableCategories($parameters = false)
    {
        return $this->service->getAvailableCategories( $parameters );
    }

    public function getCabins($parameters = false)
    {
        return $this->service->getCabins( $parameters );
    }

    /**
     * Handles the final booking step by service.
     *
     * @param array $parameters
     * @return mixed (\Unirest\Response object)
     */
    public function book( $parameters )
    {
        return $this->service->book( $parameters );
    }
}
