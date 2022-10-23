# EBD: Database Specification Component

 OnlyT3ch é uma plataforma web de compras online que permite aos seus utlizadores acesso a um vasto catálogo de produtos informáticos.
 
## A4: Conceptual Data Model

Este artefacto representa as principais entidades organizacionais, os relacionamentos entre elas, os atributos e a multiplicidade de relacionamentos para o site da Onlyt3ch.

### 1. Class diagram

 ![](./UML.png) 


### 2. Additional Business Rules
 
- BR01. Um utilizador não pode avaliar produtos que não tenha adquirido.
- BR02. O preço dos produtos têm de ser um valor positivo.
- BR03. O valor total da encomenda é a soma dos preços de todos comprados.


---


## A5: Relational Schema, validation and schema refinement

Este artefato contém o Esquema Relacional obtido pelo mapeamento do Modelo de Dados Conceituais. O Esquema Relacional inclui cada esquema de relação, atributos, domínios, chaves primárias, chaves estrangeiras e outras regras de integridade: UNIQUE, DEFAULT, NOT NULL, CHECK.

### 1. Relational Schema
 

| Relation reference | Relation Compact Notation                        |
| ------------------ | ------------------------------------------------ |
| R01                | user( __id__, name __NN__, password __NN__, email __NN__ __UK__, phone __NN__)                     |
| R02                | admin( __user_id__ → user)            |
| R03                | category( __id__, name __NN__) |
| R04                | cart(  __user_id__ → user, __product_id__ → product, quantity __CK__ quantity >= 0) |
| R05                | address( __id__, __user_id__ → user, street __NN__, houseNumber __NN__ __CK__ houseNumber > 0, postalCode __NN__, city __NN__, country __NN__ ) |
| R06                | order( __id__, __user_id__ → user, __address_id__ → address, __purchase_id__ → purchase, orderDate __NN__ __DF__ Today, cost __NN__ __CK__ cost > 0, status __NN__ __CK__ status __IN__ Status ) |
| R07                | product( __id__, __category_id__ → category, name __NN__, price __NN__ __CK__ price > 0, description __NN__, quantity __NN__ __CK__ quantity >= 0 ,score __CK__ score > 0 AND score <= 5, photo __NN__ ) | 
| R08                | purchase( __id__, __user_id__ → user,__product_id__ → product, totalCost __NN__ __CK__ totalCost > 0, date __NN__ __DF__ Today, quantity __CK__ quantity >= 0) |
| R09                | productPurchase (__product_id__ → product, __purchase_id__ → purchase) |
| R10                | review( __user_id__ → user, __product_id__ → product, title __NN__, comment __NN__, date __NN__ __DF__ Today, score __CK__ score > 0 AND score <= 5  ) |
| R11                | wishlist( __user_id__ → User, __product_id__ → product,  quantity __CK__ quantity >= 0 )   |
| R12                | about( __id__, email __NN__, phone __NN__ ) |

### Legenda:
  -  UK = UNIQUE KEY
  -  NN = NOT NULL
  -  DF = DEFAULT
  -  CK = CHECK
  
### 2. Domains


| Domain Name | Domain Specification           |
| ----------- | ------------------------------ |
| Today	      | DATE DEFAULT CURRENT_DATE      |
| Status      | ENUM ('Processing', 'Shipping', 'Delivered') |

### 3. Schema validation


| **TABLE R01**   | User               |
| --------------  | ---                |
| **Keys**        | { id }, { email }  |
| **Functional Dependencies:** |       |
| FD0101          | {id} → {email, name, password, phone} |
| FD0102          | email → {id, name, password, phone} |
| **NORMAL FORM** | BCNF               |

| **TABLE R02**   | Admin              |
| --------------  | ---                |
| **Keys**        | { id } |
| **NORMAL FORM** | BCNF               |

| **TABLE R03**   | Category              |
| --------------  | ---                |
| **Keys**        | { id }  |
| **Functional Dependencies:** |       |
| FD0301          | {id} → {name} |
| **NORMAL FORM** | BCNF               |

| **TABLE R04**   | Cart               |
| --------------  | ---                |
| **Keys**        | { User_id, Product_id }  |
| **Functional Dependencies:** |       |
| FD0401          | {User_id, Product_id} → {quantity} |
| **NORMAL FORM** | BCNF               |

