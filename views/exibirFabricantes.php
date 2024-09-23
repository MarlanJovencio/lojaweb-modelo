<?php
require_once '../classes/fabricante.inc.php';
require_once 'includes/cabecalho.inc.php';
?>
<p>
      <h1 class="text-center">Fabricantes</h1>
</p>
<?php
if (isset($_REQUEST['erros'])) {
      $errosString = $_REQUEST['erros'];
      if ($errosString == "FC:E:1") {
            echo "<ul><li>Não foi posível excluir o fabricante pois ele possui produto cadastrado</li></ul>";
      }
}
?>
<div class="table-responsive">
      <table class="table table-light table-hover">
            <thead class="table-primary">
                  <tr class="align-middle" style="text-align: center">
                        <th witdh="10%">Código</th>
                        <th>Nome</th>
                        <th>Logradouro</th>
                        <th>CEP</th>
                        <th>Cidade</th>
                        <th>E-mail</th>
                        <th>Ramo</th>
                        <th>Operação</th>
                  </tr>
            </thead>
            <tbody class="table-group-divider">
                  <?php
                  if (isset($_SESSION['fabricantes'])) {
                        $fabricantes = $_SESSION['fabricantes'];
                        foreach ($fabricantes as $fabricante) {
                              echo "<tr align='center'>";
                              echo "<td>" . $fabricante->getCodigo() . "</td>";
                              echo "<td><strong>" . $fabricante->getNome() . "</strong></td>";
                              echo "<td>" . $fabricante->getLogradouro() . "</td>";
                              echo "<td>" . $fabricante->getCep() . "</td>";
                              echo "<td>" . $fabricante->getCidade() . "</td>";
                              echo "<td>" . $fabricante->getEmail() . "</td>";
                              echo "<td>" . $fabricante->getRamo() . "</td>";
                              echo "<td><a href='./../controllers/fabricante-controller.inc.php?pOpcao=4&codigo=" . $fabricante->getCodigo() . "' class='btn btn-success btn-sm'>A</a> ";
                              echo "<a href='./../controllers/fabricante-controller.inc.php?pOpcao=6&codigo=" . $fabricante->getCodigo() . "' class='btn btn-danger btn-sm'>X</a></td>";
                              echo "</tr>";
                        }
                  }
                  ?>
            </tbody>
      </table>
</div>

<?php
require_once 'includes/rodape.inc.php';
?>