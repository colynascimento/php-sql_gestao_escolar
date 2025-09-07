<?php
$host = "localhost";
$user = "root";     // usuário padrão no XAMPP
$pass = "";         // senha padrão no XAMPP (vazia)
$db   = "gestao_escolar_db"; // seu banco de dados

// Cria a conexão
$conn = new mysqli($host, $user, $pass, $db);

// Testa conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
