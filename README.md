# avaliacao

Essa é minha conta secundária do github. O teste foi colocado nela para não misturar projetos e testes na conta principal...

O projeto foi criado usando PHP, Apache e PHPMyAdmin. Caso utilize outro tipo de banco de dados, mude os dados na configuração da connection.php;

# comandos mysql

CREATE DATABASE avaliacao;

CREATE TABLE produtos (id int NOT NULL AUTO_INCREMENT,  
    nome varchar(45) NOT NULL,  
    cor varchar(35) NOT NULL,  
    PRIMARY KEY (id) );

CREATE TABLE precos (id int NOT NULL AUTO_INCREMENT,  
    preco decimal(8,2) NOT NULL,  
    id_produto int,  
    PRIMARY KEY (id),
    FOREIGN KEY (id_produto) REFERENCES produtos(id) );
