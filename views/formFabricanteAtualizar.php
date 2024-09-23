<?php
require_once './../classes/fabricante.inc.php';
require_once "includes/cabecalho.inc.php";
$fabricante = $_SESSION['fabricante'];
?>
<p>
<h1 class="text-center">Inclusão de produto</h1>
<p>

<?php if (isset($fabricante)) :?>
<form class="row g-3" action="./../controllers/fabricante-controller.inc.php" method="post">
  <div class="col-md-3">
    <label for="pCodigo" class="form-label">Nº Referencia</label>
    <input type="number" class="form-control" name="pCodigo" value="<?php echo $fabricante->getCodigo() ?>" readonly>
  </div>
  <div class="col-md-6">
    <label for="pNome" class="form-label">Nome</label>
    <input type="text" class="form-control" name="pNome" value="<?php echo $fabricante->getNome() ?>">
  </div>
  <div class="col-md-3">
    <label for="pRamo" class="form-label">Ramo</label>
    <input type="text" class="form-control" name="pRamo" value="<?php echo $fabricante->getRamo() ?>">
  </div>
  <div class="col-md-3">
    <label for="pCep" class="form-label">CEP</label>
    <input type="text" class="form-control" name="pCep" value="<?php echo $fabricante->getCep() ?>">
  </div>
  <div class="col-md-3">
    <label for="pCidade" class="form-label">Cidade</label>
    <input type="text" class="form-control" name="pCidade" value="<?php echo $fabricante->getCidade() ?>">
  </div>
  <div class="col-md-6">
    <label for="pLogradouro" class="form-label">Logradouro</label>
    <input type="text" class="form-control" name="pLogradouro" value="<?php echo $fabricante->getLogradouro() ?>">
  </div>
  <div class="col-md-12">
    <label for="pEmail" class="form-label">E-mail</label>
    <input type="text" class="form-control" name="pEmail" value="<?php echo $fabricante->getEmail() ?>">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Incluir</button>
    <a href="./../controllers/fabricante-controller.inc.php?pOpcao=1" class="btn btn-danger">Cancelar</a>
  </div>
  <input type="hidden" name="pOpcao" value="3">
</form>
<?php endif; ?>

<?php
require_once 'includes/rodape.inc.php';
?>