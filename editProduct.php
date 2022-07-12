<!DOCTYPE html>
<html lang="pt-br">

<?php include('./components/head.php') ?>

<body>
    <?php
     require('./components/notification.php');
    ?>

    <?php

    if (empty($_GET['produto'])) {
        $_SESSION['msg'] = ["Produto não encontrado", "notify-error"];
        header('Location: http://localhost/avaliacao/index.php');
    } else {
        require('./database/connection.php');


        $id = $_GET['produto'];
        $sqlProduct = "SELECT id, nome, cor FROM produtos WHERE produtos.id= $id";

        $results = $conn->query($sqlProduct);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $id = $row['id'];
                $nome = $row['nome'];
                $cor = $row['cor'];
            }
        } else {
            $_SESSION['msg'] = ["Ocorreu um erro ao achar dado", "notify-error"];
        }

        $ids = $_GET['produto'];
        $sqlPreco = "SELECT id, preco, id_produto FROM precos WHERE precos.id_produto= $ids";

        $result = $conn->query($sqlPreco);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $preco = $row['preco'];
            }
        } else {
            $_SESSION['msg'] = ["Ocorreu um erro ao achar dado do preço", "notify-error"];
        }

        $conn->close();
    }

    ?>
    <main>
    <div class="container">
            <div class="row">
                <a role="button" href="./index.php">Home</a>
            </div>
        </div>
        <div class="container">
            <div class="formProduct">
                <h1>Edição de produtos</h1>
                <form action="./database/controller/editData.php" method="post">
                    <div class="row">

                        <div>
                            <label for="name">Nome do produto</label>
                            <input type="text" name="name_product" value="<?php echo $nome; ?>" id="name">
                        </div>

                        <div>
                            <label for="price">Preço do produto</label>
                            <input type="text" name="price_product" value="<?php echo number_format($preco , 2, ',', '.')?>" id="price">
                        </div>
                    </div>

                    <input type="hidden" name="id_product" value="<?php echo $id ?>">

                    <button type="submit">Editar</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>