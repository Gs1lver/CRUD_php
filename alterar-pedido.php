<?php
    include('database.php');
    
     if (isset($_GET['pedido'])) {
         $consultaPedido = consultarPedido($_GET['pedido']);
         
         if ($consultaPedido !== null) {
             $pedido = $consultaPedido->fetch(PDO::FETCH_ASSOC); // Obtém apenas a primeira linha do resultado (unica)
     
             if ($pedido === false) {
                 $pedido = null; // Nenhum produto encontrado, define $produto como null
             }
         }
     }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Pedido - Pão da Silva</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
        <img src="imgs/illustrations/baguete.png" alt="logo">

        <a href="index.html">Home</a>
        <a href="tela-consulta.php">Consulta</a>
    </nav>

    <h2>Alterar</h2>

    <form method="post" enctype="multipart/form-data">
        <label for="cliente">Nome do cliente:</label>
        <input type="text" name="cliente" value="<?= isset($pedido['cliente']) ? $pedido['cliente'] : ''; ?>" disabled>

        <label for="produto">Produto: </label>
        <input type="text" name="produto" value="<?= isset($pedido['produto']) ? $pedido['produto'] : ''; ?>" disabled>

        <label for="quantidade">Quantidade: </label>
        <input type="text" name="quantidade" value="<?= isset($pedido['quantidade']) ? $pedido['quantidade'] : ''; ?>" disabled>

        <label for="entrega">Entrega: </label>
        <select name="entrega" disabled>
            <option value="delivery" <?= isset($pedido['entrega']) && $pedido['entrega'] == 'delivery' ? 'selected' : ''; ?>>Delivery</option>
            <option value="retirada" <?= isset($pedido['entrega']) && $pedido['entrega'] == 'retirada' ? 'selected' : ''; ?>>Retirada</option>
        </select>

        <label for="disponivel">Concluído: </label>
        <select name="disponivel">
            <option value="sim" <?= isset($pedido['disponivel']) && $pedido['disponivel'] == 'sim' ? 'selected' : ''; ?>>Sim</option>
            <option value="nao" <?= isset($pedido['disponivel']) && $pedido['disponivel'] == 'nao' ? 'selected' : ''; ?>>Não</option>
        </select>

        <input type="submit" value="Salvar" name="salvar" class="button"></input>
    </form>

</body>

</html>
<?php

     if(isset($_POST['salvar']) && isset($_POST['disponivel'])){
        $disponivel = $_POST['disponivel'];
            
        alterarPedido($disponivel);
        header('Location: consulta-pedido.php');
     }

?>