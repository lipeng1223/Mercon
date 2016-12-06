<div class="blog-posts">
	<article>
		<div class="row">
			<div class="col-md-12">
				<div class="swiper-container horizontal-slider margin-bottom-30">
					<div class="swiper-wrapper">
    					<?php foreach ($slides as $row):?>
    					    <div class="swiper-slide">
    							<img src="<?php echo $this->crud_model->get_image_url('pslide', $row['id']);?>" alt="" class="img-responsive"/>
    						</div>
    					<?php endforeach;?>
					</div>
					<!-- Add Pagination -->
					<div class="swiper-pagination"></div>
					<!-- Add Arrows -->
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</div>
	</article>
	<?php if ($video != ''){?>
	<hr />
	<article>
		<div class="row">
			<div class="col-md-12">
				<div class="post-media margin-bottom-30">
				    <iframe style="height:400px !important" src="<?php echo $video;?>" frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</article>
	<?php }?>
</div>