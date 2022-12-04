<?php
function conv_hangul($str) {
	$str2 = $str;
	if ( urldecode($str2) != $str2 )
		$str2 = urldecode($str2);

	if ( iconv('utf-8', 'utf-8', $str2) != $str2 ) {
		$str2 = iconv('cp949', 'utf-8', $str2);
	}
	return $str2;
}

$_hid = $hid = conv_hangul($_GET['hid']);

include '_common.php';

if ($_GET['layout'] === '0') 
	include 'head.sub.php';
else
	include "_head.php";

$tmppageIndex = $pageIndex;


if (G5_IS_MOBILE) { 
	$include_file = "page/{$tmppageIndex}_mobile.php";
} else {
	$include_file = "page/{$tmppageIndex}_pc.php";
}

if (file_exists($include_file)) {
	$cost_form = '
				<div class="cost-wrap">
					<form name="costform" method="post" action="/bbs/write_update.php" onsubmit="return xfwrite_submit(this)">
						<input type="hidden" name="bo_table" value="cost" style="width:0;padding:0">
						<input type="text" name="wr_name" class="ed" required itemname="이름" placeholder="이름" value="" style="width:205px">
						<input type="text" name="wr_2" class="ed" required itemname="전화번호" placeholder="전화번호" value="">
						<label><input type="checkbox" name="agree" value="1"> 개인정보수집동의</label><a href="/page/policy.php" target="_blank">[자세히보기]</a>
						<button type="submit">전화상담신청</button>
					</form>
					<a href="" class="kakao">카톡상담신청</a>
				</div>';

	include $include_file;
}
else {
	if ($g4['view_type'] != '') {
		if (strlen($tmppageIndex) == 6) {
			$t_file1 = intval(substr($tmppageIndex, 0, 2));
			$t_file2 = intval(substr($tmppageIndex, 2, 2));
			$t_file3 = intval(substr($tmppageIndex, 4, 2));
		} 
		else {
			$t_file1 = intval(substr($tmppageIndex, 0, 2));
			$t_file2 = intval(substr($tmppageIndex, 4, 2));
			$t_file3 = intval(substr($tmppageIndex, 8, 2));

		}

		$dir = "img/mobile/{$t_file1}";
		$file_list = array();
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					$tmp2 = explode('.', $file);
					$tmp2 = explode('-', $tmp2[0]);
					if (strlen($tmppageIndex) == 6) {
						if (is_file($dir.'/'.$file) && intval(substr($file, 0, 2)) == $t_file3) $file_list[] = $file;
					}
					else {
						if (is_file($dir.'/'.$file) && $tmp2[0] == $t_file2 && $tmp2[1] == $t_file3)
							$file_list[] = $file;
					}
				}
			}
		}

		echo "<article id=\"m{$pageIndex}\">";
		
		/*
		if (file_exists("{$dir}/title.jpg")) echo "<img src=\"{$dir}/title.jpg\" class=\"w100\">";
		if (strlen($pageIndex) >= 9) {
			echo "<div class=\"w95\">
				<img src=\"{$dir}/".substr($pageIndex, 5, 1)."-t.png\" class=\"w100\">
				<ul class=\"ul-tab\">";
				foreach ($current_menu[2] as $val) {
					echo "<li><a href=\"{$val[2]}\" class=\"".($pageIndex == $val[0] ? 'on' : '')."\">{$val[1]}</a></li>";
				}
			echo "
				</ul>
			</div>
			";
		}
		*/
		if (count($file_list) > 0) {
			asort($file_list);
			foreach ($file_list as $val) {
				echo "<img src=\"{$dir}/{$val}\" class=\"w100\">";
			}
		}
		echo "</article>";
	}
	else {
		echo '
		<article id="m'.$tmppageIndex.'">
			<section class="nth-child-1"></section>
			<section class="nth-child-2"></section>
			<section class="nth-child-3"></section>
			<section class="nth-child-4"></section>
			<section class="nth-child-5"></section>
			<section class="nth-child-6"></section>
			<section class="nth-child-7"></section>
			'.$case.'
			<section class="nth-child-8"></section>
			<section class="nth-child-9"></section>
			<section class="nth-child-10"></section>
		</article>
		';
	}
}

$seo_file = "page/{$tmppageIndex}_seo.php";

if (file_exists($seo_file))
	include $seo_file;


if ($_GET['layout'] === '0') 
	include 'tail.sub.php';
else
	include "_tail.php";