CREATE DATABASE mscode_estoque2025;

USE mscode_estoque2025;

-- Create categoria table
CREATE TABLE categoria (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL
);

-- Create produto table
CREATE TABLE produto (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  descricao TEXT,
  categoria_id INT,
  data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
  quantidade_inicial INT,
  quantidade_disponivel INT,
  valor INT,
  FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);

-- Create usuario table
CREATE TABLE usuario (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL
);

-- Create venda table
CREATE TABLE venda (
  id INT PRIMARY KEY AUTO_INCREMENT,
  data_venda DATETIME DEFAULT CURRENT_TIMESTAMP,
  cpf_cliente VARCHAR(11),
  status ENUM('pendente', 'finalizada', 'cancelada') NOT NULL DEFAULT 'pendente'
);

-- Create venda_item table
CREATE TABLE venda_item (
  id INT PRIMARY KEY AUTO_INCREMENT,
  venda_id INT,
  produto_id INT,
  quantidade INT NOT NULL,
  preco_unitario DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (venda_id) REFERENCES venda(id),
  FOREIGN KEY (produto_id) REFERENCES produto(id)
);

-- Inserir usuario teste
INSERT INTO usuario (nome, email, senha) VALUES ('Usuario Teste', 'teste@teste.com', '$2y$10$imJI/zs.MLYTPl.AM.qxQ.XHILnO.zf61CRm0QppShzamLY7ksxee');

-- EXEMPLOS

-- Inserir categorias de teste
INSERT INTO categoria (nome) VALUES ('Eletrônicos');
INSERT INTO categoria (nome) VALUES ('Livros');
INSERT INTO categoria (nome) VALUES ('Vestuário');
INSERT INTO categoria (nome) VALUES ('Alimentos');

-- Inserir produtos de teste (certifique-se de que as IDs das categorias existem)
-- Supondo que 'Eletrônicos' tem id = 1, 'Livros' tem id = 2, 'Vestuário' tem id = 3
INSERT INTO produto (nome, descricao, categoria_id, quantidade_inicial, quantidade_disponivel, valor) VALUES 
('Smartphone Galaxy', 'Um smartphone de última geração.', 1, 50, 50, 2500),
('Notebook Gamer', 'Notebook potente para jogos e trabalho.', 1, 20, 20, 7000),
('O Senhor dos Anéis', 'Um clássico da literatura de fantasia.', 2, 100, 100, 50),
('Camiseta Estampada', 'Camiseta de algodão com estampa exclusiva.', 3, 200, 200, 35);

-- Inserir usuario
INSERT INTO usuario (nome, email, senha) VALUES 
('João Silva', 'joao.silva@teste.com', '$2y$10$imJI/zs.MLYTPl.AM.qxQ.XHILnO.zf61CRm0QppShzamLY7ksxee'),
('Maria Oliveira', 'maria.oliveira@teste.com', '$2y$10$imJI/zs.MLYTPl.AM.qxQ.XHILnO.zf61CRm0QppShzamLY7ksxee');

-- Insert venda
INSERT INTO venda (cpf_cliente, status) VALUES 
('12345678901', 'finalizada'),
('98765432109', 'finalizada'),
('11223344556', 'pendente'),
('66554433221', 'cancelada');

-- Insert venda_item
INSERT INTO venda_item (venda_id, produto_id, quantidade, preco_unitario) VALUES 
(1, 1, 1, 2500.00),
(1, 3, 2, 50.00);
INSERT INTO venda_item (venda_id, produto_id, quantidade, preco_unitario) VALUES 
(2, 4, 3, 35.00);
INSERT INTO venda_item (venda_id, produto_id, quantidade, preco_unitario) VALUES 
(3, 2, 1, 7000.00);
INSERT INTO venda_item (venda_id, produto_id, quantidade, preco_unitario) VALUES 
(4, 3, 1, 50.00);

-- Utils
SELECT * FROM usuario;
SELECT * FROM categoria;
SELECT * FROM produto;
SELECT * FROM venda;
SELECT * FROM venda_item;

DELETE FROM categoria WHERE id = 1;
DELETE FROM usuario;

UPDATE produto SET categoria_id = NULL WHERE categoria_id = 3;
