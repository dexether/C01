<div class="gap gap-small"></div>
<div class="container">
	<!-- Today Promo -->
	<h3 class="widget-title-lg"><?php echo $this->lang->line('main_daily_promo_title') ?></h3>
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
			<img class="product-img-primary" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="Image Alternative text" title="Image Title" />
			<img class="product-img-alt" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="Image Alternative text" title="Image Title" />
					</div>
            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
            <div class="product-caption">
                <div class="my-rating" data-rating="4.5"></div>
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
<!-- End Of Today Promo -->
<div class="gap"></div>
<div class="row" data-gutter="15">
	<div class="col-md-4">
		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/380x200background.png);">
			<a class="banner-link" href="<?php echo base_url().'c/forex-indicator'; ?>"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Indikator Forex</h5>
				<!-- <p class="banner-desc">Pro Backpacks 70% Off.</p> -->
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>

			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/STOCHASTIC.png" src="" alt="Image Alternative text" title="Image Title" style="bottom: -2px; right: -12px; width: 200px;" />
		</div>
	</div>
	<div class="col-md-4">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/750x200background.png);">
			<a class="banner-link" href="<?php echo base_url()?>c/forex-signal"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Daily Signal</h5>
				<p class="banner-desc">Best Forex Signal</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/graph.png" src="" alt="Image Alternative text" title="Image Title" style="bottom: -21px; right: -100px; width: 340px;" />
		</div>
	</div>
	<div class="col-md-4">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/750x200background.png);">
			<a class="banner-link" href="<?php echo base_url()?>c/forex-copytrade"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Copy Trade</h5>
				<p class="banner-desc">Digital Copy systems</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/copytrade2.png" src="" alt="Image Alternative text" title="Image Title" style="bottom: 0px; right: 0px; width: 200px;" />
		</div>
	</div>
	<div class="col-md-6">
		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/560x200background.png);">
			<a class="banner-link" href="<?php echo base_url().'c/forex-book'; ?>"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Buku Finansial</h5>
				<p class="banner-desc">Koleksi buku finansial terbaik</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/FIBONACCI BOOK.png" src="" alt="Image Alternative text" title="Image Title" style="top: 0px; right: -35px; width: 220px;" />
		</div>
	</div>
	<div class="col-md-6">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/560x200background.png);">
			<a class="banner-link" href="<?php echo base_url().'c/forex-seminar'; ?>"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Seminar Finansial</h5>
				<p class="banner-desc">Acara Seminar finansial terbaik</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/18-i.png" src="" alt="Image Alternative text" title="Image Title" style="top: 17px; right: -45px; width: 350px;" />
		</div>
	</div>
	<div class="col-md-4">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/380x200background.png);">
			<a class="banner-link" href="<?php echo base_url().'c/forex-robot'; ?>"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">EA & Bot</h5>
				<p class="banner-desc">Best EA & Bots, get It !</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/COPY TRADE.png" src="" alt="Image Alternative text" title="Image Title" style="bottom: -10px; right: -2px; width: 200px;" />
		</div>
	</div>
	<div class="col-md-4">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/380x200background.png);">
			<a class="banner-link" href="<?php echo base_url().'c/forex-education'; ?>"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Edukasi Finansial</h5>
				<p class="banner-desc">Best Education For you</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/MAGIC BOX TRADING SYSTEM.png" src="" alt="Image Alternative text" title="Image Title" style="bottom: -32px; right: -92px; width: 300px;" />
		</div>
	</div>
	<div class="col-md-4">

		<div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/back/380x200background.png);">
			<a class="banner-link" href="<?php echo base_url() ?>c/forex-merchandise"></a>
			<div class="banner-caption-left">
				<h5 class="banner-title">Merchandise</h5>
				<p class="banner-desc">Top Finance Merchandise!</p>
				<p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
				</p>
			</div>
			<img class="banner-img" data-src="<?php echo base_url('assets') ?>/img/test_banner/mrc.png" src="" alt="Image Alternative text" title="Image Title" style="bottom: -38px; right: -20px; width: 200px;" />
		</div>
	</div>
</div>
<div class="gap"></div>
<!-- Ads -->
<img style="height: 150px" data-src="<?php echo base_url();  ?>assets/img/ads/twofrx.gif" class="img-responsive">
<!-- End Ads -->

</div>
<div class="gap"></div>
<div class="slider-item-sm" style="background-image:url(<?php echo base_url('assets') ?>/img/1200x500.png);">
	<div class="slider-item-mask"></div>
	<div class="container">
		<div class="slider-item-inner">
			<div class="slider-item-caption slider-item-caption-white">
				<br/>
				<h4 class="slider-item-caption-title">If you buy things you do not need, soon you will have to sell things you need</h4>
				<p class="slider-item-caption-desc"><i> - Warren Buffet</i></p>
				<!-- <a class="btn btn-lg btn-ghost btn-white" href="#">Shop Now</a> -->
			</div>
		</div>
	</div>
