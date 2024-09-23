<?php
require_once './../dao/venda-dao.inc.php';
require_once './../classes/venda.inc.php';

class VendaController {

    private $dao;

    function __construct() {
        $this->dao = new VendaDAO();
    }

    public function finalizarCompra() {
        if (!isset($_REQUEST['pag'])) {
            header("Location: ./../views/dadosPagamento.php");
            return;
        }
        session_start();
        $clienteLogado = $_SESSION['clienteLogado'];
        $carrinho = $_SESSION['carrinho'];
        $carrinhoTotal = $_SESSION['carrinhoTotal'];

        $venda = new Venda($clienteLogado['cpf'], $carrinhoTotal);
        $this->dao->insert($venda, $carrinho);
        $_SESSION['itensCompra'] = $_SESSION['carrinho'];
        unset($_SESSION['carrinho']);
        header("Location: ./../views/boleto/meu-boleto-bb.php");
    }
}

if (isset($_REQUEST['pOpcao'])) {
    $pOpcao = (int) $_REQUEST['pOpcao'];
    $produtoController = new VendaController();

    if ($pOpcao == 1) {
        $produtoController->finalizarCompra();
    }
}