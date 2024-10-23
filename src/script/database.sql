CREATE DATABASE tcc;
USE tcc;

CREATE TABLE cliente (
    id_cliente INT(8) AUTO_INCREMENT PRIMARY KEY,
    nome_cli VARCHAR(80) NOT NULL,
    email_cli VARCHAR(80) NOT NULL UNIQUE,
    cpf_cli VARCHAR(14) NOT NULL UNIQUE,
    tel_cli VARCHAR(14) NOT NULL UNIQUE,
    senha_cli VARCHAR(20) NOT NULL
) CHARSET = utf8;

CREATE TABLE produto (
    id_prod INT(8) AUTO_INCREMENT PRIMARY KEY,
    descricao_prod VARCHAR(255) NOT NULL,
    nome_prod VARCHAR(80) NOT NULL,
    tipo_prod VARCHAR(80) NOT NULL,
    cor_prod VARCHAR(80) NOT NULL,
    material_prod VARCHAR(80) NOT NULL,
    tamanho_prod VARCHAR(80) NOT NULL,
    estoque INT(8) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
) CHARSET = utf8;

CREATE TABLE pedido (
    id_pedido INT(8) AUTO_INCREMENT PRIMARY KEY,
    datahora_ped DATETIME NOT NULL,
    frete_ped DECIMAL(10,2),
    valortotal_ped DECIMAL(10,2) NOT NULL, 
    pagamento_metodo_ped VARCHAR(35) NOT NULL, 
    status_ped ENUM('Aguardando pagamento', 'Preparando', 'Postado', 'A caminho', 'Entregue') DEFAULT 'Aguardando pagamento',
    comprovante_ped VARCHAR(155) NOT NULL, 
    fk_cliente INT(8), 
		FOREIGN KEY (fk_cliente) REFERENCES cliente (id_cliente)
) CHARSET = utf8;

CREATE TABLE item_pedido (
    id_item INT(8) AUTO_INCREMENT PRIMARY KEY,
    fk_pedido INT(8),
    fk_produto INT(8),
    quantidade_prod INT(8) NOT NULL,
    cor_selecionada VARCHAR(80) NOT NULL,
		FOREIGN KEY (fk_pedido) REFERENCES pedido (id_pedido),
		FOREIGN KEY (fk_produto) REFERENCES produto (id_prod)
) CHARSET = utf8;

CREATE TABLE entrega (
    id_ent INT(8) AUTO_INCREMENT PRIMARY KEY,
    status_ent ENUM('Embalando', 'Postado', 'A caminho', 'Entregue') DEFAULT 'Embalando',
    cep_ent VARCHAR(9) NOT NULL,
    rua_ent VARCHAR(80) NOT NULL,
	numero_ent INT(10) NOT NULL,
	complemento_ent VARCHAR(20),
	bairro_ent VARCHAR(80) NOT NULL,
	cidade_ent VARCHAR(80) NOT NULL,
	estado_ent VARCHAR(2) NOT NULL, 
    fk_cliente INT(8), 
    fk_pedido INT(8), 
		FOREIGN KEY (fk_cliente) REFERENCES cliente (id_cliente),
		FOREIGN KEY (fk_pedido) REFERENCES pedido (id_pedido)
) CHARSET = utf8;

-- TRIGGER PARA REDUÇÃO DO ESTOQUE
DELIMITER $$ 
CREATE TRIGGER baixa_estoque AFTER INSERT ON item_pedido
FOR EACH ROW
BEGIN
    UPDATE produto
    SET estoque = estoque - NEW.quantidade_prod
    WHERE id_prod = NEW.fk_produto;
END $$
DELIMITER ;

update pedido set status_ped = 'Aguardando pagamento' where id_pedido = 12;
select * from pedido;
