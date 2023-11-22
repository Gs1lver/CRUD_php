<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta - Pão da Silva</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <nav>
        <img src="imgs/illustrations/baguete.png" alt="logo">

        <a href="index.html">Home</a>
        <a href="pedidos.php">Pedidos</a>
        <a href="cadastro.php">Cadastro</a>
        <a href="arquivo.php">Arquivos</a>
    </nav>

    <h2>Consulta</h2>
    <br>


</body>

</html>
<?php
include('database.php');
    try {
        $smt = consultarPedidos();
        echo "<form method='post'><table border='1px'>";
        echo "<tr><th></th><th>Cliente</th><th>Produto</th><th>Quantidade</th><th>Entrega</th><th>Disponível</th></tr>";

        while ($row = $smt->fetch()) {// Substitua 'id' pelo nome do seu campo ID
            $codigo = $row['codigo'];
            echo "<tr>";
            echo "<td><input type='radio' name='codigo' value='$codigo'></td>"; // Use o ID como valor
            echo "<td>{$row['cliente']}</td>";
            echo "<td>{$row['produto']}</td>";
            echo "<td>{$row['quantidade']}</td>";
            echo "<td>{$row['entrega']}</td>";
            echo "<td>{$row['disponivel']}</td>";
        }

        echo "</table><br>";
        echo "<input type='submit'name='alterar' value='Alterar' class='button'></input>";
        echo "</form>";

        //alteração
        if (isset($_POST["alterar"])) {
            $pedidoAlterar = $_POST["codigo"];
            //echo "Botão Alterar clicado. Produto selecionado: " . $_POST["nomeProduto"];
            header("Location: alterar-pedido.php?pedido=$pedidoAlterar");
        } elseif (isset($_POST["alterar"])) {
            echo "<span class='warning'>Selecione um pedido para alterar!</span>";
        }
    } catch (PDOException $e) {
        echo "Erro ao consultar pedidos: " . $e->getMessage();
    }
?>