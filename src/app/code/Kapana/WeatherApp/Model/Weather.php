<?php

namespace Kapana\WeatherApp\Model;

use Magento\Framework\HTTP\Client\Curl;

class Weather
{
    /**
     * @var Curl
     */
    protected $curl;

    /**
     * OpenWeatherMap API key
     *
     * @var string
     */
    protected $apiKey;

    public function __construct(
        Curl $curl,
             $apiKey = '94c798d64edd1e92ab641543afb45332' // Ideally, store this in configuration!
    )
    {
        $this->curl = $curl;
        $this->apiKey = $apiKey;
    }

    /**
     * Fetch weather data for a given city
     *
     * @param string $city
     * @return array
     */
    public function getWeatherByCity($city)
    {
        // Build URL – you can also add country codes or other parameters
        $url = sprintf(
            'http://api.openweathermap.org/data/2.5/weather?q=%s&appid=%s',
            urlencode($city),
            $this->apiKey
        );

        $this->curl->get($url);
        $response = $this->curl->getBody();
        return json_decode($response, true);
    }
}
