<?php

session_start();

//validação de dados
if (isset($_POST['name_product']) && isset($_POST['color_product']) && isset($_POST['price_product'])) {

    if (empty($_POST['name_product']) && empty($_POST['color_product']) && empty($_POST['price_product'])) {
        $_SESSION['msg'] = ["Preencha o formulário", "notify-error"];
    }

    $nome = $_POST['name_product'];
    $cor = $_POST['color_product'];

    if($cor == "#ffff00") {
        $preco_desconto = $_POST['price_product'] * (10 / 100);
        $preco = $_POST['price_product'] - $preco_desconto;
    } else if($cor == '#ff0000' && $_POST['price_product'] > 50) {
        $preco_desconto = $_POST['price_product'] * (5 / 100);
        $preco = $_POST['price_product'] - $preco_desconto;
    } else if($cor == '#ff0000' || $cor == "#0000ff") {
        $preco_desconto = $_POST['price_product'] * (20 / 100);
        $preco = $_POST['price_product'] - $preco_desconto;
    }

    require('../connection.php');
    //Inserir no banco de dados
    $sqlProduct = "INSERT INTO produtos (nome, cor) VALUES ('$nome', '$cor')";

    //verifica se registro foi incluido
    if (mysqli_query($conn, $sqlProduct)) {
        $sqlPrice = "INSERT INTO precos (id_produto, preco) VALUES ('$conn->insert_id', '$preco')";
        if (mysqli_query($conn, $sqlPrice)) {
            $_SESSION['msg'] = ["Produto cadastrado", "notify-success"];
        } else {
            $_SESSION['msg'] = ["Ocorreu um erro ao cadastrar o preço", "notify-error"];
        }
    } else {
        $_SESSION['msg'] = ["Ocorreu um erro ao cadastrar", "notify-error"];
    }

    //fecha conexão do banco de dados
    mysqli_close($conn);

    //mudar essa url da location caso seja diferente no seu
    header('Location: http://localhost/avaliacao/index.php');
} else {
    $_SESSION['msg'] = ["Dados faltando", "notify-error"];
    header('Location: http://localhost/avaliacao/addProduct.php');
}
