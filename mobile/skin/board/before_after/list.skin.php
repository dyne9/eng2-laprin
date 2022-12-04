<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
$thumb_width = '197'; //썸네일 가로길이
$thumb_height = '137'; //썸네일 세로길이
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
$arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음
?>
<script src="<?php echo G5_JS_URL; ?>/jquery.fancylist.js"></script>
<form name="fboardlist"  id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="sw" value="">


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


<ul class="board_list">
<?php
for ($i=0; $i<count($list); $i++) { 
	$class = '';
	if ($list[$i]['wr_good'] == '99999999')
		$class = 'best';
?>
<li>
	<?php
	$no_thumb     = $board_skin_path."/img/no-thumbnail.png";
	$thumb1 = $thumb2 = '';
	$file1 = $list[$i]['file'][0]['path'] .'/'. $list[$i]['file'][0]['file'];
	
    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $thumb_width, $thumb_height);

    if($thumb['src']) {
        $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$thumb_width.'" height="'.$thumb_height.'">';
    } else {
        $img_content = '<span class="no_img"><i class="fa fa-picture-o" aria-hidden="true"></i></span>';
    }

	if ($is_member || 1==1) {
	?>
		<img src="<?=$thumb['src']?>" class="thumb" alt="" /><p><?=$list[$i]['subject']?></p>
	<?php } else { ?>
		<a href="/bbs/login.php?url=<?=$urlencode?>"><img src="/skin/board/mobile.before_after/img/no-login.png" alt="" /></a>
	<?php } ?>
</li>
<? } ?>
</ul>





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
