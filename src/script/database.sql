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

CREATE TABLE item (
    id_item INT(8) AUTO_INCREMENT PRIMARY KEY,
    fk_produto INT(8),
    quantidade_prod INT(8) NOT NULL, -- Checar de onde isso está vindo
		FOREIGN KEY (fk_produto) REFERENCES produto (id_prod)
) CHARSET = utf8;

CREATE TABLE pedido (
    id_pedido INT(8) AUTO_INCREMENT PRIMARY KEY,
    datahora_ped DATETIME NOT NULL,
    valor_ped DECIMAL(10,2) NOT NULL, -- CONSTA
    pagamento_metodo_ped VARCHAR(35) NOT NULL, -- CONSTA
    status_ped ENUM('Pedido realizado', 'Preparando', 'Postado', 'A caminho', 'Entregue') DEFAULT 'Pedido realizado', -- Atributo visível ao usuário
    comprovante_ped VARCHAR(155) NOT NULL, -- Gerado automaticamente
    frete_ped DECIMAL(10,2), -- CONSTA
    fk_cliente INT(8), -- Checar ligação
    fk_item INT(8),
		FOREIGN KEY (fk_cliente) REFERENCES cliente (id_cliente),
        FOREIGN KEY (fk_item) REFERENCES item (id_item)
) CHARSET = utf8;

CREATE TABLE entrega (
    id_ent INT(8) AUTO_INCREMENT PRIMARY KEY,
    status_ent ENUM('Postado', 'A caminho', 'Entregue') DEFAULT 'Postado', -- Atributo que não será visível ao usuário
    cep_ent VARCHAR(9) NOT NULL,
    rua_ent VARCHAR(80) NOT NULL,
	numero_ent INT(10) NOT NULL,
	complemento_ent VARCHAR(20),
	bairro_ent VARCHAR(25) NOT NULL,
	cidade_ent VARCHAR(80) NOT NULL,
	estado_ent VARCHAR(2) NOT NULL, -- Todos os atributos de endereço constam
    fk_cliente INT(8), -- Checar ligação
    fk_ped INT(8), -- Checar ligação
		FOREIGN KEY (fk_cliente) REFERENCES cliente (id_cliente),
		FOREIGN KEY (fk_ped) REFERENCES pedido (id_pedido)
) CHARSET = utf8;

-- TRIGGER PARA REDUÇÃO DO ESTOQUE
DELIMITER $$ 
CREATE TRIGGER baixa_estoque AFTER INSERT ON item
FOR EACH ROW
BEGIN
    UPDATE produto
    SET estoque = estoque - NEW.quantidade_prod
    WHERE id_prod = NEW.fk_produto;
END $$
DELIMITER ;