<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음
?>
<div class="tab-title clearfix">
	<ul>
		<li class="<?=$_GET['sca']==''?'active':''?>"><a href="?bo_table=<?=$bo_table?>">All</a></li>
		<?php
		for ($i=0; $i<count($arr); $i++) {
			$checked = '';
			if ($arr[$i] == $_GET['sca']) $checked = 'active';
			echo "<li class='{$checked}'><a href='?bo_table={$bo_table}&sca={$arr[$i]}'>{$arr[$i]}</a></li>";
		}
		?>
	</ul>
</div>



<div class="table-box fadeInTop">
<table>
<colgroup>
<col width="99">
<col width="150">
<col width="*">
<col width="120">
<col width="100">
<col width="113">
</colgroup>
<thead>
<tr>
	<th scope="col"><span>Number</span></th>
	<th scope="col"><span>Category</span></th>
	<th scope="col"><span>Title</span></th>
	<th scope="col"><span>Answer</span></th>
	<th scope="col"><span>Writer</span></th>
	<th scope="col"><span>Date</span></th>
</tr>
</thead>
<tbody>
<?php
for ($i=0; $i<count($list); $i++) 
{
	if ($list[$i][is_notice]) // 공지사항 
		$num = "";
	else if ($wr_id == $list[$i][wr_id]) // 현재위치
		$num = "<span class='current'>{$list[$i][num]}</span>";
	else
		$num = $list[$i][num];

	#if ($list[$i]['wr_datetime'] <= '2016-09-12 09:00:00')
	#	$list[$i]['ca_name'] = '';

	//$wr_name = cut_str($list[$i]['wr_name'], 16, '');
	//$wr_name = $list[$i]['name'];
	$wr_name = get_text(cut_str($list[$i]['wr_name'], $config['cf_cut_name'])); // 설정된 자리수 만큼만 이름 출력
	$wr_date = $list[$i]['datetime'];
	$wr_hit = $list[$i]['wr_hit'];
	
	if ($list[$i]['wr_comment'] > 0) $reply = '<span class="label complete">COMPLETE</span>';
	else $reply = '<span class="label ing">ING</span>';

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
	/*
	$list[$i]['subject'] = "{$wr_name}님의 상담입니다.";
	if ($list[$i]['wr_reply'])
		$list[$i]['subject'] = "{$wr_name}님의 답변입니다.";
	*/

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
<tr>
	<td><?=$num?></td>
	<td><?=$list[$i]['ca_name']?></td>
	<td class="title">
	    <a href="<?=$list[$i]['href']?>">
	        <span class="text">
	<?=$list[$i]['subject']?>
	        </span>
	    </a>
	</td>
	<td><?=$reply?></td>
	<td><?=$list[$i]['wr_name']?></td>
	<td><?=$list[$i]['datetime']?></td>
</tr>
<?
}
if ($i == 0) { echo "<tr><td colspan=\"6\" class=\"empty\">NO DATA</td></tr>"; }
?>
</tbody>
</table>

	<div class="btn-box">
		<? if ($write_href) echo "<a href=\"{$write_href}\" class=\"write-btn\">Write</a>"; ?>
		<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
	</div>
</div>

<!-- 페이지 -->
<div class="paging-box">
	<?=$write_pages?>
</div>

<!-- 검색 -->
<div class="search-box">
	<form name="fsearch" method="get">
		<input type="hidden" name="bo_table" value="<?=$bo_table?>">
		<input type="hidden" name="sca" value="<?=$sca?>">
		<select name="sfl" class="srh-kind">
			<option value="wr_subject">SUBJECT</option>
			<option value="wr_content">CONTENT</option>
			<option value="wr_subject||wr_content">SUBJECT+CONTENT</option>
			<option value="mb_id,1">MEMBER ID</option>
			<option value="wr_name,1">WRITER</option>
		</select>
		<input type="text" name="stx" maxlength="15" class="srh-key" placeholder="Keyword" required>
		<button type="submit" class="srh-btn">Search</button>
		<input type="hidden" name="sop" value="and">
	</form>
</div>


<script type="text/javascript">
//if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';
}
</script>


<!-- 게시판 목록 끝 -->
