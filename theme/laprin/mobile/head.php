<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>
<div id="sitemap-wrap">
	<div id="sitemap">
		<div id="sitemap-header">
			ALL MENU
			<a href="" id="sitemap-close"><img src="<?php echo G5_THEME_URL;?>/img/mobile/ico_close.png" alt="" /></a>
		</div>
		<?
		foreach ($sitemap as $key=>$val) {
			if ($is_member) {
				if ($key == '910') continue;
			}
			if (!$is_member) {
				if ($key == '920') continue;
			}
			echo "<h4>{$val[0][1]}</h4>";
			echo "<ul>";
			$i = 0;
			foreach ($sitemap[$key] as $key2=>$val2) {
				if ($val2[2] == '') continue;
				if ($key2 == 0) continue;
				$link = $val2[2];
				// if ($val2[0] == '710101') echo "<li><a href=\"{$link}\">{$val2[1]} <img src='/skin/board/basic/img/icon_new.png'></a></li>";
				if (isset($val2[3]) && is_array($val2[3])) {
					echo "<li>";
					echo "<a href=\"{$link}\">{$val2[1]}<i></i></a>";
					echo "<ul>";
					$j = 0;
					foreach ($val2[3] as $val3) {
						echo "<li><a href=\"{$val3[2]}\">{$val3[1]}</a></li>";
						++$j;
					}
					if ($j > 0 && $j % 2 == 1) echo "<li><span>&nbsp;</span></li>";
					echo "</ul>";
					echo "</li>";
				}
				else echo "<li><a href=\"{$link}\">{$val2[1]}</a></li>";
				++$i;
			}
			if ($i > 0 && $i % 2 == 1) echo "<li><span>&nbsp;</span></li>";
			echo "</ul>";
		}
		?>
	</div>
</div>
<header>
	<?php /*
	<div id="lang">
		<a href=""><img src="/img/mobile/flag-usa.png" alt=""></a>
		<a href=""><img src="/img/mobile/flag-china.png" alt=""></a>
	</div>
	*/ ?>
	<div id="gnb">
		<?php 
		if ($pageIndex) echo '<img src="/img/mobile/logo.png" alt="" class="w100" />';
		else echo '<img src="/img/mobile/logo2.png" alt="" class="w100" />';
		?>		
		<a href="/"></a>
		<a href="tel:821096057812" id="headercall"></a>
		<a href="/bbs/write.php?bo_table=counsel&pageIndex=190101"></a>
		<a href="#" id="headermenu"></a>
		<?php
		/*
		<div id="gnb-sub-wrap">
			<div id="gnb-sub">
				<img src="/img/mobile/gnb-sub.png" alt="" class="w100" />
				<a href="/bbs/write.php?bo_table=counsel"></a>
				<a href="/bbs/write.php?bo_table=reserve"></a>
				<a href="https://pf.kakao.com/_xngWzd" target="_blank"></a>
				<a href="/page.php?pageIndex=110105"></a>
			</div>
		</div>
		*/ ?>
	</div>
	<div id="headertel-wrap">
		<h4>지점을 선택하세요. <a href="#" onclick="$('#headertel-wrap').hide();return false">X</a></h4>
		<ul>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
		</ul>
	</div>
	<?php // if (is_array($header_title) && isset($header_title[2])) include $header_title[2]; ?>
	<?php if ($pageIndex) { ?>
	<div id="snb-wrap">
		<div id="snb">
			<ul>
				<?php if ($current_page[1]) { ?>
				<li>
					<a href="#"><span><?=$current_page[1]?></span></a>
					<ul>
						<?php
						foreach ($sitemap as $key=>$val) {
							foreach ($val as $key2=>$val2) {
								if ($key2 > 0) continue;
								if ($is_member && $key == '910') continue;
								if (!$is_member && $key == '920') continue;
								echo "<li><a href=\"{$val2[2]}\">{$val2[1]}</a></li>";
							}
						}
						?>
					</ul>
				</li>
				<?php } ?>
				<?php if ($current_page[2]) { ?>
				<li>
					<a href="#"><span><?=$current_page[2]?></span></a>
					<ul>
						<?php
						foreach ($sitemap[substr($pageIndex,0,3)] as $key=>$val) {
							if ($key == 0) continue;
							echo "<li><a href=\"{$val[2]}\">{$val[1]}</a></li>";
						}
						?>
					</ul>
				</li>
				<?php } ?>
				<?php if ($current_page[3]) { ?>
				<li>
					<a href="#"><span><?=$current_page[3]?></span></a>
					<ul>
						<?php
						foreach ($sitemap[substr($pageIndex,0,3)] as $key=>$val) {
							if (isset($val[3]) && is_array($val[3]) && $val[0] == substr($pageIndex,0,6)) {
								foreach ($val[3] as $val2) {
									echo "<li><a href=\"{$val2[2]}\">{$val2[1]}</a></li>";
								}
							}
						}
						?>
					</ul>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<?php
	/*

	*/ ?>
	<?php } ?>
</header>