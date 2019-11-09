<?php


namespace App\Service;


use App\Exception\WrongStationIdException;
use Symfony\Component\HttpClient\HttpClient;


class AirQualityRestApi
{
    const PERMITTED_STATION_IDS = ['114', '117', '129'];

    /**
     * @param string $stationId
     * @return string
     * @throws WrongStationIdException
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getCurrentStatus(string $stationId) : string
    {
        if(!$this->validateStation($stationId)) {
            throw new WrongStationIdException('Wrong station id passed.');
        }
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://api.gios.gov.pl/pjp-api/rest/aqindex/getIndex/'.$stationId);

        $stationData = $response->toArray();

        return $stationData['stIndexLevel']['indexLevelName'];
    }

    private function validateStation($stationId)
    {
        return in_array($stationId, self::PERMITTED_STATION_IDS);
    }
}