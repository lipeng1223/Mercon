<div id="main-slider" class="swiper-slider swiper-container horizontal-slider full-height slider-parallax">
	<div class="swiper-wrapper">
    	<?php foreach ($slides as $row):?>
    	    <div class="swiper-slide" style="background-image: url('<?php echo $this->crud_model->get_image_url('slide', $row['id']);?>');">
    			<div class="slider-caption caption-centered">
    			    <div class="slide_text">
        				<h2 class="text-white opacity-0" data-caption-class="fadeInUp" data-caption-delay="300">
        				    <?php echo $row['title'];?>
        				</h2>
        				<p class="text-white text-extra-large margin-top-15 opacity-0" data-caption-class="fadeInDown" data-caption-delay="300">
        					<?php echo $row['sub_title'];?>
        				</p>
    				</div>
    
    				<a class="btn btn-primary margin-top-15 opacity-0 btn-wide btn-scroll btn-scroll-top fa-arrow-right" data-caption-class="fadeIn" data-caption-delay="900"
    				    href="<?php echo $row['button_link'];?>">
    					<span><?php echo $row['button_text'];?></span>
    				</a>
    			</div>
    		</div>
    	<?php endforeach;?>
	</div>
	<!-- Add Pagination -->
	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-pagination"></div>
</div>