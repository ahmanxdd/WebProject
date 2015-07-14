/*
Created: 3/8/2009
Modified: 3/27/2009
Model: MySQL 5.0
Database: MySQL 5.0
*/
-- Set the default engine for the current session
-- SET storage_engine=InnoDB; /  SET storage_engine=MYISAM;
SET storage_engine=InnoDB;

drop database IF EXISTS projectDB;
create database projectDB character set utf8;
use projectDB;

-- Create tables section -------------------------------------------------

-- Table District

CREATE TABLE District
(
  distNo Varchar(5) NOT NULL,
  distName Varchar(30) NOT NULL,
 PRIMARY KEY (distNo)
) ENGINE = InnoDB
;

-- Table Customer

CREATE TABLE Customer
(
  custNo Varchar(5) NOT NULL,
  custName Varchar(30) NOT NULL,
  custGender Varchar(1) NOT NULL,
  custDOB Date,
  custTel Varchar(12),
  custAddr Varchar(60) NOT NULL,
  distNo Varchar(5) NOT NULL,
 PRIMARY KEY (custNo)
) ENGINE = InnoDB
;

-- Table Supplier

CREATE TABLE Supplier
(
  suppNo Varchar(5) NOT NULL,
  suppName Varchar(30) NOT NULL,
  suppTel Varchar(12),
  suppAddr Varchar(60) NOT NULL,
 PRIMARY KEY (suppNo)
) ENGINE = InnoDB
;

-- Table Admin

CREATE TABLE Admin
(
  adminNo Varchar(5) NOT NULL,
  adminTel Varchar(12),
 PRIMARY KEY (adminNo)
) ENGINE = InnoDB
;

-- Table Driver

CREATE TABLE Driver
(
  drvID Varchar(5) NOT NULL,
  drvName Varchar(30) NOT NULL,
  drvGender Varchar(1) NOT NULL,
 PRIMARY KEY (drvID)
) ENGINE = InnoDB
;

-- Table User

CREATE TABLE User
(
  userNo Varchar(5) NOT NULL,
  loginName Varchar(30),
  loginPswd Varchar(30) NOT NULL,
  isLoggedIn Varchar(1) NOT NULL,
  drvID Varchar(5),
  custNo Varchar(5),
  suppNo Varchar(5),
  adminNo Varchar(5),
 PRIMARY KEY (userNo),
 UNIQUE loginName (loginName)
) ENGINE = InnoDB
;

-- Table Category

CREATE TABLE Category
(
  catNo Varchar(5) NOT NULL,
  catName Varchar(30) NOT NULL,
  catParent Varchar(5),
 PRIMARY KEY (catNo)
) ENGINE = InnoDB
;

-- Table Product

CREATE TABLE Product
(
  prodNo Varchar(5) NOT NULL,
  prodName Varchar(30) NOT NULL,
  prodPrice Double(8,2) NOT NULL,
  prodPhoto Varchar(30) NOT NULL,
  stockQty Int NOT NULL,
  catNo Varchar(5),
  suppNo Varchar(5) NOT NULL,
 PRIMARY KEY (prodNo)
) ENGINE = InnoDB
;

-- Table CustOrder

CREATE TABLE CustOrder
(
  ordNo Varchar(5) NOT NULL,
  ordDate Date NOT NULL,
  ordDiscount Double(8,2),
  deliAddr Varchar(60) NOT NULL,
  custNo Varchar(5) NOT NULL,
  distNo Varchar(5) NOT NULL,
  jobNo Varchar(5),
 PRIMARY KEY (ordNo)
) ENGINE = InnoDB
;

-- Table OrderLine

CREATE TABLE OrderLine
(
  prodNo Varchar(5) NOT NULL,
  ordNo Varchar(5) NOT NULL,
  actualPrice Double(8,2) NOT NULL,
  qty Int NOT NULL,
 PRIMARY KEY (prodNo,ordNo)
) ENGINE = InnoDB
;

-- Table Schedule

CREATE TABLE Schedule
(
  jobNo Varchar(5) NOT NULL,
  jobDate Date NOT NULL,
  drvID Varchar(5) NOT NULL,
  distNo Varchar(5) NOT NULL,
 PRIMARY KEY (jobNo)
) ENGINE = InnoDB
;

-- Create relationships section ------------------------------------------------- 

ALTER TABLE User ADD CONSTRAINT is_driver FOREIGN KEY (drvID) REFERENCES Driver (drvID) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE User ADD CONSTRAINT is_customer FOREIGN KEY (custNo) REFERENCES Customer (custNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Product ADD CONSTRAINT belongs_to_category FOREIGN KEY (catNo) REFERENCES Category (catNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Category ADD CONSTRAINT is_subcategory_of FOREIGN KEY (catParent) REFERENCES Category (catNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Product ADD CONSTRAINT sell_product FOREIGN KEY (suppNo) REFERENCES Supplier (suppNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE User ADD CONSTRAINT is_supplier FOREIGN KEY (suppNo) REFERENCES Supplier (suppNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Customer ADD CONSTRAINT live_in FOREIGN KEY (distNo) REFERENCES District (distNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE CustOrder ADD CONSTRAINT place_order FOREIGN KEY (custNo) REFERENCES Customer (custNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE OrderLine ADD CONSTRAINT found_in_orderline FOREIGN KEY (prodNo) REFERENCES Product (prodNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE OrderLine ADD CONSTRAINT contain_product FOREIGN KEY (ordNo) REFERENCES CustOrder (ordNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE CustOrder ADD CONSTRAINT deliver_to FOREIGN KEY (distNo) REFERENCES District (distNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Schedule ADD CONSTRAINT able_to_serve_district FOREIGN KEY (distNo) REFERENCES District (distNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Schedule ADD CONSTRAINT willing_to_work FOREIGN KEY (drvID) REFERENCES Driver (drvID) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE CustOrder ADD CONSTRAINT deliver_by_driver FOREIGN KEY (jobNo) REFERENCES Schedule (jobNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE User ADD CONSTRAINT is_admin FOREIGN KEY (adminNo) REFERENCES Admin (adminNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

INSERT INTO admin VALUES ('A0001', '852-23338888');

INSERT INTO user VALUES ('U0001', 'admin', 'secret', 'N', NULL, NULL, NULL, 'A0001');
