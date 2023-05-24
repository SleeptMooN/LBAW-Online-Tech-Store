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
  credits FLOAT DEFAULT 0,
  phone INT DEFAULT 0,
  is_admin BOOLEAN NOT NULL DEFAULT false
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
  id SERIAL PRIMARY KEY,
  users_id INTEGER REFERENCES Users(id) ON DELETE CASCADE,
  product_id INTEGER REFERENCES Product(id) ON DELETE CASCADE
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
  users_id INTEGER REFERENCES Users(id) ON DELETE CASCADE
);

create table Purchase(
  id SERIAL PRIMARY KEY,
  totalCost FLOAT NOT NULL CHECK (totalCost > 0),
  date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
  quantity INTEGER CHECK (quantity >= 0),
  product_id INTEGER REFERENCES Product(id) ON DELETE CASCADE,
  order_id INTEGER REFERENCES Orders(id) ON DELETE CASCADE
);

create table ProductPurchase(
  product_id INTEGER REFERENCES Product(id) ON DELETE CASCADE,
  purchase_id INTEGER REFERENCES Purchase(id) ON DELETE CASCADE,
  PRIMARY KEY(product_id, purchase_id)
);

create table Cart(
  id SERIAL PRIMARY KEY,
  users_id INTEGER REFERENCES Users(id) ON DELETE CASCADE,
  product_id INTEGER REFERENCES Product(id) ON DELETE CASCADE,
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
  DEFAULT,
  '99999999',
  false
); -- Password is 1234. Generated using Hash::make('1234')

-- Users
INSERT INTO Users VALUES (DEFAULT,'Example','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','admin@admin.com',DEFAULT,'999999',true);
INSERT INTO Users VALUES (DEFAULT,' Elwood Ellis','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','wood34@gmmail.com',DEFAULT,'93697524',false);
INSERT INTO Users VALUES (DEFAULT,' Tiffani Derek ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','tiderek@1232.com',DEFAULT,'95334314',false);
INSERT INTO Users VALUES (DEFAULT,' Timmy Hattie ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','hatie3231@de32.org',DEFAULT,'90853239',false);
INSERT INTO Users VALUES (DEFAULT,' Dave Randi ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','randi53621@gmaiiil.com',DEFAULT,'99930384',false);
INSERT INTO Users VALUES (DEFAULT,' Ira Trinity ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','iraa4253@asd.com',DEFAULT,'90416185',false);
INSERT INTO Users VALUES (DEFAULT,' Ernest Macie ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','23macie123@hotmail.com',DEFAULT,'93749133',false);
INSERT INTO Users VALUES (DEFAULT,' Davey Katrina ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','katrinaa12@869.com',DEFAULT,'96523660',false);
INSERT INTO Users VALUES (DEFAULT,' Hester Araminta ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','hester1524@mail.com',DEFAULT,'93498111',false);
INSERT INTO Users VALUES (DEFAULT,' Essie Lorin ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','lorin132@ess.com',DEFAULT,'95690506',false);
INSERT INTO Users VALUES (DEFAULT,' Josh Jed ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','jjed@12321.com',DEFAULT,'95221856',false);
INSERT INTO Users VALUES (DEFAULT,' Demelza Dylan ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','de_dy3431@mail.com',DEFAULT,'99825607',false);
INSERT INTO Users VALUES (DEFAULT,' Dionne Lally ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','ionne213@56gt.com',DEFAULT,'98317321',false);
INSERT INTO Users VALUES (DEFAULT,' Severo Soren ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','sorenn_12@ial.com',DEFAULT,'97749743',false);
INSERT INTO Users VALUES (DEFAULT,' Angus Jaimie ','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','imae32123@hotmail.com',DEFAULT,'93622457',false);

