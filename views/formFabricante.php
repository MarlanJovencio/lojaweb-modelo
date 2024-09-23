<?php
require_once './../classes/fabricante.inc.php';
require_once "includes/cabecalho.inc.php";
?>
<p>
<h1 class="text-center">Inclusão de Fabricante</h1>
<p>

<form class="row g-3" action="./../controllers/fabricante-controller.inc.php" method="post">
  <div class="col-md-3">
    <label for="pCodigo" class="form-label">Nº Referencia</label>
    <input type="number" class="form-control" name="pCodigo">
  </div>
  <div class="col-md-6">
    <label for="pNome" class="form-label">Nome</label>
    <input type="text" class="form-control" name="pNome">
  </div>
  <div class="col-md-3">
    <label for="pRamo" class="form-label">Ramo</label>
    <input type="text" class="form-control" name="pRamo">
  </div>
  <div class="col-md-3">
    <label for="pCep" class="form-label">CEP</label>
    <input type="text" class="form-control" name="pCep">
  </div>
  <div class="col-md-3">
    <label for="pCidade" class="form-label">Cidade</label>
    <input type="text" class="form-control" name="pCidade">
  </div>
  <div class="col-md-6">
    <label for="pLogradouro" class="form-label">Logradouro</label>
    <input type="text" class="form-control" name="pLogradouro">
  </div>
  <div class="col-md-12">
    <label for="pEmail" class="form-label">E-mail</label>
    <input type="text" class="form-control" name="pEmail">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Incluir</button>
    <button type="reset" class="btn btn-danger">Cancelar</button>
  </div>
  <input type="hidden" name="pOpcao" value="3">
</form>

<?php
require_once 'includes/rodape.inc.php';
?>