| **TABLE R05**   | Address              |
| --------------  | ---                |
| **Keys**        | { id }  |
| **Functional Dependencies:** |       |
| FD0501          | {id} → {street, houseNumber, postalCode, city, country, User_id} |
| **NORMAL FORM** | BCNF               |

| **TABLE R06**   | Order               |
| --------------  | ---                |
| **Keys**        | { id }  |
| **Functional Dependencies:** |       |
| FD0601          | {id} → {orderDate, cost, deliveryDate, User_id, Address_id, Purchase_id} |
| **NORMAL FORM** | BCNF               |

| **TABLE R07**   | Product               |
| --------------  | ---                |
| **Keys**        | { id }  |
| **Functional Dependencies:** |       |
| FD0701          | {id} → {name, price, description, quantity, score, photo, Category_id} |
| **NORMAL FORM** | BCNF               |

| **TABLE R08**   | Purchase               |
| --------------  | ---                |
| **Keys**        | { id }  |
| **Functional Dependencies:** |       |
| FD0901          | {id} → {totalCost, date, status,quantity, Product_id, User_id} |
| **NORMAL FORM** | BCNF               |

| **TABLE R09**   | productPurchase               |
| --------------  | ---                |
| **Keys**        | { product_id, purchase_id}  |
| **NORMAL FORM** | BCNF               |

| **TABLE R10**   | Review               |
| --------------  | ---                |
| **Keys**        | { id }  |
| **Functional Dependencies:** |       |
| FD0801          | {id} → {title, comment, date, score,User_id, Product_id} |
| **NORMAL FORM** | BCNF               |

| **TABLE R11**   | Wishlist               |
| --------------  | ---                |
| **Keys**        |  {User_id, Product_id}|
| **Functional Dependencies:** |       |
| FD0901          | {User_id, Product_id} → {quantity} |
| **NORMAL FORM** | BCNF               |

| **TABLE R12**   | About               |
| --------------  | ---                |
| **Keys**        | { id }  |
| **Functional Dependencies:** |       |
| FD0901          | {id} → {email, phone} |
| **NORMAL FORM** | BCNF               |

Como todas as relações estão na forma normal de Boyce-Codd (BCNF), o esquema relacional também está no BCNF e, portanto, o esquema não precisa ser normalizado posteriormente.


---


## A6: Indexes, triggers, transactions and database population

Este artefacto contém o esquema físico da base de dados, índicies, triggers e transações necessárias para garantir a integridade dos dados. Contém também uma precisão do crescimento e da magnitude da base de dados,assim como um script completo da sua criação, incluindo todo o SQL necessário.

### 1. Database Workload
 

| **Relation reference** | **Relation Name** | **Order of magnitude**        | **Estimated growth** |
| ------------------ | ------------- | ------------------------- | -------- |
| R01                | User       | 10 k (tens of thousands) | 10 (tens) / day |
| R02                | Admin        | 100 (hundreds) | 1 (units) / day| 
| R03                | Category       | 10  | no growth |
| R04                | Cart       | 10 k  | 100 / day |
| R05                | Address      | 10 k  | 10 / day |
| R06                | Order       | 1 k  | 10 / day |
| R07                | Product       | 100   | 1 / month |
| R08                | Purchase       | 1 k  | 10 / day |
| R09                | ProductPurchase       | 1 k  | 10 / day |
| R10                | Review       | 1 k  | 10 / day |
| R11                | Wishlist       | 1 k  | 10 / day |
| R12                | About       | 1  | no growth |


### 2. Proposed Indices

#### 2.1. Performance Indices
 

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | 	Purchase   |
| **Attribute**       |  	id_Users   |
| **Type**            | Hash             |
| **Cardinality**     | Medium |
| **Clustering**      | No             |
| **Justification**   | Table 'Purchase'  is frequently accessed to obtain a user’s Purchases.Filtering is done by exact match, thus an hash type is best suited. However, expected update frequency is medium, so no clustering is proposed.  |
```sql
CREATE INDEX userid_purchase ON Purchase USING hash (id_Users);
```
| **Index**           | IDX02                                  |
| ---                 | ---                                    |
| **Relation**        | 	Review   |
| **Attribute**       |  	id_Product   |
| **Type**            | Hash             |
| **Cardinality**     | Medium |
| **Clustering**      | No              |
| **Justification**   | Table 'Review'  is frequently accessed to obtain a product’s Review.Filtering is done by exact match, thus an hash type is best suited.However, expected update frequency is medium, so no clustering is proposed.   |
```sql
CREATE INDEX idproduct_review ON Review USING hash (id_Product);
```
| **Index**           | IDX03                                  |
| ---                 | ---                                    |
| **Relation**        | 	Product   |
| **Attribute**       |  	id_Category   |
| **Type**            | Hash             |
| **Cardinality**     | Medium |
| **Clustering**      | No              |
| **Justification**   | The query that gets the products of a certain category is executed several times so it has to be fast. However, expected update frequency is medium, so no clustering is proposed.   |
```sql
CREATE INDEX idcategory_product ON Product USING hash (id_Category);
```

