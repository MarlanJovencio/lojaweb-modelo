<?php
require_once '../classes/produto.inc.php';
require_once './../classes/fabricante.inc.php';
require_once 'includes/cabecalho.inc.php';
$produto = $_SESSION['produto'];
?>
<p>
<h1 class="text-center">Alteração de produto</h1>
<p>

  <?php if (isset($produto)): ?>
  <form enctype="multipart/form-data" class="row g-3" action="./../controllers/produto-controller.inc.php" method="post">
    <div class="col-md-2">
      <label for="pId" class="form-label">ID</label>
      <input type="text" class="form-control" name="pId" value="<?php echo $produto->getId() ?>" readonly>
    </div>
    <div class="col-md-10">
      <label for="pNome" class="form-label">Nome</label>
      <input type="text" class="form-control" name="pNome" value="<?php echo $produto->getNome() ?>">
    </div>
    <div class="col-md-3">
      <label for="pReferencia" class="form-label">Nº Referencia</label>
      <input type="text" class="form-control" name="pReferencia" value="<?php echo $produto->getReferencia() ?>" readonly>
    </div>
    <div class="col-md-9">
      <label for="imagem" class="form-label">Foto:</label>
      <input type="file" class="form-control" name="pImagem" accept=".jpg">
    </div>
    <div class="col-md-3">
      <label for="pPreco" class="form-label">Preço</label>
      <input type="text" class="form-control" name="pPreco" value="<?php echo $produto->getPreco() ?>">
    </div>
    <div class="col-md-3">
      <label for="pDataFabricacao" class="form-label">Data de fabricação</label>
      <input type="date" class="form-control" name="pDataFabricacao" value="<?php echo $produto->getDataFabricacao() ?>">
    </div>
    <div class="col-md-4">
      <label for="pFabricante" class="form-label">Fabricante</label>
      <select name="pFabricante" class="form-select">
        <?php
        $fabricantes = $_SESSION['fabricantes'];
        foreach ($fabricantes as $fabricante) {
          $isSelected = '';
          if ($produto->getCodFabricante() == $fabricante->getCodigo())
            $isSelected = ' selected';
          echo '<option' . $isSelected . ' value="' . $fabricante->getCodigo() . '">' . $fabricante->getNome() . '</option>';
        }
        ?>
      </select>
    </div>
    <div class="col-md-2">
      <label for="pEstoque" class="form-label">Qde Estoque</label>
      <input type="text" class="form-control" name="pEstoque" value="<?php echo $produto->getEstoque() ?>">
    </div>
    <div class="col-12">
      <label for="pDescricao" class="form-label">Descrição do produto: </label>
      <textarea class="form-control" name="pDescricao" rows="6"
        style="resize: none"><?php echo $produto->getDescricao() ?></textarea>
    </div>
    <div class="col-12">
      <label for="pResumo" class="form-label">Resumo do produto: </label>
      <textarea class="form-control" name="pResumo" rows="6"
        style="resize: none"><?php echo $produto->getResumo() ?></textarea>
    </div>
    <input type="hidden" name="pOpcao" value="5">
    <div class="col-12 text-center">
      <button type="submit" class="btn btn-success">Alterar</button>
    </div>
  </form>
<?php endif; ?>

<?php
require_once 'includes/rodape.inc.php';
?>