-- Admins
--INSERT INTO AdminUsers VALUES (1);
--INSERT INTO AdminUsers VALUES (2);
--INSERT INTO AdminUsers VALUES (3);

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
INSERT INTO Product VALUES (DEFAULT,'Apple iPhone 14 - 512GB - Black', 1399.99 , 'Dimensions: 146.7 x 71.5 x 7.8 mm (5.78 x 2.81 x 0.31 in); Apple GPU (5-core graphics); Apple A15 Bionic (5 nm)', 100 ,4.7, 'https://static.fnac-static.com/multimedia/Images/PT/NR/d1/67/81/8480721/1540-1.jpg',1);
INSERT INTO Product VALUES (DEFAULT,'Apple iPhone 14 Pro Max - 256GB - White ', 1629.99 , 'Dimensions: 	160.7 x 77.6 x 7.9 mm (6.33 x 3.06 x 0.31 in); Apple GPU (5-core graphics); Apple A16 Bionic (4 nm)', 100 ,4.9, 'https://static.fnac-static.com/multimedia/Images/PT/NR/c2/67/81/8480706/1540-1.jpg',1);
INSERT INTO Product VALUES (DEFAULT,'Apple iPhone 13 - 128GB - Blue ', 929.99 , 'Dimensions: 146.7 x 71.5 x 7.7 mm (5.78 x 2.81 x 0.30 in); Apple GPU (4-core graphics); Apple A15 Bionic (5 nm)', 100 ,4.5, 'https://static.fnac-static.com/multimedia/Images/PT/NR/24/ed/73/7597348/1540-1.jpg',1);
INSERT INTO Product VALUES (DEFAULT,'Samsung Galaxy S22 Ultra - 128GB - Green ', 1149.99 , 'Dimensions:	163.3 x 77.9 x 8.9 mm (6.43 x 3.07 x 0.35 in); Dimensions 	163.3 x 77.9 x 8.9 mm (6.43 x 3.07 x 0.35 in); Android 12, upgradable to Android 13, One UI 5', 100 ,4.3, 'https://static.fnac-static.com/multimedia/Images/PT/NR/6c/94/78/7902316/1540-1.jpg',1);
INSERT INTO Product VALUES (DEFAULT,'Samsung Galaxy S22+ - 256GB - Pink Gold  ', 999.99 , ' 	Dimensions:	157.4 x 75.8 x 7.6 mm (6.20 x 2.98 x 0.30 in); Octa-core (1x2.8 GHz Cortex-X2 & 3x2.50 GHz Cortex-A710 & 4x1.8 GHz Cortex-A510) - Europe; Android 12, upgradable to Android 13, One UI 5', 100 ,4.8, 'https://static.fnac-static.com/multimedia/Images/PT/NR/67/94/78/7902311/1540-1.jpg',1);

INSERT INTO Product VALUES (DEFAULT,'Apple iPad Pro 12.9'' - 128GB WiFi - Black  ', 1229 , ' 	Dimensions:	280.6 x 214.9 x 6.4 mm (11.05 x 8.46 x 0.25 in); Apple GPU (10-core graphics); Octa-core;  	Apple M2', 100 ,4.5, 'https://static.fnac-static.com/multimedia/Images/PT/NR/01/9d/6a/6987009/1541-1.jpg',2);
INSERT INTO Product VALUES (DEFAULT,'Tablet Samsung Galaxy Tab S8 11'' - X706 - 5G - 256GB - Graphite  ', 959.99 , 'Dimensions: 14.6" (369.9mm) Super AMOLED;USB 3.2 Gen 1', 100 ,4.9, 'https://static.fnac-static.com/multimedia/Images/PT/NR/20/77/78/7894816/1540-1.jpg',2);
INSERT INTO Product VALUES (DEFAULT,'Tablet Lenovo Tab M10 Plus 125FU - 128 GB - Wi-Fi - Grey  ', 219.59 , 'Media Tek G80 Processor (2.00 GHz );screen: 10.6" TDDI LCD; Batery: 2 Cell Li-Polymer', 100 ,4.5, 'https://static.fnac-static.com/multimedia/Images/PT/NR/a4/27/7f/8333220/1540-1.jpg',2);

INSERT INTO Product VALUES (DEFAULT,'Apple MacBook Air 2022 13.6" | M2 CPU 8-core, GPU 10-core | SSD 1TB | 16GB RAM ', 1839.00 , '8-core CPU with 4 performance cores and 4 efficiency cores; 10-core GPU; 16-core Neural Engine', 100 ,4.8, 'https://static.fnac-static.com/multimedia/Images/PT/NR/9e/fd/7c/8191390/1540-1.jpg',3);
INSERT INTO Product VALUES (DEFAULT,'Apple MacBook Air 2020 13.3" | M1 CPU 8-core, GPU 7-core | SSD 256GB | 16GB RAM  ', 1359.00 , '8-core CPU with 4 performance cores and 4 efficiency cores; 7-core GPU; 16-core Neural Engine', 122 ,4.2, 'https://static.fnac-static.com/multimedia/Images/PT/MC/e2/12/28/19403490/1540-1.jpg#d131100b-c848-492d-99cf-c777f1e040b3',3);
INSERT INTO Product VALUES (DEFAULT,'Laptop Lenovo IdeaPad 3 15ADA05 15.6 ', 399.00 , 'AMD Ryzen™ 5 3500U Processor (2.10 GHz up to 3.70 GHz); 4 GB DDR4-2400MHz (Soldered) + 4 GB DDR4-2400MHz (SODIMM); Integrated AMD Radeon™ Vega 8 Graphic', 142 ,3.9, 'https://static.fnac-static.com/multimedia/Images/PT/NR/a3/d8/70/7395491/1541-1.jpg',3);
INSERT INTO Product VALUES (DEFAULT,'Laptop Lenovo Legion 5 Pro 16ACH6H 16', 1499.00 , 'RAM: 16GB (2x8GB) DDR4 3200 MHz; AMD Radeon Graphics + NVIDIA GeForce RTX 3070 8GB GDDR6 TGP 140W;  SSD 512GB M.2 2242 PCIe 3.0x4 NVMe', 211 ,5, 'https://static.fnac-static.com/multimedia/Images/PT/NR/20/6b/7c/8153888/1540-1.jpg',3);

