<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
	<?php
	$tmp = substr($pageIndex, 0, 3);
	?>
<footer>
	<div class="footer-sns">
		<div class="w94">
			<div class="a-split a-split3-1">
				<img src="/img/mobile/footer/sns.png" alt="" class="w100">
				<a href="https://pf.kakao.com/_xieNxmV"></a>
				<!-- <a href=""></a>
				<a href=""></a>-->
			</div>
		</div>
	</div>
	<?php
	/*
	<section id="footer_gnb2">
		<div id="footer_gnb2_form" style="">
			<h4 class="text-left">비용문의</h4>

			<form name="index_fwrite" id="index_fwrite" method="post" onsubmit="return xfwrite_submit(this);" enctype="multipart/form-data" style="margin:0px;" target="">
				<input type=hidden name="w" value="">
				<input type=hidden name="bo_table" value="cost">
				<input type=hidden name="wr_id" value="">
				<input type=hidden name="sca" value="">
				<input type="hidden" name="wr_subject" value="<?=time()?>" />
				<input type="hidden" name="wr_content" value="<?=time()?>" />
				<input type="hidden" name="pagetype" value="tail">
				<input type="hidden" name="wr_3" value="1" />
				<input type="hidden" name="page_type" value="bottom" />

				<div class="">
					<ul>
						<li>
							<select name="ca_name" required class="ca" itemname="진료과목">
							<option value="">진료과목 선택</option>
							<?php echo get_category_option2('cost') ?>
							</select>
						</li>
						<li><input type="text" name="wr_name" required itemname="이름" class="ed" placeholder="성함" /></li>
						<li><input type="tel" name="wr_2" required itemname="연락처" class="ed" placeholder="연락처" /></li>
					</ul>
					<div class="agree-wrap">
						<label class="agree"><input type="checkbox" name="agree" value="1"> 개인정보 수집과 이용에 동의합니다.</label>
						<a href="/page/policy.php" id="agree-view" class="agree-view">[개인정보취급방침]</a>
					</div>
					<button type="submit" value="신청하기">신청하기</button>
				<div class="clearfix"></div>
				</div>
			</form>
		</div>
	</section>
	*/ ?>


	<section id="footer_gnb3">
		<div class="inner w92">
			<a href="/page.php?pageIndex=170102">Why LaPrin</a>
			<a href="/page.php?pageIndex=170101">Medical Staff</a>
			<a href="/page.php?pageIndex=170103">LaPrin Tour</a>
			<a href="/page.php?pageIndex=170104">Direction</a>
			<?php 
			#if ($is_member) echo "<a href=\"/bbs/logout.php\">로그아웃</a>";
			#else echo "<a href=\"/bbs/login.php?url={$urlencode}\">로그인</a>";
			?>
			
			<?php
			$pc_url = $_SERVER['REQUEST_URI'];
			if (strpos($pc_url, '?') !== false)
				$pc_url .= "&device_view=pc";
			else
				$pc_url .= "?device_view=pc";
			#<a href="$pc_url" style="">PC버전</a>
			?>			
		</div>
	</section>

	<?php /*
	<section id="footer_gnb4">
		<div>
			<img src="/img/mobile/footerB.png" alt="" class="w100" />
			<ul>
				<li><a href="/page.php?pageIndex=130101"></a></li>
				<li><a href="/page.php?pageIndex=110106101"></a></li>
				<li><a href="/page.php?pageIndex=110108101"></a></li>
				<li><a href="/page.php?pageIndex=110107102"></a></li>
			</ul>
		</div>		
	</section>
	*/ ?>

<!-- 	<div id="footer-lang">
		<a href="/en/"><img src="/img/menu/ico-flag-us.png" alt="" /></a>
		<a href="/cn/"><img src="/img/menu/ico-flag-cn.png" alt="" /></a>
	</div> -->
	<section id="footer_address">
		<div>
			Address : 709, Samseong-ro,<br>
			Gangnam-gu, Seoul, Korea 1F, 6F, B1F<br>
			COPYRIGHT 2012~2019 koreaprincess.co.kr<br>
			ALL RIGHT RESERVED
		</div>
	</section>
</footer>

<!-- <img src="/img/mobile/footer_blank.png" alt="" class="w100"> -->


<a href="#" id="goto-top"></a>


<div id="bg-wrap"></div>

