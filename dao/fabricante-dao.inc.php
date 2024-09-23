<?php
require_once 'conexao.inc.php';
require_once '../classes/fabricante.inc.php';

class FabricanteDAO {
    private $con;

    function __construct(){
        $c = new Conexao();
        $this->con =  $c ->getConexao();
    }

    function findAll() {
        $prepared = $this->con->prepare("SELECT * FROM fabricantes p");
        $prepared->execute();
        if($prepared->rowCount()>0) {
            return $prepared->fetchAll(PDO::FETCH_CLASS, "Fabricante");
        }
        return null;
    }
    function inserir(Fabricante $fabricante){
        $sql = $this->con->prepare("INSERT INTO fabricantes(codigo, nome, logradouro, cep, cidade, email, ramo) VALUES (:codigo, :nome, :logradouro, :cep, :cidade, :email, :ramo)");
        $sql -> bindValue(':codigo', $fabricante->getCodigo());
        $sql -> bindValue(':nome', $fabricante->getNome());
        $sql -> bindValue(':logradouro', $fabricante->getLogradouro());
        $sql -> bindValue(':cep', $fabricante->getCep());
        $sql -> bindValue(':cidade', $fabricante->getCidade());
        $sql -> bindValue(':email', $fabricante->getEmail());
        $sql -> bindValue(':ramo', $fabricante->getRamo());
        $sql->execute();
    }
    function findByCodigo(int $codigo) {
        $prepared = $this->con->prepare("SELECT * FROM fabricantes f WHERE f.codigo = :codigo");
        $prepared->bindValue(':codigo', $codigo);
        $prepared->execute();
        if($prepared->rowCount()>0) {
            return $prepared->fetchObject("Fabricante");
        }
        return null;
    }
    function atualizar(int $codigo, Fabricante $fabricante){
        $sql = $this->con->prepare(
            "UPDATE fabricantes SET 
                nome = :nome,
                logradouro = :logradouro,
                cep = :cep,
                cidade = :cidade,
                email = :email,
                ramo = :ramo
            WHERE codigo = :codigo"
        );
        $sql->bindValue(':nome', $fabricante->getNome());
        $sql->bindValue(':logradouro', $fabricante->getLogradouro());
        $sql->bindValue(':cep', $fabricante->getCep());
        $sql->bindValue(':cidade', $fabricante->getCidade());
        $sql->bindValue(':email', strtolower($fabricante->getEmail()));
        $sql->bindValue(':ramo', $fabricante->getRamo());
        $sql->bindValue(':codigo', $codigo);
        $sql->execute();
    }

    function deleteById(int $codigo) {
        $prepared = $this->con->prepare("DELETE FROM fabricantes WHERE codigo = :codigo");
        $prepared->bindValue(':codigo', $codigo);
        $prepared->execute();
    }
}
?>