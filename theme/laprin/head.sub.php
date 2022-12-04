<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    $g5_head_title = $g5['title']; // 상태바에 표시될 제목
    $g5_head_title .= " | ".$config['cf_title'];
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

if (strpos($_SERVER['REQUEST_URI'], '/en/') !== false || strpos($_SERVER['REQUEST_URI'], '/cn/') !== false) {
	$tmp2 = $g5['title'];
	$seo = get_seo($pageIndex);
	$g5['title'] = $seo['title'] = $seo['subject'] = $tmp2;
}
else {
	$seo = get_seo($pageIndex);
}


// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<?php
if (G5_IS_MOBILE) {
    echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">'.PHP_EOL;
    echo '<meta name="HandheldFriendly" content="true">'.PHP_EOL;
    echo '<meta name="format-detection" content="telephone=no">'.PHP_EOL;
} else {
    echo '<meta http-equiv="imagetoolbar" content="no">'.PHP_EOL;
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">'.PHP_EOL;
}


if($config['cf_add_meta'])
    echo $config['cf_add_meta'].PHP_EOL;
?>
<meta name="content-language" content="kr">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta name="format-detection" content="telephone=no">

<meta name="robots" content="<?php echo $seo['robots']?>">
<meta name="Subject" content="<?php echo $seo['subject'] ?>">
<meta name="keywords" content="<?php echo $seo['keywords'] ?>">
<meta name="description" content="<?php echo $seo['description'] ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $seo['title'] ?>">
<meta property="og:description" content="<?php echo $seo['description'] ?>">
<meta property="og:image" content="<?php echo $seo['image'] ?>">
<meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>">
<meta name="naver-site-verification" content="<?php echo $config['cf_1'] ?>"/>
<link rel="canonical" href="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>">




<title><?php echo $g5_head_title; ?></title>

<link rel="stylesheet" href="<?php echo run_replace('head_css_url', G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE ? 'mobile' : 'default').'.css?ver='.G5_CSS_VER, G5_THEME_URL); ?>">
<!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->

<?php
if (G5_IS_MOBILE) {
?>
	<link rel="stylesheet" href="http://cdn.jsdelivr.net/font-nanum/1.0/nanumbarungothic/nanumbarungothic.css" type="text/css" />

	<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL;?>/mobile.style.css?ver=4" type="text/css">
	<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL;?>/owl.carousel.min.css" />
	<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
	<?php if(defined('_INDEX_')) { ?>
	<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL;?>/mobile_index.css" type="text/css">
	
	<?php } ?>
<?php } else { ?>	
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo G5_THEME_CSS_URL;?>/slick.css">
	<link rel="stylesheet" type="text/css" href="<?php echo G5_THEME_CSS_URL;?>/common.css">
	<?php if(defined('_INDEX_')) { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo G5_THEME_CSS_URL;?>/main.css?01">
	<link rel="stylesheet" type="text/css" href="<?php echo G5_THEME_CSS_URL;?>/owl.carousel.min.css">
	<?php } else { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo G5_THEME_CSS_URL;?>/sub.css">
	<?php } ?>
	<link rel="stylesheet" type="text/css" href="<?php echo G5_THEME_CSS_URL;?>/board.css">
	<!--[if lte IE 8]>
	<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
	<![endif]-->

<?php } ?>
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
</script>

<?php
// filemtime(G5_THEME_PATH.'/css/style.css')
//	add_javascript('<script src="'.G5_THEME_URL.'/js/jquery.js"></script>', 0);
	add_javascript('<script src="'.G5_JS_URL.'/jquery-1.12.4.min.js"></script>', 0);
	add_javascript('<script src="'.G5_JS_URL.'/jquery-migrate-1.4.1.min.js"></script>', 0);
	// add_javascript('<script src="'.G5_JS_URL.'/jquery.menu.js?ver='.G5_JS_VER.'"></script>', 0);
	add_javascript('<script src="'.G5_JS_URL.'/common.js?ver='.G5_JS_VER.'"></script>', 0);
	add_javascript('<script src="'.G5_JS_URL.'/wrest.js?ver='.G5_JS_VER.'"></script>', 0);
	add_javascript('<script src="'.G5_JS_URL.'/placeholders.min.js"></script>', 0);
	

	add_javascript('<script src="'.G5_THEME_URL.'/js/respond.min.js?ver='.G5_JS_VER.'"></script>', 0);

if(G5_IS_MOBILE) {
    	add_javascript('<script src="'.G5_THEME_URL.'/js/mobile.common.js?ver='.G5_JS_VER.'"></script>', 0);
    	add_javascript('<script type="text/javascript" src="'.G5_THEME_URL.'/js/owl.carousel.min.js"></script>', 0);
    	add_javascript('<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>', 1); // overflow scroll 감지

} else {
		add_javascript('<script src="'.G5_THEME_URL.'/js/common.js?ver2='.G5_JS_VER.'"></script>', 0);
		add_javascript('<script src="'.G5_THEME_URL.'/js/slick.js?ver='.G5_JS_VER.'"></script>', 0);
}
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/font-awesome/css/font-awesome.min.css">', 0);	
if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
?>
<?php /*
	<script type="text/javascript" src="<?php echo G5_THEME_URL;?>/js/mobile.common.js"></script>
	<script type="text/javascript" src="<?php echo G5_THEME_URL;?>/js/owl.carousel.min.js"></script>
*/ ?>	
</head>
<?php if (G5_IS_MOBILE) { ?>
	<body topmargin="0" leftmargin="0" <?=isset($g4['body_script']) ? $g4['body_script'] : "";?> class="menu<?=substr($pageIndex,0,3)?> menu<?=substr($pageIndex,0,6)?> menu<?=$pageIndex?>">
<?php } else { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?>  id="<?=!$pageIndex?'main':'sub'?>" topmargin="0" leftmargin="0" <?=isset($g4['body_script']) ? $g4['body_script'] : "";?> class="menu<?=substr($pageIndex,0,3)?> menu<?=substr($pageIndex,0,6)?> menu<?=substr($pageIndex,0,9)?> menu<?=$pageIndex?>">
<?php } ?>	
<?php
if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
    $sr_admin_msg = '';
    if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
    else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
    else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";

    echo '<div id="hd_login_msg">'.$sr_admin_msg.get_text($member['mb_nick']).'님 로그인 중 ';
    echo '<a href="'.G5_BBS_URL.'/logout.php">로그아웃</a></div>';
}
?>