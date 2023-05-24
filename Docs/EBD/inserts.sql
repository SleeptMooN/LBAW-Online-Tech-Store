-- Users
INSERT INTO Users VALUES (1,'Example','Example123','Example@example.com','987654321', 'false');
INSERT INTO Users VALUES (2,' Elwood Ellis','tMF3sw6','wood34@gmmail.com','93697524', 'true');
INSERT INTO Users VALUES (3,' Tiffani Derek ','QJg4MehPa','tiderek@1232.com','95334314', 'false');
INSERT INTO Users VALUES (4,' Timmy Hattie ','MP2p7BhIH','hatie3231@de32.org','90853239', 'false');
INSERT INTO Users VALUES (5,' Dave Randi ','9I8ELTY7u','randi53621@gmaiiil.com','99930384', 'false');
INSERT INTO Users VALUES (6,' Ira Trinity ','3Th8FkGHv','iraa4253@asd.com','90416185', 'false');
INSERT INTO Users VALUES (7,' Ernest Macie ','AbxSjnfyC','23macie123@hotmail.com','93749133', 'false');
INSERT INTO Users VALUES (8,' Davey Katrina ','fvuGD9Mye','katrinaa12@869.com','96523660', 'false');
INSERT INTO Users VALUES (9,' Hester Araminta ','PqKwgZNUj','hester1524@mail.com','93498111', 'false');
INSERT INTO Users VALUES (10,' Essie Lorin ','eevQ9yKbK','lorin132@ess.com','95690506', 'false');
INSERT INTO Users VALUES (11,' Josh Jed ','qUM8czLpV','jjed@12321.com','95221856', 'false');
INSERT INTO Users VALUES (12,' Demelza Dylan ','GjD9kL3jE','de_dy3431@mail.com','99825607', 'false');
INSERT INTO Users VALUES (13,' Dionne Lally ','wTrXHpDfv','ionne213@56gt.com','98317321', 'false');
INSERT INTO Users VALUES (14,' Severo Soren ','TxaGa44aT','sorenn_12@ial.com','97749743', 'false');
INSERT INTO Users VALUES (15,' Angus Jaimie ','bq85c6Ays','imae32123@hotmail.com','93622457', 'false');

-- Admins
INSERT INTO AdminUsers VALUES (1);
INSERT INTO AdminUsers VALUES (2);
INSERT INTO AdminUsers VALUES (3);

-- About
INSERT INTO About VALUES (1, 'onlyt3ch@gmail.com', 9333333);

-- Address
INSERT INTO Address VALUES (1, 2, '5100-123', 'Porto', 'Portugal', 1);
INSERT INTO Address VALUES (2, 109, '2340-12', 'Madrid', 'Spain', 2);
INSERT INTO Address VALUES (3, 2343, '7123-134', 'London', 'England', 3);
INSERT INTO Address VALUES (4, 543, '4523-234', 'Lisbon', 'Portugal', 4);
INSERT INTO Address VALUES (5, 214, '1232-123', 'Paris', 'France', 5);
INSERT INTO Address VALUES (6, 65, '4324-765', 'Aveiro', 'Portugal', 6);
INSERT INTO Address VALUES (7, 123, '2341-543', 'Roma', 'Italy', 7);
INSERT INTO Address VALUES (8, 7657, '3432-353', 'Algarve', 'Portugal', 8);
INSERT INTO Address VALUES (9, 342, '4321-543', 'New York', 'USA', 9);
INSERT INTO Address VALUES (10, 5646, '2414-543', 'Berlim', 'Germany', 10);

-- Category
INSERT INTO Category VALUES (1, 'Smartphones');
INSERT INTO Category VALUES (2, 'Tablets');
INSERT INTO Category VALUES (3, 'Computers');
INSERT INTO Category VALUES (4, 'Accessories');

-- Products
INSERT INTO Product VALUES (1,'Apple iPhone 14 - 512GB - Black', 1399.99 , 'Product specifications:', 7 ,4.7, 'pictures/defaultPicture.png',1);
INSERT INTO Product VALUES (2,'Apple iPhone 14 Pro Max - 256GB - White ', 1629.99 , 'Product specifications:', 9 ,4.9, 'pictures/defaultPicture.png',1);
INSERT INTO Product VALUES (3,'Apple iPhone 13 - 128GB - Blue ', 929.99 , 'Product specifications:', 4 ,4.5, 'pictures/defaultPicture.png',1);
INSERT INTO Product VALUES (4,'Samsung Galaxy S22 Ultra - 128GB - Green ', 1149.99 , 'Product specifications:', 2 ,4.3, 'pictures/defaultPicture.png',1);
INSERT INTO Product VALUES (5,'Samsung Galaxy S22+ - 256GB - Pink Gold  ', 999.99 , 'Product specifications:', 13 ,4.8, 'pictures/defaultPicture.png',1);

INSERT INTO Product VALUES (6,'Apple iPad Pro 12.9'' - 128GB WiFi - Black  ', 1229 , 'Product specifications:', 10 ,4.5, 'pictures/defaultPicture.png',2);
INSERT INTO Product VALUES (7,'Tablet Samsung Galaxy Tab S8 11'' - X706 - 5G - 256GB - Graphite  ', 959.99 , 'Product specifications:', 6 ,4.9, 'pictures/defaultPicture.png',2);
INSERT INTO Product VALUES (8,'Tablet Lenovo Tab M10 Plus 125FU - 128 GB - Wi-Fi - Grey  ', 219.59 , 'Product specifications:', 10 ,4.5, 'pictures/defaultPicture.png',2);

