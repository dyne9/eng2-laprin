<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

?>
<link rel="stylesheet" href="<?=$board_skin_path?>/style.css?ver=<?=@filemtime("{$board_skin_path}/style.css")?>" />

<div class="tCenter">
	<img src="/skin/board/mobile.basic/img/<?=$bo_table?>.jpg" alt="" />
</div>
<!-- board_area -->
<div class="board-wrap board-wrap-<?=$bo_table?>">