| **Index**           | IDX04                                  |
| ---                 | ---                                    |
| **Relation**        | 	Product   |
| **Attribute**       |  	price  |
| **Type**            |  	B-tree            |
| **Cardinality**     | High |
| **Clustering**      | Yes             |
| **Justification**   | Table ‘Product’ is frequently accessed for Products filtered by the lower prices. A b-tree index allows for faster price range queries based on the lower price  |
```sql
CREATE INDEX price_product ON Product USING btree (price);
```

#### 2.2. Full-text Search Indices 

| **Index**           | IDX05                                  |
| ---                 | ---                                    |
| **Relation**        | Product    |
| **Attribute**       | Name   |
| **Type**            | GIN             |
| **Clustering**      | NO                |
| **Justification**   | Used for improving the performance of full text search while searching for a specific term in of the biggest table of the database, 'task'. GIN was used because a task's name and description are not updated frequently.   |
```sql
ALTER TABLE Product
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION product_search_update() RETURNS TRIGGER AS $$
BEGIN
IF TG_OP = 'INSERT' THEN
  NEW.tsvectors = (
    setweight(to_tsvector('english', New.name), 'A') || setweight(to_tsvector('english', New.description), 'B')
  );
END IF;
IF TG_OP = 'UPDATE' THEN
  IF (New.name <> Old.name OR New.description <> Old.description) THEN
    New.tsvectors = (
      setweight(to_tsvector('english', New.name), 'A') || setweight(to_tsvector('english', New.description), 'B')
    );
  END IF;
END IF;
RETURN New;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER product_search_update
BEFORE INSERT OR UPDATE ON Product
FOR EACH row
EXECUTE PROCEDURE product_search_update();

CREATE INDEX search_idx ON Product USING GIN(tsvectors);
```


### 3. Triggers
 

| **Trigger**      | TRIGGER01                              |
| ---              | ---                                    |
| **Description**  | Update products' score according to all existing reviews |
```sql
CREATE FUNCTION update_product_score() RETURNS TRIGGER AS
$BODY$
BEGIN
	UPDATE Product
	SET score = (SELECT AVG(score) FROM Review WHERE id_Product = New.id_Product)
	WHERE id_Product = New.id_Product;
RETURN NEW; 	
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER product_score AFTER INSERT OR UPDATE OR DELETE
ON Review
EXECUTE PROCEDURE update_product_score();
```

| **Trigger**      | TRIGGER02                              |
| ---              | ---                                    |
| **Description**  | An user can't buy more than the available quantity of products |
```sql
CREATE FUNCTION check_purchase_quantities() RETURNS TRIGGER AS
$BODY$
BEGIN
	IF
		NOT EXISTS (SELECT quantity FROM Product WHERE id_Product = New.id_Product AND quantity >= New.quantity)
	THEN
		RAISE EXCEPTION 'You can’t buy % items of product %' , New.quantity, New.id_Product;
	END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_purchase_quantities BEFORE INSERT
ON Purchase
FOR EACH ROW
EXECUTE PROCEDURE check_purchase_quantities();
```

| **Trigger**      | TRIGGER03                              |
| ---              | ---                                    |
| **Description**  | When a user buys a product it is removed from it's cart |
```sql
CREATE FUNCTION clear_cart() RETURNS TRIGGER AS
$BODY$
BEGIN
	DELETE FROM Cart
	WHERE id_Users = New.id_Users;

RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER clear_cart AFTER INSERT
ON Purchase
EXECUTE PROCEDURE clear_cart();
```
| **Trigger**      | TRIGGER04                              |
| ---              | ---                                    |
| **Description**  | If a wishlist's product is added to the cart it is removed from the wishlist |
```sql
CREATE FUNCTION remove_wishlist_product() RETURNS TRIGGER AS
$BODY$
BEGIN
	DELETE FROM Wishlist
	WHERE id_Users = New.id_Users
  AND id_Product = New.id_Product;
RETURN NEW;  
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER remove_wishlist_product AFTER INSERT
ON Cart
EXECUTE PROCEDURE remove_wishlist_product();
```

