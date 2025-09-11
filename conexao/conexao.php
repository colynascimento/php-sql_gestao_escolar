<?php

$host = "localhost";  // Servidor do banco
$user = "root";       // Usuario (Padrão do XAMPP)
$pass = "";         // Senha (Vazia no XAMPP por padrão)
$db   = "gestao_escolar_db";  // Nome do banco

// Cria a conexão
$conn = new mysqli($host, $user ,$pass ,$db);

// Verifica se ocorreu algum erro
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>