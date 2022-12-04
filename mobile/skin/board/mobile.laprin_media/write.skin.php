<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$is_dhtml_editor = false;
if ($is_dhtml_editor) {
    include_once("$g4[path]/lib/cheditor4.lib.php");
    echo "<script src='$g4[cheditor4_path]/cheditor.js'></script>";
    echo cheditor1('wr_content', '100%', '250px');
}

if ($w == '') {
	$write['wr_name'] = $member['mb_name'];
	$write['wr_email'] = $member['mb_email'];
	list($write['hp1'], $write['hp2'], $write['hp3']) = explode('-', $member['mb_hp']);
	$write['wr_3'] = '1';
}
else {
	list($write['hp1'], $write['hp2'], $write['hp3']) = explode('-', $write['wr_2']);
}
?>

<script type="text/javascript">
user_scalable = false;
// 글자수 제한
var char_min = parseInt(<?=$write_min?>); // 최소
var char_max = parseInt(<?=$write_max?>); // 최대
</script>

<div class="board-write-wrap">
<form name="fwrite" id="fwrite" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=null> 
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=wr_id    value="<?=$wr_id?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">

<div style="border:1px solid #cdcdcd;background:#f6f6f6;color:#787878;height:120px;overflow:scroll;-webkit-overflow-scrolling: touch;font-size:.8em;line-height:1.2em;padding:10px 0">
	<?= nl2br($config['cf_privacy']) ?>
</div>
<div style="padding: 15px 0 30px 0; text-align: right; background: #fff; font-weight: bold">
	<input type="checkbox" id="agree" name="agree" value="1"><label for="agree" class="bold"> 개인정보 취급방침에 동의합니다.</label>
</div>

<table class="board_write">
<colgroup>
<col width="25%" />
<col width="" />
</colgroup>
<? if (!$is_member) { ?>
<tr>
	<th>작성자<em></em></th>
	<td>
		<input type="text" name="wr_name" size="50" class="ed w95" itemname="이름" required value="<?=$name?>">
	</td>
</tr>
<? } ?>
<tr>
	<th>휴대폰<em></em></th>
	<td>
		<input type="tel" name="wr_2" class="ed w95" value="<?=$write['wr_2']?>" />
		<input type="hidden" name="wr_3" value="<?=$write['wr_3']?>">
	</td>
</tr>
<tr>
	<th>이메일<em></em></th>
	<td>
		<input type="hidden" name="wr_email" value="">		
		<input type="text" name="wr_email1" size="10" class="ed" itemname="이메일" value="<?=$write['wr_email1']?>">
		@
		<input type="hidden" name="wr_email2" id="wr_email2" size="10" class="ed" itemname="이메일" value="<?=$write['wr_email2']?>">
		<select name="wr_email3" id="wr_email3">
		<option value="">이메일도메인</option>
		<?
		for ($i=0; $i<count($_email_domain); $i++) {
			echo "<option value=\"{$_email_domain[$i][0]}\">{$_email_domain[$i][1]}</option>";
		}
		?>
		</select>
		<br>
		<input type="checkbox" name="mail" id="mail" value="mail" <?= $recv_email_checked ?>><label for="mail" class=""> 답변사항 메일로 받기</label>
	</td>
</tr>
<tr>
	<th>제목<em></em></th>
	<td><input type="text" name="wr_subject" id="wr_subject" class="ed w95" itemname="제목" required value="<?=$subject?>"></td>
