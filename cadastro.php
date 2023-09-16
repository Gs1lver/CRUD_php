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
        <a href="index.html">Home</a>
        <a href="consulta.php">Consultar produto</a>
    </nav>

    <form action="post">
        <label for="nome">Nome do produto: </label>
        <input type="text" name="nome">

        <label for="preco">Preço: </label>
        <input type="text" name="preco">

        <select name="categoria">
            <option value="doce">Doce</option>]
            <option value="salgado">Salgado</option>
            <option value="bebida">Bebida</option>
            <option value="outro">Outro</option>
        </select>
    </form>

    <button type="submit" class="button">Cadastrar</button>
</body>

</html>