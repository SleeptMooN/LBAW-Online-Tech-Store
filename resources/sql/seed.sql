create schema if not exists lbaw22114;
SET search_path TO lbaw22114;


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
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL,
  password TEXT NOT NULL,
  email VARCHAR(128) UNIQUE NOT NULL,
  phone INT 
);

create table Address(
  id SERIAL PRIMARY KEY,
  houseNumber INTEGER NOT NULL CHECK (houseNumber > 0),
  postalCode TEXT NOT NULL,
  city TEXT NOT NULL,
  country TEXT NOT NULL,
  users_id INTEGER REFERENCES Users(id) ON DELETE CASCADE
);

create table Category(
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL
);

create table Product(
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL,
  price FLOAT NOT NULL CHECK (price > 0),
  description TEXT NOT NULL,
  quantity INTEGER NOT NULL CHECK (quantity >= 0),
  score FLOAT CHECK (score >= 0 AND score <= 5),
  photo TEXT NOT NULL,
  category_id INTEGER REFERENCES Category(id)
);

create table Review(
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL,
  comment TEXT NOT NULL,
  date timestamp NOT NULL DEFAULT NOW(),
  score FLOAT CHECK (score >= 0 AND score <= 5),
  users_id INTEGER REFERENCES Users(id) ON DELETE CASCADE,
  product_id INTEGER REFERENCES Product(id)
);

create table Wishlist(
  users_id INTEGER REFERENCES Users(id),
  product_id INTEGER REFERENCES Product(id),
  quantity INTEGER CHECK (quantity >= 0)
);


create table Orders(
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL,
  email VARCHAR(128) NOT NULL,
  phone INT, 
  orderDate timestamp NOT NULL DEFAULT NOW(),
  totalCost  FLOAT ,
  trackingNumber INT,
  status TEXT NOT NULL DEFAULT 'Processing',
  CONSTRAINT status CHECK (status IN ('Processing', 'Shipping', 'Delivered')),
  users_id INTEGER REFERENCES Users(id)
);

create table Purchase(
  id SERIAL PRIMARY KEY,
  totalCost FLOAT NOT NULL CHECK (totalCost > 0),
  date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
  quantity INTEGER CHECK (quantity >= 0),
  product_id INTEGER REFERENCES Product(id),
  order_id INTEGER REFERENCES Orders(id)
);

create table ProductPurchase(
  product_id INTEGER REFERENCES Product(id),
  purchase_id INTEGER REFERENCES Purchase(id),
  PRIMARY KEY(product_id, purchase_id)
);

create table Cart(
  id SERIAL PRIMARY KEY,
  users_id INTEGER REFERENCES Users(id),
  product_id INTEGER REFERENCES Product(id),
  quantity INTEGER CHECK (quantity >= 0)
);



create table AdminUsers(
  id INTEGER PRIMARY KEY REFERENCES Users(id)
);

create table About(
  id SERIAL PRIMARY KEY,
  email TEXT NOT NULL,
  phone INTEGER NOT NULL
);

-- INDEX 1
CREATE INDEX userid_order ON Orders USING hash (users_id);

-- INDEX 2
CREATE INDEX idproduct_review ON Review USING hash (product_id);

-- INDEX 3
CREATE INDEX idcategory_product ON Product USING hash (category_id);

-- INDEX 4
CREATE INDEX price_product ON Product USING btree (price);

-- INDEX 5
ALTER TABLE Product
ADD COLUMN tsvectors TSVECTOR;

CREATE OR REPLACE FUNCTION product_search_update() RETURNS TRIGGER AS $$
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
CREATE OR REPLACE FUNCTION update_product_score() RETURNS TRIGGER AS
$BODY$
BEGIN
	UPDATE Product
	SET score = (SELECT AVG(score) FROM Review WHERE product_id = New.product_id)
	WHERE product.id = New.product_id;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER product_score AFTER INSERT OR UPDATE OR DELETE
ON Review
FOR EACH ROW
EXECUTE PROCEDURE update_product_score();

-- TRIGGER 2
CREATE OR REPLACE FUNCTION check_purchase_quantities() RETURNS TRIGGER AS
$BODY$
BEGIN
	IF NOT EXISTS (SELECT quantity FROM Product WHERE id = New.product_id AND quantity >= New.quantity)
	THEN
		RAISE EXCEPTION 'You can’t buy % items of product %' , New.quantity, New.product_id;
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
CREATE OR REPLACE FUNCTION clear_cart() RETURNS TRIGGER AS
$BODY$
BEGIN
	DELETE FROM Cart
	WHERE users_id = New.users_id;
  RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER clear_cart AFTER INSERT