<script type="text/javascript">
$(function () {
	$('#headermenu').click(function () {
		if ( $('#headergnbBlank').length > 0 ) {
			$('#sitemap-close').trigger('click');
			return false;
		}
		$('body').append('<div id="headergnbBlank"></div>');
		$('#headergnbBlank').show();
		var top = $(window).scrollTop();
		$('#sitemap-wrap').addClass('on').css({'top':top});
		return false;
	});
	$('#sitemap-close').click(function () {
		$('#headergnbBlank').remove();
		$('#sitemap-wrap').removeClass('on');
		return false;
	});

	$('#sitemap ul li a').on('click', function () {
		if ($(this).hasClass('on')) {
			$(this).closest('li').find('ul').removeClass('on');
			$(this).removeClass('on');
			return false;
		}

		if ($(this).closest('li').find('ul').length > 0) {
			$(this).closest('li').find('ul').addClass('on');
			$(this).addClass('on');
			return false;
		}
	});

	$('#goto-top').click(function () {
		$('html,body').animate({'scrollTop': 0});
		return false;
	});
	$('#header-arrow').on('click', function () {
		if ( $(this).hasClass('on') ) {
			$('#headergnbBlank').remove();
			$(this).removeClass('on');
			$('#header_titleB').removeClass('on');
		}
		else {
			$('#headergnbBlank').remove();
			$('body').append('<div id="headergnbBlank"></div>');
			$('#headergnbBlank').click(function () {
				$('#header-arrow').trigger('click');
			});
			$(this).addClass('on');
			$('#header_titleB').addClass('on');
		}
		return false;
	});

	/*
	$(window).on('resize', function () {
		$('#gnb a').css('height', 'auto');
		var h = $('#gnb').height();
		$('#gnb a').css('height', h);
	}).trigger('resize') ;

	$('#headercall').on('click', function () {
		$('#headertel-wrap').show();
		return false;
	});
	*/

	$('#gnb-sub-anchor').on('click', function () {
		if ( $('#gnb-sub-wrap').hasClass('on') ) {
			$('#gnb-sub-wrap').removeClass('on');
			$('#gnb-sub').css({'height':0});
		}
		else {
			$('#gnb-sub-wrap').addClass('on');
			$('#gnb-sub').css({'height':$('#gnb-sub-wrap img').height()});
		}
		return false;
	});

	$('#article-footer .owl-carousel').owlCarousel({
		loop:true,
		margin:0,
		nav:false,
		dots:true,
		items:1,
		autoplay:true,
		autoplayTimeout:4000
	});


	$('.agree-view').on('click', function () {
		$('#privacy-wrap').addClass('on');
		return false;
	});

	$('#snb>ul>li>a').on('click', function () {
		if ( $(this).hasClass('on') ) {
			$('#snb li.on').removeClass();
			$(this).removeClass('on');
			return false;
		}
		$('#snb li.on').removeClass();
		$('#snb a.on').removeClass();
		$(this).addClass('on');
		$(this).closest('li').addClass('on');
		return false;
	});

	$('.common-page-header .owl-carousel').owlCarousel({
		loop:true,
		margin:0,
		nav:false,
		dots:true,
		items:1,
		autoplay:false,
		autoplayTimeout:4000,
		dotsContainer: '.common-page-header-dotsCont'
	});


	/* 서브페이지 공통 유투브 네이버 영상 플레이어 부분 */
	if ( $('#video-wrap').length > 0 ) {
		$('#video-wrap .video-thumb a').on('click', function () {
			$(this).closest('ul').find('a').removeClass();
			$(this).addClass('on');
			$('#video-wrap #video-view iframe').remove();
			var str = '<iframe width="1201" height="680" src="' + this.href + '" frameborder="no" scrolling="no" title="" allow="autoplay; gyroscope; accelerometer; encrypted-media" allowfullscreen></iframe>';
			$('#video-wrap #video-view').append(str);
			return false;
		}).eq(0).trigger('click');
	}

-
	$('.tab-wrap').each(function () {
		var tab_title = $(this).find('> .tab-title li');
		var active_tab = $(this).find('> .tab-title li.active').index();
		var tab_cont = $(this).find('> .tab-cont');

		tab_cont.removeClass('show');
		tab_cont.eq(active_tab).addClass('show');
		tab_title.find('a').click(function(e) {
			e.preventDefault();
			var select_tab = $(this).parent().index();
			tab_title.removeClass('active');
			tab_title.eq(select_tab).addClass('active');
			tab_cont.removeClass('show');
			tab_cont.eq(select_tab).addClass('show');
		});
	});

	$('#why-laprin .owl-carousel').owlCarousel({
		items:1,
		loop:true,
		margin:0,
		nav:false,
		dots:true,
		autoplay:false,
		dotsContainer: '.dotsCont'
	});
});