| **Trigger**      | TRIGGER05                              |
| ---              | ---                                    |
| **Description**  | When a product is bought its available quantity is reduced |
```sql
CREATE FUNCTION update_available_products() RETURNS TRIGGER AS
$BODY$
BEGIN
  UPDATE Product
  SET quantity = quantity - New.quantity
  WHERE id_Product = New.id_Product;
RETURN NEW;   
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_available_products AFTER INSERT
ON Purchase
EXECUTE PROCEDURE update_available_products();

```

### 4. Transactions
 
> Transactions needed to assure the integrity of the data.  

| SQL Reference   | TRAN01                   |
| --------------- | ----------------------------------- |
| Justification   |In the middle of the transaction, the insertion of new rows in the review table can occur, which implies that the information retrieved in the query that selects the reviews counter and the query that selects the reviews is different, consequently resulting in a Phantom Read. It's READ ONLY because it only uses Selects.  |
| Isolation level |  	SERIALIZABLE READ ONLY |
```sql
    BEGIN TRANSACTION;
    SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;

    SELECT COUNT(*)
    FROM Review AS R
    WHERE R.id_Product = id_Product;

    SELECT R.title, R.comment, R.creationDate, R.score, U.name
    FROM Review AS R, User AS U
    WHERE R.id_Product = id_Product;

  END TRANSACTION;                          
```

## Annex A. SQL Code


### A.1. Database schema

