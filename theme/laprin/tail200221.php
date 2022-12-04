<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>
</div>
<!-- // #wrapper -->


<?php if (1==2 && get_cookie('sms-popup') != '1') { ?>
<div id="sms-popup">
	<h4>
		문자상담
		<a href="#" id="sms-popup-close" class="sms-popup-close"><img src="<?php echo G5_THEME_URL;?>/img/page/footer/sms-popup-close.png" alt="" /></a>
	</h4>
	<div class="inner">
		<form name="footerform" id="footerform" method="post" action="/bbs/write_update.php" onsubmit="return xfwrite_submit(this)">
		<input type="hidden" name="bo_table" value="cost" />
		<input type="hidden" name="page_type" value="tail" />
		<input type="hidden" name="wr_subject" value="문자상담신청 <?=$g4['time_ymdhis']?>" />
		<ul>
			<li>
				<label class="label">이름</label>
				<input type="text" name="wr_name" required itemname="이름" class="ed" value="<?=$member['name']?>" />
			</li>
			<li class="tel">
				<label class="label">휴대전화</label>
				<input type="hidden" name="wr_2" />
				<select name="hp1" class="ed">
				<option value="010">010</option>
				<option value="011">011</option>
				<option value="016">016</option>
				<option value="018">018</option>
				<option value="019">019</option>
				</select>
				<input type="text" name="hp2" class="ed" maxlength="4" />
				<input type="text" name="hp3" class="ed" maxlength="4" />
			</li>
			<li>
				<label class="label">진료과목</label>
				<select name="ca_name" required itemname="진료과목">
				<option value="">===========</option>
				<?php echo get_category_option2('cost') ?>
				</select>
			</li>
			<li><textarea name="wr_content" cols="30" rows="5" class="ed" placeholder="100자 글자수 제한이 있습니다."></textarea></li>
		</ul>

		<hr />

		<p>내용을 남겨주시면, 상담전화를 드립니다.</p>
		<div class="small">
			개인정보취급방침 
			<a href="/page/policy.php" style="color:#fff;background:#1f1f1f;padding:0 5px">확인</a>
			<label class="checkbox"><input type="radio" name="agree" value="1" /> 동의</label>
			<label class="checkbox"><input type="radio" name="agree" value="0" /> 동의안함</label>
			<br>

			문자수신동의
			<label class="checkbox"><input type="radio" name="wr_3" value="1" /> 동의</label>
			<label class="checkbox"><input type="radio" name="wr_3" value="0" /> 동의안함</label>
		</div>

		<button type="submit">보내기</button>
		</form>

	</div>

	<a href="#" class="sms-popup-close anchor-close"><input type="checkbox" id="anchor-close-check" value="1"> 하루동안 보지 않기</a>

</div>
<?php } ?>


<aside id="right_quick">
    <ul>
        
        <li><a href="/bbs/write.php?bo_table=counsel" ><img src="<?php echo G5_THEME_URL;?>/img/common/quick_menu_02.png" alt="" title=""></a></li>
        <li><a href="https://pf.kakao.com/_xieNxmV" target="_blank"><img src="<?php echo G5_THEME_URL;?>/img/common/quick_menu_03.png" alt="" title=""></a></li>
        <li><a href="/bbs/board.php?bo_table=real_story"><img src="<?php echo G5_THEME_URL;?>/img/common/quick_menu_04.png" alt="" title=""></a></li>
        <li><button type="button" id="go_top" class="go-top">Go to the top</button></li>
    </ul>
</aside>

<footer id="footer">
    <div class="top-area clearfix">
        <ul>
            <li class="kakao">
                <a href="https://pf.kakao.com/_xieNxmV" target="_blank">
                    <span class="msg">KAKAO TALK</span>
                    <span class="id">laprinworld</span>
                </a>
            </li>
            <li class="whats">
                <a href="#none" style="cursor:default;">
                    <span class="msg">WHATSAPP</span>
                    <span class="id">laprinworld</span>
                    <span class="num">+82-10-9605-7812</span>
                </a>
            </li>
            <li class="line">
                <a href="#none" style="cursor:default;">
                    <span class="msg">LINE</span>
                    <span class="id">laprinworld</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="bottom-area">
        <div class="inner-box clearfix">
            <img src="<?php echo G5_THEME_URL;?>/img/common/logo_gray.png" alt="LaPrin" class="logo">
            <address class="company-info">
                <a href="tel:+82-10-9605-7812" class="phone">
                    <span>Phone</span>
                    <strong>+82-10-9605-7812</strong>
                </a>
                <p class="address">
                    Address : 709, Samseong-ro, Gangnam-gu, Seoul, Korea 1F, 6F, B1F<br>
                    COPYRIGHT 2012~2019 koreaprincess.co.kr ALL RIGHT RESERVED
                </p>
            </address>
            <ul class="link-list">
                <li><a href="/page.php?pageIndex=170102">Why LaPrin</a></li>
                <li><a href="/page.php?pageIndex=170101">Medical Staff</a></li>
                <li><a href="/page.php?pageIndex=170103">LaPrin Tour</a></li>
                <li><a href="/page.php?pageIndex=170104">Direction</a></li>
            </ul>
        </div>
    </div>
</footer>
<script type="text/javascript">
    // 탭 JQUERY
    $('.tab-wrap').each(function() {
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
</script>
<?php if(defined('_INDEX_')) { 
add_javascript('<script src="'.G5_THEME_URL.'/js/main.js?ver='.G5_JS_VER.'"></script>', 0);
 } ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript">
AOS.init();
</script>
<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>