ON Orders
FOR EACH ROW
EXECUTE PROCEDURE clear_cart();

-- TRIGGER 4
CREATE OR REPLACE FUNCTION remove_wishlist_product() RETURNS TRIGGER AS
$BODY$
BEGIN
	DELETE FROM Wishlist
	WHERE users_id = New.users_id
  AND product_id = New.product_id;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER remove_wishlist_product AFTER INSERT
ON Cart
FOR EACH ROW
EXECUTE PROCEDURE remove_wishlist_product();

-- TRIGGER 5
CREATE OR REPLACE FUNCTION update_available_products() RETURNS TRIGGER AS
$BODY$
BEGIN
  UPDATE Product
  SET quantity = Product.quantity - New.quantity
  WHERE product.id = New.product_id;
  RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_available_products AFTER INSERT
ON Purchase
FOR EACH ROW
EXECUTE PROCEDURE update_available_products();

-----------------------------------------
-- Populate the database
-----------------------------------------

INSERT INTO users VALUES (
  DEFAULT,
  'John Doe',
  '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
  'example@example.com',
  '99999999'
); -- Password is 1234. Generated using Hash::make('1234')

-- Users
INSERT INTO Users VALUES (DEFAULT,'Example','Example123','Example12@example.com','987654321');
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
INSERT INTO About VALUES (1, 'onlyt3ch@gmail.com', 9333333);

-- Address
--INSERT INTO Address VALUES (1, 2, '5100-123', 'Porto', 'Portugal', 1);


-- Category
INSERT INTO Category VALUES (1, 'Smartphones');
INSERT INTO Category VALUES (2, 'Tablets');
INSERT INTO Category VALUES (3, 'Computers');
INSERT INTO Category VALUES (4, 'Accessories');

-- Products
INSERT INTO Product VALUES (1,'Apple iPhone 14 - 512GB - Black', 1399.99 , 'Product specifications:', 7 ,4.7, 'https://static.fnac-static.com/multimedia/Images/PT/NR/d1/67/81/8480721/1540-1.jpg',1);
INSERT INTO Product VALUES (2,'Apple iPhone 14 Pro Max - 256GB - White ', 1629.99 , 'Product specifications:', 9 ,4.9, 'https://static.fnac-static.com/multimedia/Images/PT/NR/c2/67/81/8480706/1540-1.jpg',1);
INSERT INTO Product VALUES (3,'Apple iPhone 13 - 128GB - Blue ', 929.99 , 'Product specifications:', 4 ,4.5, 'https://static.fnac-static.com/multimedia/Images/PT/NR/24/ed/73/7597348/1540-1.jpg',1);
INSERT INTO Product VALUES (4,'Samsung Galaxy S22 Ultra - 128GB - Green ', 1149.99 , 'Product specifications:', 2 ,4.3, 'https://static.fnac-static.com/multimedia/Images/PT/NR/6c/94/78/7902316/1540-1.jpg',1);
INSERT INTO Product VALUES (5,'Samsung Galaxy S22+ - 256GB - Pink Gold  ', 999.99 , 'Product specifications:', 13 ,4.8, 'https://static.fnac-static.com/multimedia/Images/PT/NR/67/94/78/7902311/1540-1.jpg',1);

INSERT INTO Product VALUES (6,'Apple iPad Pro 12.9'' - 128GB WiFi - Black  ', 1229 , 'Product specifications:', 10 ,4.5, 'https://static.fnac-static.com/multimedia/Images/PT/NR/01/9d/6a/6987009/1541-1.jpg',2);
INSERT INTO Product VALUES (7,'Tablet Samsung Galaxy Tab S8 11'' - X706 - 5G - 256GB - Graphite  ', 959.99 , 'Product specifications:', 6 ,4.9, 'https://static.fnac-static.com/multimedia/Images/PT/NR/20/77/78/7894816/1540-1.jpg',2);
INSERT INTO Product VALUES (8,'Tablet Lenovo Tab M10 Plus 125FU - 128 GB - Wi-Fi - Grey  ', 219.59 , 'Product specifications:', 10 ,4.5, 'https://static.fnac-static.com/multimedia/Images/PT/NR/a4/27/7f/8333220/1540-1.jpg',2);

