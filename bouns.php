<?php
include_once("conn.php"); 
$sql="select * from bonus where bounus_status=0 and bounus_code=".$_POST["bonus_number"];
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
	if($row["bonus_id"]!=""){
		echo $row["bonus_id"];
	}
}

?>