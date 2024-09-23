<?php

require_once './../dao/produto-dao.inc.php';
require_once './../classes/produto.inc.php';
require_once './../classes/item-carrinho.inc.php';

class CarrinhoController {
    private $dao;

    function __construct() {
        $this->dao = new ProdutoDAO();
    }

    function adicionarItem() {
        $produto = $this->dao->findById((int) $_REQUEST['pId']);
        session_start();
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
        }

        foreach ($_SESSION['carrinho'] as $item) {
            if ($item->getProdutoId() == $produto->getId()) {
                $item->adicionarQuantidade();
                header('Location: ./../views/produtosVenda.php');
                return;
            }
        }
        $_SESSION['carrinho'][] = new ItemCarrinho($produto);
        header('Location: ./../views/produtosVenda.php');
    }
    function esvaziarCarrinho() {
        session_start();
        $_SESSION['carrinho'] = array();
        header('Location:./../views/exibirCarrinho.php');
        return;
    }
    function removerItem() {
        session_start();
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
            header('Location: ./../views/exibirCarrinho.php');
            return;
        }

        foreach ($_SESSION['carrinho'] as $item) {
            if ($item->getProdutoId() == $_REQUEST['pId']) {
                if ($_SESSION['carrinho'][array_search($item, $_SESSION['carrinho'])]->removeQuantidade() == 0) {
                    unset($_SESSION['carrinho'][array_search($item, $_SESSION['carrinho'])]);
                }
            }
        }
        header('Location: ./../views/exibirCarrinho.php');
    }
    function finalizarCompra() {
        session_start();
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
            header('Location:./../views/index.php');
            return;
        }
        if (!isset($_SESSION['clienteLogado']) || $_SESSION['clienteLogado'] == null) {
            header('Location: ./../views/formLogin.php?redirect=controllers/carrinho-controller.php?pOpcao=4');
            return;
        }

        $total = 0;
        $itens = [];
        foreach ($_SESSION['carrinho'] as $item) {
            $item->updateProduto($this->dao->findById($item->getProdutoId()));
            if ($item->temEstoque()) {
                $itens[] = $item;
                $total = $total + $item->getSubtotal();
            }
        }
        $_SESSION['carrinho'] = $itens;
        $_SESSION['carrinhoTotal'] = $total;

        header('Location:./../views/dadosCompra.php');
    }
}

if (isset($_REQUEST['pOpcao'])) {
    $pOpcao = (int) $_REQUEST['pOpcao'];
    $controller = new CarrinhoController();
    if ($pOpcao == 1) {
        $controller->adicionarItem();
    } else if ($pOpcao == 2) {
        $controller->esvaziarCarrinho();
    } else if ($pOpcao == 3) {
        $controller->removerItem();
    } else if ($pOpcao == 4) {
        $controller->finalizarCompra();
    }

}