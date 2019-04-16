<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "logingep";
$connectionToServerDB = new mysqli($host,$username,$password);
$connectionToServerDB->query('create table users(username varchar(30) primary key not null,password varchar(32) not null,date date not null);');
$connectionToServerDB = new mysqli($host,$username,$password,$db);
if($connectionToServerDB->connect_error)
{
    die("Connessione fallita ".$connectionToServerDB->connect_error);
}
$connectionToServerDB->query('create table if not exists users(username varchar(30) primary key not null,password varchar(32) not null,date date not null);');
?>