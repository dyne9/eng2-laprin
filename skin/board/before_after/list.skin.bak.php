<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
include_once("$g4[path]/lib/thumb.lib.php");
$thumb_width = '300'; //썸네일 가로길이
$thumb_height = '240'; //썸네일 세로길이
$thumb_quality = '100'; // 썸네일 퀄리티
$filter[type] = 99;
$filter[arg1] = 100;
$filter[arg2] = 1;
$filter[arg3] = 2;
?>

<?php 
if ($board['bo_use_category']) { 
	$arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음
?>
<ul class="board_category board_category_<?=count($arr)+1?>">
	<li><a href="board.php?bo_table=<?=$bo_table?>" class="<?=$_GET['sca'] == '' ? 'on' : ''?>">전체<em></em><i></i></a></li>
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


<div class="text-center" style="margin:70px 0 40px"><img src="<?=$board_skin_path?>/img/before_after2.png" alt="" /></div>

<div class="board_list owl-carousel">
<?php
$thumb_list = '';
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

	$no_thumb     = $board_skin_path."/img/no-thumbnail.jpg";
	$no_thumb     = "/img/menu/logo.png";
	$thumb1 = $thumb2 = '';
	$thumb1 = $file1 = $list[$i]['file'][0]['path'] .'/'. $list[$i]['file'][0]['file'];
	if ($board['bo_read_level'] > $member['mb_level']) ;
	/*
	if (!$list[$i][file][0][file] || !file_exists($file1))
		$thumb1 = $file1 = $no_thumb;
	else {
		// 업로드된 파일이 이미지라면
		if (preg_match("/\.(jpeg|jpg|gif|png)$/i", $file1) && file_exists($file1)) {
			$thumb1 = $file1;
			// $thumb1 = thumbnail($file1, $thumb_width, $thumb_height, 0, 1, $thumb_quality, 0, "",  $filter, $noimg); // 0 그대로 2 확대
		}
	}

	$file1 = $list[$i][file][1][path] .'/'. $list[$i][file][1][file];
	if (!$list[$i][file][1][file] || !file_exists($file1))
		$thumb1 = $file1 = $no_thumb;
	else {
		// 업로드된 파일이 이미지라면
		if (preg_match("/\.(jpeg|jpg|gif|png)$/i", $file1) && file_exists($file1))
			$thumb2 = thumbnail($file1, $thumb_width, $thumb_height, 0, 1, $thumb_quality, 0, "",  $filter, $noimg); // 0 그대로 2 확대
	}
	*/

	$short_desc = cut_str(conv_content(strip_tags($list[$i]['wr_content']), 'html2'), 300);
	$short_desc = str_replace('&nbsp;', ' ', $short_desc);

	if ($is_member) {
		$thumb_list.= "<div class=\"item\" data-index=\"{$i}\">
			<img src=\"{$thumb1}\">
			<p>{$list[$i]['subject']}</p>
		</div>";
		echo "<div class=\"item\" data-index=\"{$i}\">
			<img src=\"{$thumb1}\">
			<p>{$list[$i]['subject']}</p>
		</div>";
	}
	else {
		$thumb1 = "{$board_skin_path}/img/no-login.png";
		$thumb_list.= "<div class=\"item\" data-index=\"{$i}\">
			<a href=\"/bbs/login.php?url=".urlencode("/bbs/board.php?bo_table={$bo_table}")."\">
			<img src=\"{$thumb1}\">
			<p>{$list[$i]['subject']}</p>
			</a>
		</div>";
		echo "<div class=\"item\" data-index=\"{$i}\">
			<a href=\"/bbs/login.php?url=".urlencode("/bbs/board.php?bo_table={$bo_table}")."\">
			<img src=\"{$thumb1}\">
			<p>{$list[$i]['subject']}</p>
			</a>
		</div>";
	}

	//if ( ($i+1) % 2 == 0) echo "<li class='line'></li>";
}
if ($i == 0) { echo "<div class='empty'>등록된 내역이 없습니다.</div>"; }
?>
</div>

<div class="board_list_thumb owl-carousel">
	<?php
	echo $thumb_list;
	?>
</div>


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
	<button type="submit"">검색</button>
	<input type="hidden" name="sop" value="and">
	</form>
</div>


<script type="text/javascript">
//if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';
}
var owl1, owl2;
(function ($) {
	$(function () {
		var obj = $('.board_category li:first-child a');
		if (obj.length > 0) {
			obj.addClass('onPrev');
		}

		owl1 = $('.board-wrap .board_list').owlCarousel({
			stagePadding: 0,
			items:1,
			loop:false,
			margin:0,
			nav:true,
			dots:false,
			autoplay:true,
			autoplayTimeout:4000//,		dotsContainer: '.dotsCont'
		});
		owl2 = $('.board-wrap .board_list_thumb').owlCarousel({
			stagePadding: 0,
			items:4,
			loop:false,
			margin:50,
			nav:false,
			dots:false,
			autoplay:false,
			autoplayTimeout:4000//,		dotsContainer: '.dotsCont'
		});
		owl1.on('translated.owl.carousel', function(event) {
            owl2.trigger('to.owl.carousel', [owl1.find('.active .item').data('index'),300,true]);
			owl2.find('.item').removeClass('current');
			owl2.find('.item[data-index="' + owl1.find('.active .item').data('index') + '"]').addClass('current');
        });
		owl2.find('.active:eq(0) .item').addClass('current');

		owl2.on('click', '.owl-item', function (e) {
			e.preventDefault();
			var number = $(this).index();
			owl1.trigger('to.owl.carousel', [number,300,true]);
		});
	});
})(jQuery);
</script>
<!-- 게시판 목록 끝 -->
