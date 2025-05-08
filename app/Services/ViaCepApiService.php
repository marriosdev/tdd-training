<?php

namespace App\Services;

use App\Dtos\Cep\CepDto;

class ViaCepApiService
{
    public function getInfos(string $cep)
    {
        return new CepDto((object) $this->getCepFromApi($cep));
    }

    public function getCepFromApi(string $cep)
    {

    }
}
