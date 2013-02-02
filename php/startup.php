<?php
require_once 'Connector.php';


class StartUp extends Connector
{
    
    private $db = "PrintP";
   
    
    public function init()
    {
    $obj = new Connector();
if($obj->connect())
        {
   
   /*
   $query = "CREATE DATABASE PrintP";
   echo $obj->runQuery($query) ? "Database PrintP created\n" :  "Could not create database\n".  mysql_error()."\n<br />"; 
   */
   mysql_select_db("PrintP", $obj->con);
   
   // creates a Photographers table and populates it with sample data
   
   /*
       $query = "CREATE TABLE Photographers(
       f_name VARCHAR(50),
       l_name VARCHAR(50),
       username VARCHAR(50) PRIMARY KEY NOT NULL,
       password VARCHAR(50) NOT NULL,
       email_address VARCHAR(50) NOT NULL,
       physical_address VARCHAR(50),
       operating_area VARCHAR(100) NOT NULL,
       service_code BINARY)";
   
    echo $obj->runQuery($query) ? "Table Photographers created\n" :  "Could not create table".  mysql_error()."\n<br />";
   

    $query = "INSERT INTO Photographers (f_name,l_name,username,password,email_address,physical_address,operating_area,service_code) VALUES('Khulekani','Ngongoma','Mrena','12345','mrena@gmail.com','Durban','Umlazi',1)";
    echo $obj->runQuery($query) ? "Sample Photographer added\n" :  "Could not add sample photographer ".  mysql_error()."\n<br />";


    $query = "INSERT INTO photographers (f_name,l_name,username,password,email_address,physical_address,operating_area,service_code) VALUES('Mac','Miller','Macadelic','12345','mac@gmail.com','Durban','Durban Central',1)";
    echo $obj->runQuery($query) ? "Sample photographer added\n" :  "Could not add sample photographer\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO photographers (f_name,l_name,username,password,email_address,physical_address,operating_area,service_code) VALUES('Kendrick','Lamar','Ken','12345','ken@gmail.com','Durban','Chatsworth',1)";
    echo $obj->runQuery($query) ? "Sample photographer added\n" :  "Could not add sample photographer\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO photographers (f_name,l_name,username,password,email_address,physical_address,operating_area,service_code) VALUES('Casey','Veggies','Casey','12345','casey@gmail.com','Durban','Isipingo',1)";
    echo $obj->runQuery($query) ? "Sample photographer added\n" :  "Could not add sample photographer\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO photographers (f_name,l_name,username,password,email_address,physical_address,operating_area,service_code) VALUES('Joey','Badass','Joey','12345','joey@gmail.com','Empangeni','KwaDlangezwa',1)";
    echo $obj->runQuery($query) ? "Sample photographer added\n" :  "Could not add sample photographer\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO photographers (f_name,l_name,username,password,email_address,physical_address,operating_area,service_code) VALUES('Hannibal','King','King','12345','king@gmail.com','Empangeni','Esikhawini',1)";
    echo $obj->runQuery($query) ? "Sample photographer added\n" :  "Could not add sample photographer\t ".  mysql_error()."\n<br />";
    


    // creates a City table and populates it with sample data

       $query = "CREATE TABLE City(
       city_id INTEGER PRIMARY KEY AUTO_INCREMENT, 
       name VARCHAR(50))";
   
   echo $obj->runQuery($query) ? "Table City created\n" :  "Could not create table\t ".  mysql_error()."\n<br />";
   

    $query = "INSERT INTO City(name) VALUES('Durban')";
    echo $obj->runQuery($query) ? "Sample City added\n" :  "Could not add sample City\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO City(name) VALUES('Empangeni')";
    echo $obj->runQuery($query) ? "Sample City added\n" :  "Could not add sample City\t ".  mysql_error()."\n<br />";
    
    // creates a Areas table and populates it with sample data

    $query = "CREATE TABLE Areas(
       area_id INTEGER PRIMARY KEY AUTO_INCREMENT, 
       city VARCHAR(50) REFERENCES City(name),
       location VARCHAR(100))";

 
   echo $obj->runQuery($query) ? "Table Areas created" :  "Could not create table\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO Areas(city,location) VALUES('Empangeni','KwaDlangezwe')";
    echo $obj->runQuery($query) ? "Sample Area added\n" :  "Could not add sample Area\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO Areas(city,location) VALUES('Empangeni','Esikhawini')";
    echo $obj->runQuery($query) ? "Sample Area added\n" :  "Could not add sample Area\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO Areas(city,location) VALUES('Durban','Umlazi')";
    echo $obj->runQuery($query) ? "Sample Area added\n" :  "Could not add sample Area\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO Areas(city,location) VALUES('Durban','Durban Central')";
    echo $obj->runQuery($query) ? "Sample Area added\n" :  "Could not add sample Area\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO Areas(city,location) VALUES('Durban','Isipingo')";
    echo $obj->runQuery($query) ? "Sample Area added\n" :  "Could not add sample Area\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO Areas(city,location) VALUES('Durban','Chatsworth')";
    echo $obj->runQuery($query) ? "Sample Area added\n" :  "Could not add sample Area\t ".  mysql_error()."\n<br />";

    $query = "INSERT INTO Areas(city,location) VALUES('Durban','Isipingo')";
    echo $obj->runQuery($query) ? "Sample Area added\n" :  "Could not add sample Area\t ".  mysql_error()."\n<br />";

    
    $query = "CREATE TABLE Packages(
       package_id INTEGER PRIMARY KEY AUTO_INCREMENT,
       print_size VARCHAR(50),
       price DECIMAL)";
   
    echo $obj->runQuery($query) ? "Table Packages created\n" :  "Could not create table".  mysql_error()."\n<br />";

    $query = "INSERT INTO Packages(print_size,price) VALUES('16x16',16.00)";
    echo $obj->runQuery($query) ? "Sample Package item added\n" :  "Could not add sample Package item\n ".  mysql_error()."\n<br />";

    $query = "INSERT INTO Packages(print_size,price) VALUES('24x24',24.00)";
    echo $obj->runQuery($query) ? "Sample Package item added\n" :  "Could not add sample Package item\n ".  mysql_error()."\n<br />";

    $query = "INSERT INTO Packages(print_size,price) VALUES('64x64',64.00)";
    echo $obj->runQuery($query) ? "Sample Package item added\n" :  "Could not add sample Package item\n ".  mysql_error()."\n<br />";
   
    */
     $query = "CREATE TABLE Orders(
       order_id INTEGER PRIMARY KEY AUTO_INCREMENT,
       order_from VARCHAR(50) NOT NULL,
       order_from_id VARCHAR(1000) NOT NULL,
       order_to VARCHAR(50) NOT NULL, 
       order_date VARCHAR(10) NOT NULL,
       order_location VARCHAR(50) NOT NULL,
       order_image_number INTEGER NOT NULL,
       order_price DECIMAL NOT NUll,
       order_fullfilled BINARY,
       order_fullfilled_date VARCHAR(10),
       order_comments VARCHAR(50))";
   
   echo $obj->runQuery($query) ? "Table Orders created\n" :  "Could not create table\t ".  mysql_error()."\n<br />";
   
    /*$query = "CREATE TABLE UserIDs(
       user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
       userId_date_created VARCHAR(50),
       hash_value VARCHAR(50)
       )";
   
   echo $obj->runQuery($query) ? "Table UserIDs created\n" :  "Could not create table\t ".  mysql_error()."\n<br />";

   */

}
else
    echo "Could not connect".  mysql_error()."\n<br />";

 


    }
}

    $objStartUp = new StartUp();
    $objStartUp->init();




?>

