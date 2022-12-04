<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once "{$g4['path']}/head.sub.php";

// 모바일
sql_query("UPDATE {$write_table} SET wr_10 = '1' WHERE wr_id = '{$wr_id}' ");

if ($w == '') {
	$row = sql_fetch("SELECT * FROM g4_ext_info WHERE gubn = 'sms_notify' ");
	$tmp = unserialize($row['data']);
	if ($tmp[$bo_table][0] != '' || $tmp[$bo_table][1] != '') {
		include_once "{$g4['path']}/lib/sms.lib.php";
		for ($i=0; $i<=1; $i++) {
			if (trim($tmp[$bo_table][$i]) != '') {
				$sms_msg  = ext_sms_msg("{$bo_table}_adm", array( array('{이름}', $wr_name), array('{진료과목}', $ca_name) ));
				$sms_data = array('rphone'=>trim($tmp[$bo_table][$i]), 'msg'=>$sms_msg);
				$result = sms_send($sms_data);
			}
		}
	}
	echo push_send('img', $board);
	echo ext_info_tag('conv_tag', 'mobile_'.$bo_table);

	/* SMS 발송 */
	if ($wr_3 == '1') {
		include_once "{$g4['path']}/lib/sms.lib.php";
		$sms_msg  = ext_sms_msg("{$bo_table}_customer", array( array('{이름}', $wr_name), array('{진료과목}', $ca_name) ));
		$sms_data = array('rphone'=>trim($wr_2), 'msg'=>$sms_msg);
		$result   = sms_send($sms_data);
	}
}
?>

<?php 

include_once "{$g4['path']}/tail.sub.php";

$msg =  josa($board['bo_subject'],'이','가') . " 등록되었습니다.";
alert($msg, "/bbs/write.php?bo_table={$bo_table}");
exit;
echo '<script type="text/javascript">alert("'.josa($board['bo_subject'],'이','가').' 등록되었습니다.");</script>';

