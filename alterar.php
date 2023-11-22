<?php
    include('database.php');
    
     if (isset($_GET['produto'])) {
         $consultaProduto = consultarProduto($_GET['produto']);
         
         if ($consultaProduto !== null) {
             $produto = $consultaProduto->fetch(PDO::FETCH_ASSOC); // Obtém apenas a primeira linha do resultado (unica)
     
             if ($produto === false) {
                 $produto = null; // Nenhum produto encontrado, define $produto como null
             }
         }
     }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Produto - Pão da Silva</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
        <img src="imgs/illustrations/baguete.png" alt="logo">

        <a href="index.html">Home</a>
        <a href="consulta.php">Consulta</a>
    </nav>

    <h2>Alterar</h2>

    <form method="post" enctype="multipart/form-data">
    <label for="nome">Nome do Produto: </label>
    <input type="text" name="nome" value="<?= isset($produto['nome']) ? $produto['nome'] : ''; ?>">

    <label for="preco">Preço: </label>
    <input type="text" name="preco" value="<?= isset($produto['preco']) ? $produto['preco'] : ''; ?>">

    <label for="categoria">Categoria: </label>
    <select name="categoria">
        <option value="doce" <?= isset($produto['categoria']) && $produto['categoria'] == 'doce' ? 'selected' : ''; ?>>Doce</option>
        <option value="salgado" <?= isset($produto['categoria']) && $produto['categoria'] == 'salgado' ? 'selected' : ''; ?>>Salgado</option>
        <option value="bebida" <?= isset($produto['categoria']) && $produto['categoria'] == 'bebida' ? 'selected' : ''; ?>>Bebida</option>
        <option value="outro" <?= isset($produto['categoria']) && $produto['categoria'] == 'outro' ? 'selected' : ''; ?>>Outro</option>
    </select>

    <label for="foto">Foto: </label>
    <img src="<?= isset($produto['foto']) ? $produto['foto'] : ''; ?>" alt=" " width="100px" height="100px">
    <input type="file" name="foto">

    <input type="submit" value="Salvar" name="salvar" class="button"></input>

</body>

</html>
<?php

     if(isset($_POST['salvar']) && isset($_POST['nome']) && isset($_POST['preco']) && isset($_POST['categoria']) && isset($_FILES['foto'])){
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $categoria = $_POST['categoria'];
        $foto = $_FILES['foto'];
        

        $nomeFoto = $foto["name"];
        $tmpFoto = $foto["tmp_name"];
        $tamanhoFoto = $foto["size"];
        $tipoFoto = $foto["type"];

        define("UPLOAD_DIR", "./imgs/produtos/");
        define("MAX_SIZE", 5 * 1024 * 1024);

        if ($nomeFoto != "" && preg_match("/^image\/(png|jpg|jpeg|gif|webp)$/", $tipoFoto) && $tamanhoFoto <= MAX_SIZE) {
            $novaLocalizacao = UPLOAD_DIR . $nomeFoto;
            move_uploaded_file($tmpFoto, $novaLocalizacao);
            alterarProdutoComFoto($nome, $preco, $categoria, $novaLocalizacao);
        } else if ($nomeFoto != "") {
            echo "Erro ao fazer upload do arquivo! Verifique se o arquivo é uma imagem e se o tamanho é menor que 5MB.";
        } 
            
        alterarProdutoSemFoto($nome, $preco, $categoria);
        header('Location: consulta.php');
     }

?>