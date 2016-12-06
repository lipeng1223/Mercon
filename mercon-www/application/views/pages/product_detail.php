<div class="row">
    <div class="col-md-12">
        <h2><a href="#"><?php if ($parent != "") echo $parent." - ";?> <?php echo $child;?></a></h2>
    </div>
    
    <div class="col-md-12 margin-bottom-30">
        <div class="col-md-6">
            <img src="<?php echo $this->crud_model->get_image_url('category_detail' , $cateid);?>" class="img-responsive">
        </div>
        
        <div class="col-md-6">
            <div class="row">
                <?php if (count($pdfs) > 0):?>
                    <div class="alert alert-block alert-info fade in">
                        <?php foreach ($pdfs as $row):?>
                           <p>
                               <a href="<?php echo base_url()."uploads/category_pdf/".$row['filename']?>" target="_blank">
                                   <img alt="pdf" src="<?php echo base_url()."assets/images/pdf.jpg";?>" style="width: 20px">
                                   <?php echo $row['title'];?>
                               </a>
                           </p>
                        <?php endforeach;?>
                    </div>            
                <?php endif;?>
            </div>
            
            <div class="row">
                <?php if (count($videos) > 0):?>    
                    <div class="alert alert-block alert-success fade in">
                        <?php foreach ($videos as $row):?>
                           <p>
                               <a href="<?php echo $row['url'];?>" target="_blank">
                                   <img alt="video" src="<?php echo base_url()."assets/images/YouTube-icon.png";?>" style="width: 20px">
                                   <?php echo $row['title'];?>
                               </a>
                           </p>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
            </div>
            
            <div class="row">
                <?php if (count($links) > 0):?>    
                    <div class="alert alert-block alert-warning fade in">
                        <?php foreach ($links as $row):?>
                           <p>
                               <a href="<?php echo $row['linkAddress'];?>" target="_blank">
                                   <i class="fa fa-link fa-1x" aria-hidden="true"></i>
                                   <?php echo $row['linkName'];?>
                               </a>
                           </p>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="row margin-bottom-30">
            <div class="col-md-12">
                <?php echo $detail;?>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <p class='alert alert-danger' style="padding:5px; margin-bottom:5px">Red items are non-stock items- Air freight charges may apply</p>
            </div>
            
            <div class="col-md-6">
                <p class='alert alert-success' style="padding:5px; margin-bottom:5px">Green items are stocked items</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
    <?php 
        $i=0; $cnt = count($products);
        foreach ($products as $row):
            $mod = $i % 2;
            if($mod == 0) echo "<div class='row'>";
    ?>
        <div class="col-md-6 margin-top-10">
            <table width="100%" height="77" border="1" cellpadding="0" cellspacing="0" dir="ltr" class="partinfo_table">
                <tbody>
                    <tr>
                      <td width="91" bgcolor="white"><div><strong>PART NO</strong></div></td>
                      <td width="60" bgcolor="white"><div><strong>SIZE</strong></div></td>
                      <td width="61" bgcolor="white"><div><strong>PRICE</strong></div></td>
                      <td width="72" bgcolor="white"><div><strong>Product Code</strong></div></td>
                      <td width="90" bgcolor="white"><div><strong>WEIGH</strong><strong>T (GM)</strong></div></td>
                    </tr>
                    <tr>
                      <td colspan="4" bgcolor="white">
                           <h4><a href="#"><?php echo $row['name'];?></a></h4>
                      </td>
                      <td width="90" bgcolor="white">
                        <?php
                            $imgulr = base_url()."uploads/product_image/".$row['id'].".jpg";
                            $file_headers = @get_headers($imgulr);
                            if($file_headers[0] != 'HTTP/1.1 404 Not Found'){
                        ?>
                            <img src="<?php echo $imgulr;?>" width="89" height="66" title="<?php echo $row['name'];?>">
                        <?php }?>
                      </td>
                    </tr>
                    <?php
                        $sql = "select * from product_items where active=1 and productid=".$row['id'];
                        $items = $this->db->query($sql)->result_array();
                        foreach ($items as $row1){
                    ?>
                    <tr>
                      <td width="91" bgcolor="white" style="font-weight: bold; color:<?=$row1['color'];?>"><div><?=$row1['partno'];?></div></td>
                      <td width="43" bgcolor="white"><div><?=$row1['size'];?></div></td>
                      <td width="61" bgcolor="white" style="font-weight: bold; color:<?=$row1['color'];?>">
                        <?php
                            $price = $row1['price'];
                            if ($price >0) echo "$".$price;
                            else echo "POA";
                        ?>
                      </td>
                      <td width="72" bgcolor="white" style="font-weight: bold; color:<?=$row1['color'];?>"><div><?=$row1['code'];?></div></td>
                      <td width="90" bgcolor="white"><div><?=$row1['weight'];?></div></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    <?php 
        $i++;
        if($mod == 1 || ($mod==0 && $cnt==$i)) echo "</div>";
        endforeach;
    ?>
    </div>
    
</div>