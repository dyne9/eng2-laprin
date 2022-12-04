<?php
include "{$g4['path']}/lib/latest.lib.php";

$header_title = null;
$load_css[] = "./css/mobile/index.css";
$load_css[] = "./css/owl.carousel.min.css";
include "_head.php";
?>


<div id="slider1">
	<div class="owl-carousel">
		<div class="item"><a href="/page.php?pageIndex=150103"><img src="/img/mobile/index/slider1-1.jpg" alt=""></a></div>
		<div class="item"><a href="/page.php?pageIndex=140101"><img src="/img/mobile/index/slider1-2.jpg" alt=""></a></div>
	</div>
</div>

<div id="sec2" class="w94" style="margin-top:30px;margin-bottom:30px">
	<div class="a-split a-split3-2">
		<img src="/img/mobile/index/sec2.png" alt="" class="w100">
		<a href="/page.php?pageIndex=110101" title="Breast Augmentation"></a>
		<a href="/page.php?pageIndex=120101" title="Body Contouring"></a>
		<a href="/page.php?pageIndex=130101" title="Facial Contouring"></a>
		<a href="/page.php?pageIndex=140101" title="Stem Cell"></a>
		<a href="/page.php?pageIndex=150101" title="Aesthetics"></a>
		<a href="/page.php?pageIndex=160101" title="Women's Clinic"></a>
	</div>
</div>

<div id="sec3">
	<div class="">
		<div class="text-center">MOST POPLAR</div>
		<div class="owl-arrow">
			<i class="arrow left"></i>
			<span class="active">01</span>
			<span>/</span>
			<span>03</span>
			<i class="arrow right"></i>
		</div>
		<div class="owl-carousel">
			<div class="item" data-index="1">
				<a href="/page.php?pageIndex=110101"><img src="/img/mobile/index/sec3-1.jpg" class="w100" alt=""></a>
				<strong>Active-Subfascial<br>Breast Implant</strong>
				<p>Minimal pain, fast recovery,<br>and natural in shape and movement</p>
			</div>
			<div class="item" data-index="2">
				<a href="/page.php?pageIndex=120101"><img src="/img/mobile/index/sec3-2.jpg" class="w100" alt=""></a>
				<strong>Large Volume<br>Liposuction</strong>
				<p>Made possible by<br>LaPrin's 3STEP SAFE Lipo</p>
			</div>
			<div class="item" data-index="3">
				<a href="/page.php?pageIndex=110103"><img src="/img/mobile/index/sec3-3.jpg" class="w100" alt=""></a>
				<strong>Stem cell<br>Breast Implant</strong></strong>
				<p>Various treatments available<br>for using your own stem cells</p>
			</div>
			
		</div>
	</div>
</div>

<div id="sec4" class="w94">
	<div class="owl-carousel">
		<div class="item">
			<img src="/img/mobile/index/sec4-1.jpg" alt="" class="w100">
			<h5>WHY LaPrin</h5>
			<strong>Safe and differentiated<br>surgical system</strong>
			<p>We have various installations<br>and equipments for precise examination<br>and safe operation.</p>
		</div>
		<div class="item">
			<img src="/img/mobile/index/sec4-2.jpg" alt="" class="w100">
			<h5>WHY LaPrin</h5>
			<strong>Personalization from<br>dedicated team</strong>
				<p>The surgery is done by highly qualified medical staffs,<br>
				with many years of experience in ophthalmoplasty to<br>
				provide you with safe and accurate operation.	</p>
		</div>
		<div class="item">
			<img src="/img/mobile/index/sec4-3.jpg" alt="" class="w100">
			<h5>WHY LaPrin</h5>
			<strong>Aseptic Clean Room<br>															
				Safety System</strong>
				<p>We own an air purification system to prevent infection<br>
				through germs in the air and to maintain<br>
				a pleasant operating environment.	</p>
		</div>

	</div>
</div>

