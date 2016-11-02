<div class="gap gap-small"></div>
<div class="container">
	<!-- Today Promo -->
	<?php if(!empty($promo)): ?>
	<h3 class="widget-title-lg"><span class="fa fa-fire" aria-hidden = "true"></span> <?php echo $this->lang->line('main_daily_promo_title') ?></h3>
	<div class="row row-sm-gap" data-gutter="10">
		<div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":3,"loop":true,"nav":true}'>
	<?php
	foreach ($promo as $key => $value) {
	?>
    <div class="owl-item">
        <div class="product  owl-item-slide">
            <ul class="product-labels">

					<?php if(!$value['promo_alias'] == NULL){
						echo "<li>".$value['promo_alias']."</li>";
					}
					?>

			</ul>
            <div class="product-img-wrap">
			<img class="product-img" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="" title="Image Title" />
					</div>
            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
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
        </div>
    </div>
    <?php } ?>
</div>
</div>

<?php endif; ?>
<!-- End Of Today Promo -->
<!-- start of notification -->
<?php
$aecodeid = $this->nativesession->getObject('aecodeid');
$name = $this->nativesession->getObject('aename');
// $nama =
$data = $this->penjual->ambil_alamat($aecodeid);
if(count($data->result()) < 0 && $this->nativesession->getObject('username')):
	$this->load->view('mall/notification_desktop', array('name' => $name));
endif;
?>
<!-- end ofnotification -->
<div class="row" data-gutter="15">
	<div class="col-md-4">
		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/380x200background.png);">
			<a class="banner-link" href="<?php echo base_url().'c/forex-indicator'; ?>"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Forex Indicator</h5>
				<p class="banner-desc">Indikator forex terbaik</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>

			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/STOCHASTIC.png" src="" alt="" title="Image Title" style="bottom: -2px; right: -12px; width: 200px;" />
		</div>
	</div>
	<div class="col-md-4">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/750x200background.png);">
			<a class="banner-link" href="<?php echo base_url()?>c/forex-signal"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Daily Signal</h5>
				<p class="banner-desc">Signal Forex</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/graph.png" src="" alt="" title="Image Title" style="bottom: -21px; right: -100px; width: 340px;" />
		</div>
	</div>
	<div class="col-md-4">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/750x200background.png);">
			<a class="banner-link" href="<?php echo base_url()?>c/forex-copytrade"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Master Trader</h5>
				<p class="banner-desc">Copy trading</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/copytrade2.png" src="" alt="" title="Image Title" style="bottom: 0px; right: 0px; width: 200px;" />
		</div>
	</div>
	<div class="col-md-6">
		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/560x200background.png);">
			<a class="banner-link" href="<?php echo base_url().'c/forex-book'; ?>"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">financial book</h5>
				<p class="banner-desc">Koleksi buku finansial</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/FIBONACCI BOOK.png" src="" alt="" title="Image Title" style="top: 0px; right: -35px; width: 220px;" />
		</div>
	</div>
	<div class="col-md-6">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/560x200background.png);">
			<a class="banner-link" href="<?php echo base_url().'c/forex-seminar'; ?>"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">financial seminar</h5>
				<p class="banner-desc">Acara seminar finansial</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/seminar.png" src="" alt="" title="Image Title" style="top: 30px; right: 10px;" />
		</div>
	</div>
	<div class="col-md-4">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/380x200background.png);">
			<a class="banner-link" href="<?php echo base_url().'c/forex-robot'; ?>"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">EA & ROBOTIC</h5>
				<p class="banner-desc">EA dan program trading robot</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/COPY TRADE.png" src="" alt="" title="Image Title" style="bottom: -10px; right: -2px; width: 200px;" />
		</div>
	</div>
	<div class="col-md-4">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/380x200background.png);">
			<a class="banner-link" href="<?php echo base_url().'c/forex-education'; ?>"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">financial education</h5>
				<p class="banner-desc">Edukasi finansial</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/MAGIC BOX TRADING SYSTEM.png" src="" alt="" title="Image Title" style="bottom: -32px; right: -92px; width: 300px;" />
		</div>
	</div>
	<div class="col-md-4">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/380x200background.png);">
			<a class="banner-link" href="<?php echo base_url() ?>c/forex-merchandise"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Merchandise</h5>
				<p class="banner-desc">Koleksi barang - barang forex</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/mrc.png" src="" alt="" title="Image Title" style="bottom: -38px; right: -20px; width: 200px;" />
		</div>
	</div>
