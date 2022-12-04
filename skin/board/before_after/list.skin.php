<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
$thumb_width = '300'; //썸네일 가로길이
$thumb_height = '240'; //썸네일 세로길이
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

<div class="board_list thumb-slide">
<?php
$thumb_list = '';
for ($i=0; $i<count($list); $i++) 
{
	if ($list[$i][is_notice]) // 공지사항 
		$num = "<span class='ico ico-notice'><em style='width:49px'>NOTICE</em></span>";
	else if ($wr_id == $list[$i][wr_id]) // 현재위치
		$num = "<span class='current'>{$list[$i][num]}</span>";
	else if ($list[$i]['wr_good'] >= 100)
		$num = "<img src=\"{$basic_skin_path}/img/icon_best.gif\" alt=\"\">";
	else
		$num = $list[$i][num];

		$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);
		$thumbig = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 850, 440, false, true);

		if($thumb['src']) {
			$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'"  class="thumb">';
		} else {
			$img_content = $board_skin_url."/img/no-thumbnail.png";
		}

		// $thumb1 = $thumb['src'];
		$thumb1 = $file1 = $thumbig['src'];


	if ($board['bo_read_level'] > $member['mb_level']) ;


$short_desc = cut_str(conv_content(strip_tags($list[$i]['wr_content']), 'html2'), 300);
	$short_desc = str_replace('&nbsp;', ' ', $short_desc);

	if ($is_member || 1==1) {
		$thumb_list.= "<div class=\"item\" data-index=\"{$i}\">
			<img src=\"{$thumb1}\">
			<p class=\"txt-area\">{$list[$i]['subject']}</p>
		</div>";
	}
	else {
		$thumb1 = "{$board_skin_path}/img/no-login.png";
		$thumb_list.= "<div class=\"item\" data-index=\"{$i}\">
			<a href=\"/bbs/login.php?url=".urlencode("/bbs/board.php?bo_table={$bo_table}")."\">
			<img src=\"{$thumb1}\">
			<p>{$list[$i]['subject']}</p>
			</a>
		</div>";
	}

	//if ( ($i+1) % 2 == 0) echo "<li class='line'></li>";
}
if ($i == 0) { echo "<div class='empty'>등록된 내역이 없습니다.</div>"; }
?>
	<div class="owl-nav">
		<a href="" class="owl-prev"></a>
		<a href="" class="owl-next"></a>
	</div>
	<div id="big_img">
	</div>
</div>

<div class="board_list_thumb_wrap">
	<div class="board_list_thumb" style="width:<?=$i*256?>px">
		<?php
		echo $thumb_list;
		?>
	</div>
</div>
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
<div class="board_button" style="text-align: right">
	&nbsp;
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
	<select name="sfl">
		<option value="wr_subject">제목</option>
		<option value="wr_content">내용</option>
		<option value="wr_subject||wr_content">제목+내용</option>
		<option value="mb_id,1">회원아이디</option>
		<option value="wr_name,1">글쓴이</option>
	</select>
	<input name="stx" class="ed" maxlength="15" itemname="검색어" required value='<?=stripslashes($stx)?>'>
	<button type="submit"">검색</button>
	<input type="hidden" name="sop" value="and">
	</form>
</div>


<script type="text/javascript">
//if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';
}
var owl1, owl2;
(function ($) {
	$(function () {
		var obj = $('.board_category li:first-child a');
		if (obj.length > 0) {
			obj.addClass('onPrev');
		}
		$('.board_list_thumb .item:eq(0)').addClass('current');
		$('#big_img').html($('.board_list_thumb .item:eq(0)').clone(true));

		var _page = 0;
		$('.board-wrap .owl-prev').on('click', function () {
			var obj = $('.board_list_thumb .current');
			var idx = obj.data('index');
			idx = idx - 0 - 1;
			var obj2 = $('.board_list_thumb .item[data-index="' + idx + '"]');
			if (obj2.length == 0) return false;
			obj2.trigger('click');
			return false;
		});
		$('.board-wrap .owl-next').on('click', function () {
			var obj = $('.board_list_thumb .current');
			var idx = obj.data('index');
			idx = idx - 0 + 1;
			var obj2 = $('.board_list_thumb .item[data-index="' + idx + '"]');
			if (obj2.length == 0) return false;
			obj2.trigger('click');
			return false;
		});
		$('.board-wrap .board_list_thumb .item').on('click', function () {
			$('.board-wrap .board_list_thumb .item').removeClass('current');
			$(this).addClass('current');
			$('#big_img').html( $(this).clone(true) );

			var idx = $(this).data('index');
			var page = parseInt(idx / 4);
			if (_page != page) {
				$('.board-wrap .board_list_thumb').animate({'left': 1020*page*-1});
			}
			_page = page;
			return false;
		});

	});
})(jQuery);
</script>
<!-- 게시판 목록 끝 -->
