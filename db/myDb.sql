/*
inventory
-invID
-name
-desc
-image
-price
-qty

users
-userID
-fName
-lName
-email
-userPW
-isAdmin

orders
-orderID
-shippingAddress
-datePlaced
-userID

orderItems
-orderID
-inventoryID
-qty
*/

/*
DROP TABLE IF EXISTS orderItems;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS inventory;
DROP TABLE IF EXISTS users;
*/

DROP TABLE IF EXISTS inventory;
CREATE TABLE inventory (
  invID SERIAL NOT NULL PRIMARY KEY,
  name VARCHAR NOT NULL,
  description VARCHAR NOT NULL,
  image VARCHAR,
  price NUMERIC(5,2) DEFAULT 999.99,
  qty INT DEFAULT 0
);

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  userID SERIAL NOT NULL PRIMARY KEY,
  fName VARCHAR NOT NULL,
  lName VARCHAR NOT NULL,
  email VARCHAR NOT NULL,
  userPW VARCHAR NOT NULL,
  isAdmin BOOLEAN NOT NULL DEFAULT FALSE
);

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  orderID SERIAL NOT NULL PRIMARY KEY,
  userID INT NOT NULL REFERENCES users(userID),
  shippingAddress VARCHAR NOT NULL,
  orderDate TIMESTAMP NOT NULL DEFAULT NOW()
);

DROP TABLE IF EXISTS orderItems;
CREATE TABLE orderItems (
  orderID INT NOT NULL REFERENCES orders(orderID),
  invID INT NOT NULL REFERENCES inventory(invID),
  qty INT NOT NULL,
  PRIMARY KEY(orderID, invID)
);

INSERT INTO users (fName, lName, email, userPW) VALUES ('Bob', 'Ross', 'Bob@gmail.com', 'H4ppy');
INSERT INTO users (fName, lName, email, userPW) VALUES ('Harry', 'Potter', 'HPotter@Hogwarts.edu', 'H3dgw1g');
INSERT INTO inventory (name, description) VALUES ('Wet Dog', 'This candle perfectly captures the aroma of a wet dog.');
INSERT INTO inventory (name, description) VALUES ('Old Car', 'You know that smell that older cars have? Somewhere between decomposing plastic and long forgotten fries? That''s this candle.');
INSERT INTO inventory (name, description) VALUES ('Belly Button Funk', 'Have you ever stuck your finger in your belly button and then smelled it? It''s not great, but here it is as a candle.');
INSERT INTO inventory (name, description) VALUES ('Dumpster Behind the Movie Theater', 'Rancid soda and soggy popcorn, name a more iconic duo.');
INSERT INTO orders (shippingAddress, userID) VALUES ('12 Privet Dr.', 2);
INSERT INTO orderItems (orderID, invID, qty) VALUES (1, 1, 1);
INSERT INTO orderItems (orderID, invID, qty) VALUES (1, 4, 2);

-- SELECT * FROM orders
--   inner join orderItems on orders.orderid = orderitems.orderid
--   inner join inventory on orderitems.invid = inventory.invid
--   inner join users on orders.userid = users.userid
--   where users.userid = 2;