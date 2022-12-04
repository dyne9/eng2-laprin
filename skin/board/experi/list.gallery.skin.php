<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
include_once("$g4[path]/lib/thumb.lib.php");
$thumb_width = '377'; //썸네일 가로길이
$thumb_height = '250'; //썸네일 세로길이
$thumb_quality = '100'; // 썸네일 퀄리티
$filter[type] = 99;
$filter[arg1] = 100;
$filter[arg2] = 1;
$filter[arg3] = 2;
$arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음
?>


<ul class="board_list board_<?=$bo_table?>">
<?php
for ($i=0; $i<count($list); $i++) 
{
	$tr_css = '';
	if ($list[$i][is_notice]) { // 공지사항 
		$num = "<span class='ico-notice'>NOTICE</span>";
		$tr_css = 'notice';
	}
	else if ($wr_id == $list[$i][wr_id]) // 현재위치
		$num = "<span class='current'>{$list[$i][num]}</span>";
	else
		$num = $list[$i][num];

	$no_thumb     = $board_skin_path."/img/no-thumbnail.png";
	if ($bo_table == 'experi') $no_thumb     = $board_skin_path."/img/no-thumbnail-experi.jpg";
	$thumb1 = $thumb2 = '';
	$file1 = $list[$i]['file'][0]['path'] .'/'. $list[$i]['file'][0]['file'];
	if ($list[$i]['file'][0]['file'] && file_exists($file1) && preg_match("/\.(jpeg|jpg|gif|png)$/i", $file1)) {
		$thumb1 = $file1;
	}
	else {
		$edit_img = $list[$i]['wr_content'];
		$edit_img = preg_replace('/alt="(.*?)"/i', '', $edit_img);
		if (preg_match("/\/data\/(?:cheditor4|se)[^<>]*\.(gif|jp[e]?g|png|bmp)/i", $edit_img, $tmp)) {  // data/cheditor------
			$thumb1 = '..' . $tmp[0]; // 파일명
		}
		if (!$thumb1 && preg_match("/\/filedata\/(?:cheditor4|se)[^<>]*\.(gif|jp[e]?g|png|bmp)/i", $edit_img, $tmp)) {  // data/cheditor------
			$thumb1 = '..' . $tmp[0]; // 파일명
		}
		
	}
	if ($thumb1) $thumb1 = thumbnail($thumb1, $thumb_width, $thumb_height, 0, 2, $thumb_quality, 0, "",  $filter, $noimg); // 0 그대로 2 확대
	#else $thumb1 = $no_thumb;

	if (!$thumb1) $thumb1 = "<i class=\"nil-img\"><img src=\"{$no_thumb}\"></i>";
	else $thumb1 = "<img src=\"{$thumb1}\" class=\"thumb\">";

	$short_desc = cut_str(conv_content(strip_tags($list[$i]['wr_content']), 'html2'), 370);
	$short_desc = str_replace('&nbsp;', ' ', $short_desc);

	$li_css = '';
	if ($list[$i]['wr_6'] == '-1') $li_css = 'end-event';
?>
<li class="<?=$li_css?>">
	<a href="<?=$list[$i]['href']?>">
		<?=$thumb1?>
		<p class="subject ellipsis"><?=$list[$i]['subject']?></p>
		<p class="datetime">
			<?php if ($bo_table == 'experi') { ?>
			<?=$list[$i]['wr_name']?> / <?=$list[$i]['wr_5']?>세 / 수술일자 : <?=$list[$i]['wr_6']?>
			<?php } ?>
			<?php if ($bo_table == 'event') { ?>
			기간 : <?=$list[$i]['wr_5']?>
			<?php } ?>
		</p>
		<p class="end-event">종료된 이벤트입니다.</p>
	</a>
</li>
<?
}
if ($i == 0) { echo "<li class=\"empty\">등록된 내역이 없습니다.</li>"; }
?>
</ul>

<div class="board_button" style="text-align: right">
	<? if ($write_href) echo "<div class='pAbsolute' style='right:0'><a href=\"$write_href\" class=\"orange\">글쓰기</a></div> "; ?>
</div>

<!-- 페이지 -->
<div class="board_page">
	<? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='이전검색'></a>"; } ?>
	<?=$write_pages?>
	<? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='다음검색'></a>"; } ?>
</div>

<!-- 검색 -->
<div class="board_search">
	<form name="fsearch" method="get">
	<input type="hidden" name="bo_table" value="<?=$bo_table?>">
	<input type="hidden" name="sca"      value="<?=$sca?>">
	<select name="sfl" class="ed">
		<option value="wr_subject">제목</option>
		<option value="wr_content">내용</option>
		<option value="wr_subject||wr_content">제목+내용</option>
		<option value="mb_id,1">회원아이디</option>
		<option value="wr_name,1">글쓴이</option>
	</select>
	<input name="stx" class="ed" size="20" maxlength="30" itemname="검색어" required value='<?=stripslashes($stx)?>'>
	<button type="submit"">검색</button>
	<input type="hidden" name="sop" value="and">
	</form>
</div>





<script type="text/javascript">
//if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';
}
(function ($) {
	$(function () {
		$('.board_tbl tbody tr').hover(function () {
			$(this).addClass('on');
		}, function () {
			$(this).removeClass('on');
		});
		/*
		$(window).on('load', function () {
			if (document.location.hash != '') {
				var tmp = document.location.hash.toString().replace('#', '');
				$('.board_list a').each(function () {
					if ( $(this).attr('href').indexOf('wr_id=' + tmp) > 0 ) {
						$(this).trigger('click');
						return false;
					}
				});
			}
		});
		*/
	});
})(jQuery);
</script>


<!-- 게시판 목록 끝 -->
