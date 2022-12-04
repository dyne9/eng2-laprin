<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$mod = $board[bo_gallery_cols] = 2;

$write_pages = get_paging_mobile(5, $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>



<table class="board_list">
<colgroup>
<col width="15%">
<col width="">
<col width="20%">
</colgroup>
<thead>
<tr>
	<th>번호<em></em></th>
	<th>제목<em></em></th>
	<th>작성자</th>
</tr>
</thead>
<tbody>
<?
for ($i=0; $i<count($list); $i++) { 
	$class = '';
	if ($list[$i]['wr_good'] == '99999999')
		$class = 'best';

	if ($list[$i]['wr_comment'] > 0) $reply = "<span class=\"ico\"><em style=\"width:50px\">완료</em></span>";
	else $reply = "<span class=\"ico gray\"><em style=\"width:50px\">답변중</em></span>";
	/*
	$reply_cnt = strlen($list[$i]['wr_reply']);
	if ($reply_cnt > 0) {
		$reply = "&nbsp;";
	} else {
	    $sql = " select count(*) as cn from $write_table where wr_is_comment = '0' and wr_num = '".$list[$i]['wr_num']."' and mb_id = 'admin'";
		$row = sql_fetch($sql);
		$reply_cnt = $row[cn];
		if ($reply_cnt >= 1) {
			$reply = "<span class=\"ico\"><em style=\"width:50px\">완료</em></span>";
		}
		else {
			$reply = "<span class=\"ico gray\"><em style=\"width:50px\">답변중</em></span>";
		}
	}
	*/

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
	<td class="subject">
		<? 
		$title = get_text($list[$i]['wr_subject']);
		echo "<a href='{$list[$i]['href']}' class='{$tmpClass}' secret_href='{$list[$i]['secret_href']}'>";
		echo $list[$i][reply];
		echo " " . $list[$i]['icon_secret']. " ";
		if ($list[$i]['icon_reply']) {
			echo "<img src='{$board_skin_path}/img/icon_reply.gif'>";
			echo " <span style='background:#ff5193;display:inline-block;padding:3px 5px;color:#fff;font-size:.9em'>답변</span>";
		}
		echo " " . $list[$i]['subject'] . " ";
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