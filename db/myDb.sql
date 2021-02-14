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

DROP TABLE IF EXISTS orderItems;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS inventory;
DROP TABLE IF EXISTS users;

CREATE TABLE inventory (
  invID SERIAL NOT NULL PRIMARY KEY,
  name VARCHAR NOT NULL,
  description VARCHAR NOT NULL,
  image VARCHAR,
  price NUMERIC(5,2) DEFAULT 999.99,
  qty INT DEFAULT 0
);

CREATE TABLE users (
  userID SERIAL NOT NULL PRIMARY KEY,
  fName VARCHAR NOT NULL,
  lName VARCHAR NOT NULL,
  email VARCHAR NOT NULL,
  userPW VARCHAR(60) NOT NULL,
  isAdmin BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE orders (
  orderID SERIAL NOT NULL PRIMARY KEY,
  userID INT NOT NULL REFERENCES users(userID),
  shippingAddress VARCHAR NOT NULL,
  orderDate TIMESTAMP NOT NULL DEFAULT NOW()
);

CREATE TABLE orderItems (
  orderID INT NOT NULL REFERENCES orders(orderID),
  invID INT NOT NULL REFERENCES inventory(invID),
  qty INT NOT NULL,
  PRIMARY KEY(orderID, invID)
);

INSERT INTO users (fName, lName, email, userPW) VALUES ('Bob', 'Ross', 'Bob@gmail.com', '$2y$10$BqPJz3jlJy0z7.PZL8Q2muLA/yG9BuZ53CGHUN0RRgaGQfoEcP1Bq'); -- PW: H4ppy
INSERT INTO users (fName, lName, email, userPW) VALUES ('Harry', 'Potter', 'HPotter@Hogwarts.edu', '$2y$10$a6beyCQBofQVk4Q9hejRk.xF6XQ2z527Gbu9npZKbYzqzn7qTBnI.'); -- PW: H3dgw1g
INSERT INTO users (fName, lName, email, userPW, isAdmin) VALUES ('testAdmin', 'Admin', 'test@admin.com', '$2y$10$S4LrZT.8xqCYcZIikw89Qui.dA7NSEKA7bXUakWhKFh4s95iuRm3O', 't'); -- PW: Admin123
INSERT INTO inventory (name, description, price) VALUES ('Wet Dog', 'This candle perfectly captures the aroma of a wet dog.', 9.99);
INSERT INTO inventory (name, description, price) VALUES ('Old Car', 'You know that smell that older cars have? Somewhere between decomposing plastic and long forgotten fries? That''s this candle.', 9.99);
INSERT INTO inventory (name, description, price) VALUES ('Belly Button Funk', 'Have you ever stuck your finger in your belly button and then smelled it? It''s not great, but here it is as a candle.', 9.99);
INSERT INTO inventory (name, description, price) VALUES ('Dumpster Behind the Movie Theater', 'Rancid soda and soggy popcorn, name a more iconic duo.', 9.99);
INSERT INTO orders (shippingAddress, userID) VALUES ('12 Privet Dr.', 2);
INSERT INTO orders (shippingAddress, userID) VALUES ('12 Privet Dr.', 2);
INSERT INTO orderItems (orderID, invID, qty) VALUES (1, 1, 1);
INSERT INTO orderItems (orderID, invID, qty) VALUES (1, 4, 2);
INSERT INTO orderItems (orderID, invID, qty) VALUES (2, 2, 3);
INSERT INTO orderItems (orderID, invID, qty) VALUES (2, 3, 4);


-- SELECT orders.orderid, orders.shippingaddress, orders.orderdate, orderItems.qty as orderqty,
--   inventory.invid, inventory.name, inventory.description, inventory.price,
--   CONCAT(users.fname, ' ', users.lname) as username FROM orders
--   inner join orderItems on orders.orderid = orderitems.orderid
--   inner join inventory on orderitems.invid = inventory.invid
--   inner join users on orders.userid = users.userid
--   where users.userid = 2;

SELECT orders.orderid, orders.shippingaddress, orders.orderdate,
  CONCAT(users.fname, ' ', users.lname) as username FROM orders
  inner join users on orders.userid = users.userid
  where users.userid = 2;

SELECT inventory.name, orderItems.qty, inventory.price from orderItems
  inner join inventory on orderitems.invid = inventory.invid
  WHERE orderItems.orderid = 2;