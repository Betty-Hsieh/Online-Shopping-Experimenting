<?php 
include_once("../box/header.php"); 

if(isset($_GET["p_id"])){
	$p_id=$_GET["p_id"];
}
$sql_product="select * from product where p_id=".$p_id;
$result_product=mysql_query($sql_product);

$sql_addproduct="select * from product where parent_id=".$p_id." and add_product=1";
$result_addproduct=mysql_query($sql_addproduct);
?>

    <section>
    	<div class="container">
            <div class="row">
                <?php include_once("../box/nav.php"); ?>
                <div class="col-sm-9">
                	<form action="shopping_car.php" method="post">
                    	<?php while($product=mysql_fetch_array($result_product)){
							$product_img=array();
							$product_img=explode("|",$product["pro_img"]);
						?>
                        <div class="row">
                            <div class="col-sm-6">
                                <figure class="img-responsive  product_img"><img src="../images/product/<?=$product_img[0] ?>" /></figure>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="title"><?=$product["pro_name"] ?></h5>
                                <p><?=$product["pro_descript"] ?></p>
                                <p class="txt"><?=$product["pro_price"] ?>元</p>
                                <span>數量：</span><input id="spinner" name="num" value="1">
                                <p class="text-center"><input type="submit" value="加入購物車" /></p> 
                            </div>
                        </div>
                        <input type="hidden" name="p_id" value="<?=$product["p_id"] ?>" />                       
                        <?php
							echo "<div class='text-center product_imgs'>";
							if(count($product_img)>1){
								for($i=1;$i<count($product_img);$i++){
									echo "<figure ><img src='../images/product/".$product_img[$i]."' class='img-responsive '/></figure>";	
								}
							}
							echo "</div>";
						 }
						?>
                    </form>
                </div>
            </div>
    	</div>
    </section>
</body>
</html>