```sql
CREATE SCHEMA lbaw22114;

SET search_path TO lbaw22114;

CREATE DOMAIN "Today" AS date NOT NULL DEFAULT ('now'::text)::date;

DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS Address CASCADE;
DROP TABLE IF EXISTS Category CASCADE;
DROP TABLE IF EXISTS Product CASCADE;
DROP TABLE IF EXISTS Review CASCADE;
DROP TABLE IF EXISTS Wishlist CASCADE;
DROP TABLE IF EXISTS Purchase CASCADE;
DROP TABLE IF EXISTS ProductPurchase CASCADE;
DROP TABLE IF EXISTS Orders CASCADE;
DROP TABLE IF EXISTS Cart CASCADE;
DROP TABLE IF EXISTS AdminUsers CASCADE;
DROP TABLE IF EXISTS About CASCADE;

create table Users(
  id_Users SERIAL PRIMARY KEY,
  name TEXT NOT NULL,
  password TEXT NOT NULL,
  email VARCHAR(128) UNIQUE NOT NULL,
  phone INT NOT NULL
);

create table Address(
  id_Address SERIAL PRIMARY KEY,
  houseNumber INTEGER NOT NULL CHECK (houseNumber > 0),
  postalCode TEXT NOT NULL,
  city TEXT NOT NULL,
  country TEXT NOT NULL,
  id_Users INTEGER REFERENCES Users(id_Users) ON DELETE CASCADE
);

create table Category(
  id_Category SERIAL PRIMARY KEY,
  name TEXT NOT NULL
);

create table Product(
  id_Product SERIAL PRIMARY KEY,
  name TEXT NOT NULL,
  price FLOAT NOT NULL CHECK (price > 0),
  description TEXT NOT NULL,
  quantity INTEGER NOT NULL CHECK (quantity >= 0),
  score FLOAT CHECK (score >= 0 AND score <= 5),
  photo TEXT NOT NULL,
  id_Category INTEGER REFERENCES Category(id_Category)
);

create table Review(
  id_Review SERIAL PRIMARY KEY,
  title TEXT NOT NULL,
  comment TEXT NOT NULL,
  creationDate TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
  score FLOAT CHECK (score >= 0 AND score <= 5),
  id_Users INTEGER REFERENCES Users(id_Users) ON DELETE CASCADE,
  id_Product INTEGER REFERENCES Product(id_Product)
);

create table Wishlist(
  id_Users INTEGER REFERENCES Users(id_Users),
  id_Product INTEGER REFERENCES Product(id_Product),
  quantity INTEGER CHECK (quantity >= 0)
);

create table Purchase(
  id_Purchase SERIAL PRIMARY KEY,
  totalCost FLOAT NOT NULL CHECK (totalCost > 0),
  purchaseDate TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
  quantity INTEGER CHECK (quantity >= 0),
  id_Product INTEGER REFERENCES Product(id_Product),
  id_Users INTEGER REFERENCES Users(id_Users)
);

create table ProductPurchase(
  id_Product INTEGER REFERENCES Product(id_Product) ON UPDATE CASCADE,
  id_Purchase INTEGER REFERENCES Purchase(id_Purchase) ON UPDATE CASCADE,
  PRIMARY KEY(id_Product, id_Purchase)
);

create table Orders(
  id_PurchaseOrder SERIAL PRIMARY KEY,
  cost FLOAT NOT NULL CHECK (cost > 0),
  orderDate TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
  status TEXT NOT NULL,
  CONSTRAINT status CHECK (status IN ('Processing', 'Shipping', 'Delivered')),
  id_Users INTEGER REFERENCES Users(id_Users),
  id_Address INTEGER REFERENCES Address(id_Address) ON DELETE CASCADE,
  id_Purchase INTEGER REFERENCES Purchase(id_Purchase) ON DELETE CASCADE
);

create table Cart(
  id_Users INTEGER REFERENCES Users(id_Users),
  id_Product INTEGER REFERENCES Product(id_Product),
  quantity INTEGER CHECK (quantity >= 0)
);

create table AdminUsers(
  id_Users INTEGER PRIMARY KEY REFERENCES Users(id_Users)
);

create table About(
  id_About SERIAL PRIMARY KEY,
  email TEXT NOT NULL,
  phone INTEGER NOT NULL
);


-- INDEX 1
CREATE INDEX userid_purchase ON Purchase USING hash (id_Users);

-- INDEX 2
CREATE INDEX idproduct_review ON Review USING hash (id_Product);

-- INDEX 3
CREATE INDEX idcategory_product ON Product USING hash (id_Category);

-- INDEX 4
CREATE INDEX price_product ON Product USING btree (price);

-- INDEX 5
ALTER TABLE Product
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION product_search_update() RETURNS TRIGGER AS $$
BEGIN
IF TG_OP = 'INSERT' THEN
  NEW.tsvectors = (
    setweight(to_tsvector('english', New.name), 'A') || setweight(to_tsvector('english', New.description), 'B')
  );
END IF;
IF TG_OP = 'UPDATE' THEN
  IF (New.name <> Old.name OR New.description <> Old.description) THEN
    New.tsvectors = (
      setweight(to_tsvector('english', New.name), 'A') || setweight(to_tsvector('english', New.description), 'B')
    );
  END IF;
END IF;
RETURN New;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER product_search_update
BEFORE INSERT OR UPDATE ON Product
FOR EACH row
EXECUTE PROCEDURE product_search_update();

CREATE INDEX search_idx ON Product USING GIN(tsvectors);


-- TRIGGER 1
CREATE FUNCTION update_product_score() RETURNS TRIGGER AS
$BODY$
BEGIN
	UPDATE Product
	SET score = (SELECT AVG(score) FROM Review WHERE id_Product = New.id_Product)
	WHERE id_Product = New.id_Product;
RETURN NEW; 	
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER product_score AFTER INSERT OR UPDATE OR DELETE
ON Review
EXECUTE PROCEDURE update_product_score();


-- TRIGGER 2
CREATE FUNCTION check_purchase_quantities() RETURNS TRIGGER AS
$BODY$
BEGIN
	IF
		NOT EXISTS (SELECT quantity FROM Product WHERE id_Product = New.id_Product AND quantity >= New.quantity)
	THEN
		RAISE EXCEPTION 'You can’t buy % items of product %' , New.quantity, New.id_Product;
	END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_purchase_quantities BEFORE INSERT
ON Purchase
FOR EACH ROW
EXECUTE PROCEDURE check_purchase_quantities();


-- TRIGGER 3
CREATE FUNCTION clear_cart() RETURNS TRIGGER AS
$BODY$
BEGIN
	DELETE FROM Cart
	WHERE id_Users = New.id_Users;

RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER clear_cart AFTER INSERT
ON Purchase
EXECUTE PROCEDURE clear_cart();


-- TRIGGER 4
CREATE FUNCTION remove_wishlist_product() RETURNS TRIGGER AS
$BODY$
BEGIN
	DELETE FROM Wishlist
	WHERE id_Users = New.id_Users
  AND id_Product = New.id_Product;
RETURN NEW;  
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER remove_wishlist_product AFTER INSERT
ON Cart
EXECUTE PROCEDURE remove_wishlist_product();


-- TRIGGER 5
CREATE FUNCTION update_available_products() RETURNS TRIGGER AS
$BODY$
BEGIN
  UPDATE Product
  SET quantity = quantity - New.quantity
  WHERE id_Product = New.id_Product;
RETURN NEW;   
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_available_products AFTER INSERT
ON Purchase
EXECUTE PROCEDURE update_available_products();


```

