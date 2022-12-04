<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
$thumb_width = '197'; //썸네일 가로길이
$thumb_height = '137'; //썸네일 세로길이
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<?php 
if ($board['bo_use_category']) { 
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
<?php } ?>

    <form name="fboardlist"  id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">
    
<table class="table-box fadeInTop board_list">
<colgroup>
<col width="100" />
<col width="120" />
<col width="120" />
<col width="" />
<col width="100" />
<col width="100" />
</colgroup>
<thead>
<tr>
	<th scope="col"><span>No<em></em></span></th>
	<th scope="col"><span>Category<em></em></span></th>
	<th scope="col"></th>
	<th scope="col"><span>Subject<em></em></span></th>
	<th scope="col"><span>Writer<em></em></span></th>
	<th scope="col"><span>Date</span></th>	
</tr>
</thead>
<tbody>
<?
for ($i=0; $i<count($list); $i++) 
{
	if ($list[$i][is_notice]) // 공지사항 
		$num = "<span class='ico ico-notice'><em style='width:49px; font-size:12px;'>NOTICE</em></span>";
	else if ($wr_id == $list[$i][wr_id]) // 현재위치
		$num = "<span class='current'>{$list[$i][num]}</span>";
	else if ($list[$i]['wr_good'] >= 99999999)
		$num = "<span class=\"best\">BEST</span>";
	else
		$num = $list[$i][num];

		$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

		if($thumb['src']) {
			$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'"  class="thumb">';
		} else {
			$img_content = $board_skin_url."/img/no-thumbnail.png";
		}

		
	$subject  = '';
	// $subject .= $list[$i]['icon_secret']. " ";
	$subject .= "{$list[$i][subject]}";
	// $subject .= " " . $list[$i][icon_new];
	$subject = "<a href='{$list[$i][href]}'>{$subject}</a>";
	
	$ca_name = $list[$i]['ca_name'];
	$wr_name = $list[$i]['wr_name'];
	$wr_date = $list[$i]['datetime'];
	$wr_hit = $list[$i]['wr_hit'];

	if ($ca_name == '이벤트') 
		$ca_name = "<span class='ca' style='background:#ff6280;'>{$ca_name}</span>";
	else 
		$ca_name = "<span class='' style=''>{$ca_name}</span>";
?>
<tr>
	<td><?= $num ?></td>
	<td><?=$list[$i]['ca_name']?></td>
	<td><?php echo $img_content?></td>
	<td class="subject"><?=$subject?></td>
	<td><?=$wr_name?></td>
	<td><?=$wr_date?></td>
</tr>
<?
}
if ($i == 0) { echo "<tr><td colspan=\"5\" class=\"empty\">등록된 내역이 없습니다.</td></tr>"; }
?>
</tbody>
</table>

	<?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
        	<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
        </ul>	
        <?php } ?>
    </div>
    <?php } ?> 
</form>

<!-- 페이지 -->
<div class="paging-box">
	<?=$write_pages?>
</div>

<!-- 검색 -->
<div class="search-box">
    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
		<select name="sfl" class="srh-kind">
			<option value="wr_subject">제목</option>
			<option value="wr_content">내용</option>
			<option value="wr_subject||wr_content">제목+내용</option>
			<option value="mb_id,1">회원아이디</option>
			<option value="wr_name,1">글쓴이</option>
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
(function ($) {
	$(function () {
		var obj = $('.board_category li:first-child a');
		if (obj.length > 0) {
			obj.addClass('onPrev');
		}
		$('.board_list li:last-child').after('<li class="end"></li>');
		$('#best-owl-carousel .owl-carousel').owlCarousel({
			stagePadding: 0,
			items:4,
			loop:true,
			margin:0,
			nav:true,
			dots:false,
			autoplay:true,
			autoplayTimeout:4000//,		dotsContainer: '.dotsCont'
		});
	});
})(jQuery);
</script>

<!-- 게시판 목록 끝 -->
