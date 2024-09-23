<?php
require_once './../classes/item-carrinho.inc.php';
require_once "includes/cabecalho.inc.php";

if (!isset($_SESSION['clienteLogado']) || $_SESSION['clienteLogado'] == null) {
      header("Location: formLogin.php");
}
$clienteLogado = $_SESSION['clienteLogado'];
$carrinho = [];
if (isset($_SESSION['carrinho']) && $_SESSION['carrinho'] != null && count($_SESSION['carrinho']) > 0) {
      $carrinho = $_SESSION['carrinho'];
}
$carrinhoTotal = 0;
if (isset($_SESSION['carrinhoTotal']) && $_SESSION['carrinhoTotal'] != null) {
      $carrinhoTotal = $_SESSION['carrinhoTotal'];
}

?>

<?php
if (isset($_SESSION['itensSemEstoque']) && $_SESSION['itensSemEstoque'] != null && count($_SESSION['itensSemEstoque']) > 0) {
      foreach ($_SESSION['itensSemEstoque'] as $itemSemEstoque) {
            ?>
            <div class="alert alert-danger" role="alert">
                  O produto <b><?= $itemSemEstoque->getProdutoNome() ?></b> não está disponivel no estoque, existem apenas
                  <b><?= $itemSemEstoque->getProdutoEstoque() ?></b> unidade(s) disponivel(is) em estoque
            </div>
      <?php }
}
?>

<h1 class="text-center">Dados do cliente</h1>

<p>&nbsp;
<div style="font-size: 1.25rem;">
      <p><b>Nome:</b> <?php echo $clienteLogado['nome']; ?>
      <p><b>CPF:</b> <?php echo $clienteLogado['cpf'] ?>
      <p><b>Endereço Completo:</b>
            <?php echo $clienteLogado['logradouro'] . ' - ' . $clienteLogado['cidade'] . ', ' . $clienteLogado['estado'] . ' - ' . $clienteLogado['cep']; ?>.
      <p><b>Telefone:</b> <?php echo $clienteLogado['telefone']; ?>
      <p><b>Email:</b> <?php echo $clienteLogado['email']; ?>
            </font>
      <p>
            <hr>
      <p>&nbsp;
</div>

<h1 class="text-center">Dados da compra</h1>
<p>

<div class="table-responsive">
      <table class="table">
            <thead class="table-success">
                  <tr class="align-middle" style="text-align: center">
                        <th witdh="10%">Item</th>
                        <th>Referencia</th>
                        <th>Nome</th>
                        <th>Fabricante</th>
                        <th>Preço</th>
                        <th>Qde.</th>
                        <th>Valor</th>
                  </tr>
            </thead>
            <tbody class="table-group-divider">
                  <?php
                  foreach ($carrinho as $item) {
                        ?>
                        <tr class="align-middle" style="text-align: center">
                              <td><img src="imagens/produtos/<?php echo $item->getProdutoReferencia() ?>.jpg" width="100"
                                          height="100" border="0"></td>
                              <td><?php echo $item->getProdutoId() ?></td>
                              <td><?php echo $item->getProdutoNome() ?></td>
                              <td><?php echo $item->getProdutoNomeFabricante() ?></td>
                              <td>R$ <?php echo number_format(
                                    $item->getProdutoPreco(),
                                    2,
                                    ",",
                                    "."
                              ); ?></td>
                              <td><?php echo $item->getQuantidade() ?></td>
                              <td>R$ <?php echo number_format(
                                    $item->getSubtotal(),
                                    2,
                                    ",",
                                    "."
                              ); ?></td>
                        </tr>
                  <?php } ?>
                  <!-- percurso termina aqui -->

                  <tr align="right">
                        <td colspan="7">
                              <font face="Verdana" size="4" color="red"><b>Valor Total = R$
                                          <?php echo number_format($carrinhoTotal,
                                                2,
                                                ",",
                                                "."
                                          ); ?></b></font>
                        </td>
                  </tr>
      </table>
      <?php
      if (count($carrinho) > 0) {
            ?>
            <div class="container text-center">
                  <div class="row">
                        <div class="col">
                              <a class="btn btn-success" role="button"
                                    href="./../controllers/venda-controller.php?pOpcao=1"><b>Efetuar o pagamento</b></a>
                        </div>
                  </div>
            </div>
            <?php
      }
      ?>
      <!-- Rodape -->

      <?php require_once "includes/rodape.inc.php" ?>