</div>
</div>

<div class="container">
	<div class="gap gap-small">
	</div>
	<h3 class="widget-title"><?php echo $this->lang->line('main_best_ea'); ?></h3>
	<div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>
		<?php foreach ($brand['forex-robot'] as $key => $value) {	?>
			<div class="owl-item">
					<div class="product  owl-item-slide">
						<ul class="product-labels">
							<?php if(!$value['promo_alias'] == NULL){
								echo "<li>".$value['promo_alias']."</li>";
							}
							?>
						</ul>
							<div class="product-img-wrap">
									<img class="product-img" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="" title="Image Title" />
							</div>
							<a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
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
					</div>
			</div>
			<?php } ?>
	</div>
</div>
<?php if(!empty($brand['forex-seminar'])): ?>
<div class="container">
	<div class="gap gap-small">
	</div>
	<h3 class="widget-title">Forex Seminar</h3>
	<div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>
		<?php foreach ($brand['forex-seminar'] as $key => $value) {	?>
			<div class="owl-item">
					<div class="product  owl-item-slide">
						<ul class="product-labels">
							<?php if(!$value['promo_alias'] == NULL){
								echo "<li>".$value['promo_alias']."</li>";
							}
							?>
						</ul>
							<div class="product-img-wrap">
									<img class="product-img" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="" title="Image Title" />
							</div>
							<a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
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
					</div>
			</div>
			<?php } ?>
	</div>
</div>
<?php endif; ?>
<div class="container">
	<div class="gap gap-small">
	</div>
	<h3 class="widget-title">Master Trader</h3>
	<div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>
		<?php foreach ($brand['forex-copytrade'] as $key => $value) {	?>
			<div class="owl-item">
					<div class="product  owl-item-slide">
						<ul class="product-labels">
							<?php if(!$value['promo_alias'] == NULL){
								echo "<li>".$value['promo_alias']."</li>";
							}
							?>
						</ul>
							<div class="product-img-wrap">
									<img class="product-img" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="" title="Image Title" />
							</div>
							<a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
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
					</div>
			</div>
			<?php } ?>
	</div>
</div>
<div class="container">
	<div class="gap gap-small">
	</div>
	<h3 class="widget-title"><?php echo $this->lang->line('main_best_book'); ?></h3>
	<div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>
		<?php	foreach ($brand['forex-book'] as $key => $value) {	?>
			<div class="owl-item">
					<div class="product  owl-item-slide">
						<ul class="product-labels">
							<?php if(!$value['promo_alias'] == NULL){
								echo "<li>".$value['promo_alias']."</li>";
							}
							?>
						</ul>
							<div class="product-img-wrap">
									<img class="product-img" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="" title="Image Title" />
							</div>
							<a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
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
					</div>
			</div>
			<?php } ?>
	</div>
</div>

<div class="container">
	<div class="gap gap-small">
	</div>
	<h3 class="widget-title"><?php echo $this->lang->line('main_best_indicator'); ?></h3>
	<div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>
		<?php	foreach ($brand['forex-indicator'] as $key => $value) {	?>
			<div class="owl-item">
					<div class="product  owl-item-slide">
						<ul class="product-labels">
							<?php if(!$value['promo_alias'] == NULL){
								echo "<li>".$value['promo_alias']."</li>";
							}
							?>
						</ul>
							<div class="product-img-wrap">
									<img class="product-img" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="" title="Image Title" />
							</div>
							<a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
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
					</div>
			</div>
			<?php } ?>
	</div>
</div>

<div class="container">
	<div class="gap gap-small">
	</div>
	<h3 class="widget-title"><?php echo $this->lang->line('main_best_merch'); ?></h3>
	<div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>
		<?php	foreach ($brand['forex-merchandise'] as $key => $value) {	?>
			<div class="owl-item">
					<div class="product  owl-item-slide">
						<ul class="product-labels">
							<?php if(!$value['promo_alias'] == NULL){
								echo "<li>".$value['promo_alias']."</li>";
							}
							?>
						</ul>
							<div class="product-img-wrap">
									<img class="product-img" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="" title="Image Title" />
							</div>
							<a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
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
					</div>
			</div>
			<?php } ?>
	</div>
</div>
<div class="gap"></div>
<script type="text/javascript">
	$(document).ready(function($) {
		$(".my-rating").starRating({
			starSize: 15
		});
	});
</script>
