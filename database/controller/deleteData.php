<?php

session_start();

//validação de dados
if (isset($_GET['produto'])) {

    $id = $_GET['produto'];

    require('../connection.php');

    //Inserir no banco de dados
    $sqlProduct = "DELETE FROM produtos WHERE id = $id";
    $sqlPrice = "DELETE FROM precos WHERE id_produto = $id";

    //verifica se registro foi incluido
    if (mysqli_query($conn, $sqlProduct)) {
        if (mysqli_query($conn, $sqlPrice)) {
            $_SESSION['msg'] = ["Produto deletado", "notify-success"];
        } else {
            $_SESSION['msg'] = ["Ocorreu um erro ao deletar o preço", "notify-error"];
        }
    } else {
        $_SESSION['msg'] = ["Ocorreu um erro ao deletar o produto", "notify-error"];
    }

    //fecha conexão do banco de dados
    mysqli_close($conn);

    //mudar essa url da location caso seja diferente no seu
    header('Location: http://localhost/avaliacao/index.php');
} else {
    $_SESSION['msg'] = ["Dados faltando", "notify-error"];
    header('Location: http://localhost/avaliacao/index.php');
}


?>