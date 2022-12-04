<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$mod = $board[bo_gallery_cols] = 2;

$write_pages = get_paging_mobile(5, $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
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


<form name="fboardlist" method="post">
<input type='hidden' name='bo_table' value='<?=$bo_table?>'>
<input type='hidden' name='sfl'  value='<?=$sfl?>'>
<input type='hidden' name='stx'  value='<?=$stx?>'>
<input type='hidden' name='spt'  value='<?=$spt?>'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='sw'   value=''>

<table class="board_list">
<colgroup>
<col width="20%">
<col width="">
<col width="20%">
</colgroup>
<thead>
<tr>
	<th>Number<em></em></th>
	<th>Subject<em></em></th>
	<th>작성자</th>
</tr>
</thead>
<tbody>
<?
for ($i=0; $i<count($list); $i++) { 
	$class = '';
	if ($list[$i]['wr_good'] == '99999999')
		$class = 'best';

	#if ($list[$i]['wr_comment'] > 0) $reply = "<span class=\"ico\"><em style=\"width:50px\">완료</em></span>";
	#else $reply = "<span class=\"ico gray\"><em style=\"width:50px\">답변중</em></span>";

	$wr_name = get_text(cut_str($list[$i]['wr_name'], $config['cf_cut_name'])); // 설정된 자리수 만큼만 이름 출력
	if ( ($list[$i]['mb_id'] && $list[$i]['mb_id'] == $member['mb_id']) || $list[$i]['mb_id'] == 'admin') {
	}
	else {
		if (strlen($wr_name) <= 1) 
			;
		else {
			$tmp = mb_strlen($wr_name, 'utf-8');
			$tmp2 = '';
			for ($j=1; $j<$tmp; $j++) $tmp2 .= ".";
			$wr_name =  preg_replace('/.(?!'.$tmp2.')/u','○', $wr_name);
		}
	}
	#$list[$i]['subject'] = "{$wr_name}님의 상담입니다.";
	
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
			echo "<img src='/skin/board/counsel/img/icon_reply.png'>";
			echo " <span style='background:#2a3ea7;display:inline-block;padding:3px 5px;color:#fff;font-size:.9em'>답변</span>";
		}
		echo " " . $list[$i]['subject'] . " ";
		echo "</a>";
		?>
	</td>
	<td class="name"><? echo $wr_name ?></td>
</tr>
<? } ?>
</tbody>
</table>


<!-- 페이지 -->

<div class="">
	<div class="board_button text-right">
			<? if ($write_href) { ?>
			<a href="<?=$write_href?>" class="orange">Write</a>
			<? } ?>
	</div>
</div>
<div class="board_page">
	<? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='이전검색'></a>"; } ?>
	<?=$write_pages?>
	<? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='다음검색'></a>"; } ?>
</div>


<script type="text/javascript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';

</script>