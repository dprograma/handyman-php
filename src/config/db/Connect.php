<?php
//create a new mysqli connection
$mysqli = new mysqli('localhost', 'root', '');
//sql statement to create database
$db = "CREATE DATABASE IF NOT EXISTS `handyman_8791` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$mysqli->query($db);

$mysqli->select_db('handyman_8791');

//sql statement to create migrationTable
$table = "CREATE TABLE IF NOT EXISTS migrationTable (
        `userId` INT(20) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `userpassword` VARCHAR(50) NOT NULL,
        `firstname` VARCHAR(50) NOT NULL,
        `lastname` VARCHAR(50) NOT NULL,
        `username` VARCHAR(50) NOT NULL,
        `address` VARCHAR(50) NOT NULL,
        `permission` INT(5) NOT NULL default '5',
        `phone` VARCHAR(20) NOT NULL,
        `displayimage` VARCHAR(100),
        `sessionid` VARCHAR(250),
        `loggedIn` INT(11),
        `registered` INT(11),
        PRIMARY KEY(userId)
    )";

$mysqli->query($table);

//sql statement to create request table
$table = "CREATE TABLE IF NOT EXISTS requestTable (
        `requestId` INT(20) NOT NULL auto_increment,
        `category` VARCHAR(100) NOT NULL,
        `fieldname` VARHCAR(2) NOT NULL,
        `updated` INT(10) UNSIGNED,
        `request` VARCHAR(50) NOT NULL,
        `price` DOUBLE,
        `logistics` FLOAT,
        `tax` FLOAT,
        `amount` DOUBLE GENERATED ALWAYS AS (price+logistics+(tax/100*price)),
        PRIMARY KEY(requestId)
    )";

$mysqli->query($table);

//sql statement to create customer request

$table = "CREATE TABLE IF NOT EXISTS customerRequestTable(
        `customerrequestId` INT(20) NOT NULL auto_increment,
        `customerrequest` VARCHAR(50) NOT NULL,
        `requestcategory` VARCHAR(50) NOT NULL,
        `customername` VARCHAR(50) NOT NULL,
        `customeremail` VARCHAR(50) NOT NULL,
        `customerphone` VARCHAR(50) NOT NULL,
        `customeraddress` VARCHAR(50) NOT NULL,
        `orderdate` DATETIME,
        `orderreturndate` DATETIME,
        `quantity` INT(10),
        `unitprice` DECIMAL,
        `amount` DECIMAL,
        `tax` FLOAT,
        PRIMARY KEY(customerrequestId)
    )";

$mysqli->query($table);
