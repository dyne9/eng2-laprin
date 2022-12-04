<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once("$g4[path]/lib/thumb.lib.php");
$thumb_width = '197'; //썸네일 가로길이
$thumb_height = '137'; //썸네일 세로길이
$thumb_quality = '100'; // 썸네일 퀄리티
$filter[type] = 99;
$filter[arg1] = 100;
$filter[arg2] = 1;
$filter[arg3] = 2;
?>
<div id="view_content"></div>
<?php
if ($board['bo_use_category']) { 
	$arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음
?>

<ul class="board_category board_category_<?=count($arr)+1?>">
	<li><a href="board.php?bo_table=<?=$bo_table?>" class="<?=$_GET['sca'] == '' ? 'on' : ''?>">전체<em></em><i></i></a></li>
	<?php
    $str = "";
    	for ($i=0; $i<count($arr); $i++) {
	    if (trim($arr[$i])) {
			$checked = '';
			if ($arr[$i] == urldecode($_GET['sca'])) $checked = 'on';
			echo "<li><a href='?bo_table={$bo_table}&sca=".urlencode($arr[$i])."' class='{$checked}'>{$arr[$i]}<em></em><i></i></a></li>";
		}
	}
	if ($i%3 != 2) { echo "<li><span>&nbsp;</span></li>"; ++$i; }
	if ($i%3 != 2) { echo "<li><span>&nbsp;</span></li>"; ++$i; }
	?>
</ul>
<?php } ?>

<ul class="board_list">
<?
for ($i=0; $i<count($list); $i++) { 
	$class = '';
	if ($list[$i]['wr_good'] == '99999999')
		$class = 'best';
?>
<li>
	<?php
	$no_thumb     = $board_skin_path."/img/no-thumbnail.png";
	$thumb1 = $thumb2 = '';
	$file1 = $list[$i]['file'][0]['path'] .'/'. $list[$i]['file'][0]['file'];
	if ($list[$i]['file'][0]['file'] && file_exists($file1) && preg_match("/\.(jpeg|jpg|gif|png)$/i", $file1)) {
		$thumb1 = $file1;
	}
	else {
		$edit_img = $list[$i]['wr_content'];
		$edit_img = preg_replace('/alt="(.*?)"/i', '', $edit_img);
		if (preg_match("/data\/(?:cheditor4|se)[^<>]*\.(gif|jp[e]?g|png|bmp)/i", $edit_img, $tmp)) {  // data/cheditor------
			$thumb1 = '../' . $tmp[0]; // 파일명
		}
	}
	if ($thumb1) 
		$thumb1 = thumbnail($thumb1, $thumb_width, $thumb_height, 0, 0, $thumb_quality, 0, "",  $filter, $noimg); // 0 그대로 2 확대
	else
		$thumb1 = $no_thumb;
	
	?>
	<a href="<?=$list[$i]['href']?>"><img src="<?=$thumb1?>" class="thumb" alt="" /><p><?=$list[$i]['subject']?></p></a>
</li>
<? } ?>
</ul>





<div class="">
	<div class="board_button " style="right:0px">
		<div class="fLeft">
		</div>
		<div class="fRight">
			<? if ($write_href) { ?>
			<a href="<?=$write_href?>" class="orange">글쓰기</a>
			<? } ?>
		</div>
	</div>
</div>
<div class="board_page">
	<? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='이전검색'></a>"; } ?>
	<?=$write_pages?>
	<? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='다음검색'></a>"; } ?>
</div>


<script>
$(function () {
	var view_content_scroll = false;
		$('.board_list a').on('click', function () {
			$('#view_content').load( this.href + ' #view-content', function () {
				if (view_content_scroll) $('html,body').animate({'scrollTop': $('#view_content').offset().top});
				if (!view_content_scroll) view_content_scroll = true;
			});
			return false;
		});
		<?php 
		if ($_GET['view_wr_id']) { 
			$link = "/bbs/board.php?bo_table={$bo_table}&wr_id={$_GET['view_wr_id']}";
		?>
		$('#view_content').load( "<?=$link?>" + ' #view-content', function () {
			if (view_content_scroll) $('html,body').animate({'scrollTop': $('#view_content').offset().top});
			if (!view_content_scroll) view_content_scroll = true;
		});
		
		<?php } else { ?>
		$('.board_list a').eq(0).trigger('click');
		<?php } ?>
});
</script>