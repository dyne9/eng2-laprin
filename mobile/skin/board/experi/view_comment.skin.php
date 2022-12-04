<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

?>
<style type="text/css">
#commentContents { background: #fff }
</style>
<script type="text/javascript">
// 글자수 제한
var char_min = parseInt(<?=$comment_min?>); // 최소
var char_max = parseInt(<?=$comment_max?>); // 최대
</script>

<? if ($cwin==1) { ?><table width=100% cellpadding=10 align=center><tr><td><?}?>

<!-- 코멘트 리스트 -->
<div id="commentContents">
<?
for ($i=0; $i<count($list); $i++) {
    $comment_id = $list[$i][wr_id];
?>
<a name="c_<?=$comment_id?>"></a>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
    <td><? for ($k=0; $k<strlen($list[$i][wr_comment_reply]); $k++) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td>
    <td width='100%'>

        <table border=0 cellpadding=0 cellspacing=0 width=100%>
        <tr>
            <td height=1 colspan=3 style="background:#ddd"><td>
        </tr>
        <tr>
            <td height=1 colspan=3></td>
        </tr>
        <tr>
            <td valign=top>
                <div style="height:35px; border-bottom: 1px dotted #C0C0C0; clear:both; line-height:28px;">
					<div style="float:left; margin:3px 0 0 10px;">
						<strong><?= $list[$i]['name'] ?></strong>
		                <span style="color:#888888; font-size:11px;"><?=$list[$i][datetime]?></span>
					</div>
					<div style="float:right;margin-top:3px">
				        <? if ($list[$i][is_reply]) { echo "<a href=\"#\" onclick=\"return comment_box('{$comment_id}', 'c');\">[답변]</a> "; } ?>
						<? if ($list[$i][is_edit]) { echo "<a href=\"#\" onclick=\"return comment_box('{$comment_id}', 'cu');\">[수정]</a> "; } ?>
		                <? if ($list[$i][is_del])  { echo "<a href=\"#\" onclick=\"return comment_delete('{$list[$i][del_link]}');\">[삭제]</a> "; } ?>	
					</div>
                </div>

                <!-- 코멘트 출력 -->
                <div style='line-height:20px; padding:7px 7px 7px 10px; word-break:break-all; overflow:hidden; clear:both; '>
                <?
                if (strstr($list[$i][wr_option], "secret")) echo "<span style='color:#ff6600;'>*</span> ";
                $str = $list[$i][content];
                if (strstr($list[$i][wr_option], "secret"))
                    $str = "<span class='small' style='color:#ff6600;'>$str</span>";

                $str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
                // FLASH XSS 공격에 의해 주석 처리 - 110406
                //$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(swf)\".*\<\/a\>\]/i", "<script>doc_write(flash_movie('$1://$2.$3'));</script>", $str);
                $str = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);' border='0'>", $str);
                echo $str;
                ?>
                </div>
                <? if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?>
                <span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
                <span id='reply_<?=$comment_id?>' style='display:none;'></span><!-- 답변 -->
                </div>
                <input type=hidden id='secret_comment_<?=$comment_id?>' value="<?=strstr($list[$i][wr_option],"secret")?>">
                <textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?=get_text($list[$i][content1], 0)?></textarea></td>
        </tr>
        <tr>
            <td height=5 colspan=3></td>
        </tr>
        </table>

    </td>
</tr>
</table>
<? } ?>
</div>
<!-- 코멘트 리스트 -->

