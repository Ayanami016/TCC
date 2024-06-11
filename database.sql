create database tcc;
use tcc;

-- Murillo 28.04 - faltam todas as chaves estrangeiras

/*Isa 29.04 - Correção da quantia de caracteres em cada atributo, adição do charset utf-8
charset UTF-8 evitará erros de acentuação*/

-- Isa 13.05 - Correção nos nomes das foreign key e correção nas tabelas data e hora da tabela pedido
create table endereco (
id_endereco int(8) auto_increment primary key,
rua_end varchar (80) not null,
numero_end int(10) not null,
complemento_end varchar (20) not null,
bairro_end varchar (25) not null,
cidade_end varchar (80) not null,
estado_end varchar (2) not null,
cep_end varchar(9) not null,
fk_cliente int(8) -- FK
) charset = utf8;

create table cliente (
id_cliente int(8) auto_increment primary key,
nome_cli varchar (80) not null,
senha_cli varchar (20) not null,
email_cli varchar(80) not null unique,
tel_cli varchar(14) not null unique,
cpf_cli varchar(14) not null unique,
fk_endereco int(8) -- FK
) charset = utf8;

create table produto (
id_prod int(8) auto_increment primary key,
descricao_prod varchar(255) not null,
nome_prod varchar(80) not null,
tipo_prod varchar(80) not null,
cor_prod varchar(20) not null,
material_prod varchar(80) not null,
tamanho_prod varchar(10) not null,
estoque int(8) not null,
preco decimal(10,2) not null,
fk_fornec int(8) -- FK
) charset = utf8;

create table pedido (
id_pedido int(8) auto_increment primary key,
quantidade_ped int(10) not null,
data_ped date not null,
hora_ped time not null,
valor_ped decimal(10,2) not null, -- possivel alteração que pode ser util
pagamento_metodo_ped varchar(35) not null,
status_ped varchar(30) not null,
comprovante_ped varchar(155) not null,
frete_ped decimal(10,2) not null, -- possivel alteração que pode ser util
fk_prod int(8), -- FK
fk_cliente int(8) -- FK
) charset = utf8;

create table administrador (
id_adm int(8) auto_increment primary key,
cpf_adm varchar(14) not null unique,
nome_adm varchar(80) not null,
senha_adm varchar(20) not null,
tel_adm varchar(15) not null unique
) charset = utf8;

create table fornecedor (
id_fornec int(8) auto_increment primary key,
nome_fornec varchar(80) not null,
tel_fornec varchar(14) not null unique,
descricao_fornec varchar(255) not null,
historico_pedidos varchar(80) not null
) charset = utf8;

create table entrega (
id_ent int(8) auto_increment primary key,
status_ent varchar(20) not null,
metodo_envio varchar(80) not null,
fk_cliente int(8), -- FK
fk_prod int(8), -- FK
fk_endereco int(8) -- FK
) charset = utf8;
-- Isa 29.04 -  Criação e inserção de chave estrangeira
-- murillo 29.04 criacao da tabela com a possibilidade de alterar os dados em DECIMAL efalta adicionar a FK
-- Isa 02.05 - Alteração nas tabela pedido: adição do atributo 'pagamento_hora_ped datetime not null'

-- DADOS GENÉRICOS
-- AS FK nao precisam estar entre aspas simples
insert into endereco (rua_end, numero_end, complemento_end, bairro_end, cidade_end, estado_end, cep_end, fk_cliente)
	values ('rua vivara grande','69','casa 0','vila cuzil','sao paulo','SP','03379-020',1);
insert into cliente (nome_cli, senha_cli, email_cli, tel_cli, cpf_cli, fk_endereco)
	values ('agustinho','soumuitofoda123','agustinho@gmail.com','(11)12345-6789','123.456.789-10',1);
insert into produto (descricao_prod, nome_prod, tipo_prod, cor_prod, material_prod, tamanho_prod, estoque, preco, fk_fornec)
	values ('muito lindo!!!!','joia linda','joia','dourado','ouro','médio','90','289.99',1);
insert into pedido (quantidade_ped, data_ped, hora_ped, valor_ped, pagamento_metodo_ped, status_ped, comprovante_ped, frete_ped, fk_prod, fk_cliente)
	values ('12', current_date(), current_time(), '25.85','debito','em andamento','uh4ueifu43','14.00',1,1);
insert into administrador (cpf_adm, nome_adm, senha_adm, tel_adm)
	values ('000.000.000-00','marivaldo','AmooJesus','(11)12345-6781');
insert into fornecedor (nome_fornec, tel_fornec, descricao_fornec, historico_pedidos)
	values ('Chines 25 de março','(45)12345-6789','SOU CHINA MUITO LEGAL BIJUTERIA','Nao sei o que colocar aqui');
insert into entrega (status_ent, metodo_envio, fk_cliente, fk_prod, fk_endereco)
	values ('Enviando','Sedex',1,1,1);


-- FOREIGN KEY - TABELAS A SEREM ALTERADAS: endereco, cliente, produto, entrega
-- EXECUTAR ISSO PRIMEIRO CASO HAJA DROP TABLES
SET foreign_key_checks = 0;
-- FORMAÇÃO DO NOME DA FK: fk_id_ o que é a fk e onde está_ onde vai ser inserida
alter table endereco add constraint fk_id_cliente_endereco foreign key (fk_cliente) references cliente (id_cliente);
alter table cliente add constraint fk_id_endereco_cliente foreign key (fk_endereco) references endereco (id_endereco);
alter table produto add constraint fk_id_fornec_produto foreign key (fk_fornec) references fornecedor (id_fornec);
alter table pedido add constraint fk_id_prod_pedido foreign key (fk_prod) references produto (id_prod);
alter table pedido add constraint fk_id_cliente_pedido foreign key (fk_cliente) references cliente (id_cliente);
alter table entrega add constraint fk_id_cliente_entrega foreign key (fk_cliente) references cliente (id_cliente);
alter table entrega add constraint fk_id_prod_entrega foreign key (fk_prod) references produto (id_prod);
alter table entrega add constraint fk_id_endereco_entrega foreign key (fk_endereco) references endereco (id_endereco);

show tables;
select * from pedido;
drop database tcc;

/*LISTA DE COMANDOS
Ver tabela: select * from [nome_tabela]
Mostrar todas as tabelas: show tables;
Deletar tabela: drop table [nome_tabela]

AJUSTAR PRIMEIRO AS FK: SET foreign_key_checks = 0

Adicionar FK: 
alter table nometabeka
add constraint nome da fk - aqui voce personaliza
foreign key (fk)
references nome da tabela onde a fk se encontra (fk)
*/