<?php
include_once './../classes/produto.inc.php';
include_once './../classes/item-carrinho.inc.php';
include_once 'includes/cabecalho.inc.php';
?>
<h1 class="text-center">Show room de produtos</h1>
<p>

<div class="row row-cols-1 row-cols-md-5 g-4">

  <?php
  if (isset($_SESSION['produtos'])) {
    $produtos = $_SESSION['produtos'];
    foreach ($produtos as $produto) {
      ?>
      <div class="col">
        <div class="card">
          <img src="imagens/produtos/<?php echo $produto->getReferencia(); ?>.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo $produto->getNome() ?></h5>
            <p class="card-text"><?php echo $produto->getResumo() ?></p>
            <h6 class="card-text text-end">Marca: <?php echo $produto->getNomeFabricante() ?></h6>
            <h4 class="card-title"><?php echo "R$ " . number_format(
              $produto->getPreco(),
              2,
              ",",
              "."
            ); ?></h4>
            <div class="text-end">
              <?php echo "<a href='./../controllers/carrinho-controller.php?pOpcao=1&pId=" . $produto->getId() . "' class='btn btn-danger'>Comprar</a>" ?>
            </div>
          </div>
        </div>
      </div>
      <?php

    }

  }
  //percurso inicia aqui  
  ?>
</div>

<?php require_once "includes/rodape.inc.php" ?>