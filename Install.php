<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//create database
include("config.php");
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if(! $conn )
{
  die('Connecting database failed: ' . mysqli_error($conn));
}

$sql = "CREATE DATABASE IF NOT EXISTS ".DB_DATABASE." DEFAULT CHARSET utf8 COLLATE utf8_general_ci";
$retval = mysqli_query($conn,$sql);
if(! $retval )
{
    die('Creating database failed: ' . mysqli_error($conn));
}
mysqli_select_db($conn, DB_DATABASE );
//create admin accounts table
$sql = "CREATE TABLE admin( ".
        "id INT NOT NULL AUTO_INCREMENT, ".
		"level INT NOT NULL, ".
        "username VARCHAR(100) NOT NULL, ".
        "password VARCHAR(100) NOT NULL, ".
		"login_times INT NOT NULL, ".
        "last_login DATETIME, ".
        "PRIMARY KEY ( id ))ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
    die('Creating table failed: ' . mysqli_error($conn));
}
//create photo_list table
$sql = "CREATE TABLE photo_list( ".
        "id INT NOT NULL AUTO_INCREMENT, ".
        "filename VARCHAR(255) NOT NULL, ".
        "last_update DATETIME, ".
        "PRIMARY KEY ( id ))ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
    die('Creating table failed: ' . mysqli_error($conn));
}
//create menus table
$sql = "CREATE TABLE menus( ".
        "id INT NOT NULL AUTO_INCREMENT, ".
		"type INT NOT NULL, ".
        "name_en VARCHAR(255) NOT NULL, ".
		"name_ch VARCHAR(255) NOT NULL, ".
		"price FLOAT NOT NULL, ".
        "feature VARCHAR(255) NOT NULL, ".
        "last_update DATETIME, ".
        "PRIMARY KEY ( id ))ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
    die('Creating table failed: ' . mysqli_error($conn));
}
//create feature_menu table
$sql = "CREATE TABLE feature_menu( ".
        "id INT NOT NULL AUTO_INCREMENT, ".
		"menu_id INT NOT NULL, ".
        "last_update DATETIME, ".
        "PRIMARY KEY ( id ))ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
    die('Creating table failed: ' . mysqli_error($conn));
}
//create booking table
$sql = "CREATE TABLE booking( ".
        "id INT NOT NULL AUTO_INCREMENT, ".
		"name VARCHAR(255) NOT NULL, ".
		"phone VARCHAR(50) NOT NULL, ".
		"email VARCHAR(255) NOT NULL, ".
		"people INT NOT NULL, ".
        "book_time DATETIME NOT NULL, ".
		"special_req VARCHAR(65535) NOT NULL, ".
        "submit_time DATETIME, ".
        "PRIMARY KEY ( id ))ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
    die('Creating table failed: ' . mysqli_error($conn));
}
//create subscribe table
$sql =  "CREATE TABLE subscribe( ".
        "id INT NOT NULL AUTO_INCREMENT, ".
		"email INT NOT NULL, ".
        "submit_time DATETIME, ".
        "PRIMARY KEY ( id ))ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
    die('Creating table failed: ' . mysqli_error($conn));
}
//add a default admin
$sql = "INSERT INTO admin ".
        "(level,username,password,login_times)".
        "VALUES ".
        "(1,'admin','123456',0)";
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
    die('Insert admin failed: ' . mysqli_error($conn));
}
echo "Installing database finished!";
mysqli_close($conn);

