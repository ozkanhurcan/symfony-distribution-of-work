<?php


namespace App\Service;

use App\Service\Interfaces\WorksProviderInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


class WorksGlobalProvider implements WorksProviderInterface
{
    public function __construct()
    {
    }

    public function toArray()
    {
        $httpClient = HttpClient::create();
        try {
            $response = $httpClient->request('GET', 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7');
        } catch (\Exception $e) {
            return $e;
        }

        $responseArray = [];
        foreach ($response->toArray() as $key => $value) {
            $parentKey = array_keys($value)[0];
            $responseArray[$key] = $value[$parentKey];
            $responseArray[$key]['title'] = $parentKey;
            $responseArray[$key]['required_load'] = $value[$parentKey]['estimated_duration'] * $value[$parentKey]['level'];
        }
        usort($responseArray, function ($item1, $item2) {
            return $item2['required_load'] <=> $item1['required_load'];
        });

        return $responseArray;
    }
}