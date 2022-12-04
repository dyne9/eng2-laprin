<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once "{$g4['path']}/head.sub.php";

if ($w == '') {
	$row = sql_fetch("SELECT * FROM g4_ext_info WHERE gubn = 'sms_notify' ");
	$tmp = unserialize($row['data']);
	if ($tmp[$bo_table][0] != '' || $tmp[$bo_table][1] != '') {
		include_once "{$g4['path']}/lib/sms.lib.php";
		for ($i=0; $i<=1; $i++) {
			if (trim($tmp[$bo_table][$i]) != '') {
				$data = array('rphone'=>trim($tmp[$bo_table][$i]), 'msg'=>"새로운 상담이 등록되었습니다. - {$RemailName}");
				$result = sms_send($data);
			}
		}
	}
}
?>
<?php 
$row = sql_fetch("SELECT * FROM g4_ext_info WHERE gubn = 'push_notify' ");
$tmp = unserialize($row['data']);
if ($tmp[$bo_table] != '')
	echo push_send('img', '새로운 상담이 등록되었습니다.'); 

include_once "{$g4['path']}/tail.sub.php";
