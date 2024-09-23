<?php
require_once 'conexao.inc.php';
require_once '../classes/venda.inc.php';
require_once '../classes/item-carrinho.inc.php';

class VendaDAO {
    private $con;

    function __construct() {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    private function converterDataMysql($data) {
        return date('Y-m-d', $data);
    }

    public function insert(Venda $venda, array $carrinho) {
        $stmt = $this->con->prepare(
            "INSERT INTO vendas (cpf_cliente, dataVenda, valorTotal) VALUES (?, ?, ?)"
        );
        $stmt->bindValue(1, $venda->getCpfCliente());
        $stmt->bindValue(2, $this->converterDataMysql($venda->getDataVenda()));
        $stmt->bindValue(3, $venda->getValorTotal());
        $stmt->execute();
        $idVenda = $this->con->lastInsertId();
        if ($idVenda != false) {
            $venda->setId((int) $idVenda);
            $this->insertItens($venda, $carrinho);
        }
    }
    public function insertItens(Venda $venda, array $carrinho) {
        foreach ($carrinho as $item) {
            $sql = "INSERT INTO itens(id_produto, quantidade, valorTotal, id_venda) 
            VALUES(:id_produto, :quantidade, :valorTotal, :id_venda)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id_produto", $item->getProdutoId());
            $stmt->bindValue(":quantidade", $item->getQuantidade());
            $stmt->bindValue(":valorTotal", $item->getSubtotal());
            $stmt->bindValue(":id_venda", $venda->getId());
            $stmt->execute();
            $idItem = $this->con->lastInsertId();
            if ($idItem != false) {
                $item->setId((int) $idItem);
            }
        }
    }

}