</tr>
<?php if (isset($wr_1_gubn)) { ?>
<tr>
	<th>지점<em></em></th>
	<td>
		<select name="wr_1" required itemname="지점">
		<option value="">지점을 선택해주세요.</option>
		<?php
		foreach ($_wr_1_gubn as $val) echo "<option value='{$val}'>{$val}</option>";
		?>
		</select>
	</td>
</tr>
<?php } ?>
<?php if ($board['bo_use_category']) { ?>
<tr>
	<th>분류<em></em></th>
	<td>
		<select name="ca_name" required itemname="분류">
			<option value="">분류를 선택해주세요.</option>
			<?=$category_option?>
		</select>
	</td>
</tr>
<?php } ?>
<tr>
	<th>내용<em></em></th>
	<td>
        <? if ($is_dhtml_editor) { ?>
            <?=cheditor2('wr_content', $content);?>
        <? } else { ?>
        <textarea id="wr_content" name="wr_content" class=tx style='width:95%; word-break:break-all;' rows=5 itemname="내용" required 
        <? if ($write_min || $write_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?>><?=$content?></textarea>
        <? if ($write_min || $write_max) { ?><script type="text/javascript"> check_byte('wr_content', 'char_count'); </script><?}?>
        <? } ?>
    </td>
</tr>
<? 
$option = "";
$option_hidden = "";
if ($is_notice || $is_html || $is_secret || $is_mail) { 
    $option = "";
    if ($is_notice) { 
        #$option .= "<input type=checkbox name=notice value='1' $notice_checked>공지&nbsp;";
    }

    if ($is_html) {
        if ($is_dhtml_editor) {
            $option_hidden .= "<input type=hidden value='html1' name='html'>";
        } else {
            #$option .= "<input onclick='html_auto_br(this);' type=checkbox value='$html_value' name='html' $html_checked><span class=w_title>html</span>&nbsp;";
        }
    }
    if ($is_secret) {
        if ($is_admin || $is_secret==1) {
            #$option .= "<input type=checkbox value='secret' name='secret' $secret_checked><span class=w_title>비밀글</span>&nbsp;";
        } else {
            #$option_hidden .= "<input type=hidden value='secret' name='secret'>";
        }
    }
    if ($is_mail) {
        #$option .= "<input type=checkbox value='mail' name='mail' $recv_email_checked>답변메일받기&nbsp;";
    }
}

echo $option_hidden;
if ($option) {
?>
<tr>
    <th>옵 션</td>
    <td colspan="3"><?=$option?></td>
</tr>
<? } ?>
<? if ($is_file) { 
	for ($i=0; $i<(int)$board['bo_upload_count']; $i++) { ?>
<tr>
	<th>사진 #<?= ($i+1) ?><em></em></th>
	<td>
		<input type="file" class="" name="bf_file[]" style="width:90%;line-height:1em" title="파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능">
		<? 
		if ($file[$i]['source']) { 
			echo "<input type=\"checkbox\" name=\"bf_file_del[{$i}]\" value=\"1\"> <a href='{$file[$i][href]}'>{$file[$i][source]}({$file[$i][size]})</a> 파일 삭제";
		}
		?>
	</td>
</tr>
<?php
	}
	echo "<tr><th></th><td>더 많은 사진은 PC에서 업로드 가능합니다.</td></tr>";
} 
?>
<!-- <tr>
	<th>상담형태</th>
	<td>
		<?php
		$tmp = array('전화상담', '카카오톡', '문자상담');
		foreach ($tmp as $val) {
			echo "<label style='display:block;'><input type='checkbox' name='wr_7[]' value='{$val}'> {$val}</label> ";
		}
		?>
	</td>
</tr> -->
<? if (!$is_member) { ?>
<tr>
	<th>비밀번호<em></em></th>
	<td>
		<? if ($is_password) { ?>
		<input type="password" name="wr_password" class="ed" size="20" itemname="패스워드" <?=$password_required?>>
		<? } ?>
		<?
		if ($is_secret) {
			if ($is_admin || $is_secret==1) {
	            echo "<input type=checkbox value='secret' name='secret' id='secret' $secret_checked><label for='secret'> 비밀글</label>&nbsp;";
		    } else {
			    echo "<input type=hidden value='secret' name='secret'>";
	        }
	    }
		?>
	</td>
</tr>
<? } ?>
<? if ($is_guest && $recaptcha['use']) { ?>
<tr>
    <th>&nbsp;</th>
    <td>
        <div id="g-recaptcha"></div>
    </td>
</tr>
<? } else if ($is_guest) { ?>
<tr>
	<th>자동등록방지</th>
	<td><img id='kcaptcha_image' style="display:block;margin-bottom:5px" /><input class='ed' type=input size=10 name=wr_key itemname="자동등록방지" required>&nbsp;&nbsp;왼쪽의 글자를 입력하세요.</td>
</tr>
<? } ?>
</table>


<div class="board_button" style="text-align: right">
	<button type="submit" class="btn orange" accesskey='s' id="btn_submit">확인</button>
	<a href="board.php?bo_table=<?=$bo_table?>" class="cancel">취소</a>
</div>

	
</form>
</div>

<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
<?
// 관리자라면 분류 선택에 '공지' 옵션을 추가함
/*
if ($is_admin) 
{
    echo "
    if (typeof(document.fwrite.ca_name) != 'undefined')
    {
        document.fwrite.ca_name.options.length += 1;
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].value = '공지';
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].text = '공지';
    }";
} 
*/
?>

with (document.fwrite) 
{
	/*
    if (typeof(wr_name) != "undefined")
        wr_name.focus();
    else if (typeof(wr_subject) != "undefined")
        wr_subject.focus();
    else if (typeof(wr_content) != "undefined")
        wr_content.focus();
	*/

    if (typeof(ca_name) != "undefined")
        if (w.value == "u")
            ca_name.value = "<?=$write[ca_name]?>";
}

function html_auto_br(obj) 
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f) 
{
	if (!$('#agree').prop('checked')) {
		alert('개인정보취급방침에 동의해주세요');
		$('#agree').focus();
		return false;
	}

	/*
	f.elements['wr_2'].value = f.elements['hp1'].value + '-' + f.elements['hp2'].value + '-' + f.elements['hp3'].value;
	if (f.elements['wr_2'].value.length > 5) {
		var pattern = /^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/;
		if(!pattern.test(f.elements['wr_2'].value)){
			alert("SMS 를 받으시려면 올바른 전화번호를 입력하세요.");
			f.elements['hp1'].focus();
			return false;
		}
	}
	*/
	if (f.elements['wr_2'].value) {
		f.elements['wr_2'].value = f.elements['wr_2'].value.replace(/-/g, '');
		var tmp = f.elements['wr_2'].value.replace(/([0-9]{3})([0-9]{3,4})([0-9]{4})/, '$1-$2-$3');
		var pattern = /^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/;
		if(!pattern.test(tmp)){
			alert("상담을 받으시려면 올바른 전화번호를 입력하세요.");
			f.elements['wr_2'].focus();
			return false;
		}
		f.elements['wr_2'].value = tmp;
	}
	

    if (document.getElementById('char_count')) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(document.getElementById('char_count').innerHTML);
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            } 
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }

    if (document.getElementById('tx_wr_content')) {
        if (!ed_wr_content.outputBodyText()) { 
            alert('내용을 입력하십시오.'); 
            ed_wr_content.returnFalse();
            return false;
        }
    }

    <?
    if ($is_dhtml_editor) echo cheditor3('wr_content');
    ?>

    var subject = "";
    var content = "";
    $.ajax({
        url: "<?=$board_skin_path?>/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined") 
            ed_wr_content.returnFalse();
        else 
            f.wr_content.focus();
        return false;
    }

    if (f.elements['g-recaptcha-response'] && f.elements['g-recaptcha-response'].value == '') {
        alert('자동등록방지를 확인해 주십시오');
        return false;
    }

    if (f.wr_key && !check_kcaptcha(f.wr_key)) {
        return false;
    }

	document.getElementById('btn_submit').disabled = true;
    //document.getElementById('btn_list').disabled = true;

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/write_update.php';";
    else
        echo "f.action = './write_update.php';";
    ?>
    
    return true;
}
$(function () {
	$('#wr_email3').change(function () {
		if ( this.value == '-1' ) {
			$('#wr_email2').val('').prop('type', 'text').focus();
		}
		else {
			$('#wr_email2').val( this.value ).prop('type', 'hidden');
		}
	});
});
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
