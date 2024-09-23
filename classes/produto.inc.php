<?php

require_once './../utils/funcoes-uteis.php';

class Produto{

    private $produto_id;
    private $nome;
    private $data_fabricacao;
    private $preco;
    private $estoque;
    private $descricao;
    private $resumo;
    private $referencia;
    private int $cod_fabricante;
    private string $nome_fabricante;

    function __construct(){}

    function setProduto(
        string $nome,
        string $data_fabricacao,
        float $preco,
        int $estoque,
        string $descricao,
        string $resumo,
        string $referencia,
        int $cod_fabricante
    ){
        $this->nome = $nome;
        $this->data_fabricacao = strtotime($data_fabricacao);
        $this->preco = $preco;
        $this->estoque = $estoque;
        $this->descricao = $descricao;
        $this->resumo = $resumo;
        $this->referencia = $referencia;
        $this->cod_fabricante = $cod_fabricante;
    }

    function getId(): int {
        return (int) $this->produto_id;
    }

    function getNome(){
        return $this->nome;
    }
    function setNome(string $nome){
        $this->nome = $nome;
    }

    function getDataFabricacao(){
        return $this->data_fabricacao;
    }
    function getDataFabricacaoFormatada(): string {
        return formatarData(strtotime($this->data_fabricacao));
    }
    function setDataFabricacao(string $data_fabricacao){
        $this->data_fabricacao = strtotime($data_fabricacao);
    }

    function getPreco(){
        return $this->preco;
    }
    function setPreco(float $preco){
        $this->preco = $preco;
    }

    function getEstoque(){
        return $this->estoque;
    }
    function setEstoque(int $estoque){
        $this->estoque = $estoque;
    }

    function getDescricao(){
        return $this->descricao;
    }
    function setDescricao(string $descricao){
        $this->descricao = $descricao;
    }

    function getResumo(){
        return $this->resumo;
    }
    function setResumo(string $resumo){
        $this->resumo = $resumo;
    }

    function getReferencia(){
        return $this->referencia;
    }
    function setReferencia(string $referencia){
        $this->referencia = $referencia;
    }

    function getCodFabricante(){
        return $this->cod_fabricante;
    }
    function setCodFabricante(int $cod_fabricante){
        $this->cod_fabricante = $cod_fabricante;
    }

    function getNomeFabricante(){
        return $this->nome_fabricante;
    }

}

?>