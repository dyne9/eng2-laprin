<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 모바일은 view['content'] 의 pre, xmp 태그를 div 로 변환
$view['content'] = str_replace(array('<pre', '</pre>', '<xmp', '</xmp'), array('<div', '</div', '<div', '</div'), $view['content']);

// 동영상태그 넣어줌
$view[content] = '<div style="text-align:center">'. $view['wr_5'] . '</div>'. $view['content'];

$copy_href = $move_href = $search_href = $reply_href = false;

$board['bo_image_width'] = 616;
?>
<div class="board-view-wrap">
<table class="board_view">
<colgroup>
<col width="20%" />
<col width="" />
<col width="20%" />
<col width="30%" />
</colgroup>
<?php if ($view['ca_name']) { ?>
<tr>
	<th>분류</th>
	<td colspan="5"><?= $view['ca_name'] ?></td>
</tr>
<?php } ?>
<tr>
	<th>제 목</th>
	<td colspan="3">
		<div style="">
			<p style="margin:0;padding:0;padding-right: 25px">
				<?=cut_hangul_last(get_text($view[wr_subject]))?>
			</p>
		</div>
	</td>
</tr>
<tr>
	<th>작성자</th>
	<td><?=$view['name']?></td>
	<th>등록일</th>
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
		<? if ($prev_href) { echo "<a href='{$prev_href}' class='gray'>이전</a> "; } ?>
		<? if ($next_href) { echo "<a href='{$next_href}' class='gray'>다음</a> "; } ?>
	</div>
	<div class="fRight">
		<? if ($update_href) { echo "<a href=\"$update_href\" class='gray'>글수정</a> "; } ?>
	    <? if ($delete_href) { echo "<a href=\"$delete_href\" class='gray'>글삭제</a> "; } ?>
	    <? echo "<a href=\"$list_href\" class=\"black\">목 록</a> "; ?>
	</div>
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
    // resizeBoardImage(<?=(int)$board[bo_image_width]?>);
	$(function () {
		$('.board_view img, #writeContents img').each(function () {
			// $(this).css({'max-width': 620, 'max-height': '100%'});
		});
	});
}
</script>
<!-- 게시글 보기 끝 -->
