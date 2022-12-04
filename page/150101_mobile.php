<style>
#m150101 .owl-carousel .owl-dots {text-align:center;margin-top:20px}
#m150101 .owl-carousel .owl-dots .owl-dot {padding:6px;background:#fff;display:inline-block;border-radius:100%;margin:0 3px}
#m150101 .owl-carousel .owl-dots .active {background:#1f1f1f}
</style>
<article id="m<?=$pageIndex?>">
	<div data-aos="fade-up" data-aos-once="true">
		<img src="/img/mobile/15/1-1.jpg" alt="" class="w100">
	</div>
	<div data-aos="fade-up" data-aos-once="true">
		<img src="/img/mobile/15/1-2.jpg" alt="" class="w100">
	</div>
	<div data-aos="fade-up" data-aos-once="true">
		<section class="tab-wrap">
				<ul class="tab-title w94">
					<li class="active"><a href="#">Filler</a></li>
					<li><a href="#">Botox</a></li>					
				</ul>
			<div class="tab-cont">
				<img src="/img/mobile/15/1-2-1.jpg" alt="" class="w100">
				<div style="background:url('/img/mobile/15/1-2-1-00-bg.jpg') center no-repeat;background-size:cover;padding:40% 0 10%">
					<div class="w94">
						<div class="owl-carousel">
							<div class="item"><img src="/img/mobile/15/1-2-1-00-1.png" alt="" class="w100"></div>
							<div class="item"><img src="/img/mobile/15/1-2-1-00-2.png" alt="" class="w100"></div>
						</div>
					</div>
				</div>
				<div class="tab-wrap">
					<ul class="tab-title w94">
						<li class="active"><a href="#">1111111</a></li>
						<li><a href="#">222222</a></li>
						<li><a href="#">33333333</a></li>
						<li><a href="#">44444444</a></li>
					</ul>
					<div class="tab-cont">내용 #1</div>
					<div class="tab-cont">내용 #2</div>
					<div class="tab-cont">내용 #3</div>
					<div class="tab-cont">내용 #4</div>
				</div>
			</div>
			<div class="tab-cont"><img src="/img/mobile/15/1-2-2.jpg" alt="" class="w100"></div>
			
		</section>
	</div>
	<div data-aos="fade-up" data-aos-once="true">
		<img src="/img/mobile/15/1-9.jpg" alt="" class="w100">
	</div>
	<div data-aos="fade-up" data-aos-once="true">
		<img src="/img/mobile/15/1-10.jpg" alt="" class="w100">
	</div>
	
</article>


<script>
$(function () {
	$('#m150101 .owl-carousel').owlCarousel({
		items:1,
		loop:true,
		margin:0,
		nav:false,
		dots:true,
		autoplay:true
	});
});
</script>