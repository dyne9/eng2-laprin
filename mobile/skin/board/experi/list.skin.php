<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$thumb_width = '197'; //썸네일 가로길이
$thumb_height = '137'; //썸네일 세로길이
$arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<?php if ($board['bo_use_category']) { ?>
<form name="sca_form" method="get">
	<input type="hidden" name="bo_table" value="<?=$bo_table?>">
	<select name="sca" class="w100" onchange="this.form.submit()">
	<option value="">========================</option>
	<?php
	for($i=0; $i<count($arr); $i++) {
		echo "<option value=\"{$arr[$i]}\"".($sca == $arr[$i] ? ' selected': '').">{$arr[$i]}</option>";
	}
	?>
	</select>	
</form>
<?php } ?>

<div id="best-owl-carousel">
	<div class="owl-carousel">
<?php
# BEST 게시물을 가져온다
$rs = sql_query("select * from {$write_table} where wr_is_comment = 0 and wr_good = '99999999' order by wr_good desc ");
while ($row = sql_fetch_array($rs)) {
	$row = get_list($row, $board, $board_skin_path, $board['bo_subject_len']);
	$no_thumb     = $board_skin_path."/img/no-thumbnail.png";
	$thumb1 = $thumb2 = '';
	$file1 = $row['file'][0]['path'] .'/'. $row['file'][0]['file'];
	if ($row['file'][0]['file'] && file_exists($file1) && preg_match("/\.(jpeg|jpg|gif|png)$/i", $file1)) {
		$thumb1 = $file1;
	}
	else {
		$edit_img = $row['wr_content'];
		$edit_img = preg_replace('/alt="(.*?)"/i', '', $edit_img);
		if (preg_match("/data\/(?:cheditor4|se)[^<>]*\.(gif|jp[e]?g|png|bmp)/i", $edit_img, $tmp)) {  // data/cheditor------
			$thumb1 = '../' . $tmp[0]; // 파일명
		}
	}
	echo "<div class=\"item\"><a href=\"{$row['href']}\"><img src=\"{$thumb1}\"><p>{$row['subject']}</p></a></div>";
}
?>
	</div>
</div>

<table class="board_list">
<colgroup>
<col width="15%">
<col width="20%">
<col width="20%">
<col width="">
</colgroup>
<thead>
<tr>
	<th>No<em></em></th>
	<th>Category<em></em></th>
	<th colspan="2">Subject</th>
</tr>
</thead>
<tbody>
<?
for ($i=0; $i<count($list); $i++) { 
	$class = '';
	if ($list[$i]['wr_good'] == '99999999')
		$class = 'best';
?>
<tr>
	<td class="num">
		<?
		if ($list[$i]['is_notice']) 
			echo '<span style="color:#0000ff">공지</span>';
		else if ($list[$i]['wr_good'] == '99999999')
			echo "<span class=\"best\">BEST</span>";
		else 
			echo $list[$i][num];
		?>
	</td>
	<td><?=$list[$i]['ca_name']?></td>
	<td>
		<?php
	$no_thumb     = $board_skin_path."/img/no-thumbnail.png";
	$thumb1 = $thumb2 = '';
	$file1 = $list[$i]['file'][0]['path'] .'/'. $list[$i]['file'][0]['file'];
	
    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $thumb_width, $thumb_height);

    if($thumb['src']) {
        $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$thumb_width.'" height="'.$thumb_height.'">';
    } else {
        $img_content = $no_thumb;
    }
		?>
		<a href="<?=$list[$i]['href']?>"><img src="<?=$thumb['src']?>" class="thumb" alt="" /></a>
	</td>
	<td>
		<a href="<?=$list[$i]['href']?>"><?=$list[$i]['subject']?></a>
	</td>
</tr>
<? } ?>
</tbody>
</table>





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
(function ($) {
	$(function () {
		$('#best-owl-carousel .owl-carousel').owlCarousel({
			stagePadding: 0,
			items:1.5,
			loop:true,
			margin:10,
			nav:true,
			dots:false,
			autoplay:true,
			center:true,
			autoplayTimeout:4000//,		dotsContainer: '.dotsCont'
		});
	});
})(jQuery);
</script>