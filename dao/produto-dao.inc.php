<?php
require_once 'conexao.inc.php';
require_once '../classes/produto.inc.php';

class ProdutoDAO {
    private $con;

    function __construct() {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    private function converterDataMysql($data) {
        return date('Y-m-d', $data);
    }

    function incluirProduto(Produto $produto) {
        $sql = $this->con->prepare("INSERT INTO produtos (nome, data_fabricacao, preco, estoque, descricao, resumo, referencia, cod_fabricante) VALUES (:nome, :data_fabricacao, :preco, :estoque, :descricao, :resumo, :referencia, :cod_fabricante)");
        $sql->bindValue(':nome', $produto->getNome());
        $sql->bindValue(':data_fabricacao', $this->converterDataMysql($produto->getDataFabricacao()));
        $sql->bindValue(':preco', $produto->getPreco());
        $sql->bindValue(':estoque', $produto->getEstoque());
        $sql->bindValue(':descricao', $produto->getDescricao());
        $sql->bindValue(':resumo', $produto->getResumo());
        $sql->bindValue(':referencia', $produto->getReferencia());
        $sql->bindValue(':cod_fabricante', $produto->getCodFabricante());
        $sql->execute();
    }

    function findAll() {
        $prepared = $this->con->prepare("SELECT p.*, f.nome AS nome_fabricante FROM produtos p INNER JOIN fabricantes f ON f.codigo = p.cod_fabricante");
        $prepared->execute();
        if ($prepared->rowCount() > 0) {
            return $prepared->fetchAll(PDO::FETCH_CLASS, "Produto");
        }
        return null;
    }

    function findById(int $id): Produto|null {
        $prepared = $this->con->prepare("SELECT p.*, f.nome AS nome_fabricante FROM produtos p INNER JOIN fabricantes f ON f.codigo = p.cod_fabricante WHERE p.produto_id = :id");
        $prepared->bindValue(':id', $id);
        $prepared->execute();
        if ($prepared->rowCount() > 0) {
            return $prepared->fetchObject("Produto");
        }
        return null;
    }

    function atualizar(int $id, Produto $produto) {
        $sql = $this->con->prepare(
            "UPDATE produtos SET 
                nome = :nome,
                referencia = :referencia,
                data_fabricacao = :dataFabricacao,
                preco = :preco,
                estoque = :estoque,
                descricao = :descricao,
                resumo = :resumo,
                cod_fabricante = :codFabricante
            WHERE produto_id = :id"
        );
        $sql->bindValue(':nome', $produto->getNome());
        $sql->bindValue(':referencia', $produto->getReferencia());
        $sql->bindValue(':dataFabricacao', $this->converterDataMysql($produto->getDataFabricacao()));
        $sql->bindValue(':preco', $produto->getPreco());
        $sql->bindValue(':estoque', $produto->getEstoque());
        $sql->bindValue(':descricao', $produto->getDescricao());
        $sql->bindValue(':resumo', $produto->getResumo());
        $sql->bindValue(':codFabricante', $produto->getCodFabricante());
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    function deleteById(int $id) {
        $prepared = $this->con->prepare("DELETE FROM produtos WHERE produto_id = :id");
        $prepared->bindValue(':id', $id);
        $prepared->execute();
    }

    function findAllByCodFabricante(int $codFabricante) {
        $prepared = $this->con->prepare(
            "SELECT p.*, f.nome AS nome_fabricante FROM produtos p INNER JOIN fabricantes f ON f.codigo = p.cod_fabricante WHERE f.codigo =:codFabricante");
        $prepared->bindValue(':codFabricante', $codFabricante);
        $prepared->execute();

        if ($prepared->rowCount() > 0) {
            return $prepared->fetchAll(PDO::FETCH_CLASS, "Produto");
        }
        return null;
    }

    function gerarReferenciaImagem(): int {
        $referencia = null;
        $prepared = $this->con->prepare(
            "SELECT 1 FROM produtos p WHERE p.referencia = :referencia");
        do {
            $referencia = rand(1, 9999999999);
            $prepared->bindValue(':referencia', $referencia);
            $prepared->execute();
            if ($prepared->rowCount() > 0) {
                $referencia = null;
            }
        } while ($referencia == null);
        return $referencia;
    }
}
?>