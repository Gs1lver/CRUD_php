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
            <a href="index.html">Home</a>
            <a href="cadastro.php">Cadastrar produto</a>
        </nav>

        <h2>Consulta</h2>
        <form method="get">
            <label for="nome">Nome do produto: </label>
            <input type="text" name="consulta">
            
            <input type="submit" value="Consultar" class="button"></input>
        </form>
        <br>

    
</body>
</html>
<?php
include('database.php');

if (isset($_GET["consulta"])) {
    try {
        $nome = $_GET["consulta"];
        $smt = consultar($nome);
        echo "<form method='post'><table border='1px'>";
        echo "<tr><th></th><th>Nome</th><th>Preço</th><th>Categoria</th><th>Foto</th></tr>";

        while ($row = $smt->fetch()) {
            $nomeProduto = $row['nome']; // Substitua 'id' pelo nome do seu campo ID
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
        echo "<input type='submit' name='excluir' value='Excluir' class='button'></input>";
        echo "<input type='submit'name='alterar' value='Alterar' class='button'></input>";
        echo "</form>";

        //exclusão
        if (isset($_POST["excluir"]) && isset($_POST["nomeProduto"])) {
            $produtoExcluir = $_POST["nomeProduto"];
            excluir($produtoExcluir);

        } elseif (isset($_POST["excluir"])) {
            echo "<span>Selecione um produto para excluir!</span>";
        }

        //alteração
        if (isset($_POST["alterar"]) && isset($_POST["nomeProduto"])) {
            $produtoAlterar = $_POST["nomeProduto"];
            //echo "Botão Alterar clicado. Produto selecionado: " . $_POST["nomeProduto"];
            header("Location: alterar.php?produto=$produtoAlterar");
        } elseif (isset($_POST["alterar"])) {
            echo "<span>Selecione um produto para alterar!</span>";
        }

    } catch (PDOException $e) {
        echo "Erro ao consultar produto: " . $e->getMessage();
    }
}
?>
