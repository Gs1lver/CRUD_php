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
        <label for="produto">Produto:</label>
        <input type="text" name="produto">

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" min="0" max="50">

        <input class="button" type="submit" value="Pedir">
    </form>
</body>

</html>