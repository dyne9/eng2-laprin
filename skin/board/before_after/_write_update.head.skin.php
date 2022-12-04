<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$_SESSION['captcha_keystring'] = $_POST['wr_key'] = 'b';

#$_POST['wr_subject'] = $wr_subject = $_POST['wr_name'] .' 님의 진료예약입니다. 접수일 : '. date('Y-m-d H:i:s');

$wr_2 = $_POST['hp1'].'-'.$_POST['hp2'].'-'.$_POST['hp3'];