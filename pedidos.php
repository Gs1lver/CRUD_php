<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <nav>
        <img src="imgs/illustrations/baguete.png" alt="logo">

        <a href="index.html">Home</a>
        <a href="cadastro.php">Cadastro</a>
        <a href="consulta.php">Consulta</a>
        <a href="arquivo.php">Arquivos</a>
    </nav>

    <form method="post">
        <label for="cliente">Nome do cliente:</label>
        <input type="text" name="cliente" required>

        <?php
            include('database.php');
            try{
                $smt = produtosDisponiveis();
                echo "<label for='produto'>Produto:</label>";
                echo "<select name='produto'>Produto:";
                while($row = $smt->fetch()){
                    $nomeProduto = $row['nome'];
                    echo "<option value='$nomeProduto'>{$row['nome']}</option>";
                }
            } catch (PDOException $e) {
                echo "Erro ao consultar produto: " . $e->getMessage();
            }
            echo "</select>";
        ?>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" min="0" max="50" required>

        <label for="entrega">Entrega:</label>
        <div>
            <input type='radio' name='opcaoEntrega' id="delivery" value="delivery">
            <label for="delivery">Delivery</label>
        </div>
        <div>
            <input type='radio' name='opcaoEntrega' id="retirada" value="retirada">
            <label for="retirada">Retirada</label>
        </div>

        <input class="button" type="submit" value="Pedir">
    </form>
</body>

</html>