INSERT INTO Product VALUES (9,'Apple MacBook Air 2022 13.6" | M2 CPU 8-core, GPU 10-core | SSD 1TB | 16GB RAM ', 2239.00 , 'Product specifications:', 8 ,4.8, 'https://static.fnac-static.com/multimedia/Images/PT/NR/9e/fd/7c/8191390/1540-1.jpg',3);
INSERT INTO Product VALUES (10,'Apple MacBook Air 2020 13.3" | M1 CPU 8-core, GPU 7-core | SSD 256GB | 16GB RAM  ', 1359.00 , 'Product specifications:', 2 ,4.2, 'https://static.fnac-static.com/multimedia/Images/PT/MC/e2/12/28/19403490/1540-1.jpg#d131100b-c848-492d-99cf-c777f1e040b3',3);
INSERT INTO Product VALUES (11,'Laptop Lenovo IdeaPad 3 15ADA05 15.6 ', 399.00 , 'Product specifications:', 14 ,3.9, 'https://static.fnac-static.com/multimedia/Images/PT/NR/a3/d8/70/7395491/1541-1.jpg',3);
INSERT INTO Product VALUES (12,'Laptop Lenovo Legion 5 Pro 16ACH6H 16', 1499.00 , 'Product specifications:', 7 ,5, 'https://static.fnac-static.com/multimedia/Images/PT/NR/20/6b/7c/8153888/1540-1.jpg',3);

INSERT INTO Product VALUES (13,'Stand Asus ROG Throne Qi', 120.59 , 'Product specifications:', 7 ,4.6, 'https://static.fnac-static.com/multimedia/Images/PT/NR/70/c4/66/6734960/1540-1.jpg',4);
INSERT INTO Product VALUES (14,'Headphones Sony WH-1000XM5 Bluetooth ANC NFC Black', 390.90 , 'Product specifications:', 19 ,4.9, 'https://static.fnac-static.com/multimedia/Images/PT/NR/44/10/7c/8130628/1540-1.jpg',4);
INSERT INTO Product VALUES (15,'Powerbank Apple Magsafe Battery Pack', 115 , 'Product specifications:', 14 ,4.4, 'https://static.fnac-static.com/multimedia/Images/PT/NR/cb/2a/72/7482059/1541-2.jpg',4);

-- Wishlist
INSERT INTO Wishlist VALUES (1, 1,3);
INSERT INTO Wishlist VALUES (1, 3,2);
INSERT INTO Wishlist VALUES (4, 4,2);
INSERT INTO Wishlist VALUES (4, 7,2);
INSERT INTO Wishlist VALUES (6, 13,2);
INSERT INTO Wishlist VALUES (7, 12,1);
INSERT INTO Wishlist VALUES (10, 10,2);
INSERT INTO Wishlist VALUES (12, 8,3);

-- Cart
INSERT INTO Cart VALUES (DEFAULT,4,5,1);
INSERT INTO Cart VALUES (DEFAULT,4,9,1);


-- Order
--INSERT INTO Orders VALUES (1,'john','jj@jj.com','987654321', '2022-08-23',312,DEFAULT, 1);


-- Purchase
--INSERT INTO Purchase VALUES (1,321.32,'2022-10-4',2,2,1);

--ProductPurchase
--INSERT INTO ProductPurchase VALUES (1, 1);
-- Review
INSERT INTO Review VALUES (1,'Title', 'comment' , DEFAULT, 4.2, 3, 4);
INSERT INTO Review VALUES (2,'Title', 'comment' , '2022-10-17', 5, 15, 3);
INSERT INTO Review VALUES (3,'Title', 'comment' , '2022-10-2', 3.6, 5, 4);
INSERT INTO Review VALUES (4,'Title', 'comment' , '2022-06-7', 4.2, 8, 5);
INSERT INTO Review VALUES (5,'Title', 'comment' , '2022-11-2', 4.7, 2, 8);
INSERT INTO Review VALUES (6,'Title', 'comment' , '2022-04-23', 4, 3, 9);
INSERT INTO Review VALUES (7,'Title', 'comment' , '2022-07-1', 4.9, 7, 10);
INSERT INTO Review VALUES (8,'Title', 'comment' , '2022-03-3', 3.9, 5, 11);
INSERT INTO Review VALUES (9,'Title', 'comment' , '2022-07-1', 4.2, 2, 10);

-----------------------------------------
-- END
-----------------------------------------





