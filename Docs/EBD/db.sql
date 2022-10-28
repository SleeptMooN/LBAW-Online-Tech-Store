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
  id_Product INTEGER REFERENCES Product(id_Product)
);

create table ProductPurchase(
  id_Product INTEGER REFERENCES Product(id_Product),
  id_Purchase INTEGER REFERENCES Purchase(id_Purchase),
  PRIMARY KEY(id_Product, id_Purchase)
);

create table Orders(
  id_PurchaseOrder SERIAL PRIMARY KEY,
  orderDate TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
  cost FLOAT NOT NULL CHECK (cost > 0),
  status TEXT NOT NULL,
  id_Users INTEGER REFERENCES Users(id_Users),
  id_Address INTEGER REFERENCES Address(id_Address) ON DELETE CASCADE,
  id_Purchase INTEGER REFERENCES Purchase(id_Purchase) ON DELETE CASCADE,
  CONSTRAINT status CHECK (status IN ('Processing', 'Shipping', 'Delivered'))
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
CREATE INDEX userid_order ON Orders USING hash (id_Users);

-- INDEX 2
CREATE INDEX idproduct_review ON Review USING hash (id_Product);

-- INDEX 3
CREATE INDEX idcategory_product ON Product USING hash (id_Category);

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

CREATE OR REPLACE TRIGGER product_search_update
BEFORE INSERT OR UPDATE ON Product
FOR EACH row
EXECUTE PROCEDURE product_search_update();

CREATE INDEX search_idx ON Product USING GIN(tsvectors);

-- TRIGGER 1
CREATE OR REPLACE FUNCTION update_product_score() RETURNS TRIGGER AS
$BODY$
BEGIN
	UPDATE Product
	SET score = (SELECT AVG(score) FROM Review WHERE id_Product = New.id_Product)
	WHERE id_Product = New.id_Product;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER product_score AFTER INSERT OR UPDATE OR DELETE
ON Review
FOR EACH ROW
EXECUTE PROCEDURE update_product_score();

-- TRIGGER 2
CREATE OR REPLACE FUNCTION check_purchase_quantities() RETURNS TRIGGER AS
$BODY$
BEGIN
	IF NOT EXISTS (SELECT quantity FROM Product WHERE id_Product = New.id_Product AND quantity >= New.quantity)
	THEN
		RAISE EXCEPTION 'You can’t buy % items of product %' , New.quantity, New.id_Product;
	END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER check_purchase_quantities BEFORE INSERT
ON Purchase
FOR EACH ROW
EXECUTE PROCEDURE check_purchase_quantities();

-- TRIGGER 3
CREATE OR REPLACE FUNCTION clear_cart() RETURNS TRIGGER AS
$BODY$
BEGIN
	DELETE FROM Cart
	WHERE id_Users = New.id_Users;
  RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER clear_cart AFTER INSERT
ON Orders
FOR EACH ROW
EXECUTE PROCEDURE clear_cart();

-- TRIGGER 4
CREATE OR REPLACE FUNCTION remove_wishlist_product() RETURNS TRIGGER AS
$BODY$
BEGIN
	DELETE FROM Wishlist
	WHERE id_Users = New.id_Users
  AND id_Product = New.id_Product;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER remove_wishlist_product AFTER INSERT
ON Cart
FOR EACH ROW
EXECUTE PROCEDURE remove_wishlist_product();

-- TRIGGER 5
CREATE OR REPLACE FUNCTION update_available_products() RETURNS TRIGGER AS
$BODY$
BEGIN
  UPDATE Product
  SET quantity = Product.quantity - New.quantity
  WHERE id_Product = New.id_Product;
  RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER update_available_products AFTER INSERT
ON Purchase
FOR EACH ROW
EXECUTE PROCEDURE update_available_products();