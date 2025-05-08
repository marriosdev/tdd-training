<?php
declare(strict_types=1);

namespace App\Dtos\Cep;

class CepDto
{
    public string $cep;
    public string $logradouro;
    public string $complemento;
    public string $unidade;
    public string $bairro;
    public string $localidade;
    public string $uf;
    public string $estado;
    public string $regiao;
    public string $ibge;
    public string $gia;
    public string $ddd;
    public string $siafi;

    public function __construct(object $data)
    {
        $this->cep = $data->cep ?? '';
        $this->logradouro = $data->logradouro ?? '';
        $this->complemento = $data->complemento ?? '';
        $this->unidade = $data->unidade ?? '';
        $this->bairro = $data->bairro ?? '';
        $this->localidade = $data->localidade ?? '';
        $this->uf = $data->uf ?? '';
        $this->estado = $data->estado ?? '';
        $this->regiao = $data->regiao ?? '';
        $this->ibge = $data->ibge ?? '';
        $this->gia = $data->gia ?? '';
        $this->ddd = $data->ddd ?? '';
        $this->siafi = $data->siafi ?? '';
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
