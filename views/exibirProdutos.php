<?php        
      require_once '../classes/produto.inc.php';
      require_once 'includes/cabecalho.inc.php';
?>
<p>
<h1 class="text-center">Produtos do estoque</h1>
<p> 
<div class="table-responsive">
<table class="table table-light table-hover">
      <thead class="table-primary">
            <tr class="align-middle" style="text-align: center">
                <th witdh="10%">ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Data de Fabricação</th>
                <th>Preço unitário</th>
                <th>Em Estoque</th>
                <th>Fabricante</th>
                <th>Operação</th>
            </tr>
      </thead>
      <tbody class="table-group-divider">
      <?php
            if(isset($_SESSION['produtos'])) {
                  $produtos = $_SESSION['produtos'];
                  foreach($produtos as $produto){
                        echo "<tr align='center'>";
                        echo "<td>".$produto->getId()."</td>";
                        echo "<td><strong>".$produto->getNome()."</strong></td>";
                        echo "<td>".$produto->getDescricao()."</td>";
                        echo "<td>".$produto->getDataFabricacaoFormatada()."</td>";
                        echo "<td>"."R$ ".number_format(
                              $produto->getPreco(),
                              2,
                              ",",
                              "."
                          )."</td>";
                        echo "<td>".$produto->getEstoque()."</td>";
                        echo "<td>(".$produto->getCodFabricante().") - ".$produto->getNomeFabricante()."</td>";
                        echo "<td><a href='./../controllers/produto-controller.inc.php?pOpcao=4&id=".$produto->getId()."' class='btn btn-success btn-sm'>A</a> ";
                        echo "<a href='./../controllers/produto-controller.inc.php?pOpcao=6&id=".$produto->getId()."' class='btn btn-danger btn-sm'>X</a></td>";
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