### A.2. Database population

```sql

-----------------------------------------
-- Populate the database
-----------------------------------------


-- Users
INSERT INTO Users VALUES (DEFAULT,'Example','Example123','Example@example.com','987654321');
INSERT INTO Users VALUES (DEFAULT,' Elwood Ellis','tMF3sw6','wood34@gmmail.com','93697524');
INSERT INTO Users VALUES (DEFAULT,' Tiffani Derek ','QJg4MehPa','tiderek@1232.com','95334314');
INSERT INTO Users VALUES (DEFAULT,' Timmy Hattie ','MP2p7BhIH','hatie3231@de32.org','90853239');
INSERT INTO Users VALUES (DEFAULT,' Dave Randi ','9I8ELTY7u','randi53621@gmaiiil.com','99930384');
INSERT INTO Users VALUES (DEFAULT,' Ira Trinity ','3Th8FkGHv','iraa4253@asd.com','90416185');
INSERT INTO Users VALUES (DEFAULT,' Ernest Macie ','AbxSjnfyC','23macie123@hotmail.com','93749133');
INSERT INTO Users VALUES (DEFAULT,' Davey Katrina ','fvuGD9Mye','katrinaa12@869.com','96523660');
INSERT INTO Users VALUES (DEFAULT,' Hester Araminta ','PqKwgZNUj','hester1524@mail.com','93498111');
INSERT INTO Users VALUES (DEFAULT,' Essie Lorin ','eevQ9yKbK','lorin132@ess.com','95690506');
INSERT INTO Users VALUES (DEFAULT,' Josh Jed ','qUM8czLpV','jjed@12321.com','95221856');
INSERT INTO Users VALUES (DEFAULT,' Demelza Dylan ','GjD9kL3jE','de_dy3431@mail.com','99825607');
INSERT INTO Users VALUES (DEFAULT,' Dionne Lally ','wTrXHpDfv','ionne213@56gt.com','98317321');
INSERT INTO Users VALUES (DEFAULT,' Severo Soren ','TxaGa44aT','sorenn_12@ial.com','97749743');
INSERT INTO Users VALUES (DEFAULT,' Angus Jaimie ','bq85c6Ays','imae32123@hotmail.com','93622457');

-- Admins
INSERT INTO AdminUsers VALUES (1);
INSERT INTO AdminUsers VALUES (2);
INSERT INTO AdminUsers VALUES (3);

-- About
INSERT INTO About VALUES (DEFAULT,'onlyt3ch@gmailll.com',9333333);

-- address
INSERT INTO Address VALUES  (DEFAULT,'2','5100-123','Porto','Portugal','3');
INSERT INTO Address VALUES  (DEFAULT,'109','2340-12','Madrid','Spain','6');
INSERT INTO Address VALUES  (DEFAULT,'2343','7123-134','London','England','5');
INSERT INTO Address VALUES  (DEFAULT,'543','4523-234','Lisbon','Portugal','7');
INSERT INTO Address VALUES  (DEFAULT,'214','1232-123','Paris','French','12');
INSERT INTO Address VALUES  (DEFAULT,'65','4324-765','Aveiro','Portugal','11');
INSERT INTO Address VALUES  (DEFAULT,'123','2341-543','Roma','Italy','15');
INSERT INTO Address VALUES  (DEFAULT,'7657','3432-353','Algarve','Portugal','9');
INSERT INTO Address VALUES  (DEFAULT,'342','4321-543','New York','USA','14');
INSERT INTO Address VALUES  (DEFAULT,'5646','2414-543','Belim','Germany','8');

-- Category
INSERT INTO Category VALUES  (DEFAULT,'Smartphones');
INSERT INTO Category VALUES  (DEFAULT,'Tablets');
INSERT INTO Category VALUES  (DEFAULT,'Computers');
INSERT INTO Category VALUES  (DEFAULT,'Accessories');

-- Products
INSERT INTO Product VALUES  (DEFAULT,'Apple iPhone 14 - 512GB - Black', 1399.99 , 'Product specifications:', 7 ,4.7, 'pictures/defaultPicture.png',1);
INSERT INTO Product VALUES  (DEFAULT,'Apple iPhone 14 Pro Max - 256GB - White ', 1629.99 , 'Product specifications:', 9 ,4.9, 'pictures/defaultPicture.png',1);
INSERT INTO Product VALUES  (DEFAULT,'Apple iPhone 13 - 128GB - Blue ', 929.99 , 'Product specifications:', 4 ,4.5, 'pictures/defaultPicture.png',1);
INSERT INTO Product VALUES  (DEFAULT,'Samsung Galaxy S22 Ultra - 128GB - Green ', 1149.99 , 'Product specifications:', 2 ,4.3, 'pictures/defaultPicture.png',1);
INSERT INTO Product VALUES  (DEFAULT,'Samsung Galaxy S22+ - 256GB - Pink Gold  ', 999.99 , 'Product specifications:', 13 ,4.8, 'pictures/defaultPicture.png',1);

INSERT INTO Product VALUES  (DEFAULT,'Apple iPad Pro 12.9'' - 128GB WiFi - Black  ', 1229 , 'Product specifications:', 10 ,4.5, 'pictures/defaultPicture.png',2);
INSERT INTO Product VALUES  (DEFAULT,'Tablet Samsung Galaxy Tab S8 11'' - X706 - 5G - 256GB - Graphite  ', 959.99 , 'Product specifications:', 6 ,4.9, 'pictures/defaultPicture.png',2);
INSERT INTO Product VALUES  (DEFAULT,'Tablet Lenovo Tab M10 Plus 125FU - 128 GB - Wi-Fi - Grey  ', 219.59 , 'Product specifications:', 10 ,4.5, 'pictures/defaultPicture.png',2);

INSERT INTO Product VALUES  (DEFAULT,'Apple MacBook Air 2022 13.6" | M2 CPU 8-core, GPU 10-core | SSD 1TB | 16GB RAM ', 2239.00 , 'Product specifications:', 8 ,4.8, 'pictures/defaultPicture.png',3);
INSERT INTO Product VALUES  (DEFAULT,'Apple MacBook Air 2020 13.3" | M1 CPU 8-core, GPU 7-core | SSD 256GB | 16GB RAM  ', 1359.00 , 'Product specifications:', 2 ,4.2, 'pictures/defaultPicture.png',3);
INSERT INTO Product VALUES  (DEFAULT,'Laptop Lenovo IdeaPad 3 15ADA05 15.6 ', 399.00 , 'Product specifications:', 14 ,3.9, 'pictures/defaultPicture.png',3);
INSERT INTO Product VALUES  (DEFAULT,'Laptop Lenovo Legion 5 Pro 16ACH6H 16', 1499.00 , 'Product specifications:', 7 ,5, 'pictures/defaultPicture.png',3);

INSERT INTO Product VALUES  (DEFAULT,'Stand Asus ROG Throne Qi', 120.59 , 'Product specifications:', 7 ,4.6, 'pictures/defaultPicture.png',4);
INSERT INTO Product VALUES  (DEFAULT,'Headphones Sony WH-1000XM5 Bluetooth ANC NFC Black', 390.90 , 'Product specifications:', 19 ,4.9, 'pictures/defaultPicture.png',4);
INSERT INTO Product VALUES  (DEFAULT,'Powerbank Apple Magsafe Battery Pack', 115 , 'Product specifications:', 14 ,4.4, 'pictures/defaultPicture.png',4);


-- Wishlist
INSERT INTO Wishlist VALUES  ( 5, 4,3);
INSERT INTO Wishlist VALUES  ( 5, 6,2);
INSERT INTO Wishlist VALUES  ( 10, 6,2);
INSERT INTO Wishlist VALUES  ( 10, 1,2);
INSERT INTO Wishlist VALUES  ( 4, 4,2);
INSERT INTO Wishlist VALUES  ( 14, 5,1);
INSERT INTO Wishlist VALUES  ( 9, 2,2);
INSERT INTO Wishlist VALUES  ( 11, 8,3);

-- Cart
INSERT INTO Cart VALUES  ( 4,7,2);
INSERT INTO Cart VALUES  ( 12,2,1);
INSERT INTO Cart VALUES  ( 12,7,2);
INSERT INTO Cart VALUES  ( 11,6,1);
INSERT INTO Cart VALUES  ( 11,3,2);

-- Purchase
INSERT INTO Purchase VALUES (DEFAULT,321.32,'2022-10-4',2,4,3);
INSERT INTO Purchase VALUES (DEFAULT,121.36,'2022-09-1',1,6,8);
INSERT INTO Purchase VALUES (DEFAULT,2321.32,'2022-05-3',3,9,3);
INSERT INTO Purchase VALUES (DEFAULT,1221.32,'2022-08-2',1,2,3);
INSERT INTO Purchase VALUES (DEFAULT,421.32,'2022-10-21',2,5,9);
INSERT INTO Purchase VALUES (DEFAULT,821.32,'2022-11-12',2,7,12);

--ProductPurchase
INSERT INTO ProductPurchase VALUES (1, 4);
INSERT INTO ProductPurchase VALUES (5, 4);
INSERT INTO ProductPurchase VALUES (3, 3);
INSERT INTO ProductPurchase VALUES (8, 4);
INSERT INTO ProductPurchase VALUES (6, 4);
INSERT INTO ProductPurchase VALUES (2, 5);
INSERT INTO ProductPurchase VALUES (2, 6);
INSERT INTO ProductPurchase VALUES (5, 5);
INSERT INTO ProductPurchase VALUES (10, 6);
INSERT INTO ProductPurchase VALUES (12, 3);
INSERT INTO ProductPurchase VALUES (11, 6);
INSERT INTO ProductPurchase VALUES (4, 1);
INSERT INTO ProductPurchase VALUES (6, 1);
INSERT INTO ProductPurchase VALUES (1, 2);
INSERT INTO ProductPurchase VALUES (9, 2);
INSERT INTO ProductPurchase VALUES (5, 2);

-- Order
INSERT INTO Orders VALUES (DEFAULT, 390.90,'2022-08-23' ,'Processing', 7 ,1 ,1);
INSERT INTO Orders VALUES (DEFAULT, 3920.90,DEFAULT ,'Delivered', 8 ,6 ,2);
INSERT INTO Orders VALUES (DEFAULT, 1390.99,'2022-08-23' ,'Shipping', 4 ,2 ,5);
INSERT INTO Orders VALUES (DEFAULT, 320.99,'2022-08-23' ,'Processing', 13 ,3 ,3);
INSERT INTO Orders VALUES (DEFAULT, 1320.90,DEFAULT ,'Shipping', 15 ,7 ,2);
INSERT INTO Orders VALUES (DEFAULT, 230.90,'2022-08-23' ,'Processing', 11 ,9 ,4);
INSERT INTO Orders VALUES (DEFAULT, 760.90,'2022-08-23' ,'Delivered', 5 ,4 ,1);
INSERT INTO Orders VALUES (DEFAULT, 990.90,'2022-08-23' ,'Shipping', 8 ,8 ,3); 

-- Review
INSERT INTO Review VALUES  (DEFAULT,'Title', 'comment' , DEFAULT, 4.6, 3, 4);
INSERT INTO Review VALUES  (DEFAULT,'Title', 'comment' , '2022-10-17', 5, 15, 3);
INSERT INTO Review VALUES  (DEFAULT,'Title', 'comment' , '2022-10-2', 3.6, 5, 4);
INSERT INTO Review VALUES  (DEFAULT,'Title', 'comment' , '2022-06-7', 4.2, 8, 5);
INSERT INTO Review VALUES  (DEFAULT,'Title', 'comment' , '2022-11-2', 4.7, 2, 8);
INSERT INTO Review VALUES  (DEFAULT,'Title', 'comment' , '2022-04-23', 4, 3, 9);
INSERT INTO Review VALUES  (DEFAULT,'Title', 'comment' , '2022-07-1', 5, 7, 10);
INSERT INTO Review VALUES  (DEFAULT,'Title', 'comment' , '2022-03-3', 3.9, 5, 11);

-----------------------------------------
-- end
-----------------------------------------
```

---


## Revision history

Changes made to the first submission:
1. Item 1
1. ..

***
GROUP22114, 23/10/2022

* António Pedro Cabral dos Santos, up201907156 up201907156@up.pt
* João Margato Borlido Pereira, up201907007 up201907007@up.pt (editor)
* Miguel Ângelo Pacheco Valente, up201704608 up201704608@up.pt