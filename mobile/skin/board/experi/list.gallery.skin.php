<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
include_once("$g4[path]/lib/thumb.lib.php");
$thumb_width = '297'; //썸네일 가로길이
$thumb_height = '150'; //썸네일 세로길이
$thumb_quality = '100'; // 썸네일 퀄리티
$filter[type] = 99;
$filter[arg1] = 100;
$filter[arg2] = 1;
$filter[arg3] = 2;

$write_pages = get_paging_mobile(5, $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");
?>

<?php if ($bo_table == 'patient_improve') { ?>
	<div><img src="<?=$board_skin_path?>/img/patient_improve.png" class="w100"/></div>
<?php } ?>
<!--
<div style="background:#f7f6f5;padding:10px 0;text-align:center; margin-bottom:20px;">
	<form name="fcategory" method="get" style="margin:0px;">
	진료과목
	<select name=sca onchange="location='<?=$category_location?>'+<?=strtolower($g4[charset])=='utf-8' ? "encodeURIComponent(this.value)" : "this.value"?>;">
	<option value=''>전체</option>
	<?= get_category_option($bo_table) ?>
	</select>
	</form>
</div>-->
<ul class="board_list board_list_<?=$bo_table?>">
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

	$no_thumb     = "/skin/board/gallery/img/no-thumbnail.png";
	if ($bo_table == 'experi' || $bo_table == 'praise') 
		$no_thumb     = "/img/menu/thumb_1.jpg";
	$thumb1 = $thumb2 = '';
	$file1 = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
	if ($list[$i][file][0][file] && preg_match("/\.(jpeg|jpg|gif|png)$/i", $file1) && file_exists($file1)) {
		$thumb1 = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
		$thumb1 = thumbnail($thumb1, $thumb_width, $thumb_height, 0, 0, $thumb_quality, 0, "",  $filter, $noimg); // 0 그대로 2 확대
	}
	else {
		$edit_img = $list[$i]['wr_content'];
		$edit_img = preg_replace('/alt="(.*?)"/i', '', $edit_img);
		if (preg_match("/data\/(?:cheditor4|se)[^<>]*\.(gif|jp[e]?g|png|bmp)/i", $edit_img, $tmp)) {  // data/cheditor------
			$thumb1 = '../' . $tmp[0]; // 파일명
			$thumb1 = thumbnail($file, $thumb_width, $thumb_height, 0, 0, $thumb_quality, 0, "",  $filter, $noimg); // 0 그대로 2 확대
		}
		else {
			$thumb1 = $no_thumb;
		}
	}
		
	$subject  = '';
	$subject .= $list[$i]['icon_secret']. " ";
	$subject .= "{$list[$i][subject]}";
	$subject .= " " . $list[$i][icon_new];
	$subject = "<a href='{$list[$i][href]}'>{$subject}</a>";
	
	if ($list[$i]['ca_name'])
		$ca_name = "[{$list[$i]['ca_name']}] ";
	else
		$ca_name = '';
	$wr_name = $list[$i]['wr_name'];
	$wr_date = $list[$i]['datetime'];
	$wr_hit = $list[$i]['wr_hit'];

	$short_desc = cut_str(conv_content(strip_tags($list[$i]['wr_content']), 'html2'), 200);
	$short_desc = str_replace('&nbsp;', ' ', $short_desc);

	echo "<li>
	<a href='{$list[$i]['href']}'>
		<img src='{$thumb1}' class='thumb'>
		<p class='subject ellipsis'>{$ca_name}{$list[$i]['subject']}</p>
		<p class='short_desc'>{$short_desc}</p>
		<div class=\"arrow\">
			<i class=\"arrow-left\"></i>
			<i class=\"ico\">+</i>
		</div>
	</a>
	</li>";
	
	
	/*echo "<li> //수정전
	<a href='{$thumb1}' title='{$list[$i]['wr_name']}님 아기<br>출산일 {$list[$i]['wr_subject']}'>
		<img src='{$thumb1}' class='thumb'>
		<p class='subject ellipsis'>{$list[$i]['wr_name']}님 <span style='font-size:.9em'>아기</span></p>
		<p class='desc'>출산일 {$list[$i]['wr_subject']}</p>
	</a>
	</li>";*/
}
if ($i == 0) { echo "<li class='empty'>등록된 내역이 없습니다.</li>"; }
?>
</ul>


<div class="clr"></div>

<div class="board_button" style="text-align: right">
	<? if ($write_href) echo "<div><a href=\"$write_href\" class=\"orange\">글쓰기</a></div> "; ?>
</div>

<!-- 페이지 -->
<div class="board_page">
	<? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='이전검색'></a>"; } ?>
	<?=$write_pages?>
	<? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='다음검색'></a>"; } ?>
</div>


<script type="text/javascript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
try {
	if ('<?=$stx?>') {
	    document.fsearch.sfl.value = '<?=$sfl?>';
	}
} catch (e) { }
(function ($) {
	$(function () {
		$('.board_tbl tbody tr').hover(function () {
			$(this).addClass('on');
		}, function () {
			$(this).removeClass('on');
		});
		var obj = $('.board_category li:first-child a');
		if (obj.length > 0) {
			obj.addClass('onPrev');
		}
		$('.board_list tr:last-child').addClass('end');
	});
	/*
	$('.board_list').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
	*/
})(jQuery);
</script>

<!-- 게시판 목록 끝 -->