</div>
<div class="container">
<div class="gap"></div>
<h3 class="widget-title-lg"><?php echo $this->lang->line('main_best_ea'); ?></h3>
<div class="row row-sm-gap" data-gutter="10">
	<div class="owl-carousel owl-loaded owl-nav-out" data-autoplay="true" data-options='{"items":3,"loop":true,"nav":true}'>
	<?php
	foreach ($brand['forex-robot'] as $key => $value) {
    
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
			<img class="product-img-primary" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="Image Alternative text" title="Image Title" />
			<img class="product-img-alt" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="Image Alternative text" title="Image Title" />
					</div>
            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
            <div class="product-caption">
                <div class="my-rating" data-rating="4.5"></div>
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
</div>

<div class="gap"></div>
<div class="slider-item-sm" style="background-color:#708566;">
	<div class="container">
		<div class="slider-item-inner">
			<!-- <div class="gap"></div> -->
			<div class="slider-item-caption slider-item-caption-white">
				<br/>
				<br/><br/>
				<h4 class="slider-item-caption-title"> The most important investment you can make is in yourself.</h4>
				<p class="slider-item-caption-desc"><i> - Warren Buffet</i></p>
				<!-- <a class="btn btn-lg btn-ghost btn-white" href="#">Shop Now</a> -->
			</div>
			<a href="http://www.askapimperium.com/"><img class="slider-item-img" data-src="<?php echo base_url()?>assets/img/imperium200x60.png" alt="Image Alternative text" title="Image Title" style="right: 0;bottom: 0;" /></a>
		</div>
	</div>
</div>

<!-- Start of books -->
<div class="gap"></div>
<div class="container">
	<h3 class="widget-title-lg"><?php echo $this->lang->line('main_best_book'); ?></h3>
	<div class="row row-sm-gap" data-gutter="10">
	<div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":3,"loop":true,"nav":true}'>
	<?php
	foreach ($brand['forex-book'] as $key => $value) {
    
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
			<img class="product-img-primary" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="Image Alternative text" title="Image Title" />
			<img class="product-img-alt" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="Image Alternative text" title="Image Title" />
					</div>
            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
            <div class="product-caption">
                <div class="my-rating" data-rating="4.5"></div>
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
</div>
<div class="gap"></div>
<div class="slider-item-sm" style="background-color:#6AAD4B;">
	<div class="container">
		<div class="slider-item-inner">
			<div class="gap"></div>
			<div class="slider-item-caption slider-item-caption-white">
				<br/>
				<h4 class="slider-item-caption-title">Never test the depth of river with both the feet</h4>
				<p class="slider-item-caption-desc"><i> - Warren Buffet</i></p>
				<!-- <a class="btn btn-lg btn-ghost btn-white" href="#">Shop Now</a> -->
			</div>
		</div>
	</div>
</div>
<!-- End Of book -->
<!-- Start of indikator -->
<div class="gap"></div>
<div class="container">
	<h3 class="widget-title-lg"><?php echo $this->lang->line('main_best_indicator'); ?></h3>
	<div class="row row-sm-gap" data-gutter="10">
	<div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":3,"loop":true,"nav":true}'>
	<?php
	foreach ($brand['forex-indicator'] as $key => $value) {
    
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
			<img class="product-img-primary" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="Image Alternative text" title="Image Title" />
			<img class="product-img-alt" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="Image Alternative text" title="Image Title" />
					</div>
            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
            <div class="product-caption">
                <div class="my-rating" data-rating="4.5"></div>
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
</div>
<div class="gap"></div>
<div class="slider-item-sm" style="background-color:#B56532;">
	<div class="container">
		<div class="slider-item-inner">
			<div class="gap"></div>
			<div class="slider-item-caption slider-item-caption-white">
				<h4 class="slider-item-caption-title">Never depend on single income Make investment to create a second source</h4>
				<p class="slider-item-caption-desc"><i> - Warren Buffet</i></p>

			</div>
		</div>
	</div>
</div>
<div class="gap"></div>
<div class="container">
	<h3 class="widget-title-lg"><?php echo $this->lang->line('main_best_merch'); ?></h3>
	<div class="row row-sm-gap" data-gutter="10">
	<div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":3,"loop":true,"nav":true}'>
	<?php
	foreach ($brand['forex-merchandise'] as $key => $value) {
    
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
			<img class="product-img-primary" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="Image Alternative text" title="Image Title" />
			<img class="product-img-alt" data-src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" src="<?php echo base_url()  ?>assets/img/ripple.svg" alt="Image Alternative text" title="Image Title" />
					</div>
            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
            <div class="product-caption">
                <div class="my-rating" data-rating="4.5"></div>
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
</div>
<div class="gap"></div>

<script type="text/javascript">
	$(document).ready(function($) {
		$(".my-rating").starRating({
			starSize: 25
		});
	}); 
</script>