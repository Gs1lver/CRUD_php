<?php

    require('env.php');

    try {
        $con = "mysql:host=$host;dbname=$database;charset=utf8";
        $pdo = new PDO($con, $user, $password); 
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e) {
        echo "Erro ao conectar ao banco: " . $e->getMessage();
    }


?>