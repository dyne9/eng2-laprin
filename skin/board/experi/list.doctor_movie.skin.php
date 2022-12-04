<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>


<table class="board_list">
<colgroup>
<col width="80" />
<col width="260" />
<col width="" />
<col width="103" />
</colgroup>
<thead>
<tr>
	<th scope="col"><span>번호<em></em></span></th>
	<th scope="col" colspan="2"><span>제목<em></em></span></th>
	<th scope="col"><span>조회수</span></th>
</tr>
</thead>
<tbody>
<?
for ($i=0; $i<count($list); $i++) 
{
	if ($list[$i][is_notice]) // 공지사항 
		$num = "";
	else if ($wr_id == $list[$i][wr_id]) // 현재위치
		$num = "<span class='current'>{$list[$i][num]}</span>";
	else if ($list[$i]['wr_good'] == '99999999')
		$num = "<span class=\"best\">BEST</span>";
	else
		$num = $list[$i][num];

	#if ($list[$i]['wr_datetime'] <= '2016-09-12 09:00:00')
	#	$list[$i]['ca_name'] = '';

	//$wr_name = cut_str($list[$i]['wr_name'], 16, '');
	//$wr_name = $list[$i]['name'];
	$wr_name = get_text(cut_str($list[$i]['wr_name'], $config['cf_cut_name'])); // 설정된 자리수 만큼만 이름 출력
	$wr_date = $list[$i]['datetime'];
	$wr_hit = $list[$i]['wr_hit'];
	
	if ($list[$i]['wr_comment'] > 0) $reply = "<span class=\"ico\"><em style=\"width:50px\">완료</em></span>";
	else $reply = "<span class=\"ico gray\"><em style=\"width:50px\">답변중</em></span>";

	$wr_name = get_text(cut_str($list[$i]['wr_name'], $config['cf_cut_name'])); // 설정된 자리수 만큼만 이름 출력
	#$wr_name =  preg_replace('/.(?!..)/u','○', $wr_name);
	//$list[$i]['subject'] = "{$wr_name}님의 상담입니다.";

	$short_desc = cut_str(conv_content(strip_tags($list[$i]['wr_content']), 'html2'), 300);
	$short_desc = str_replace('&nbsp;', ' ', $short_desc);
?>
<tr>
	<td><?= $num ?></td>
	<td>
		<a href="<?=$list[$i]['href']?>"><img src="<?=$list[$i]['file'][0]['path'].'/'.$list[$i]['file'][0]['file']?>" alt=""></a>
	</td>
	<td class="subject">
		<?
		$tmpClass = '';
		if ($list[$i]['secret'] == '1')
			$tmpClass = 'secret';
		#echo $nobr_begin;
		echo "<a href='{$list[$i]['href']}' class='{$tmpClass}' secret_href='{$list[$i]['secret_href']}'>";
        echo $list[$i][reply];
		echo $list[$i]['icon_secret']. " ";
		echo "<span style='font-size:1.2em'> " . $list[$i]['subject'] . "</span> ";
		echo $list[$i]['icon_new'];
		echo "<p>".$short_desc."</p>";
		echo "</a>";
		?>
	</td>
	<td><?= $list[$i]['wr_hit'] ?></td>
</tr>
<?
}
if ($i == 0) { echo "<tr><td colspan=\"6\" class=\"empty\">등록된 내역이 없습니다.</td></tr>"; }
?>
</tbody>
</table>

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
		var obj = $('.board_category li:first-child a');
		if (obj.length > 0) {
			obj.addClass('onPrev');
		}
		$('.board_list tr:last-child').addClass('end');

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
	});
})(jQuery);
</script>


<!-- 게시판 목록 끝 -->