<div id="sec5" class="w94">
	<h5 class="text-center">REAL STORY</h5>
	<ul class="category">
		<li><a href="#sec5-1" class="on"></a></li>
		<li><a href="#sec5-2"></a></li>
	</ul>
	
	
	<div id="sec5-1" class="sub on">
		<img src="/img/mobile/index/sec5-1.jpg" alt="" class="w100" usemap="#map1">
		<map name="map1">
			<area shape="rect" coords="0,0,596,597" href="/bbs/board.php?bo_table=laprin_media&view_wr_id=3" alt="">
			<area shape="rect" coords="0,597,298,893" href="/bbs/board.php?bo_table=laprin_media&view_wr_id=12" alt="">
			<area shape="rect" coords="298,597,596,893" href="/bbs/board.php?bo_table=laprin_media&view_wr_id=9" alt="">
			<area shape="rect" coords="0,893,298,1190" href="/bbs/board.php?bo_table=laprin_media&view_wr_id=10" alt="">
			<area shape="rect" coords="298,893,596,1190" href="/bbs/board.php?bo_table=laprin_media&view_wr_id=7" alt="">
		</map>
	</div>
		
		
	<div id="sec5-2" class="sub">
		<img src="/img/mobile/index/sec5-2.jpg" alt="" class="w100" usemap="#map2">
		<map name="map2">
			<area shape="rect" coords="0,0,596,353" href="/bbs/board.php?bo_table=real_story&wr_id=5" alt="">
			<area shape="rect" coords="0,353,596,707" href="/bbs/board.php?bo_table=real_story&wr_id=4" alt="">
			<area shape="rect" coords="0,707,596,1059" href="/bbs/board.php?bo_table=real_story&wr_id=3" alt="">
		</map>	

	</div>
	
	
</div>

<div id="sec6" class="w94">
	<img src="/img/mobile/index/sec6.png" alt="" class="w100">
</div>




<script type="text/javascript" src="/js/owl.carousel.min.js"></script>
<script type="text/javascript">
$(function () {
	$('#slider1 .owl-carousel').owlCarousel({
		loop:true,
		margin:0,
		nav:false,
		dots:true,
		items:1,
		autoplay:true,
		autoplayTimeout:4000
	});
	var sec3_owl = $('#sec3 .owl-carousel').owlCarousel({
		loop:true,
		margin:30,
		stagePadding:20,
		nav:false,
		dots:false,
		items:1.2,
		autoplay:true,
		center:true,
		autoplayTimeout:4000
	});
	$('#sec3 .right').on('click', function () {
		sec3_owl.trigger('next.owl.carousel');
	});
	$('#sec3 .left').on('click', function () {
		sec3_owl.trigger('prev.owl.carousel');
	});
	sec3_owl.on('translated.owl.carousel', function (evt) {
		$('#sec3 .owl-arrow .active').text( '0' + sec3_owl.find('.active').find('.item').data('index') );
	});

	$('#sec4 .owl-carousel').owlCarousel({
		loop:true,
		margin:0,
		stagePadding:0,
		nav:false,
		dots:true,
		items:1,
		autoplay:true,
		center:true,
		autoplayTimeout:4000
	});
	
	/*
	$('#sec5 a').on('click', function () {
		var obj = $('#sec5 .bg img');
		$('#sec5 a').removeClass('on');
		$(this).addClass('on');
		obj.attr('src', $(this).attr('href'));
		return false;
	});
	*/


	var sec4_page = 1;
	$('#sec4-more').on('click', function () {
		if ( $('#sec4-loading').css('display') == 'block') return false;
		$('#sec4-loading').show();
		sec4_page++;
		$.get('/page/index_sec4_more.php?page=' + sec4_page, function (data) {
			$('#sec4-loading').hide();
			if (data == '') {
				sec4_page--;
				alert("마지막 페이지입니다.");
			}
			else
				$('#sec4 ul').append(data);
		}, 'text');
		return false;
	});

	$('#sec5 .category a').on('click', function () {
		$(this).closest('ul').find('a').removeClass();
		$(this).addClass('on');
		$('#sec5 .sub').removeClass('on');
		$( $(this).attr('href') ).addClass('on');
		$('img[usemap]').rwdImageMaps();
		return false;
	});

	/*
	$('#sec5 .category a').on('click', function () {
		$(this).closest('ul').find('a').removeClass();
		$(this).addClass('on');
		$('#sec5 .category-list').load( this.href );
		return false;
	}).eq(0).trigger('click');
	*/

	$('#sec7 .owl-carousel').owlCarousel({
		items:1.5,
		loop:false,
		margin:16,
		nav:false,
		dots:true,
		autoplay:true,
		autoWidth:false,
		center:true,
		autoplayTimeout:7000// ,		dotsContainer: '#slider1 .dotsCont'
	});
});
</script>
<?php
include_once("layer.inc.mobile.php");
include "_tail.php";