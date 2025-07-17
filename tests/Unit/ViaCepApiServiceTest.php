<?php

namespace Tests\Unit;

use App\Dtos\Cep\CepDto;
use App\Services\ViaCepApiService;
use RuntimeException;
use stdClass;
use Tests\TestCase;

class ViaCepApiServiceTest extends TestCase
{
    public function test_should_return_cep_dto_if_cep_valid(): void
    {
        // Arange
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
        
        $viaCepResponse = new stdClass();
        $viaCepResponse->statusCode = 200;
        $viaCepResponse->data = $expectedArray;

        $dtoExpected = new CepDto((object) $expectedArray);
        
        $serviceMock = $this->getMockBuilder(ViaCepApiService::class)
            ->onlyMethods(['getCepFromApi'])
            ->getMock();

        $serviceMock->expects($this->once())
            ->method(constraint: 'getCepFromApi')
            ->with(arguments: $validCep)
            ->willReturn($viaCepResponse);
    
        // Action
        $dtoReturned = $serviceMock->getInfos($validCep);
    
        // Assert
        $this->assertEquals($dtoExpected->toArray(), $dtoReturned->toArray());
    }

    public function test_should_throw_argument_exception_if_cep_invalid(): void
    {
        // Arange
        $invalidCep = "2319387123";
       
        $viaCepApiResponse = new stdClass();
        $viaCepApiResponse->statusCode = 404;
        
        $serviceMock = $this->getMockBuilder(ViaCepApiService::class)
            ->onlyMethods(['getCepFromApi'])
            ->getMock();

        $serviceMock->expects($this->once())
            ->method('getCepFromApi')
            ->with($invalidCep)
            ->willReturn($viaCepApiResponse);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("Ocorreu um erro ao buscar o CEP");

        // Assert
        $serviceMock->getInfos($invalidCep);
    }
}
