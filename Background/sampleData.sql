
INSERT INTO Admin (adminNo, adminTel) VALUES('A0001', '852-23338888');


INSERT INTO Category (catNo, catName, catParent) VALUES('CAT01', 'Computer Equipment', NULL);
INSERT INTO Category (catNo, catName, catParent) VALUES('CAT02', 'Printer', 'CAT01');
INSERT INTO Category (catNo, catName, catParent) VALUES('CAT03', 'Inkjet Printer', 'CAT02');
INSERT INTO Category (catNo, catName, catParent) VALUES('CAT04', 'TV', NULL);
INSERT INTO Category (catNo, catName, catParent) VALUES('CAT05', 'Laser Printer', 'CAT02');
INSERT INTO Category (catNo, catName, catParent) VALUES('CAT06', 'Colour Laser Printer', 'CAT05');
INSERT INTO Category (catNo, catName, catParent) VALUES('CAT07', 'Black and White Laser Printer', 'CAT05');


INSERT INTO District (distNo, distName) VALUES('DST01', 'HK Island');
INSERT INTO District (distNo, distName) VALUES('DST02', 'Kowloon');
INSERT INTO District (distNo, distName) VALUES('DST03', 'New Territories');


INSERT INTO Customer (custNo, custName, custGender, custDOB, custTel, custAddr, distNo) VALUES('C0001', 'Customer C0001', 'F', '1990-10-25', '852-11111111', 'Home address for C0001', 'DST02');
INSERT INTO Customer (custNo, custName, custGender, custDOB, custTel, custAddr, distNo) VALUES('C0002', 'Customer C0002', 'M', '1991-10-25', '852-22222222', 'Home address for C0002', 'DST01');
INSERT INTO Customer (custNo, custName, custGender, custDOB, custTel, custAddr, distNo) VALUES('C0003', 'Customer C0003', 'F', '1992-10-25', '852-33333333', 'Home address for C0003', 'DST03');

INSERT INTO Driver (drvID, drvName, drvGender) VALUES('D0001', 'Driver D0001', 'M');
INSERT INTO Driver (drvID, drvName, drvGender) VALUES('D0002', 'Driver D0002', 'F');
INSERT INTO Driver (drvID, drvName, drvGender) VALUES('D0003', 'Driver D0003', 'M');


INSERT INTO Schedule (jobNo, jobDate, drvID, distNo) VALUES('J0001', '2009-05-14', 'D0002', 'DST03');
INSERT INTO Schedule (jobNo, jobDate, drvID, distNo) VALUES('J0003', '2009-05-14', 'D0003', 'DST01');
INSERT INTO Schedule (jobNo, jobDate, drvID, distNo) VALUES('J0004', '2009-05-17', 'D0003', 'DST03');
INSERT INTO Schedule (jobNo, jobDate, drvID, distNo) VALUES('J0006', '2009-05-19', 'D0001', 'DST02');
INSERT INTO Schedule (jobNo, jobDate, drvID, distNo) VALUES('J0007', '2009-05-18', 'D0003', 'DST01');
INSERT INTO Schedule (jobNo, jobDate, drvID, distNo) VALUES('J0009', '2009-05-19', 'D0003', 'DST02');


INSERT INTO CustOrder (ordNo, ordDate, ordDiscount, deliAddr, custNo, distNo, jobNo) VALUES('OR001', '2009-05-12', 10.00, 'Home address for C0003', 'C0003', 'DST03', 'J0001');
INSERT INTO CustOrder (ordNo, ordDate, ordDiscount, deliAddr, custNo, distNo, jobNo) VALUES('OR002', '2009-05-12', 0.00, 'Home address for C0002', 'C0002', 'DST01', 'J0003');
INSERT INTO CustOrder (ordNo, ordDate, ordDiscount, deliAddr, custNo, distNo, jobNo) VALUES('OR003', '2009-05-15', 10.00, 'Home address for C0003', 'C0003', 'DST03', 'J0004');
INSERT INTO CustOrder (ordNo, ordDate, ordDiscount, deliAddr, custNo, distNo, jobNo) VALUES('OR004', '2009-05-16', 10.00, 'Home address for C0002', 'C0002', 'DST01', 'J0007');
INSERT INTO CustOrder (ordNo, ordDate, ordDiscount, deliAddr, custNo, distNo, jobNo) VALUES('OR005', '2009-05-16', 0.00, 'Home address for C0002', 'C0002', 'DST01', 'J0007');


INSERT INTO Supplier (suppNo, suppName, suppTel, suppAddr) VALUES('S0001', 'Supplier S0001', '852-11111111', 'Company address for S0001');
INSERT INTO Supplier (suppNo, suppName, suppTel, suppAddr) VALUES('S0002', 'Supplier S0002', '852-22222222', 'Company address for S0002');
INSERT INTO Supplier (suppNo, suppName, suppTel, suppAddr) VALUES('S0003', 'Supplier S0003', '852-33333333', 'Company address for S0003');



