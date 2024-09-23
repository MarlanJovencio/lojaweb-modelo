<?php

require_once 'conexao.inc.php';

class ClienteDAO {
    private $con;

    function __construct() {
        $temporaryCon = new Conexao();
        $this->con = $temporaryCon->getConexao();
    }

    function autenticar(string $email, string $senha) {
        $prepared = $this->con->prepare("SELECT * FROM clientes c WHERE c.email = :email AND c.senha = :senha");
        $prepared->bindValue(':email', strtolower($email));
        $prepared->bindValue(':senha', $senha);
        $prepared->execute();
        if($prepared->rowCount()>0) {
            return $prepared->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

}