<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
include_once("$g4[path]/lib/thumb.lib.php");
$thumb_width = '297'; //썸네일 가로길이
$thumb_height = '236'; //썸네일 세로길이
$thumb_quality = '100'; // 썸네일 퀄리티
$filter[type] = 99;
$filter[arg1] = 100;
$filter[arg2] = 1;
$filter[arg3] = 2;


$write_pages = get_paging_mobile(5, $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>


<table class="board_list">
<colgroup>
<col width="15%">
<col width="20%">
<col width="">
<col width="20%">
</colgroup>
<thead>
<tr>
	<th>번호<em></em></th>
	<th colspan="2">제목<em></em></th>
	<th>작성자</th>
</tr>
</thead>
<tbody>
<?
for ($i=0; $i<count($list); $i++) { 
	$class = '';
	if ($list[$i]['wr_good'] == '99999999')
		$class = 'best';
?>
<tr class="<?=$class?>">
	<td class="num">
		<?
		if ($list[$i]['is_notice']) 
			echo '<span style="color:#0000ff">공지</span>';
		else if ($list[$i]['wr_good'] == '99999999')
			echo "<img src='{$board_skin_path}/img/icon_best.gif'>";
		else 
			echo $list[$i][num];
		?>
	</td>
	<td>
		<?php
		$no_thumb     = "/skin/board/gallery/img/no-thumbnail.png";
		$thumb1 = $thumb2 = '';
		$file1 = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
		if (!$list[$i][file][0][file] || !file_exists($file1))
			$thumb1 = $file1 = $no_thumb;
		else {
			// 업로드된 파일이 이미지라면
			if (preg_match("/\.(jpeg|jpg|gif|png)$/i", $file1) && file_exists($file1))
				$thumb1 = thumbnail($file1, $thumb_width, $thumb_height, 0, 1, $thumb_quality, 0, "",  $filter, $noimg); // 0 그대로 2 확대
		}
		echo "<img src='{$thumb1}' class='thumb'>";
		?>
	</td>
	<td class="subject">
		<? 
		$title = get_text($list[$i]['wr_subject']);
		echo "<a href='{$list[$i]['href']}' class='{$tmpClass}' secret_href='{$list[$i]['secret_href']}'>";
		echo $list[$i]['subject'] . " ";
		echo "</a>";
		?>
	</td>
	<td class="name"><? echo $list[$i]['name'] ?></td>
</tr>
<? } ?>
</tbody>
</table>


<!-- 페이지 -->

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


<script type="text/javascript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
try {
	if ('<?=$stx?>') {
	    document.fsearch.sfl.value = '<?=$sfl?>';
	}
} catch (e) { }
</script>