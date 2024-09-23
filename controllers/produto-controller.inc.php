<?php

require_once './../dao/produto-dao.inc.php';
require_once './../classes/produto.inc.php';

class ProdutoController {
    private $dao;

    function __construct() {
        $this->dao = new ProdutoDAO();
    }

    function inserir() {
        $produto = new Produto();
        $produto->setProduto(
            $_REQUEST['pNome'],
            $_REQUEST['pDataFabricacao'],
            (float) $_REQUEST['pPreco'],
            (int) $_REQUEST['pEstoque'],
            $_REQUEST['pDescricao'],
            $_REQUEST['pResumo'],
            $this->uploadImagem(null),
            $_REQUEST['pFabricante']
        );
        $this->dao->incluirProduto($produto);

        header('Location: produto-controller.inc.php?pOpcao=2');
    }
    function exibirProdutos() {
        session_start();
        $_SESSION['produtos'] = $this->dao->findAll();
        if ($_REQUEST['pOpcao'] == 2)
            header('Location: ./../views/exibirProdutos.php');
        else
            header('Location: ./../views/produtosVenda.php');
    }
    function montarFormProduto() {
        require_once './fabricante-controller.inc.php';
        echo "<script>console.log('ProdutoController.montarFormProduto starts')</script>";
        session_start();
        $fabricanteController = new FabricanteController();
        $fabricanteController->exibirFabricantes("./../views/formProduto.php");
    }
    function montarFormProdutoAtualizar() {
        require_once './fabricante-controller.inc.php';
        session_start();
        $fabricanteController = new FabricanteController();
        $fabricanteController->exibirFabricantes(null);
        $id = (int) $_REQUEST['id'];
        $produto = $this->dao->findById($id);
        $_SESSION['produto'] = $produto;
        header('Location: ./../views/formProdutoAtualizar.php');
    }
    function atualizar() {
        session_start();
        $produto = new Produto();
        $referencia = (int) $_REQUEST['pReferencia'];
    if ($_FILES['pImagem'] != null) {
            $this->deletarImagem($referencia);
            $referencia = $this->uploadImagem(null);
        }
        $produto->setProduto(
            $_REQUEST['pNome'],
            $_REQUEST['pDataFabricacao'],
            (float) $_REQUEST['pPreco'],
            (int) $_REQUEST['pEstoque'],
            $_REQUEST['pDescricao'],
            $_REQUEST['pResumo'],
            $referencia,
            $_REQUEST['pFabricante']
        );
        $this->dao->atualizar($_REQUEST['pId'], $produto);
        header('Location: produto-controller.inc.php?pOpcao=2');
    }

    function exclir() {
        $id = (int) $_REQUEST['id'];
        $ref = $this->dao->findById($id)->getReferencia();
        $this->dao->deleteById($id);
        $this->deletarImagem($ref);
        header('Location: produto-controller.inc.php?pOpcao=2');
    }
    private function uploadImagem(?string $referencia): string {
        $imagem = $_FILES['pImagem'];
        if ($referencia != null) {
            $nome = $referencia;
        } else {
            $nome = $this->dao->gerarReferenciaImagem();
        }
        if ($imagem != NULL) {
            $nome_temporario = $_FILES['pImagem']["tmp_name"];
            copy($nome_temporario, "../views/imagens/produtos/$nome.jpg");
        } else {
            echo "Você não realizou o upload de forma satisfatória.";
        }
        return $nome;
    }
    function deletarImagem(string $ref) {

        $arquivo = "../views/imagens/produtos/$ref.jpg";

        if (file_exists($arquivo)) { // verifica se o arquivo existe
            if (!unlink($arquivo)) { //aqui que se remove o arquivo retornando true, senão mostra mensagem
                echo "Não foi possível deletar o arquivo!";
            }
        }
    }
}

if (isset($_REQUEST['pOpcao'])) {
    $pOpcao = (int) $_REQUEST['pOpcao'];
    $produtoController = new ProdutoController();

    if ($pOpcao == 1) {
        $produtoController->inserir();
    } else if ($pOpcao == 2 || $pOpcao == 7) {
        $produtoController->exibirProdutos();
    } else if ($pOpcao == 3) {
        unset($_REQUEST['pOpcao']);
        $produtoController->montarFormProduto();
    } else if ($pOpcao == 4) {
        $produtoController->montarFormProdutoAtualizar();
    } else if ($pOpcao == 5) {
        $produtoController->atualizar();
    } else if ($pOpcao == 6) {
        $produtoController->exclir();
    }
}
?>