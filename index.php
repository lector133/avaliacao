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
                <a role="button" href="./addProduct.php">Adicionar Produto</a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <table id="tabela">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Cor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>


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

                        $sqlProduct = "SELECT produtos.id, produtos.nome, produtos.cor, precos.preco FROM produtos
                    INNER JOIN precos ON produtos.id = precos.id_produto";

                        $results = $conn->query($sqlProduct);
                        if ($results->num_rows > 0) {
                            while ($row = $results->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td data-id="<?php echo $row['id'] ?>"><?php echo $row['id'] ?></td>
                                    <td data-nome="<?php echo $row['nome'] ?>"><?php echo $row['nome'] ?></td>
                                    <td data-preco="<?php echo $row['preco'] ?>">R$ <?php echo number_format($row['preco'] , 2, ',', '.')?></td>
                                    <td data-cor="<?php echo $row['cor'] ?>"><input type="color" value="<?php echo $row['cor'] ?>" disabled style="background-color: transparent; border-color:none; border: none" /></td>
                                    <td>
                                        <div class="row">
                                            <a role="button" href="./editProduct.php?produto=<?php echo $row['id'] ?>">Editar</a>
                                            <a role="button" href="./database/controller/deleteData.php?produto=<?php echo $row['id'] ?>">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php

                            }
                        } else {

                            ?>

                            <tr>
                                <td>Nenhum dado encontrado</td>
                                <td>Nenhum dado encontrado</td>
                                <td>Nenhum dado encontrado</td>
                                <td>Nenhum dado encontrado</td>
                                <td>Sem ações</td>
                            </tr>

                        <?php
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <input id="fiter_input" type="text">
            <button id="filter">Filtrar</button>
        </div>
    </main>

    <script>
        document.getElementById('filter').addEventListener('click', Pesquisar)

        function Pesquisar() {
            let Filtrar, Tabela, td, i;

            Filtrar = document.getElementById('fiter_input');

            Filtrar = Filtrar.value.toUpperCase();

            Tabela = document.getElementById('tabela');

            tr = Tabela.getElementsByTagName('tr');


            for (i = 1; i < tr.length; i++) {
                tdID = tr[i].getElementsByTagName("td")[0]

                if (tdID) {
                    if (tdID.innerHTML.toUpperCase().indexOf(Filtrar) > -1) {
                        tr[i].style.display = ""
                    } else {
                        tdNome = tr[i].getElementsByTagName("td")[1]

                        if (tdNome) {
                            if (tdNome.innerHTML.toUpperCase().indexOf(Filtrar) > -1) {
                                tr[i].style.display = ""
                            } else {
                                tdPreco = tr[i].getElementsByTagName("td")[2]

                                if (tdPreco) {
                                    if (tdPreco.innerHTML.toUpperCase().indexOf(Filtrar) > -1) {
                                        tr[i].style.display = ""
                                    } else {
                                        tdCor = tr[i].getElementsByTagName("td")[3]

                                        if (tdCor) {
                                            if (tdCor.innerHTML.toUpperCase().indexOf(Filtrar) > -1) {
                                                tr[i].style.display = ""
                                            } else {
                                                tr[i].style.display = "none"
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }
    </script>
</body>

</html>