<? if ($is_comment_write) { ?>
<!-- 코멘트 입력 -->
<div id=comment_write style="display:none;">
<table width=100% border=0 cellpadding=1 cellspacing=0 style="background:#dddddd"><tr><td>
<form name="fviewcomment" method="post" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off" style="margin:0px;">
<input type=hidden name=w           id=w value='c'>
<input type=hidden name=bo_table    value='<?=$bo_table?>'>
<input type=hidden name=wr_id       value='<?=$wr_id?>'>
<input type=hidden name=comment_id  id='comment_id' value=''>
<input type=hidden name=sca         value='<?=$sca?>' >
<input type=hidden name=sfl         value='<?=$sfl?>' >
<input type=hidden name=stx         value='<?=$stx?>'>
<input type=hidden name=spt         value='<?=$spt?>'>
<input type=hidden name=page        value='<?=$page?>'>
<input type=hidden name=cwin        value='<?=$cwin?>'>
<input type=hidden name=is_good     value=''>

<table width=100% cellpadding=3 height=156 cellspacing=0 style="border:1px solid #fff; background:url(<?=$board_skin_path?>/img/co_bg.gif) repeat #fff;">
<tr>
    <td colspan="2" style="padding:5px 0 0 5px;">
		<?/*
        <span style="cursor: pointer;" onclick="textarea_decrease('wr_content', 8);"><img src="<?=$board_skin_path?>/img/co_btn_up.gif" border='0'></span>
        <span style="cursor: pointer;" onclick="textarea_original('wr_content', 8);"><img src="<?=$board_skin_path?>/img/co_btn_init.gif" border='0'></span>
        <span style="cursor: pointer;" onclick="textarea_increase('wr_content', 8);"><img src="<?=$board_skin_path?>/img/co_btn_down.gif" border='0'></span>
		*/?>
        <? if ($is_guest) { ?>
            이름 <INPUT type=text maxLength=20 size=10 name="wr_name" itemname="이름" required class=ed>
            패스워드 <INPUT type=password maxLength=20 size=10 name="wr_password" itemname="패스워드" required class=ed>
            <img id='kcaptcha_image' />
            <input title="왼쪽의 글자를 입력하세요." type="input" name="wr_key" size="10" itemname="자동등록방지" required class=ed>
        <? } ?>
		<!--
        <input type=checkbox id="wr_secret" name="wr_secret" value="secret">비밀글
		-->
        <? if ($comment_min || $comment_max) { ?><span id=char_count></span>글자<?}?>
    </td>
</tr>
<tr>
    <td>
        <textarea id="wr_content" name="wr_content" rows=8 itemname="내용" required
        <? if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?> style='width:98%; word-break:break-all;' class=tx></textarea>
        <? if ($comment_min || $comment_max) { ?><script type="text/javascript"> check_byte('wr_content', 'char_count'); </script><?}?>
    </td>
</tr>
<tr>
    <td>
		<button type="submit" class="ed" value="댓글입력" accesskey='s' style="display:block;width:100%;background:#666;color:#fff;padding:5px 0">댓글 입력</button>
    </td>
</tr>
</table>
</form>
</td></tr></table>
</div>

<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;

function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    /*
    var s;
    if (s = word_filter_check(document.getElementById('wr_content').value))
    {
        alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
        document.getElementById('wr_content').focus();
        return false;
    }
    */

    var subject = "";
    var content = "";
    $.ajax({
        url: "<?=$board_skin_path?>/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
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

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("코멘트는 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("코멘트는 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("코멘트를 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('패스워드가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    return true;
}

/*
jQuery.fn.extend({
    kcaptcha_load: function() {
        $.ajax({
            type: 'POST',
            url: g4_path+'/'+g4_bbs+'/kcaptcha_session.php',
            cache: false,
            async: false,
            success: function(text) {
                $('#kcaptcha_image')
                    .attr('src', g4_path+'/'+g4_bbs+'/kcaptcha_image.php?t=' + (new Date).getTime())
                    .css('cursor', '')
                    .attr('title', '');
                md5_norobot_key = text;
            }
        });
    }
});
*/

function comment_box(comment_id, work)
{
    var el_id;
    // 코멘트 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'comment_write';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 코멘트 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
			if (document.getElementById('wr_secret')) {
	            if (document.getElementById('secret_comment_'+comment_id).value)
	                document.getElementById('wr_secret').checked = true;
	            else
	                document.getElementById('wr_secret').checked = false;
			}
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        save_before = el_id;
    }

    if (typeof(wrestInitialized) != 'undefined')
        wrestInitialized();

    //jQuery(this).kcaptcha_load();
    if (comment_id && work == 'c')
        $.kcaptcha_run();

	return false;
}

function comment_delete(url)
{
    if (confirm("이 코멘트를 삭제하시겠습니까?")) location.href = url;
	return false;
}

comment_box('', 'c'); // 코멘트 입력폼이 보이도록 처리하기위해서 추가 (root님)
</script>
<?php } else if ($board['bo_comment_level'] == '2') { ?>
<textarea name="" class="" style="width:98%" rows="8" placeholder="댓글 작성을 위해서는 로그인이 필요합니다." onclick="if (confirm('댓글 작성을 위해서는 로그인이 필요합니다.\n\n로그인창으로 이동하시겠습니까?'))document.location.href='/bbs/login.php?url=<?=$urlencode?>'"></textarea>
<?php } ?>

<? if($cwin==1) { ?></td><tr></table><p align=center><a href="javascript:window.close();"><img src="<?=$board_skin_path?>/img/btn_close.gif" border="0"></a><br><br><?}?>
<div style="height: 5px; background: #fff; border-bottom: 2px solid #393f4f"></div>