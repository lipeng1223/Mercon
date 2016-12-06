<html>
<head>
    <style>
        hr {
            page-break-after: always;
        	height: 0px;
        }
    </style>
</head>
<body>
<br/>
<?php
    $products = $this->db->order_by('sequence', 'asc')->get_where('product_keyword', array('active'=>1, 'categoryid'=>$categoryid))->result_array();
    $i = 1;
    $kk = 0;
    foreach ($products as $product):
        $mod = $i % 2;
        if($mod == 1) echo "<table><tr>";
?>
        <td>
            <table border="1" style="background-color:white; text-align:center; vertical-align: middle;">
                <tbody>
                    <tr>
                        <td width="60" style="line-height: 25px;"><h4>PART NO</h4></td>
                        <td width="60" style="line-height: 25px;"><div><strong>SIZE</strong></div></td>
                        <td width="40" style="line-height: 25px;"><div><strong>PRICE</strong></div></td>
                        <td width="40"><div><strong>Product Code</strong></div></td>
                        <td width="62"><div><strong>WEIGHT (GM)</strong></div></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="line-height: 10px;">
                          <h4><?php echo $product['name'];?></h4>
                        </td>
                        <td width="62" style="line-height: 5px;">
                          <?php
                            $imgulr = base_url()."uploads/product_image/".$product['id'].".jpg";
                            $file_headers = @get_headers($imgulr);
                            if($file_headers[0] != 'HTTP/1.1 404 Not Found'){
                          ?>
                                <img src="<?php echo $imgulr;?>" width="89" width="60" height="40">
                          <?php }?>
                        </td>
                    </tr>
                    <?php
                        $items = $this->db->get_where('product_items', array('active'=>1, 'productid'=>$product['id']))->result_array();
                        foreach ($items as $item):
                    ?>
                    <tr>
                        <td width="60" style="font-weight: bold; color:<?=$item['color'];?>"><?=$item['partno'];?></td>
                        <td width="60"><?=$item['partno'];?></td>
                        <td width="40" style="font-weight: bold; color:<?=$item['color'];?>">
                            <?php
                                $price = $item['price'];
                                if ($price >0) echo "$".$price;
                                else echo "POA";
                            ?>
                        </td>
                        <td width="40" style="font-weight: bold; color:<?=$item['color'];?>"><?=$item['code'];?></td>
                        <td width="62"><?=$item['weight'];?></td>
                    </tr>
                    <?php
                            $kk++;
                        endforeach;
                    ?>
                 </tbody>
            </table>
        </td>
<?php 
        if($mod == 0 || $i == count($products)) {
            if ($kk > 40 && $i < count($products)) {
                echo "</tr></table><br/><hr>";
                $kk = 0;
            }
            else {
                echo "</tr></table><br/><br/>";
            } 
        }
        $i++;
    endforeach;
?>
</body>
</html>