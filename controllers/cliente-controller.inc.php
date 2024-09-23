<?php

require_once './../dao/cliente-dao.inc.php';

class ClienteController {
    private $dao;

    function __construct() {
        $this->dao = new ClienteDAO();
    }

    function autenticar() {
        session_start();
        $_SESSION['erros'] = null;
        $email = $_REQUEST['pEmail'];
        $senha = $_REQUEST['pSenha'];
        $erros = array();
        if($email==null || empty($email)) {
            $erros[] = "E-mail não informado";
        }
        if($senha==null || empty($senha)) {
            $erros[] = "Senha não informada";
        }
        if(count($erros)>0) {
            $erroString = '<ul>';
            foreach($erros as $erro) {
                $erroString = $erroString . "<li>$erro</li>";
            }
            $erroString = $erroString . "</ul>";
            $_SESSION['erros'] = $erroString;
            header("Location: ./../views/formLogin.php?erros=$erroString");
            return;
        }

        $cliente = $this->dao->autenticar($email, $senha);
        if($cliente==null) {
            $erros = "<ul><li>E-mail ou senha inválidos</li></ul>";
            header("Location: ./../views/formLogin.php?erros=$erros");
        } else {
            $_SESSION['clienteLogado'] = $cliente;
            if(isset($_REQUEST['redirect'])){
                header('Location: ./../'. $_REQUEST['redirect']);
            } else {
                header('Location: ./../views/produtosVenda.php');
            }
        }
    }

    function logout() {
        session_start();
        unset($_SESSION['clienteLogado']);
        unset($_SESSION['carrinho']);
        header('Location: ./../views/index.php');
    }
}

$pOpcao = (int) $_REQUEST['pOpcao'];

$controller = new ClienteController();

if($pOpcao == 1) {
    $controller->autenticar();
} else if($pOpcao == 2) {
    $controller->logout();
} else if($pOpcao == 3) {
    
}