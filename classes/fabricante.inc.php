<?php

class Fabricante {
    private int $codigo;
    private string $nome;
    private string $logradouro;
    private string $cep;
    private string $cidade;
    private string $email;
    private string $ramo;

    public function __construct() {
    }

    public function setFabricante(
        int $codigo,
        string $_nome,
        string $_logradouro,
        string $_cep,
        string $_cidade,
        string $_email,
        string $_ramo
    ) {
        $this->codigo = $codigo;
        $this->nome = $_nome;
        $this->logradouro = $_logradouro;
        $this->cep = $_cep;
        $this->cidade = $_cidade;
        $this->email = $_email;
        $this->ramo = $_ramo;
    }

    public function getCodigo(): int {
        return $this->codigo;
    }
    public function setCodigo(int $_codigo) {
        $this->codigo = $_codigo;
    }
    public function getNome(): string {
        return $this->nome;
    }
    public function setNome(string $_nome) {
        $this->nome = $_nome;
    }
    public function getLogradouro(): string {
        return $this->logradouro;
    }
    public function setLogradouro(string $_logradouro) {
        $this->logradouro = $_logradouro;
    }
    public function getCep(): string {
        return $this->cep;
    }
    public function setCep(string $_cep) {
        $this->cep = $_cep;
    }
    public function getCidade(): string {
        return $this->cidade;
    }
    public function setCidade(string $_cidade) {
        $this->cidade = $_cidade;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $_email) {
        $this->email = $_email;
    }
    public function getRamo(): string {
        return $this->ramo;
    }
    public function setRamo(string $_ramo) {
        $this->ramo = $_ramo;
    }

}

?>