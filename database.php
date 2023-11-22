<?php

require('env.php');

function conexao()
{
    global $host, $user, $password, $database; //nao sei se é um bom habito mas n consegui pensar em outra forma de fazer isso :()
    try {
        $con = "mysql:host=$host;dbname=$database;charset=utf8";
        $pdo = new PDO($con, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "<span class='warning'>Erro ao conectar ao banco: " . $e->getMessage() . "</span>";
    }

    return $pdo;
}

function criarArquivoProdutos($nomeArquivo)
{
    try {
        $pdo = conexao();

        $smt = $pdo->prepare("SELECT * FROM padaria_produtos");
        $smt->execute();
        $dados = $smt->fetchAll(PDO::FETCH_ASSOC); // essa linha é a que faz o select e retorna os dados

        $csv_file = fopen($nomeArquivo, "w");

        if (!empty($dados)) {
            fputcsv($csv_file, array_keys($dados[0]));
        }

        foreach ($dados as $linha) {
            fputcsv($csv_file, $linha);
        }

        fclose($csv_file);
        echo "<span class='success'>Arquivo criado com sucesso!</span>";
    } catch (PDOException $e) {
        echo "<span class='warning'>Erro ao criar arquivo: " . $e->getMessage() . "</span>";
    }
}

function cadastrar($nome, $preco, $categoria, $foto)
{
    try {
        $nome = ucfirst($nome);
        $pdo = conexao();
        $rows = verificarProdutoExistente($nome, $pdo);

        if ($rows <= 0) {
            $smt = $pdo->prepare("INSERT INTO padaria_produtos (nome, preco, categoria, foto) VALUES (:nome, :preco, :categoria, :foto)");
            $smt->bindParam(':nome', $nome);
            $smt->bindParam(':preco', $preco);
            $smt->bindParam(':categoria', $categoria);
            $smt->bindParam(':foto', $foto);
            $smt->execute();
            echo "<span class='success'>Produto cadastrado com sucesso!</span>";
        } else {
            echo "<span class='warning'>Produto já cadastrado!</span>";
        }
    } catch (PDOException $e) {
        echo "<span class='warning'>Erro ao cadastrar produto: " . $e->getMessage() . "</span>";
    }
}

function verificarProdutoExistente($nome, $pdo)
{
    $nome = strtolower($nome);
    $smt = $pdo->prepare("SELECT * FROM padaria_produtos WHERE nome = :nome");
    $smt->bindParam(':nome', $nome);
    $smt->execute();
    $rows = $smt->rowCount();
    return $rows;
}

function consultarProduto($nome = null)
{
    $pdo = conexao();

    if ($nome != null && $nome != "") {
        $smt = $pdo->prepare("SELECT * FROM padaria_produtos WHERE nome= :nome");
        $smt->bindParam(':nome', $nome);
    } else {
        $smt = $pdo->prepare("SELECT * FROM padaria_produtos");
    }
    $smt->execute();
    return $smt;
}

function produtosDisponiveis(){
    $pdo = conexao();
    $smt = $pdo->prepare("SELECT nome FROM padaria_produtos");
    $smt->execute();
    return $smt;
    //retorna so os nomes de produtos
}

function excluirProduto($nome)
{
    try {
        $pdo = conexao();
        $smt = $pdo->prepare("DELETE FROM padaria_produtos WHERE nome = :nome");
        $smt->bindParam(':nome', $nome);
        $smt->execute();
        echo "<span class='success'>Produto excluído com sucesso! Consulte novamente para atualizar a tabela!</span>";
    } catch (PDOException $e) {
        echo "<span class='warning'>Erro ao excluir produto: " . $e->getMessage() . "</span>";
    }
}

function alterarProdutoComFoto($nome, $preco, $categoria, $foto)
{
    try {
        $pdo = conexao();
        $smt = $pdo->prepare("UPDATE padaria_produtos SET nome = :nome, preco = :preco, categoria = :categoria, foto = :foto WHERE nome = :nome");
        $smt->bindParam(':nome', $nome);
        $smt->bindParam(':preco', $preco);
        $smt->bindParam(':categoria', $categoria);
        $smt->bindParam(':foto', $foto);
        $smt->execute();
        echo "<span class='success'>Produto alterado com sucesso!</span>";
    } catch (PDOException $e) {
        echo "<span class='warning'>Erro ao alterar produto: " . $e->getMessage() . "</span>";
    }
}

function alterarProdutoSemFoto($nome, $preco, $categoria)
{
    try {
        $pdo = conexao();
        $smt = $pdo->prepare("UPDATE padaria_produtos SET nome = :nome, preco = :preco, categoria = :categoria WHERE nome = :nome");
        $smt->bindParam(':nome', $nome);
        $smt->bindParam(':preco', $preco);
        $smt->bindParam(':categoria', $categoria);
        $smt->execute();
        echo "<span class='success'>Produto alterado com sucesso!</span>";
    } catch (PDOException $e) {
        echo "<span class='warning'>Erro ao alterar produto: " . $e->getMessage() . "</span>";
    }
}

function cadastrarPedido($cliente, $produto, $quantidade, $entrega, $disponivel)
{
    try {
        $pdo = conexao();
        $smt = $pdo->prepare("INSERT INTO padaria_pedidos (cliente, produto, quantidade, entrega, disponivel) VALUES (:cliente, :produto, :quantidade, :entrega, :disponivel)");
        $smt->bindParam(':cliente', $cliente);
        $smt->bindParam(':produto', $produto);
        $smt->bindParam(':quantidade', $entrega);
        $smt->bindParam(':disponivel', $disponivel);
        $smt->execute();
        echo "<span class='success'>Produto cadastrado com sucesso!</span>";

    } catch (PDOException $e) {
        echo "<span class='warning'>Erro ao cadastrar pedido: " . $e->getMessage() . "</span>";
    }
}

function consultarPedidos()
{
    $pdo = conexao();
    $smt = $pdo->prepare("SELECT * FROM padaria_produtos");
    $smt->execute();
    return $smt;
    //retorna todos os pedidos
}

function alterarPedido($disponivel){
    try {
        $pdo = conexao();
        $smt = $pdo->prepare("UPDATE padaria_pedidos SET nome = :nome, preco = :preco, categoria = :categoria WHERE nome = :nome");
        $smt->bindParam(':nome', $nome);
        $smt->bindParam(':preco', $preco);
        $smt->bindParam(':categoria', $categoria);
        $smt->execute();
        echo "<span class='success'>Produto alterado com sucesso!</span>";
    } catch (PDOException $e) {
        echo "<span class='warning'>Erro ao alterar produto: " . $e->getMessage() . "</span>";
    }
}