<?php
require_once './../classes/fabricante.inc.php';
require_once "includes/cabecalho.inc.php";
?>
<p>
<h1 class="text-center">Inclusão de produto</h1>
<p>

<form enctype="multipart/form-data" class="row g-3" action="./../controllers/produto-controller.inc.php" method="post">
  <div class="col-md-9">
    <label for="pNome" class="form-label">Nome</label>
    <input type="text" class="form-control" name="pNome">
  </div>
  <div class="col-md-3">
    <label for="pPreco" class="form-label">Preço</label>
    <input type="text" class="form-control" name="pPreco">
  </div>
  <div class="col-md-3">
    <label for="pDataFabricacao" class="form-label">Data de fabricação</label>
    <input type="date" class="form-control" name="pDataFabricacao">
  </div>
  <div class="col-md-3">
    <label for="pFabricante" class="form-label">Fabricante</label>
    <select name="pFabricante" class="form-select">
      <option disabled selected value="0">Escolha...</option>
      <?php
      $fabricantes = $_SESSION['fabricantes'];

      foreach ($fabricantes as $fabricante) {
        echo '<option value="' . $fabricante->getCodigo() . '">' . $fabricante->getNome() . '</option>';
      }
      ?>
    </select>
  </div>
  <div class="col-md-2">
    <label for="pEstoque" class="form-label">Qde Estoque</label>
    <input type="text" class="form-control" name="pEstoque">
  </div>
  <div class="col-md-4">
    <label for="imagem" class="form-label">Foto:</label>
    <input type="file" class="form-control" name="pImagem" accept=".jpg">
  </div>
  <div class="col-12">
    <label for="pDescricao" class="form-label">Descrição do produto: </label>
    <textarea class="form-control" name="pDescricao" rows="6" style="resize: none"></textarea>
  </div>
  <div class="col-12">
    <label for="pResumo" class="form-label">Resumo do produto: </label>
    <textarea class="form-control" name="pResumo" rows="3" style="resize: none"></textarea>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Incluir</button>
    <button type="reset" class="btn btn-danger">Cancelar</button>
  </div>
  <input type="hidden" name="pOpcao" value="1">
</form>

<?php
require_once 'includes/rodape.inc.php';
?>