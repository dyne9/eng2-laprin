<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

?>
<link rel="stylesheet" href="<?=$board_skin_path?>/style.css?ver=<?=@filemtime("{$board_skin_path}/style.css")?>" />

<?php if ($bo_table == 'before_after') { ?>
    <main id="container" class="board-wrap">
        <article class="sub-visual" style="background-image:url('/img/sub/sub_bg_8.jpg');">
            <div class="title-box table" style="background-image:url('/img/sub/sub_img_8-1.jpg');">
                <div class="table-cell fadeInTop">
                    <h1 class="page-name">
                        <span class="menu">Testimonials</span>
                        <span class="big-title">Before &amp; After</span>
                    </h1>
                    <p class="sub-title">
                        Explore our Before &amp; After Gallery
                    </p>
                </div>
            </div>
        </article>

        <section class="before-after inner-box fadeInTop">
            <h2 class="cont-title"><span>BEFORE &amp; AFTER</span></h2>

<?php } else if ($bo_table == 'real_story') { ?>
    <main id="container" class="board-wrap">
        <article class="sub-visual" style="background-image:url('/img/sub/sub_bg_8.jpg');">
            <div class="title-box table" style="background-image:url('/img/sub/sub_img_8-1.jpg');">
                <div class="table-cell fadeInTop">
                    <h1 class="page-name">
                        <span class="menu">Testimonials</span>
                        <span class="big-title">Real-Story Pictures</span>
                    </h1>
                    <p class="sub-title">
                        Explore our Real-Story Pictures Gallery
                    </p>
                </div>
            </div>
        </article>

        <section class="before-after inner-box fadeInTop">
            <h2 class="cont-title"><span>Real-Story Pictures</span></h2>

<?php } ?>