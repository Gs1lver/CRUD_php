<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Arquivos</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <nav>
        <img src="imgs/illustrations/baguete.png" alt="logo">

        <a href="index.html">Home</a>
        <a href="tela-consulta.php">Consulta</a>
        <a href="cadastro.php">Cadastro</a>
    </nav>

    <form method="get">
        <input type="submit" name="arquivoProdutos" value="Produtos" class="button"></input>
        <input type="submit" name="arquivoPedidos" value="Pedidos" class="button"></input>
    </form>

</body>

</html>


<?php
include('database.php');

if (isset($_GET["arquivoProdutos"])) {
    $smt = criarArquivoProdutos("produtos.csv");
}

if (isset($_GET["arquivoPedidos"])) {
    $smt = criarArquivoPedidos("pedidos.csv");
}

?>