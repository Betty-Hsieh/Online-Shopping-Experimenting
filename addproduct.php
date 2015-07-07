<?php
include_once("conn.php"); 
$sql="select * from product where p_id=".$_POST["p_id"];
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
	if($row["pro_price"]!=""){
		echo $row["pro_price"];
	}
}

?>