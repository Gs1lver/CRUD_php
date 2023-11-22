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
            echo "<tr>";
            echo "<td><input type='radio' name='nomeProduto' value='$nomeProduto'></td>"; // Use o ID como valor
            echo "<td>{$row['nome']}</td>";
            echo "<td>{$row['preco']}</td>";
            echo "<td>{$row['categoria']}</td>";
            if ($row["foto"] != null)
                echo "<td><img src='{$row['foto']}' width='50px' height='50px'></td>";
            else
                echo "<td>-</td>";
            echo "</tr>";
        }

        echo "</table><br>";
        echo "<input type='submit'name='alterar' value='Alterar' class='button'></input>";
        echo "</form>";

        //alteração
        if (isset($_POST["alterar"]) && isset($_POST["nomeProduto"])) {
            $produtoAlterar = $_POST["nomeProduto"];
            //echo "Botão Alterar clicado. Produto selecionado: " . $_POST["nomeProduto"];
            header("Location: alterar.php?produto=$produtoAlterar");
        } elseif (isset($_POST["alterar"])) {
            echo "<span class='warning'>Selecione um produto para alterar!</span>";
        }
    } catch (PDOException $e) {
        echo "Erro ao consultar produto: " . $e->getMessage();
    }
?>