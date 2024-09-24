<?php
class Erro {
    private int $codigo;
    private string $descricao;

    function __construct(int $_codigo, string $_descricao) {
        $this->codigo = $_codigo;
        $this->descricao = $_descricao;
    }
    function geCodigo(): int {
        return $this->codigo;
    }
    function geDescricao(): string {
        return $this->descricao;
    }
}

?>