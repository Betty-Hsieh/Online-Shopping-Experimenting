<?php
include_once("team1/conn.php"); 
$sql="select * from bonus where bounus_code=".$_POST["bouns_number"];
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
	echo $row["bonus_price"];
}

?>