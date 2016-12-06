<section id="page-title">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<h1 class="mainTitle">Training</h1>
			</div>
			<ol class="breadcrumb">
				<li>
					<span>Home</span>
				</li>
				<li class="active">
					<span>Training</span>
				</li>
			</ol>
		</div>
	</div>
</section>

<section class="container-fluid container-fullw bg-white">
	<div class="container">
		<div class="row">
		
			<div class="col-md-6 col-sm-6 col-xs-12">
			    <p>In this section you will find multiple instructional videos on how to use/install products that we sell here at Merriman. This includes installation of valves, fittings and use of tools.</p>
			    
			    <blockquote>
			    <?php foreach ($videos as $row):?>
			    <h4>
			        <a href="<?php echo $row['url'];?>" target="_blank">
			            <img alt="video" src="<?php base_url()?>assets/images/YouTube-icon.png" style="width: 20px">
			            <?php echo $row['title'];?>
			        </a>
			    </h4>
			    <?php endforeach;?>
			    </blockquote>
			     
			</div>
		</div>
	</div>
</section>