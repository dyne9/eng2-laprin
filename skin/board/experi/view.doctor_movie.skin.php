<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
if ($search_href) $list_href = $search_href;

#$tmp = unserialize(urldecode($view['wr_content'])); $write = array_merge($view, $tmp);
?>

<table class="board_view">
<colgroup>
<col width="150px" />
<col width="" />
<col width="150px" />
<col width="200px" />
<col width="150px" />
<col width="200px" />
</colgroup>
<?php if ($view['ca_name']) { ?>
<tr>
	<th>분류</th>
	<td colspan="5"><?=$view['ca_name']?></td>	
</tr>
<?php } ?>
<tr>
	<th>제목</th>
	<td colspan="5"><?=cut_hangul_last(get_text($view['wr_subject']))?></td>
</tr>
<?php if ($bo_table == 'experi') { ?>
<tr>
	<th>환자명</th>
	<td><?=$view['wr_name']?></td>
	<th>나이</th>
	<td><?=$view['wr_5']?>세</td>
	<th>수술일자</th>
	<td><?=$view['wr_6']?></td>
</tr>
<?php } ?>
<?php if ($bo_table == 'event') { ?>
<tr>
	<th>이벤트기간</th>
	<td><?=$view['wr_5']?></td>
	<th>이벤트진행여부</th>
	<td><?=$view['wr_6'] == '1' ? '진행중' : '종료'?></td>
</tr>
<?php } ?>
<?
// 가변 파일
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) {
    if ($view[file][$i][source] && !$view[file][$i][view]) {
        $cnt++;
        echo "<tr><th>첨부파일</th><td colspan='4'>";
        echo "&nbsp;&nbsp;<img src='{$basic_skin_path}/img/icon_file.gif' align=absmiddle border='0'>";
        echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '".urlencode($view[file][$i][source])."');\" title='{$view[file][$i][content]}'>";
        echo "&nbsp;<span style=\"color:#888;\">{$view[file][$i][source]} ({$view[file][$i][size]})</span>";
        echo "&nbsp;<span style=\"color:#ff6600; font-size:11px;\">[{$view[file][$i][download]}]</span>";
        #echo "&nbsp;<span style=\"color:#d3d3d3; font-size:11px;\">DATE : {$view[file][$i][datetime]}</span>";
        echo "</a></td></tr>";
    }
}
?>
<tr>
	<td colspan="4" class="viewContentTD">
        <?php
        // 파일 출력
		$i = 0;
		if (in_array($bo_table, array('media', 'column', 'story', 'photo', 'praise', 'experi', 'doctor_movie'))) 
			$i = 1;
        for (;$i<=count($view[file]); $i++) {
            if ($view[file][$i][view]) 
                echo "<p class='tCenter'>". $view[file][$i][view] . "</p>";
        }

		$youtube = '';
		if ($view['wr_link1']) {
			#$youtube = '<embed width="100%" height="600" src="'.$view['wr_link1'].'&amp;autoplay=1&amp;loop=1" frameborder="0" allowfullscreen=""></embed>';
			#<iframe width="560" height="315" src="https://www.youtube.com/embed/juOFho9xrUU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			$youtube = '<iframe width="100%" height="600" src="'.$view['wr_link1'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}

        ?>

        <!-- 내용 출력 -->
        <span id="writeContents"><?=$youtube?><?=$view['content'];?></span>
        
        <?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
        <!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>
	</td>
</tr>
</table>

<?
// 코멘트 입출력
include_once("./view_comment.php");
?>




<div class="board_button">
	<div class="fLeft">
	    <? echo "<a href=\"$list_href\" class=\"black \">목 록</a> "; ?>
	    <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\" class='gray'>이 전</a> "; } ?>
	    <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\" class='gray'>다 음</a> "; } ?>
	</div>
	<div class="fRight">
		<? if ($update_href) echo "<a href=\"$update_href\" class=\"gray \">수 정</a> "; ?>
		<? if ($delete_href) echo "<a href=\"$delete_href\" class=\"gray \">삭 제</a> "; ?>
		<? if ($write_href) echo "<a href=\"$write_href\" class=\"orange \">글쓰기</a> "; ?>
	</div>
</div>




<script type="text/javascript">
function file_download(link, file) {
    <? if ($board[bo_download_point] < 0) { ?>if (confirm("'"+decodeURIComponent(file)+"' 파일을 다운로드 하시면 포인트가 차감(<?=number_format($board[bo_download_point])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))<?}?>
    document.location.href=link;
}
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript">
window.onload=function() {
    resizeBoardImage(<?=(int)$board[bo_image_width]?>);
	//drawFont();
}
</script>
<!-- 게시글 보기 끝 -->
