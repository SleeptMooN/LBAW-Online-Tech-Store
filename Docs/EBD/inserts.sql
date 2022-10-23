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
