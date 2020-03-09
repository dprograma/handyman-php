<?php

//create a new mysqli connection
$mysqli = new mysqli('localhost', 'root', '');
//sql statement to create database
$db = "CREATE DATABASE IF NOT EXISTS `handyman_8791` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$mysqli->query($db);

$mysqli->select_db('handyman_8791');

//sql statement to create a table
    $table = "CREATE TABLE IF NOT EXISTS migrationTable (
        `userId` INT(20) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `password` VARCHAR(50) NOT NULL,
        `firstname` VARCHAR(50) NOT NULL,
        `lastname` VARCHAR(50) NOT NULL,
        `username` VARCHAR(50) NOT NULL,
        `phone` VARCHAR(20) NOT NULL,
        `sessionid` VARCHAR(250),
        PRIMARY KEY(userId)
    )"; 
    
    $mysqli->query($table);
