<!DOCTYPE html>
<html lang="pt-br">

<?php include('./components/head.php') ?>

<body>
    <?php
    require('./components/notification.php');
    ?>
    <main>
        <div class="container">
            <div class="row">
                <a role="button" href="./index.php">Home</a>
            </div>
        </div>
        <div class="container">
            <div class="formProduct">
                <h1>Cadastro de produtos</h1>
                <form action="./database/controller/insertData.php" method="post">
                    <div class="row">
                        <div>
                            <label for="name">Nome do produto</label>
                            <input type="text" name="name_product" id="name">
                        </div>

                        <div>
                            <label for="color">Cor do produto</label>
                            <select name="color_product" id="color">
                                <option value="#0000ff">Azul</option>
                                <option value="#ffff00">Amarelo</option>
                                <option value="#ff0000">Vermelho</option>
                            </select>
                        </div>

                        <div>
                            <label for="price">Preço do produto</label>
                            <input type="text" name="price_product" id="price">
                        </div>
                    </div>

                    <button type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>