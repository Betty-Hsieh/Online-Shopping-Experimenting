<?php 
include_once("../box/header.php"); 

//產品
$sql_product="select * from product where add_product=0";
$result_product=mysql_query($sql_product);

?>
    <section>
    	<div class="container">
            <div class="row">
                <?php include_once("../box/nav.php"); ?>
                <div class="col-sm-9">
                	<div class="row">
                    	<?php while($product=mysql_fetch_array($result_product)){
							$product_img=array();
							$product_img=explode("|",$product["pro_img"]);
						?>
                    	<div class="col-sm-3">
                			<div class="product_box text-center">
                            	<a href="product.php?p_id=<?=$product["p_id"] ?>">
                                	<figure class="product_img"><img src="../images/product/<?=$product_img[0] ?>"  class="img-responsive"/></figure>
                                	<p class="txt"><?=$product["pro_price"] ?>元</p>
                                    <h5 class="title"><?=$product["pro_name"] ?></h5>
                                </a>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
    	</div>
    </section>
</body>
</html>