INSERT INTO Product VALUES (DEFAULT,'Stand Asus ROG Throne Qi', 120.59 , 'Efficient and fast Qi wireless charging technology with gaming style for any gaming room; Customizable 18 RGB lighting zones, and sync-able with other Aura Sync products; Support 2 USB 3.1 ports (1.5A) to charge devices or connect to your gaming gears', 72 ,4.6, 'https://static.fnac-static.com/multimedia/Images/PT/NR/70/c4/66/6734960/1540-1.jpg',4);
INSERT INTO Product VALUES (DEFAULT,'Headphones Sony WH-1000XM5 Bluetooth ANC NFC Black', 390.90 , 'width: 1,2 m; Drivers: 30mm; 4 Hz–40,000 Hz;  ', 192 ,4.9, 'https://static.fnac-static.com/multimedia/Images/PT/NR/44/10/7c/8130628/1540-1.jpg',4);
INSERT INTO Product VALUES (DEFAULT,'Powerbank Apple Magsafe Battery Pack', 115 , 'Compatibility: >iPhone 12;  27 W', 14 ,4.4, 'https://static.fnac-static.com/multimedia/Images/PT/NR/cb/2a/72/7482059/1541-2.jpg',4);
INSERT INTO Product VALUES (DEFAULT,'Gigabyte Video Card GeForce RTX 3060 Ti GAMING OC 8G (rev. 2.0)', 567.99 , 'GeForce RTX 3060 Ti; 7680 x 4320 pixels; 1740 MHz', 76 ,4.4, 'https://static.fnac-static.com/multimedia/Images/PT/MC/62/02/41/21037666/1540-1.jpg#b5762081-c5b4-40fc-bcdb-4da081c30a1d',4);

INSERT INTO Product VALUES (DEFAULT,' Lenovo ThinkPad L13 | 13.3'' | Intel® Core i5-1135G7 | Intel Iris Xe Graphics | 8 GB | SSD 256GB', 886.57 , 'CPU:Intel Core i5-1135G7; 2,4 GHz (Turbo: 4,2 GHz); Intel Iris Xe Graphics', 46 ,4.8, 'https://static.fnac-static.com/multimedia/Images/PT/MC/ef/e0/2e/19849455/1540-1.jpg#1710f501-b988-4871-847a-70d961e6fd06',3);
INSERT INTO Product VALUES (DEFAULT,'Tablet Lenovo Tab P11 TB-J607Z - 128GB - 5G - Storm Grey', 459 , 'screen: Touch IPS LCD 2K (2000x1200) de 11" (27,94 cm), 400 nit, HDR; 128GB uMCP (UFS-Based MCP, UFS 2.1)', 75 ,4.2, 'https://static.fnac-static.com/multimedia/Images/PT/NR/02/21/7d/8200450/1540-1.jpg',2);
INSERT INTO Product VALUES (DEFAULT,'Apple iPad Air 10.9'' Wi-Fi - 64GB - Azul ', 699 , '10.9-inch (diagonal) Multi-Touch display with LED backlighting and IPS technology', 94 ,4.9, 'https://static.fnac-static.com/multimedia/Images/PT/NR/35/9f/79/7970613/1540-1.jpg',2);

-- Wishlist
INSERT INTO Wishlist VALUES (DEFAULT,9, 1);

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
INSERT INTO Review VALUES (DEFAULT,'Battery', 'The bactery is really good' , DEFAULT, 4.2, 3, 4);
INSERT INTO Review VALUES (DEFAULT,'Best purchase', 'This phone is amazing, i really recomend' , '2022-10-17', 5, 15, 3);
INSERT INTO Review VALUES (DEFAULT,'Screen', 'The screen could be better, but in general is a good phone' , '2022-10-2', 3.6, 5, 4);
INSERT INTO Review VALUES (DEFAULT,'Recommendation', 'this phone is a good choice' , '2022-06-7', 4.2, 8, 5);
INSERT INTO Review VALUES (DEFAULT,'Battery', 'Really good' , '2022-11-2', 4.7, 2, 8);
INSERT INTO Review VALUES (DEFAULT,'Battery', 'could be better' , '2022-04-23', 4, 3, 9);
INSERT INTO Review VALUES (DEFAULT,'Screen', 'The screen is really good' , '2022-07-1', 4.9, 7, 10);
INSERT INTO Review VALUES (DEFAULT,'Sound', 'The sound is amyzing!!' , '2022-03-3', 4.9, 5, 14);
INSERT INTO Review VALUES (DEFAULT,'Battery', 'Really good' , '2022-07-1', 4.2, 2, 10);

-----------------------------------------
-- END
-----------------------------------------





