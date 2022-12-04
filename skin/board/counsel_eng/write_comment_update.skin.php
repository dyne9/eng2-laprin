<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// SMS 를 사용한다면.
if ($_POST['send_sms'] == '1') {

	include_once "{$g4['path']}/lib/sms.lib.php";

	$sms_msg  = ext_sms_msg("{$bo_table}_reply", array( array('{이름}', $wr['wr_name']), array('{진료과목}', $wr['ca_name']) ));
	$data = array('rphone'=>$wr['wr_2'], 'msg'=>$sms_msg);
	$result = sms_send($data);
}

if ($_POST['send_email'] == '1') {

    include_once("$g4[path]/lib/mailer.lib.php");

	$subject = "'{$board[bo_subject]}' 에 대한 답변입니다.";

	$mail_content  = "";
	$mail_content .= "<div style=\"font-size:12px; font-family:gulim; line-height:1.6;\"><b>[ 원글 ]</b><br>";
	$mail_content .= get_text($wr['wr_content']);
	$mail_content .= "<br><br><b>[ 답변글 ]</b><br>";
	$mail_content .= $wr_content;
	$mail_content .= "</div>";

    ob_start();
	include_once ("{$g4['path']}/data/mail/{$bo_table}/mail.skin.php");
    $content = ob_get_contents();
    ob_end_clean();


	mailer($RemailName, $RemailEmail, $wr['wr_email'], $subject, $content, 1);

}
