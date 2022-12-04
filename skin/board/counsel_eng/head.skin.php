<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

?>
<link rel="stylesheet" href="<?=$board_skin_path?>/style.css?ver=<?=@filemtime("{$board_skin_path}/style.css")?>" />

    <main id="container">
        <article class="sub-visual" style="background-image:url('/img/sub/sub_bg_9.jpg');">
            <div class="title-box table" style="background-image:url('/img/sub/sub_img_9-1.jpg');">
                <div class="table-cell fadeInTop">
                    <h1 class="page-name">
                        <span class="menu">Consultation</span>
                        <span class="big-title">
							<?php echo $board['bo_subject']; ?>
						</span>
                    </h1>
                    <p class="sub-title">
						<?php 
						if ($bo_table == 'counsel') echo 'Please leave an online inquiry and will respond quickly and kindly.';
						else if ($bo_table == 'counsel2') echo 'We will respond quickly and kindly.';
						?>
                        
                    </p>
                </div>
            </div>
        </article>

        <section class="table-area inner-box fadeInTop">
            <h2 class="cont-title fadeInTop"><span><?php echo $board['bo_subject']; ?></span></h2>
