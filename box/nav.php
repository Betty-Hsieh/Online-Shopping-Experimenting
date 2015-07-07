<div class="col-sm-3">
    <ul class="list-unstyled">
        <li><a href="index.php">全部商品</a></li>
        <?php while($catelog=mysql_fetch_array($result_catelog)){?>
        <li><a href="product_list.php?c_id=<?=$catelog["catelog_id"];?>"> <?=$catelog["catelog_name"]; ?></a></li>
        <?php }?>
        <li><a href="shop.php">結帳</a></li>
    </ul>
</div>