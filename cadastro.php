<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        define("UPLOAD_DIR", "./imgs/produtos/");
        define("MAX_SIZE", 5 * 1024 * 1024);
        
        require('database.php');
        $nome = $_POST["nome"];
        $preco = $_POST["preco"];
        $categoria = $_POST["categoria"];
        $foto = $_FILES["foto"];

        // DEIXAR A INSERÇÃO DE FOTO OPCIONAL - sono
        
        // $nomeFoto = $foto["name"];
        // $tmpFoto = $foto["tmp_name"];
        // $tamanhoFoto = $foto["size"];
        // $tipoFoto = $foto["type"];

        // if (preg_match("/^image\/(png|jpg|gif|webp)$/", $tipoFoto) && $nomeFoto != "" && $tamanhoFoto <= MAX_SIZE) {
        //     $novaLocalizacao = UPLOAD_DIR . $nomeFoto;
        //     cadastrar($nome, $preco, $categoria, $novaLocalizacao);
        //     move_uploaded_file($tmpFoto, $novaLocalizacao);
        // } else {
        //     echo "Erro ao fazer upload do arquivo! Verifique se o arquivo é uma imagem e se o tamanho é menor que 5MB.";
        // }

      
        cadastrar($nome, $preco, $categoria, $foto);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Pão da Silva</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <nav>
        <a href="index.html">Home</a>
        <a href="consulta.php">Consultar produto</a>
    </nav>

    <h2>Cadastro</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="nome">Nome do produto: </label>
        <input type="text" name="nome" required>

        <label for="preco">Preço: </label>
        <input type="text" name="preco" required>

        <label for="categoria">Categoria: </label>
        <select name="categoria" required>
            <option value="doce">Doce</option>
            <option value="salgado">Salgado</option>
            <option value="bebida">Bebida</option>
            <option value="outro">Outro</option>
        </select>

        <label for="foto">Foto: </label>
        <input type="file" name="foto">
        
        <input type="submit" value="Cadastrar" class="button"></input>
    </form>

</body>

</html>
