<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

#$_SESSION['captcha_keystring'] = $_POST['wr_key'] = 'b';
/*
$tmp = array();
foreach ($_POST as $key=>$val) {
	$tmp[$key] = $val;
}

//$wr_content = $_POST['wr_content'] = urlencode(serialize($tmp));