INSERT INTO Product VALUES (9,'Apple MacBook Air 2022 13.6" | M2 CPU 8-core, GPU 10-core | SSD 1TB | 16GB RAM ', 2239.00 , 'Product specifications:', 8 ,4.8, 'pictures/defaultPicture.png',3);
INSERT INTO Product VALUES (10,'Apple MacBook Air 2020 13.3" | M1 CPU 8-core, GPU 7-core | SSD 256GB | 16GB RAM  ', 1359.00 , 'Product specifications:', 2 ,4.2, 'pictures/defaultPicture.png',3);
INSERT INTO Product VALUES (11,'Laptop Lenovo IdeaPad 3 15ADA05 15.6 ', 399.00 , 'Product specifications:', 14 ,3.9, 'pictures/defaultPicture.png',3);
INSERT INTO Product VALUES (12,'Laptop Lenovo Legion 5 Pro 16ACH6H 16', 1499.00 , 'Product specifications:', 7 ,5, 'pictures/defaultPicture.png',3);

INSERT INTO Product VALUES (13,'Stand Asus ROG Throne Qi', 120.59 , 'Product specifications:', 7 ,4.6, 'pictures/defaultPicture.png',4);
INSERT INTO Product VALUES (14,'Headphones Sony WH-1000XM5 Bluetooth ANC NFC Black', 390.90 , 'Product specifications:', 19 ,4.9, 'pictures/defaultPicture.png',4);
INSERT INTO Product VALUES (15,'Powerbank Apple Magsafe Battery Pack', 115 , 'Product specifications:', 14 ,4.4, 'pictures/defaultPicture.png',4);

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
INSERT INTO Cart VALUES (4,5,1);
INSERT INTO Cart VALUES (3,8,4);
INSERT INTO Cart VALUES (1,10,6);
INSERT INTO Cart VALUES (7,14,8);
INSERT INTO Cart VALUES (14,15,15);

-- Purchase
INSERT INTO Purchase VALUES (1,321.32,'2022-10-4',2,2);
INSERT INTO Purchase VALUES (2,121.36,'2022-09-1',1,4);
INSERT INTO Purchase VALUES (3,2321.32,'2022-05-3',3,5);
INSERT INTO Purchase VALUES (4,1221.32,'2022-08-2',1,3);
INSERT INTO Purchase VALUES (5,421.32,'2022-10-21',2,3);
INSERT INTO Purchase VALUES (6,821.32,'2022-11-12',2,10);

--ProductPurchase
INSERT INTO ProductPurchase VALUES (1, 4);
INSERT INTO ProductPurchase VALUES (5, 4);
INSERT INTO ProductPurchase VALUES (3, 4);
INSERT INTO ProductPurchase VALUES (8, 4);
INSERT INTO ProductPurchase VALUES (6, 4);
INSERT INTO ProductPurchase VALUES (2, 5);
INSERT INTO ProductPurchase VALUES (2, 6);
INSERT INTO ProductPurchase VALUES (5, 5);
INSERT INTO ProductPurchase VALUES (10, 6);
INSERT INTO ProductPurchase VALUES (12, 6);
INSERT INTO ProductPurchase VALUES (11, 6);

-- Order
INSERT INTO Orders VALUES (1, '2022-08-23', 390.90, 'Processing', 7, 1, 4);
INSERT INTO Orders VALUES (2, DEFAULT, 3920.90, 'Delivered', 8, 6, 5);
INSERT INTO Orders VALUES (3, '2022-08-23', 1390.99, 'Shipping', 4, 2, 6);
INSERT INTO Orders VALUES (4, '2022-08-23', 320.99, 'Processing', 13, 3, 6);
INSERT INTO Orders VALUES (5, DEFAULT, 1320.90, 'Shipping', 15, 7, 1);
INSERT INTO Orders VALUES (6, '2022-08-23', 230.90, 'Processing', 11, 9, 2);
INSERT INTO Orders VALUES (7, '2022-08-23', 760.90, 'Delivered', 5, 4, 3);
INSERT INTO Orders VALUES (8, '2022-08-23', 990.90, 'Shipping', 8, 8, 4);

-- Review
INSERT INTO Review VALUES (1,'Title', 'comment' , DEFAULT, 4.6, 3, 4);
INSERT INTO Review VALUES (2,'Title', 'comment' , '2022-10-17', 5, 15, 3);
INSERT INTO Review VALUES (3,'Title', 'comment' , '2022-10-2', 3.6, 5, 4);
INSERT INTO Review VALUES (4,'Title', 'comment' , '2022-06-7', 4.2, 8, 5);
INSERT INTO Review VALUES (5,'Title', 'comment' , '2022-11-2', 4.7, 2, 8);
INSERT INTO Review VALUES (6,'Title', 'comment' , '2022-04-23', 4, 3, 9);
INSERT INTO Review VALUES (7,'Title', 'comment' , '2022-07-1', 5, 7, 10);
INSERT INTO Review VALUES (8,'Title', 'comment' , '2022-03-3', 3.9, 5, 11);
