<?php
    try {
        $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=projeto_paises_php;charset=utf8', 'root', '123456');
    } catch (PDOException $e) {
        echo "<p>" . 'Erro: ' . $e->getMessage() . "</p>";
    }
    return $db;
?>