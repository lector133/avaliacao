<?php

session_start();

//validação de dados
if (isset($_POST['id_product'])) {

    $id = $_POST['id_product'];
    $nome = $_POST['name_product'];
    $preco = $_POST['price_product'];

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

    //Inserir no banco de dados
    $sqlProduct = "UPDATE produtos SET nome = '$nome' WHERE produtos.id = $id";
    $sqlPrice = "UPDATE precos SET preco = '$preco'  WHERE precos.id_produto = $id";

    //verifica se registro foi incluido
    if (mysqli_query($conn, $sqlProduct)) {
        if (mysqli_query($conn, $sqlPrice)) {
            $_SESSION['msg'] = ["Produto editado", "notify-success"];
        } else {
            $_SESSION['msg'] = ["Ocorreu um erro ao editar o preço", "notify-error"];
        }
    } else {
        $_SESSION['msg'] = ["Ocorreu um erro ao editar", "notify-error"];
    }

    //fecha conexão do banco de dados
    mysqli_close($conn);

    //mudar essa url da location caso seja diferente no seu
    header('Location: http://localhost/avaliacao/index.php');
} else {
    $_SESSION['msg'] = ["Dados faltando", "notify-error"];
    header('Location: http://localhost/avaliacao/editProduct.php?produto='. $_POST['id_produto']);
}


?>