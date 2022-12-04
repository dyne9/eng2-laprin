<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

?>

</div>
<!-- // board_area -->

<div class="footer_before_space"></div>

<script type="text/javascript">
(function ($) {
	$(function () {
		$('.board_list tbody tr').hover(function () {
			$(this).addClass('on');
		}, function () {
			$(this).removeClass('on');
		});
	});
})(jQuery);
</script>