<?php

namespace App\Service;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class QueryService
{
    private $baseURLApiViaCEP = 'viacep.com.br/ws/';
    private $baseURLApiBrasilApi = 'https://brasilapi.com.br/api/cep/v2/';
    private $baseURLApiCEPla = 'http://cep.la/';

    public function queryZipCode($cep)
    {
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get(self::formatEndPoint($this->baseURLApiViaCEP, self::formatCEP($cep, true), '/json')),
            $pool->get(self::formatEndPoint($this->baseURLApiBrasilApi, self::formatCEP($cep, true))),
            $pool->get(self::formatEndPoint($this->baseURLApiCEPla, self::formatCEP($cep, true))),
        ]);

        foreach ($responses as $singleResponse) {
            if ($singleResponse->status() == 200) {
                return $singleResponse->json();
            }
        }

        return response()->json(
            ['error' => 'CEP não foi localizado em nenhuma base de dados'],
            422
        );
    }

    private function formatEndPoint($baseURL, $cep, $finalEndPoint = '')
    {
        return $baseURL . $cep . $finalEndPoint;
    }

    private function formatCEP($cep, $onlyNumbers = false)
    {
        if ($onlyNumbers)
            return str_replace('-', '', $cep);

        if (!strpos($cep, '-')) {
            return substr_replace($cep, '-', 5, 0);
        }
        return $cep;
    }
}
