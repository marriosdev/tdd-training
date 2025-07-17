<?php
declare(strict_types=1);

namespace App\Services;

use App\Dtos\Cep\CepDto;
use RuntimeException;
use stdClass;

class ViaCepApiService
{
    /**
     * 
     * @param string $cep
     * @return CepDto
     */
    public function getInfos(string $cep)
    {
        $viaCepResponse = $this->getCepFromApi($cep);

        if($viaCepResponse->statusCode !== 200) {
            throw new RuntimeException("Ocorreu um erro ao buscar o CEP");
        }

        return new CepDto((object) $viaCepResponse->data);
    }

    public function getCepFromApi(string $cep): stdClass
    {
        return new stdClass();
    }
}
