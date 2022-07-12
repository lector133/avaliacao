<?php
//Dados de conexão banco de dados
$servername = "127.0.0.1";
$database = "avaliacao";
$username = "root";
$password = "";

// Criando conecção
$conn = mysqli_connect($servername, $username, $password, $database);

// Checando conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}


?>