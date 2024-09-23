<?php
require_once './../classes/item-carrinho.inc.php';
require_once 'includes/cabecalho.inc.php';

?>

<h1 class="text-center">Carrinho de compra</h1>
<p>
      <?php
      // validação de carrinho vazio
      
      ?>
<div class="table-responsive">
      <table class="table table-ligth table-striped">
            <thead class="table-danger">
                  <tr class="align-middle" style="text-align: center">
                        <th witdh="10%">Item No</th>
                        <th>Ref.</th>
                        <th>Nome</th>
                        <th>Fabricante</th>
                        <th>Preço</th>
                        <th>Qde.</th>
                        <th>Total</th>
                        <th>Remover</th>
                  </tr>
            </thead>
            <tbody class="table-group-divider">
                  <?php
                  $valorTotal = 0;
                  if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                        $posicao = 1;

                        foreach ($_SESSION['carrinho'] as $item) {
                              ?>
                              <tr class="align-middle" style="text-align: center">
                                    <td><?php echo $posicao; ?></td>
                                    <td><?php echo $item->getProdutoId(); ?></td>
                                    <td><?php echo $item->getProdutoNome(); ?></td>
                                    <td><?php echo $item->getProdutoFabricanteNome(); ?></td>
                                    <td>R$ <?php echo number_format(
                                          $item->getProdutoPreco(),
                                          2,
                                          ",",
                                          "."
                                    ); ?></td>
                                    <td><?php echo $item->getQuantidade(); ?></td>
                                    <td>R$ <?php echo number_format(
                                          $item->getSubtotal(),
                                          2,
                                          ",",
                                          "."
                                    ); ?></td>
                                    <td><a href="./../controllers/carrinho-controller.php?pOpcao=3&pId=<?php echo $item->getProdutoId() ?>"
                                                class='btn btn-danger btn-sm'>X</a></td>
                              </tr>
                              <?php
                              $valorTotal = $valorTotal + $item->getSubtotal();
                              $posicao++;
                        }
                  } else {
                        ?>
                        <tr class="align-middle" style="text-align: center">
                              <td colspan="8">Sem itens no carrinho</td>
                        </tr>
                        <?php
                  }
                  ?>

                  <!-- percurso termina aqui -->

                  <tr align="right">
                        <td colspan="8">
                              <font face="Verdana" size="4" color="red"><b>Valor Total = R$
                                          <?php echo number_format(
                                                $valorTotal,
                                                2,
                                                ",",
                                                "."
                                          ); ?></b></font>
                        </td>
                  </tr>
      </table>
      <div class="container text-center">
            <div class="row">
                  <div class="col">
                        <a class="btn btn-warning" role="button" href="./../controllers/produto-controller.inc.php?pOpcao=7"><b>Continuar comprando</b></a>
                  </div>
                  <div class="col">
                        <a class="btn btn-danger" role="button" href="./../controllers/carrinho-controller.php?pOpcao=2"><b>Esvaziar carrinho</b></a>
                  </div>
                  <div class="col">
                        <a class="btn btn-success" role="button" href="./../controllers/carrinho-controller.php?pOpcao=4"><b>Finalizar compra</b></a>
                  </div>
            </div>
      </div>

      <?php
      require_once 'includes/rodape.inc.php';
      ?>