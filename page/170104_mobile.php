<style>
.root_daum_roughmap {width:100%; margin:0 auto}
.root_daum_roughmap .wrap_map {height:300px}
.tab-wrap ul li a {border-color:#fff;background:#fb47a4;color:#fff}
.tab-wrap ul li.active a {background:#fffbef;color:#030303}
</style>
<article id="m<?=$pageIndex?>">
	<div data-aos="fade-up" data-aos-once="true">
		<img src="/img/mobile/17/4-1.png" alt="" class="w100">
	</div>
	<div class="w94">
		<div data-aos="fade-up" data-aos-once="true">
			<div id="daumRoughmapContainer1549609469512" class="root_daum_roughmap root_daum_roughmap_landing"></div>
		</div>
		<div data-aos="fade-up" data-aos-once="true">
			<img src="/img/mobile/17/4-2.png" alt="" class="w100">
		</div>
		<div data-aos="fade-up" data-aos-once="true">
			<img src="/img/mobile/17/4-3.png" alt="" class="w100">
		</div>
		<div data-aos="fade-up" data-aos-once="true">
			<div class="tab-wrap">
				<ul class="tab-title">
					<li class="active"><a href="#">Diving</a></li>
					<li><a href="#">Public Transportation (Subway)</a></li>
					<li><a href="#">Public Transportation (Bus)</a></li>
					<li><a href="#">Airport Shuttle</a></li>
				</ul>
				<div class="tab-cont"><img src="/img/mobile/17/4-4-1.png" alt="" class="w100"></div>
				<div class="tab-cont"><img src="/img/mobile/17/4-4-2.png" alt="" class="w100"></div>
				<div class="tab-cont"><img src="/img/mobile/17/4-4-3.png" alt="" class="w100"></div>
				<div class="tab-cont"><img src="/img/mobile/17/4-4-4.png" alt="" class="w100"></div>
			</div>
		</div>
	</div>
</article>




<!-- 2. 설치 스크립트 -->
<script>
(function(){var c=(location.protocol=="https:")?"https:":"http:";var a="83534364";if(window.daum&&window.daum.roughmap&&window.daum.roughmap.cdn){return}window.daum=window.daum||{};window.daum.roughmap={cdn:a,URL_KEY_DATA_LOAD_PRE:c+"//t1.daumcdn.net/roughmap/",url_protocal:c};var b=c+"//t1.daumcdn.net/kakaomapweb/place/jscss/roughmap/"+a+"/roughmapLander.js";document.write('<script charset="UTF-8" src="'+b+'"><\/script>')})();
</script>
<!-- 3. 실행 스크립트 -->
<script charset="UTF-8">
	new daum.roughmap.Lander({
		"timestamp" : "1549609469512",
		"key" : "s5zu",
		"mapWidth" : "",
		"mapHeight" : ""
	}).render();
$(function () {
	$('.sub-nav a').on('click', function () {
		$(this).closest('ul').find('a').removeClass('on');
		$(this).addClass('on');
		$('.sub6-3').removeClass('on');
		$( $(this).attr('href') ).addClass('on');
		return false;
	}).eq(0).trigger('click');
});
</script>