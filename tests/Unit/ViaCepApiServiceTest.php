<?php

namespace Tests\Unit;

use App\Dtos\Cep\CepDto;
use App\Services\ViaCepApiService;
use Tests\TestCase;

class ViaCepApiServiceTest extends TestCase
{
    public function test_should_return_cep_dto_if_cep_valid(): void
    {
        // A
        $validCep = "01001000";
        $expectedArray = [
            'cep' => '01001-000',
            'logradouro' => 'Praça da Sé',
            'complemento' => 'lado ímpar',
            'unidade' => '',
            'bairro' => 'Sé',
            'localidade' => 'São Paulo',
            'uf' => 'SP',
            'estado' => 'São Paulo',
            'regiao' => 'Sudeste',
            'ibge' => '3550308',
            'gia' => '1004',
            'ddd' => '11',
            'siafi' => '7107',
        ];

        $dtoExpected = new CepDto((object) $expectedArray);

        $serviceMock = $this->getMockBuilder(ViaCepApiService::class)
            ->onlyMethods(['getCepFromApi'])
            ->getMock();
    
        $serviceMock->expects($this->once())
            ->method('getCepFromApi')
            ->with($validCep)
            ->willReturn($expectedArray);
    
        $dtoReturned = $serviceMock->getInfos($validCep);
    
        $this->assertEquals($dtoExpected->toArray(), $dtoReturned->toArray());
    }
}
