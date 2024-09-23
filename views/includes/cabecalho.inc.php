<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Loja virtual Des Web PHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <?php
    session_start();
    if (!isset($_SESSION['clienteLogado'])) {
      $erros = "<ul><li>Usuário não logado</li></ul>";
      require_once "menuC.inc.php";
    } else {
      $tipoCliente = $_SESSION['clienteLogado']['tipo'];
      require_once "menu$tipoCliente.inc.php";
    }
    ?>