function xfwrite_submit(f) {
	if (!f.elements['agree'].checked) {
		alert("개인정보취급방침에 동의하셔야 합니다.");
		f.elements['agree'].focus();
		return false;
	}
	//f.elements['wr_2'].value = f.elements['hp1'].value + '-' + f.elements['hp2'].value + '-' + f.elements['hp3'].value;
	//if (f.elements['wr_3'].checked) {
	f.elements['wr_2'].value = f.elements['wr_2'].value.replace(/-/g, '');
	var tmp = f.elements['wr_2'].value.replace(/([0-9]{3})([0-9]{3,4})([0-9]{4})/, '$1-$2-$3');
	var pattern = /^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/;
	if(!pattern.test(tmp)){
		alert("상담을 받으시려면 올바른 전화번호를 입력하세요.");
		f.elements['wr_2'].focus();
		return false;
	}
	f.elements['wr_2'].value = tmp;
	
	//}

	f.action = '/bbs/write_update.php';
	return true;
}
/*
if (typeof user_scalable != 'undefined' && user_scalable === false) {
	document.querySelector("meta[name=viewport]").setAttribute(
		'content', 
		'width=640, initial-scale=0.5, maximum-scale=0.5, minimum-scale=0.5, user-scalable=yes, target-densitydpi=medium-dpi');
}
*/
$(function () {
	<?php if ($pageIndex) { ?>
	$('#article-footer .owl-carousel').owlCarousel({
		items:1,
		loop:true,
		margin:0,
		nav:true,
		dots:false,
		autoplay:true,
		autoplayTimeout:4000
	});
	<?php } ?>

	/* 진료과 공통 페이지 */
	$('.menu130 .m-dept-sec-1 .more a.more2').on('click', function () {
		var obj = $($(this).attr('href')).offset();
		$('html,body').animate({'scrollTop': obj.top});
		return false;
	});
	$('.menu130 .m-dept-sec-2 dl dt a, .menu160 .m-dept-sec-2 dl dt a').on('click', function () {
		if ( $(this).parent().hasClass('on') ) {
			$(this).parent().removeClass('on');
			$(this).parent().next().removeClass('on');
			return false;
		}
		$(this).parent().addClass('on');
		$(this).parent().next().addClass('on');
		return false;
	});
});
function doctor_load_view(wr_id) { // wr_id 는 의료진 게시판의 게시물 고유번호 wr_id
	popup_open('iframe', '/page/doctor_load_view_m.php?wr_id=' + wr_id);
	$('#inner_bg').on('click', function () {
		popup_close();
	});
}
</script>



<div id="privacy-wrap">
	<div style="position:fixed;left:0;right:0;top:0;bottom:0;background:#333;opacity:.5;z-index:1001"></div>
	<div class="inner">
		<div style="background:#d87489;color:#fff;padding:15px 0;border-radius:5px 5px 0 0;text-align:center">개인정보처리방침</div>
		<div style="padding:20px;background:#fff;border-radius:0 0 5px 5px">
			<div style="overflow:scroll;height:300px">
				<?php echo nl2br($config['cf_privacy']) ?>
			</div>
			<button type="button" onclick="$('#privacy-wrap').removeClass('on')">닫기</button>
		</div>
	</div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="<?php echo G5_THEME_URL;?>/js/jquery.rwdImageMaps.min.js"></script>
<script type="text/javascript">
$(function(){$('.calPos img').on('load',function(){var b=$(document.body).width();if($(this).height()>0){$(this).closest('.calPos').find('a').each(function(){var a=$(this).attr('pos').split(',');var w=a[2],h=a[3],l=a[0],t=a[1],r=b/640;$(this).css({'width':r*w,'height':r*h,'left':r*l,'top':r*t})})}}).trigger('load');$(window).resize(function(){$('.calPos img').trigger('load')})});

$(document).ready(function(e) {
    $('img[usemap]').rwdImageMaps();
});
AOS.init();
</script>
<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>