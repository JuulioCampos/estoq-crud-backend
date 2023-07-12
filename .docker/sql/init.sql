-- Arquivo: init.sql

-- Criação da tabela 'product_type'
CREATE TABLE product_type (
  id SERIAL PRIMARY KEY,
  description VARCHAR(150) NOT NULL,
  tax DECIMAL(10, 2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserts para a tabela 'product_type'
INSERT INTO product_type (description, tax)
VALUES
  ('Cano', 1.2),
  ('Eletronico', 1.2),
  ('Alvenaria', 1.1),
  ('Alimento', 1.5),
  ('toRemoved', 1);

-- Criação da tabela 'product'
CREATE TABLE product (
  id SERIAL PRIMARY KEY,
  product VARCHAR(150) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  product_type_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (product_type_id) REFERENCES product_type(id)
);

-- Inserts para a tabela 'product'
INSERT INTO product (product, price, product_type_id)
VALUES
  ('Cano PVC', 21.2, 1),
  ('Televisão', 25.52, 2),
  ('Mesa', 31.01, 3),
  ('Banana', 212.2, 4),
  ('forRemove', 212.2, 4);

-- Criação da tabela 'sales'
CREATE TABLE sales (
  id SERIAL PRIMARY KEY,
  product_id INT NOT NULL,
  amount DECIMAL(10, 2) NOT NULL,
  quantity INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (product_id) REFERENCES product(id)
);

-- Inserts para a tabela 'sales'
INSERT INTO sales (product_id, amount, quantity)
VALUES
  (1, 50.0, 2),
  (2, 100.0, 5),
  (3, 150.0, 192),
  (4, 200.0, 1);
