<?php 
include_once("conn.php"); 
include_once("class/chang.class.php");

print_r($_SESSION['product']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UNI-SHOP</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http:/resources/demos/external/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="js/chang.js"></script>
<script language="javascript">
function tally()
{ fm = document.orderform

  Cost = fm.Item1.value *26.15 +
         fm.Item2.value *26.10 +
         fm.Item3.value *26 

  fm.Total.value = "$" + Cost
}
</script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/base.css">
</head>
<body background="images/th.jpg">
    <header> 
    	<div class="container">
            <a href="index.php"><img src="images/logo.png" style="width:100%; overflow:hidden;"/></a> 
            <p class="text-center"><img src="images/001.gif" alt="" width="517" height="39" /><img src="images/001.gif" alt="" width="517" height="39" /></p>
    	</div>
    </header>
    <section>
    	<div class="container">
            <h5>購物車清單</h5>
            <ol>
            	<?php 
				$totalprice=0;
				foreach( $_SESSION['product'] as list($p_id, $num, $addp_id)){
					$sql_product="select * from product where p_id=".$p_id;
					$result_product=mysql_query($sql_product);
					while($product=mysql_fetch_array($result_product)){
						$totalprice=$totalprice+$product["pro_price"];
						$product_img=array();
						$product_img=explode("|",$product["pro_img"]);
						$sql_addproduct="select * from product where parent_id=".$p_id." and add_product=1";
						$result_addproduct=mysql_query($sql_addproduct);
				?>
            	<li>
                	<div class="row">
                    	<div class="col-sm-3"><figure class="img-responsive addimg"><img class="product_img" src="images/product/<?=$product_img[0] ?>"  /></figure></div>
                        <div class="col-sm-1"><?=$product["pro_name"] ?></div>
                        <div class="col-sm-5"><?=$product["pro_descript"] ?></div>
                        <div class="col-sm-2"><?=$product["pro_price"] ?>元</div>
                        <div class="col-sm-1"><button value="刪除"></button></div>
                    </div>
                    <?php while($addproduct=mysql_fetch_array($result_addproduct)){
						$totalprice=$totalprice+$addproduct["pro_price"];
					?>	
                    <div class="row">
                    	<div  class="col-sm-2"><input type="checkbox" value="" <?php echo ($addp_id==0)?"":"checked"; ?> /></div>
                        <div class="col-sm-3"><figure class="img-responsive addimg"><img class="product_img"  src="images/product/<?=$addproduct["pro_img"] ?>"  /></figure></div>
                        <div class="col-sm-1"><?=$addproduct["pro_price"] ?>元</div>
                        <div class="col-sm-6"><?=$addproduct["pro_descript"] ?></div>
                    </div>
                    <?php }?>
                </li>
               <?php
					}
				}
				?>
            </ol>
            <p class="text-right">Total：<span id="Total"><?=$totalprice ?></span>元</p>
<form method="post" name="orderform" action="mailto:me@mydomain.com" enctype="text/plain">
<table border="0">
<tr><td colspan="4">
<p>item 1<input type="text" name="Item1" value="0" onchange="this.value=this.value*1; tally()">
<p>item 2<input type="checkbox" name="Item2" value="0" onchange="this.value=this.value*1; tally()">
<p>item 3<input type="text" name="Item3" value="0" onchange="this.value=this.value*1; tally()">
</td></tr>
<tr>
<td> Total <input type="text" name="Total" value="$0" size="7"></td>
</tr>
<tr><td colspan="2" align="center"><input type="Submit" value="Send Order"></td>
</tr>
</table>
</form>

            <h5>購買人</h5>
            <div>
            	<div class="row">
					<div class="col-sm-2">學號：</div>
                    <div class="col-sm-4"><input type="text" name="student_id"></div>
                    <div class="col-sm-2">連絡電話：</div>
                    <div class="col-sm-4"><input type="text" name="student_tel"></div>
                </div>
            </div>
    	</div>
    </section>
</body>
</html>
