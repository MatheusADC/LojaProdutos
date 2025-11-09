<?php
// Conexão com o banco de dados
$servername = "YOUR_SERVER_NAME";
$username = "YOUR_USER_NAME";
$password = "YOUR_PASSWORD";
$dbname = "YOUR_DB_NAME";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>