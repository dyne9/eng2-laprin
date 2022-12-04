<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 모바일은 view['content'] 의 pre, xmp 태그를 div 로 변환
$view['content'] = str_replace(array('<pre', '</pre>', '<xmp', '</xmp'), array('<div', '</div', '<div', '</div'), $view['content']);

// 동영상태그 넣어줌
$view[content] = '<div style="text-align:center">'. $view['wr_5'] . '</div>'. $view['content'];

$copy_href = $move_href = $search_href = $reply_href = false;

$board['bo_image_width'] = 616;

$wr_name = $view['wr_name'];
if ($view['mb_id'] == $member['mb_id'] || $view['mb_id'] == 'admin' || $view['mb_id'] == 'yesonhospital')
	;
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
?>
<table class="board_view">
<colgroup>
<col width="20%" />
<col width="" />
<col width="20%" />
<col width="30%" />
</colgroup>
<?php if ($view['ca_name']) { ?>
<tr>
	<th>Category</th>
	<td colspan="5"><?= $view['ca_name'] ?></td>
</tr>
<?php } ?>
<tr>
	<th>Subject</th>
	<td colspan="3">
		<div style="">
			<p style="margin:0;padding:0;padding-right: 25px">
				<?=cut_hangul_last(get_text($view[wr_subject]))?>
			</p>
		</div>
	</td>
</tr>
<tr>
	<th>Writer</th>
	<td><?=$wr_name?></td>
	<th>Date</th>
	<td><?=$view['datetime']?></td>
</tr>
<tr>
	<td colspan="4" style="word-break:break-all; padding:10px; border-bottom:0">
		<div id="writeContents">
        <?php
        // 파일 출력
        for ($i=0; $i<=count($view[file]); $i++) {
            if ($view[file][$i][view]) 
                echo "<p class=\"text-center\">". $view[file][$i][view] . "</p>";
        }
        ?>

        <!-- 내용 출력 -->
		<?=$view[content];?>
		</div>
        
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
		<!--<? if ($prev_href) { echo "<a href='{$prev_href}' class='gray'>이전</a> "; } ?>
		<? if ($next_href) { echo "<a href='{$next_href}' class='gray'>다음</a> "; } ?>-->
	</div>
	<div class="fRight">
		<? if ($update_href) { echo "<a href=\"$update_href\" class='gray'>Modify</a> "; } ?>
	    <? if ($delete_href) { echo "<a href=\"$delete_href\" class='gray'>Delete</a> "; } ?>
	    <? echo "<a href=\"$list_href\" class=\"black\">List</a> "; ?>
	</div>
</div>
<div style="height:20px"></div>



<script type="text/javascript">
function file_download(link, file) {
    <? if ($board[bo_download_point] < 0) { ?>if (confirm("'"+decodeURIComponent(file)+"' 파일을 다운로드 하시면 포인트가 차감(<?=number_format($board[bo_download_point])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))<?}?>
    document.location.href=link;
}
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript">
window.onload=function() {
    // resizeBoardImage(<?=(int)$board[bo_image_width]?>);
    //drawFont('16');
	$(function () {
		$('.board_view img, #writeContents img').each(function () {
			$(this).css({'max-width': 620, 'max-height': '100%'});
		});
	});
}
</script>
<!-- 게시글 보기 끝 -->
