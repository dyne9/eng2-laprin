<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

$wrapper_visual = '';
if (in_array($pageIndex, array('180101', '180102', '180103', '190101', '190102'))) $wrapper_visual = 'short-visual';

if (in_array($pageIndex, array('170101', '170102', '170103', '170104'))) $wrapper_visual = 'laprin-about-wrap';
?>
    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
<!-- #wrapper -->
<div id="wrapper" class="<?=$wrapper_visual?>">


    <header id="header">
        <div class="submenu-dim"></div>
        <nav id="gnb" class="inner-box clearfix">
            <a href="/" class="logo">
                <strong>LaPrin</strong>
            </a>

            <button type="button" class="menu-toggle"><span><i></i>Menu open</span></button>
            <ul class="menu">
				<?php
				foreach ($sitemap as $key=>$val) {
					$link = $val[1][2];
					if (substr($pageIndex,0,3) == substr($val[0][0], 0, 3)) echo "<li class=\"active\">\n";
					else echo "<li>\n";
					echo "<a href=\"{$link}\" class=\"big-menu\">{$val[0][1]}</a>\n";
					$j = 1; 
					if (is_array($val)) {
						$tmp = array();
						foreach ($val as $key2=>$val2) {
							if ($key2 == 0) continue;
							$class = '';
							$link = $val2[2];
							if ($val2[0] == $pageIndex) $tmp[] = "<li class=\"active\"><a href=\"{$link}\">{$val2[1]}</a></li>";
							else $tmp[] = "<li><a href=\"{$link}\">{$val2[1]}</a></li>";
						}
						if (substr($val[0][0], 0, 3) == '130') {
							$str = '';
							for ($k=0; $k<5; $k++) { if (!isset($tmp[$k])) break; $str .= $tmp[$k]; }
							if ($str != '') echo "<ul class=\"sub-drop\">{$str}</ul>";
							$str = '';
							for ($k=5; $k<9; $k++) { if (!isset($tmp[$k])) break; $str .= $tmp[$k]; }
							if ($str != '') echo "<ul class=\"sub-drop\">{$str}</ul>";
							$str = '';
							for ($k=9; $k<15; $k++) { if (!isset($tmp[$k])) break; $str .= $tmp[$k]; }
							if ($str != '') echo "<ul class=\"sub-drop\">{$str}</ul>";
						} else {
							$str = '';
							for ($k=0; $k<count($tmp); $k++) { if (!isset($tmp[$k])) break; $str .= $tmp[$k]; }
							if ($str != '') echo "<ul class=\"sub-drop\">{$str}</ul>";
						}
					}
					echo "</li>";
				}
				?>
            </ul>

            <div class="language-select">
                <button type="button">Language</button>
                <ul>
                    <li><a href="https://laprinps.com/" target="_blank">KOREAN</a></li>
                    <li><a href="http://www.laprincn.com/" target="_blank">CHINESE</a></li>
                    <li><a href="http://jpn.laprinps.com/" target="_blank">JAPAN</a></li>
                    <li><a href="https://www.laprinps.com/ad/09_vietnam/190613_pc/" target="_blank">VIETNAM</a></li>
                </ul>
            </div>
        </nav>
    </header>

<?php if ($bo_table == 'before_after' || $bo_table == 'real_story' || $bo_table == 'laprin_media') { ?>
    <main id="container" class="board-wrap">
        <article class="sub-visual" style="background-image:url('/img/sub/sub_bg_8.jpg');">
            <div class="title-box table" style="background-image:url('/img/sub/sub_img_8-1.jpg');">
                <div class="table-cell fadeInTop">
                    <h1 class="page-name">
                        <span class="menu">Testimonials</span>
                        <span class="big-title"><?php echo $board['bo_subject'];?></span>
                    </h1>
                    <p class="sub-title">
                        <?php echo $sub_title; ?>
                    </p>
                </div>
            </div>
        </article>

        <section class="before-after inner-box fadeInTop">
            <h2 class="cont-title"><span><?php echo $board['bo_subject'];?></span></h2>


<?php } else if ($bo_table == 'counsel' || $bo_table == 'counsel2') { ?>
    <main id="container">
        <article class="sub-visual" style="background-image:url('/img/sub/sub_bg_9.jpg');">
            <div class="title-box table" style="background-image:url('/img/sub/sub_img_9-1.jpg');">
                <div class="table-cell fadeInTop">
                    <h1 class="page-name">
                        <span class="menu">Consultation</span>
                        <span class="big-title"><?php echo $board['bo_subject'];?></span>
                    </h1>
                    <p class="sub-title">
                        <?php echo $sub_title; ?>
                    </p>
                </div>
            </div>
        </article>

        <section class="before-after inner-box fadeInTop">
            <h2 class="cont-title"><span><?php echo $board['bo_subject'];?></span></h2>

<?php } else if (!$bo_table && !$pageIndex && !defined('_INDEX_')) { ?>

    <main id="container">
        <article class="sub-visual" style="background-image:url('/img/sub/sub_bg_9.jpg');">
            <div class="title-box table" style="background-image:url('/img/sub/sub_img_9-1.jpg');">
                <div class="table-cell fadeInTop">
                    <h1 class="page-name">
                        <span class="menu">LAPRIN</span>
                        <span class="big-title">
							welcome
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
            <h2 class="cont-title fadeInTop"><span>WELCOME</span></h2>            
<?php } ?>
