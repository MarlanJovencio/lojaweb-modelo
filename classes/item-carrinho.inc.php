<?php
require_once 'produto.inc.php';

class ItemCarrinho {
    private int $id_item;
    private Produto $produto;
    private int $id_produto;
    private int $quantidade;
    private float $valorTotal;
    private int $id_venda;

    function __construct(
        Produto $produto
    ) {
        $this->produto = $produto;
        $this->valorTotal = $produto->getPreco();
        $this->quantidade = 1;
    }
    function getId(): float {
        return $this->id_item;
    }
    function setId(int $id): void {
        $this->id_item = $id;
    }

    function adicionarQuantidade(): int {
        $this->quantidade = $this->quantidade + 1;
        $this->valorTotal = $this->quantidade * $this->produto->getPreco();
        return $this->quantidade;
    }
    function removeQuantidade(): int {
        $this->quantidade = $this->quantidade - 1;
        $this->quantidade = $this->quantidade < 0 ? 0 : $this->quantidade;
        $this->valorTotal = $this->quantidade * $this->produto->getPreco();
        return $this->quantidade;
    }

    function getProdutoId(): int {
        if(isset($this->produto) && $this->produto!==null) return $this->produto->getId();

        return $this->id_produto;
    }
    function getProdutoNome(): string {
        return $this->produto->getNome();
    }
    function getProdutoFabricanteNome(): string {
        return $this->produto->getNomeFabricante();
    }
    function getProdutoPreco(): float {
        return $this->produto->getPreco();
    }
    function getProdutoReferencia(): string {
        return $this->produto->getReferencia();
    }
    function getProdutoNomeFabricante(): string {
        return $this->produto->getNomeFabricante();
    }
    function getQuantidade(): int {
        return $this->quantidade;
    }
    function getSubtotal(): float {
        return $this->quantidade * $this->produto->getPreco();
    }
    function updateProduto(Produto $prod): void {
        $this->produto = $prod;
    }
    function temEstoque(): bool {
        return $this->produto->getEstoque() >= $this->getQuantidade();
    }
}