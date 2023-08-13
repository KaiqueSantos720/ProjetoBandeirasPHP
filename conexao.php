<?php
    try {
        $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=php_project;charset=utf8', 'root', 'testes-bancos-de-dados');
    } catch (PDOException $e) {
        echo "<p>" . 'Erro: ' . $e->getMessage() . "</p>";
    }
    return $db;
?>