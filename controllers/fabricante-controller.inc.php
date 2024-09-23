<?php

require_once './../dao/fabricante-dao.inc.php';
require_once './../dao/produto-dao.inc.php';
require_once './../classes/fabricante.inc.php';

class FabricanteController {
    private $dao;
    public function __construct() {
        $this->dao = new FabricanteDAO();
    }

    public function exibirFabricantes(?string $urlRedirecionar) {
        echo "<script>console.log('FabricanteController.exibirFabricantes starts with urlRedirecionar=$urlRedirecionar')</script>";
        var_dump($urlRedirecionar);
        if ($urlRedirecionar != null)
            session_start();
        $_SESSION['fabricantes'] = $this->dao->findAll();
        if ($urlRedirecionar != null)
            header("Location: $urlRedirecionar");
    }
    function montarFormAtualizar() {
        session_start();
        $codigo = (int) $_REQUEST['codigo'];
        $_SESSION['fabricante'] = $this->dao->findByCodigo($codigo);
        header('Location: ./../views/formFabricanteAtualizar.php');
    }
    function inserir() {
        $fabricante = new Fabricante();
        $fabricante->setFabricante(
            (int) $_REQUEST['pCodigo'],
            $_REQUEST['pNome'],
            $_REQUEST['pLogradouro'],
            $_REQUEST['pCep'],
            $_REQUEST['pCidade'],
            $_REQUEST['pEmail'],
            $_REQUEST['pRamo']
        );
        $this->dao->inserir($fabricante);

        header('Location: fabricante-controller.inc.php?pOpcao=1');
    }
    function atualizar() {
        session_start();
        $fabricante = new Fabricante();
        $fabricante->setFabricante(
            (int) $_REQUEST['pCodigo'],
            $_REQUEST['pNome'],
            $_REQUEST['pLogradouro'],
            $_REQUEST['pCep'],
            $_REQUEST['pCidade'],
            $_REQUEST['pEmail'],
            $_REQUEST['pRamo']
        );
        $this->dao->atualizar($_REQUEST['pCodigo'], $fabricante);
        header('Location: fabricante-controller.inc.php?pOpcao=1');
    }
    function excluir() {
        $codigo = (int) $_REQUEST['codigo'];
        $produtoDao = new ProdutoDAO();
        $produtosFabricante = $produtoDao->findAllByCodFabricante($codigo);
        if (isset($produtosFabricante) && sizeof($produtosFabricante) > 0) {
            header('Location: fabricante-controller.inc.php?pOpcao=1&erros=FC:E:1');
        } else {
            $this->dao->deleteById($codigo);
            header('Location: fabricante-controller.inc.php?pOpcao=1');
        }

    }
}

if (isset($_REQUEST['pOpcao'])) {
    $pOpcao = (int) $_REQUEST['pOpcao'];
    $fabricanteController = new FabricanteController();

    if ($pOpcao == 1) {
        if (isset($_REQUEST['erros'])) {
            $fabricanteController->exibirFabricantes("./../views/exibirFabricantes.php?erros=" . $_REQUEST['erros']);
        } else {
            $fabricanteController->exibirFabricantes('./../views/exibirFabricantes.php');
        }
    } else if ($pOpcao == 2) {
        header('Location: ./../views/formFabricante.php');
    } else if ($pOpcao == 3) {
        $fabricanteController->inserir();
    } else if ($pOpcao == 4) {
        $fabricanteController->montarFormAtualizar();
    } else if ($pOpcao == 5) {
        $fabricanteController->atualizar();
    } else if ($pOpcao == 6) {
        $fabricanteController->excluir();
    }
}
?>