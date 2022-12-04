<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
$thumb_width = '286'; //썸네일 가로길이
$thumb_height = '177'; //썸네일 세로길이
?>


<div id="view_content"></div>

<?php 
if ($board['bo_use_category']) { 
	$arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음
?>
<ul class="board_category board_category_<?=count($arr)+1?>">
	<li><a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=<?=$bo_table?>" class="<?=$_GET['sca'] == '' ? 'on' : ''?>">전체<em></em><i></i></a></li>
	<?
    $str = "";
    	for ($i=0; $i<count($arr); $i++) {
	    if (trim($arr[$i])) {
			$checked = '';
			if ($arr[$i] == urldecode($_GET['sca'])) $checked = 'on';
			echo "<li><a href='?bo_table={$bo_table}&sca=".urlencode($arr[$i])."' class='{$checked}'>{$arr[$i]}<em></em><i></i></a></li>";
		}
	}
	?>
</ul>
<?php } ?>


<?php if ($bo_table == 'patient_improve') { ?>
<div><img src="/skin/board/gallery/img/patient_improve.jpg" /></div>
<?php } ?>


<ul class="board_list">	
<?php
for ($i=0; $i<count($list); $i++) 
{
	if ($list[$i][is_notice]) // 공지사항 
		$num = "<span class='ico ico-notice'><em style='width:49px'>NOTICE</em></span>";
	else if ($wr_id == $list[$i][wr_id]) // 현재위치
		$num = "<span class='current'>{$list[$i][num]}</span>";
	else if ($list[$i]['wr_good'] >= 100)
		$num = "<img src=\"{$basic_skin_path}/img/icon_best.gif\" alt=\"\">";
	else
		$num = $list[$i][num];

	$no_thumb     = $board_skin_path."/img/no-thumbnail.png";
    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

    if($thumb['src']) {
        $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'"  class="thumb">';
    } else {
        $img_content = $no_thumb;
    }
		
	$subject  = '';
	$subject .= $list[$i]['icon_secret']. " ";
	$subject .= "{$list[$i][subject]}";
	// $subject .= " " . $list[$i][icon_new];
	$subject = "<a href='{$list[$i][href]}'>{$subject}</a>";
	
	$ca_name = $list[$i]['ca_name'];
	$wr_name = $list[$i]['wr_name'];
	$wr_date = $list[$i]['datetime'];
	$wr_hit = $list[$i]['wr_hit'];
	echo "<li>
	<a href=\"{$list[$i]['href']}\">
		".$img_content."
		<p class=\"ca_name\">{$list[$i]['ca_name']}</p>
		<p class='subject ellipsis'>{$list[$i]['subject']} </p>
	</a>
	</li>";
}
if ($i == 0) { echo "<li class='empty'>등록된 내역이 없습니다.</li>"; }
?>
</ul>


<div class="board_button" style="text-align: right">
	&nbsp;
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
	<select name="sfl">
		<option value="wr_subject">제목</option>
		<option value="wr_content">내용</option>
		<option value="wr_subject||wr_content">제목+내용</option>
		<option value="mb_id,1">회원아이디</option>
		<option value="wr_name,1">글쓴이</option>
	</select>
	<input name="stx" class="ed" maxlength="15" itemname="검색어" required value='<?=stripslashes($stx)?>'>
	<span class="button black"><button>검색</button></span>
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
		var obj = $('.board_category li:first-child a');
		if (obj.length > 0) {
			obj.addClass('onPrev');
		}

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
})(jQuery);
</script>

<!-- 게시판 목록 끝 -->
