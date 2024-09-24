<?php
require_once './../utils/funcoes-uteis.php';
class Cupom {
    private string $cd_cupom;
    private $dataValidade;
    private int $porcentagem;

    public function __construct() {
    }

    public function getCodigo(): string {
        return $this->cd_cupom;
    }
    public function setCodigo(string $_codigo) {
        $this->cd_cupom = $_codigo;
    }
    public function setNome(string $_nome) {
        $this->nm_cupom = $_nome;
    }
    public function getPorcentagem(): int {
        return $this->porcentagem;
    }
    function getDataValidade() {
        return $this->dataValidade;
    }
    function getDataValidadeAsTime(): int {
        return strtotime($this->dataValidade);
    }
    function getDataVendaFormatada(): string {
        return formatarData(data: strtotime($this->dataValidade));
    }
    function setDataVenda(string $_dataValidade) {
        $this->dataValidade = strtotime($_dataValidade);
    }
}