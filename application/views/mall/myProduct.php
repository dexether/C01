<div class="container">
    <header class="page-header">
        <h3 class="page-title">
            <?php echo $this->lang->line('myproduct_title'); ?>
        </h3>
    </header>
 <div class="container">
	<div class="col-md-3">
		<div class="category-filters">
			<div class="category-filters-section">
				<h3 class="widget-title-sm">Category</h3>
				<ul class="cateogry-filters-list">
				<?php
					foreach ($list_cat as $key => $value2){
				?>	
					<li>
						<a href="<?php echo base_url().'myproduct/'.$value2['cat_name']; ?>"><?php echo $value2['cat_alias'] ?></a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<?php
		$count = 1;
		foreach ($list_prod as $key => $value) {	
			if($count%3 == 1){
		?>
			<div class="row">
			<?php } ?>
					<div class="product col-md-3" style="margin:5px;">
						<ul class="product-labels">
							<?php if(!$value['is_active'] == '1'){
								echo "<li> Menunggu Admin Approval</li>";
							}
							?>
						</ul>
						<div class="product-img-wrap">
							<img class="product-img-primary" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="" title="Image Title" />
						</div>
						<div class="product-caption">
							<div class="my-rating" data-rating="<?php echo $value['prod_star']; ?>"></div>
							<h5 class="product-caption-title"><?php echo $value['prod_alias']; ?></h5>
							<div class="product-caption-price">
								<?php if($value['promo_name'] == NULL || $value['promo_value'] == 0 ){
									echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['prod_price']).'</span>';
								}else{
									echo '<span class="product-caption-price-old">'.$this->format->set_rp($value['prod_price']).'</span>';
									echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['final_price']).'</span>';
								}
								?>
							</div>
						</div>
						<div>
							<input class="btn btn-primary" type="button" name="edit" id="edit" value="Edit" onclick="window.location.href='<?php echo base_url()."product/edit/".$value['prod_name'] ?>';">
							<input class="btn btn-primary" type="button" name="remove" id="remove" value="Remove" onclick="window.location.href='<?php echo base_url()."product/delete/".$value['prod_id'] ?>';">
						</div>
					</div>
			<?php 
				if($count%3 == 0){
			?>
			</div>
				<?php } $count++;?>
			<?php } if($count%4 != 1){?>
			</div>
			<?php } ?>
	</div>
</div>
</div>