INSERT INTO Product (prodNo, prodName, prodPrice, prodPhoto, stockQty, catNo, suppNo) VALUES('P0001', 'HP Colour Laser Printer', 2500.00, 'laserColor.gif', 3, 'CAT06', 'S0001');
INSERT INTO Product (prodNo, prodName, prodPrice, prodPhoto, stockQty, catNo, suppNo) VALUES('P0002', 'Optical Mouse', 30.00, 'mouse.gif', 5, 'CAT01', 'S0002');
INSERT INTO Product (prodNo, prodName, prodPrice, prodPhoto, stockQty, catNo, suppNo) VALUES('P0003', 'HP Desktop PC', 3200.00, 'desktopPC.gif', 5, 'CAT01', 'S0001');
INSERT INTO Product (prodNo, prodName, prodPrice, prodPhoto, stockQty, catNo, suppNo) VALUES('P0004', 'LCD HD TV 42 Inch', 8000.00, 'LCDTV.jpg', 1, 'CAT04', 'S0002');
INSERT INTO Product (prodNo, prodName, prodPrice, prodPhoto, stockQty, catNo, suppNo) VALUES('P0005', 'HP Black & White Laser Printer', 700.00, 'laserBW.gif', 2, 'CAT07', 'S0001');


INSERT INTO OrderLine (prodNo, ordNo, actualPrice, qty) VALUES('P0001', 'OR001', 2250.00, 1);
INSERT INTO OrderLine (prodNo, ordNo, actualPrice, qty) VALUES('P0002', 'OR002', 30.00, 2);
INSERT INTO OrderLine (prodNo, ordNo, actualPrice, qty) VALUES('P0001', 'OR003', 2250.00, 2);
INSERT INTO OrderLine (prodNo, ordNo, actualPrice, qty) VALUES('P0002', 'OR004', 27.00, 1);
INSERT INTO OrderLine (prodNo, ordNo, actualPrice, qty) VALUES('P0002', 'OR005', 30.00, 1);
INSERT INTO OrderLine (prodNo, ordNo, actualPrice, qty) VALUES('P0004', 'OR001', 7200.00, 10);
INSERT INTO OrderLine (prodNo, ordNo, actualPrice, qty) VALUES('P0004', 'OR004', 7200.00, 5);
INSERT INTO OrderLine (prodNo, ordNo, actualPrice, qty) VALUES('P0005', 'OR004', 630.00, 3);

INSERT INTO User (UserNo, loginName, loginPswd, isLoggedIn, drvID, custNo, suppNo, adminNo) VALUES('U0001', 'admin', 'secret', 'N', NULL, NULL, NULL, 'A0001');
INSERT INTO User (UserNo, loginName, loginPswd, isLoggedIn, drvID, custNo, suppNo, adminNo) VALUES('U0002', 'loginD0001', 'mypswd', 'N', 'D0001', NULL, NULL, NULL);
INSERT INTO User (UserNo, loginName, loginPswd, isLoggedIn, drvID, custNo, suppNo, adminNo) VALUES('U0003', 'loginC0001', 'mypswd', 'N', NULL, 'C0001', NULL, NULL);
INSERT INTO User (UserNo, loginName, loginPswd, isLoggedIn, drvID, custNo, suppNo, adminNo) VALUES('U0004', 'loginC0002', 'mypswd', 'N', NULL, 'C0002', NULL, NULL);
INSERT INTO User (UserNo, loginName, loginPswd, isLoggedIn, drvID, custNo, suppNo, adminNo) VALUES('U0005', 'loginD0002', 'mypswd', 'N', 'D0002', NULL, NULL, NULL);
INSERT INTO User (UserNo, loginName, loginPswd, isLoggedIn, drvID, custNo, suppNo, adminNo) VALUES('U0006', 'loginS0001', 'mypswd', 'N', NULL, NULL, 'S0001', NULL);
INSERT INTO User (UserNo, loginName, loginPswd, isLoggedIn, drvID, custNo, suppNo, adminNo) VALUES('U0007', 'loginC0003', 'mypswd', 'N', NULL, 'C0003', NULL, NULL);
INSERT INTO User (UserNo, loginName, loginPswd, isLoggedIn, drvID, custNo, suppNo, adminNo) VALUES('U0008', 'loginD0003', 'mypswd', 'N', 'D0003', NULL, NULL, NULL);
INSERT INTO User (UserNo, loginName, loginPswd, isLoggedIn, drvID, custNo, suppNo, adminNo) VALUES('U0009', 'loginS0003', 'mypswd', 'N', NULL, NULL, 'S0003', NULL);
INSERT INTO User (UserNo, loginName, loginPswd, isLoggedIn, drvID, custNo, suppNo, adminNo) VALUES('U0010', 'loginS0002', 'mypswd', 'N', NULL, NULL, 'S0002', NULL);


