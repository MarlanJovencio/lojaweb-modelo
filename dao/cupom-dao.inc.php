<?php

require_once 'conexao.inc.php';
require_once '../classes/cupom.inc.php';


class CupomDAO {
    private $con;

    function __construct() {
        $temporaryCon = new Conexao();
        $this->con = $temporaryCon->getConexao();
    }

    function findByCodigo(string $codigo): Cupom|null {
        $prepared = $this->con->prepare("SELECT * FROM cupons c WHERE c.cd_cupom = :codigo");
        $prepared->bindValue(':codigo', $codigo);
        $prepared->execute();
        if ($prepared->rowCount() > 0) {
            return $prepared->fetchObject("Cupom");
        }
        return null;
    }
}