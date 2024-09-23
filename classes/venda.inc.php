<?php
require_once './../utils/funcoes-uteis.php';
class Venda {
    private int $id_venda;
    private string $cpf_cliente;
    private $dataVenda;
    private float $valorTotal;

    public function __construct(string $cpf, float $valorTotal) {
        $this->cpf_cliente = $cpf;
        $this->valorTotal = $valorTotal;
        $this->dataVenda = time();
    }

    public function getId(): int {
        return $this->id_venda;
    }
    public function setId(int $id) {
        $this->id_venda = $id;
    }
    public function getCpfCliente(): string {
        return $this->cpf_cliente;
    }
    public function getValorTotal(): float {
        return $this->valorTotal;
    }
    function getDataVenda() {
        return $this->dataVenda;
    }
    function getDataVendaFormatada(): string {
        return formatarData(strtotime($this->dataVenda));
    }
    function setDataVenda(string $data_fabricacao) {
        $this->data_fabricacao = strtotime($data_fabricacao);
    }
}