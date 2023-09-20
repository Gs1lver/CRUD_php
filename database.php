<?php

    require('env.php');

    function conexao(){
        global $host, $user, $password, $database; //nao sei se é um bom habito mas n consegui pensar em outra forma de fazer isso :()
        try {
            $con = "mysql:host=$host;dbname=$database;charset=utf8";
            $pdo = new PDO($con, $user, $password); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }catch (PDOException $e) {
            echo "Erro ao conectar ao banco: " . $e->getMessage();
        }

        return $pdo;
    }

    function cadastrar($nome, $preco, $categoria, $foto){
        try{
            $nome = strtolower($nome);
            $pdo = conexao();
            $rows = verificarProdutoExistente($nome, $pdo);

            if ($rows <= 0){
                $smt = $pdo->prepare("INSERT INTO padaria (nome, preco, categoria, foto) VALUES (:nome, :preco, :categoria, :foto)");
                $smt->bindParam(':nome', $nome);
                $smt->bindParam(':preco', $preco);
                $smt->bindParam(':categoria', $categoria);
                $smt->bindParam(':foto', $foto);
                $smt->execute();
                echo "<span>Produto cadastrado com sucesso!</span>";
            } else {
                echo "<span>Produto já cadastrado!</span>";
            }

        } catch (PDOException $e){
            echo "Erro ao cadastrar produto: " . $e->getMessage();
        }
    }

    function verificarProdutoExistente($nome, $pdo){
        $nome = strtolower($nome);
        $smt = $pdo->prepare("SELECT * FROM padaria WHERE nome = :nome");
        $smt->bindParam(':nome', $nome);
        $smt->execute();
        $rows = $smt->rowCount();
        return $rows;
    }
    
    function consultar($nome = null) {
        $pdo = conexao();

        if($nome != null && $nome != ""){
            $smt = $pdo->prepare("SELECT * FROM padaria WHERE nome= :nome");
            $smt->bindParam(':nome', $nome);
        } else {
            $smt = $pdo->prepare("SELECT * FROM padaria");
        }
        $smt->execute();
        return $smt;
    }

    function excluir($nome){
        try{
            $pdo = conexao();
            $smt = $pdo->prepare("DELETE FROM padaria WHERE nome = :nome");
            $smt->bindParam(':nome', $nome);
            $smt->execute();
            echo "<span>Produto excluído com sucesso! Consulte novamente para atualizar a tabela!</span>";
        } catch (PDOException $e){
            echo "Erro ao excluir produto: " . $e->getMessage();
        }
    }

    function alterar(){

    }


