<?php


namespace App\Service;


use Symfony\Component\HttpClient\HttpClient;


class AirQualityRestApi
{

    /**
     * @param string $stationId
     * @return string
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getCurrentStatus(string $stationId) : string
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://api.gios.gov.pl/pjp-api/rest/aqindex/getIndex/'.$stationId);

        $stationData = $response->toArray();

        return $stationData['stIndexLevel']['indexLevelName'];
    }

    /**
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getStationList()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://api.gios.gov.pl/pjp-api/rest/station/findAll');

        $stationList = $response->toArray();

        return $stationList;
    }
}