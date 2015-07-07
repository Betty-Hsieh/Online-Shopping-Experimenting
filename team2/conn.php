<?php
header("Content-Type:text/html; charset=utf-8");
$dbhost = "localhost"; //資料庫網址或IP
$dbusername = "root"; //資料庫帳號
$dbuserpassword = "apple"; //資料庫密碼
$default_dbname = "chang";//資料庫名稱
$connection = mysql_connect($dbhost, $dbusername, $dbuserpassword) or die(mysql_error());
$db = mysql_select_db($default_dbname, $connection) or die(mysql_error());
mysql_query("SET NAMES 'utf8'");

session_start(7200);
$car_product=array();

//分類
$sql_catelog="select * from catalog";
$result_catelog=mysql_query($sql_catelog);
?>