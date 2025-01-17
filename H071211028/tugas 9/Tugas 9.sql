use classicmodels;

SELECT * FROM orders;
SELECT * FROM orderdetails;


#NO.1
INSERT INTO orders
VALUES(10427,'2022-10-22','2022-10-28',NULL,'In Process',NULL,119),
(10428,'2022-11-20','2022-11-28',NULL,'In Process',NULL,141),
(10429,'2022-11-12','2022-11-20',NULL,'In Process',NULL,119);

INSERT INTO orderdetails
VALUES(10427,'S18_2957',100,180.45,8),
(10428,'S32_2509',16,80,4),
(10429,'S18_2957',8,18.05,7);

#NO.2
SET autocommit=0;
BEGIN;
DELETE FROM orderdetails;
ROLLBACK;