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

CREATE TABLE endereco (
	id_endereco INT(8) AUTO_INCREMENT PRIMARY KEY,
	rua_end VARCHAR(80) NOT NULL,
	numero_end INT(10) NOT NULL,
	complemento_end VARCHAR(20),
	bairro_end VARCHAR(25) NOT NULL,
	cidade_end VARCHAR(80) NOT NULL,
	estado_end VARCHAR(2) NOT NULL,
	cep_end VARCHAR(9) NOT NULL,
	fk_cliente INT(8),
		FOREIGN KEY (fk_cliente) REFERENCES cliente (id_cliente)
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
    valor_ped DECIMAL(10,2) NOT NULL,
    pagamento_metodo_ped VARCHAR(35) NOT NULL,
    status_ped VARCHAR(30) NOT NULL,
    comprovante_ped VARCHAR(155) NOT NULL,
    frete_ped DECIMAL(10,2),
    fk_cliente INT(8),
		FOREIGN KEY (fk_cliente) REFERENCES cliente (id_cliente)
) CHARSET = utf8;

CREATE TABLE item (
    id_item INT(8) AUTO_INCREMENT PRIMARY KEY,
    fk_pedido INT(8),
    fk_produto INT(8),
    quantidade_prod INT(8) NOT NULL,
		FOREIGN KEY (fk_pedido) REFERENCES pedido (id_pedido),
		FOREIGN KEY (fk_produto) REFERENCES produto (id_prod)
) CHARSET = utf8;

CREATE TABLE entrega (
    id_ent INT(8) AUTO_INCREMENT PRIMARY KEY,
    status_ent VARCHAR(20) NOT NULL,
    metodo_envio VARCHAR(80) NOT NULL,
    fk_cliente INT(8),
    fk_ped INT(8),
    fk_endereco INT(8),
		FOREIGN KEY (fk_cliente) REFERENCES cliente (id_cliente),
		FOREIGN KEY (fk_ped) REFERENCES pedido (id_pedido),
		FOREIGN KEY (fk_endereco) REFERENCES endereco (id_endereco)
) CHARSET = utf8;

-- TRIGGER PARA REDUÇÃO DO ESTOQUE
DELIMITER $$ 
CREATE TRIGGER baixa_estoque AFTER INSERT ON item
FOR EACH ROW
BEGIN
    UPDATE produto
    SET estoque = estoque - NEW.quantidade_prod
    WHERE id_prod = NEW.fk_produto;
END$$
DELIMITER ;