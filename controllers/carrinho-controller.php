<?php

require_once './../dao/produto-dao.inc.php';
require_once './../dao/cupom-dao.inc.php';
require_once './../classes/produto.inc.php';
require_once './../classes/cupom.inc.php';
require_once './../classes/item-carrinho.inc.php';

class CarrinhoController {
    private $dao;
    private $cupomDao;

    function __construct() {
        $this->dao = new ProdutoDAO();
        $this->cupomDao = new CupomDAO();
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
        $itensSemEstoque = [];
        foreach ($_SESSION['carrinho'] as $item) {
            $item->updateProduto($this->dao->findById($item->getProdutoId()));
            if ($item->temEstoque()) {
                $itens[] = $item;
                $total = $total + $item->getSubtotal();
            } else {
                $itensSemEstoque[] = $item;
            }
        }
        if (isset($_SESSION['cupom']) && $_SESSION['cupom'] != null || $_SESSION['clienteLogado']['perfil'] == 1) {
            $_SESSION['carrinhoDesconto'] = (($_SESSION['cupom']->getPorcentagem() / 100) + ($_SESSION['clienteLogado']['perfil'] == 1 ? 0.3 : 0)) * $total;
            $total = $total - $_SESSION['carrinhoDesconto'];
        }
        $_SESSION['carrinho'] = $itens;
        $_SESSION['carrinhoTotal'] = $total;
        $_SESSION['itensSemEstoque'] = $itensSemEstoque;

        header('Location:./../views/dadosCompra.php');
    }
    function adicionarCumpom(): void {
        session_start();
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
            header('Location:./../views/index.php');
            return;
        }
        $cupom = $this->cupomDao->findByCodigo($_REQUEST['pCupom']);
        if ($cupom == null || $cupom->getDataValidadeAsTime() < time()) {
            header('Location: ./../views/exibirCarrinho.php?mensagem=Cupom inválido!');
            return;
        }
        $_SESSION['cupom'] = $cupom;
        header('Location: ./../views/exibirCarrinho.php');
    }
    function removerCumpom(): void {
        session_start();
        unset($_SESSION['cupom']);
        header('Location:./../views/exibirCarrinho.php');
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
    } else if ($pOpcao == 5) {
        $controller->adicionarCumpom();
    } else if ($pOpcao == 6) {
        $controller->removerCumpom();
    }

}