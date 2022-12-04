<?php
###########################################################
####### hid, 값이 변하므로 $_hid 를 받아둔다 (ie) #########
###########################################################
$hid = $_hid;


// 회원가입,글쓰기 메일 도메인 selectbox
$_email_domain = array();
$_email_domain[] = array('naver.com', 'naver.com');
$_email_domain[] = array('hanmail.net', 'hanmail.net');
$_email_domain[] = array('nate.com', 'nate.com');
$_email_domain[] = array('daum.net', 'daum.net');
$_email_domain[] = array('gmail.com', 'gmail.com');
$_email_domain[] = array('paran.com', 'paran.com');
$_email_domain[] = array('hotmail.com', 'hotmail.com');
$_email_domain[] = array('-1',          'etc');

$_area_gubn = array('서울특별시', '경기도', '충청북도', '충청남도', '강원도', '경상북도', '경상남도', '전라북도', '전라남도', '제주도', '광주광역시', '대구광역시', '대전광역시', '울산광역시', '인천광역시', '부산광역시');

$_age_gubn = array('10대', '20대', '30대', '40대', '50대', '60대', '70대', '80대', '90대 이상');




function get_category_option2($bo_table='')
{
	global $g5;

	$board = sql_fetch("SELECT * FROM {$g5['board_table']} WHERE bo_table = '{$bo_table}' ");

    $arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음
    $str = "";
    for ($i=0; $i<count($arr); $i++)
        if (trim($arr[$i]))
            $str .= "<option value='$arr[$i]'>$arr[$i]</option>\n";

    return $str;
}

function alert_popup_close($msg) {
	global $g5;
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$g5[charset]\">";
	echo "<script type='text/javascript'>alert('$msg');";
	echo "try { parent.popup_close() } catch (e) {history.back()} ";
	echo "</script>";
	exit;
}
function goto_url_parent($url)
{
	global $g5;
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$g5[charset]\">";
    echo "<script type='text/javascript'>top.location.replace('$url'); </script>";
    exit;
}

function conv_webutf($text){
	$text = iconv('UTF-8', 'UTF-16LE', $text);
	$cnt = strlen($text);
	$dec = 0;
	for($i = 0; $i < $cnt; $i ++) {
		$hex = pow(2, 8 * $i);
		$dec += ord($text[$i]) * $hex;
	}

	return $dec;
}

function josa($str, $tail1, $tail2) {
	$text = $str;
	preg_match('/.$/u', $text, $temp);
	return ((conv_webutf($temp[0]) - 16) % 28 != 0) ? $str.$tail1 : $str.$tail2;
}



$basic_skin_path = "{$g5['path']}/skin/board/basic";



function get_paging_mobile($write_pages, $cur_page, $total_page, $url, $add="")
{
	if ($total_page < 2) return '';
    $str = "";
    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) {
		$str .= "<a href='" . $url . ($start_page-1) . "{$add}' class='btn_page'><span class='img_sample ico_prev'>이전페이지</span></a>&nbsp;";
	}
	else {
		$str .= '<span class="btn_page"><span class="img_sample ico_prev">이전페이지 없음</span></span>';
	}
	

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= "<a href='$url$k{$add}' class='link_page'>{$k}</a>";
            else
				$str .= "<span class='screen_out'>현재페이지</span><em class='link_page'>{$k}</em>";    
        }
    }

    if ($total_page > $end_page) {
		$str .= "<a href='" . $url . ($end_page+1) . "{$add}' class='btn_page'><span class='img_sample ico_next'>다음페이지</span></a>";
	}
	else {
		$str .= '<span class="btn_page"><span class="img_sample ico_next">다음페이지</span></span>';
	}

    $str .= "";

    return $str;
}

/************* 모바일 버전 대응 ****************
if (!isset($_SESSION['is_mobile'])) {
	require_once (G5_PATH.'/lib/Mobile_Detect.php');
	$detect = new Mobile_Detect;
	$_SESSION['is_mobile'] = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	#$_SESSION['view_type'] = $_SESSION['is_mobile'] == 'computer' ? '' : 'mobile';
	$_SESSION['device'] = $_SESSION['is_mobile'] == 'phone' ? 'mobile' : '';
}

if (strpos($_SERVER['HTTP_HOST'], 'm.') !== false) $g5['device'] = 'mobile';

if ($_GET['device'] == 'pc') $_SESSION['device'] = '';
else if ($_GET['device'] == 'mobile') $_SESSION['device'] = 'mobile';

$g5['device'] = $_SESSION['device'];

**/

// else if ($_GET['device_view'] == 'mobile' && $_SESSION['is_mobile'] != 'computer') $_SESSION['view_type'] = 'mobile';



//if ($_SERVER['REMOTE_ADDR'] == '121.54.224.200') {	$g5['view_type'] = 'mobile';}



$sitemap = array(
	'110'=> array(
		array('110100', 'Breast'),
		array('110101', 'Active-Subfascial Breast Implant'),
		array('110102', 'Microthane Breast Implant'),
		array('110103', 'Stem Cell Fat Grafting'),
		array('110104', 'Revision Surgery')
	),
	'120'=> array(
		array('120100', 'Body'),
		array('120101', 'Large Volume Liposuction'),
		array('120102', 'Sectional Liposuction'),
		array('120103', 'Revision Liposuction')
	),
	'130'=> array(
		array('130100', 'Facial'),
		array('130101', 'Canthoplasty'),
		array('130102', 'Double Eyelid'),
		array('130103', 'Dark Circle'),
		array('130104', 'Upper/Lower Blepharoplasty'),
		array('130105', 'Revision Eye Surgery'),
		array('130106', 'Nose Tip Rhinoplasty'),
		array('130107', 'No Scar Bulbos Nose Relocation'),
		array('130108', 'Soft Mesh Rhinoplasty'),
		array('130109', 'Revision Rhinoplasty'),
		array('130110', 'Power V Liposuction'),
		array('130111', 'Nano Fat Grafting'),
		array('130112', 'MACS Lifting')
	),
	'140'=> array(
		array('140100', 'Stem Cell'),
		array('140101', 'About Stem Cell'),
		array('140102', 'Stem cell Treatment'),
		array('140103', 'Stem Cell Rejuvenation')
	),
	'150'=> array(
		array('150100', 'Aesthetics'),
		array('150101', 'Filler & Botox'),
		array('150102', 'Lifting'),
		array('150103', 'Brightening'),
		array('150104', 'Scar & Pore Treatment')
	),
	'160'=> array(
		array('160100', 'Women\'s Clinic'),
		array('160101', 'Non-invasive Vaginal Tightening'),
		array('160102', '3D Labium Minora Sculpting')
		//array('160103', 'Cervical Cancer Injection')
	),
	'170'=> array(
		array('170100', 'LaPrin'),
		array('170101', 'Medical Staff'),
		array('170102', 'LaPrin\'s Story'),
		array('170103', 'LaPrin Tour'),
		array('170104', 'Operation & Direction')
	),
	'180'=> array(
		array('180100', 'Testimonials'),
		array('180101', 'Before & After',				'/before_after'),
		array('180102', 'Real-Story Pictures',			'/real_story')
		/*array('180103', 'Real-Story Video',		'/laprin_media')*/
	),
	'190'=> array(
		array('190100', 'Consultation'),
		array('190101', 'Online Consultation',			'/counsel'),
		array('190102', 'Postoperative Consultation',	'/counsel2')
	)/*,
	'910'=> array(
		array('910000', '멤버쉽'),
		array('910110', '로그인',						'/bbs/login.php?url='.$urlencode),
		array('910120', '회원가입',						'/bbs/register_form.php'),
		array('910130', '회원정보찾기',					'/bbs/password_lost.php'),
		array('910140', '이용약관',						'/page/provision.php'),
		array('910150', '개인정보취급방침',				'/page/policy.php')
		//array('910160', '비급여진료비안내')
	),
	'920'=> array(
		array('920000', '멤버쉽'),
		array('920110', '로그아웃',						'/bbs/logout.php'),
		array('920120', '회원정보수정',					'/bbs/register_form.php?w=u'),
		array('920140', '이용약관',						'/page/provision.php'),
		array('920150', '개인정보취급방침',				'/page/policy.php')
	)*/
);

if (G5_IS_MOBILE)  {
}


foreach ($sitemap as $key=>$val) {
	foreach ($val as $key2=>$val2) {
		$depth_3 = false;
		if (isset($val2[3]) && is_array($val2[3])) {
			$depth_3 = true;
			foreach ($val2[3] as $key3=>$val3) {
				if (isset($val3[2]) && !is_null($val3[2])) $link = $val3[2];
				//else $link = "/page.php?hid=".str_replace(' ', '', $val3[1]);
				else $link = "/page.php";

				if (strpos($link, '?') === false) $link .= "?pageIndex={$val3[0]}";
				else $link .= "&pageIndex={$val3[0]}";

				$sitemap[$key][$key2][3][$key3][2] = $link;


				$depth_4 = false;
				if (isset($val3[3]) && is_array($val3[3])) {
					$depth_4 = true;
					foreach ($val3[3] as $key4=>$val4) {
						if (isset($val4[2]) && !is_null($val4[2])) $link = $val4[2];
						//else $link = "/page.php?hid=".str_replace(' ', '', $val4[1]);
						else $link = "/page.php";

						if (strpos($link, '?') === false) $link .= "?pageIndex={$val4[0]}";
						else $link .= "&pageIndex={$val4[0]}";

						$sitemap[$key][$key2][3][$key3][3][$key4][2] = $link;
					}

					if ($depth_4 && (!isset($val3[2]) || is_null($val3[2]))) $sitemap[$key][$key2][3][$key3][2] = $sitemap[$key][$key2][3][$key3][3][0][2];
				}
			}
			if ($depth_3 && (!isset($val2[2]) || is_null($val2[2]))) $sitemap[$key][$key2][2] = $sitemap[$key][$key2][3][0][2];
		}
	}
}

foreach ($sitemap as $key=>$val) {
	foreach ($val as $key2=>$val2) {
		if ($key2 == 0) {
			$obj = $val[1];
			if (isset($val[1][3]) && is_array($val[1][3])) {
				$obj = $val[1][3][0];
			}
		}
		else $obj = $val2;

		if (isset($obj[2]) && !is_null($obj[2])) $link = $obj[2];
		//else $link = "/page.php?hid=".str_replace(' ', '', $obj[1]);
		else $link = "/page.php";

		if (strpos($link, 'pageIndex=') === false) {
			if (strpos($link, '?') === false) $link .= "?pageIndex={$obj[0]}";
			else $link .= "&pageIndex={$obj[0]}";
		}
		$sitemap[$key][$key2][2] = $link;
	}
}

$top_title = array();




/* 각 페이지마다 상단 이미지 */
if ($bo_table && !$pageIndex) {
	switch ($bo_table) {
		case 'before_after' :
			$pageIndex = '180101';

		break;
		case 'real_story' :
			$pageIndex = '180102';

		break;
		case 'laprin_media' :
			$pageIndex = '180103';

		break;
		case 'counsel' :
			$pageIndex = '190101';

		break;
		case 'counsel2' :
			$pageIndex = '190102';

		break;
	}
}

if ($bo_table) {
	switch ($bo_table) {
		case 'before_after' :
			$bo_title = 'Before &amp; After';
			$sub_title = "Explore our Before & After Gallery";
		break;
		case 'real_story' :
			$bo_title = 'Real-Story Pictures';
			$sub_title = "Explore our Real-Story Pictures Gallery";
		break;
		case 'laprin_media' :
			$bo_title = 'Real-Story Video';
			$sub_title = "Explore our Real-Story Video Gallery";
		break;
		case 'counsel' :
			$bo_title = 'Online Consultation';
			$sub_title = "Please leave an online inquiry and will respond quickly and kindly.";
		break;
		case 'counsel2' :
			$bo_title = 'Postoperative Consultation';
			$sub_title = "We will respond quickly and kindly.";
		break;
	}
}

if ($_SERVER['PHP_SELF'] == '/bbs/login.php') $pageIndex = '910110';


########### pageIndex 가 넘어오지 않을 경우 hid 명으로 탐색 #####################
if ($_SERVER['PHP_SELF'] != '/index.php' && (!isset($pageIndex) || empty($pageIndex)) && urldecode($_GET['hid'])) {
	$hid = urldecode($_GET['hid']);
	foreach ($sitemap as $key=>$val) {
		foreach ($val as $key2=>$val2) {
			if ($key2 == 0) continue;
			if (is_array($val2[3])) {
				$parse_url = parse_url($val2[2], PHP_URL_QUERY);
				preg_match('@hid=([^&]*)@', $parse_url, $tmpx);
				if ($tmpx[1] == $hid) {
					$pageIndex = $val2[0]; break 2;
				}
				foreach ($val2[3] as $key3=>$val3) {
					$parse_url = parse_url($val3[2], PHP_URL_QUERY);
					preg_match('@hid=([^&]*)@', $parse_url, $tmpx);
					if ($tmpx[1] == $hid) {
						$pageIndex = $val3[0]; break 3;
					}
				}
			}
			else {
				$parse_url = parse_url($val2[2], PHP_URL_QUERY);
				preg_match('@hid=([^&]*)@', $parse_url, $tmpx);
				if ($tmpx[1] == $hid) {
					$pageIndex = $val2[0]; break 2;
				}
			}
		}
	}
}

$current_page = $current_menu = array();
$current_page[] = 'HOME';
$current_menu[] = '';
if ($sitemap[substr($pageIndex, 0, 3)]) {
	$current_page[] = $sitemap[substr($pageIndex, 0, 3)][0][1];
	$current_menu[] = $sitemap[substr($pageIndex, 0, 3)];
	$g5['title'] = "{$current_page[1]}";
	foreach ($sitemap[substr($pageIndex, 0, 3)] as $val) {
		if ($val[0] == $pageIndex) {
			$current_page[] = $val[1];
			$current_menu[] = $sitemap[substr($pageIndex, 0, 3)];
			$g5['title'] = "{$current_page[2]}";
			break; 
		}
		else if ($val[0] == substr($pageIndex, 0, 6)) {
			$current_page[] = $val[1];
			$g5['title'] = "{$current_page[2]}";
			if (isset($val[3]) && is_array($val[3])) {
				$current_menu[] = $val[3];
				foreach ($val[3] as $val2) {
					if ($val2[0] == substr($pageIndex,0,9)) {
						$current_page[] = $val2[1];
						$g5['title'] = "{$current_page[3]}";
						if (isset($val2[3]) && is_array($val2[3])) {
							$current_menu[] = $val2[3];
							foreach ($val2[3] as $val3) {
								if ($val3[0] == $pageIndex) {
									$current_page[] = $val3[1];
									$g5['title'] = $current_page[4];
									break 3;
								}
							}
						}
						break;
					}
				}
			}
			break;
		}
	}
}
//echo '<xmp>';print_r ($current_menu);echo '</xmp>';exit;


# 게시판 헤더 파일을 교체시킨다. 
/*
if ($g5['view_type'] == 'mobile') {
	$basic_skin_path = "{$g5['path']}/skin/board/mobile.basic";
	//$board['bo_skin'] = 'tv';
	$board['bo_skin'] = "mobile.{$board['bo_skin']}";
	$board_skin_path = "{$g5['path']}/skin/board/{$board['bo_skin']}"; // 게시판 스킨 경로

	$board['bo_page_rows'] = 10;
	if ($bo_table == 'self_experi') {
	}
	else if ($bo_table == 'case') {
		#$board['bo_page_rows'] = 6;
		#$board['bo_subject_len'] = 100;
	}
	
}
*/

//$g5_mobile_path = "{$g5['path']}/mobile";


/*
$pc_mobile_match = array(
	array('/page/1_9.php',				'/mobile/page/1_1.php'),
	array('/page/1_2.php',				'/mobile/page/1_2.php'),
	array('/page/1_7.php',				'/mobile/page/1_3.php'),
	array('/page/1_8.php',				'/mobile/page/1_4.php'),
	array('/page/2_1.php',				'/mobile/page/2_1.php'),
	array('/page/2_2.php',				'/mobile/page/2_2.php'),
	array('/page/3_1.php',				'/mobile/page/3_1.php'),
	array('/page/3_2.php',				'/mobile/page/3_2.php'),
	array('/page/3_3.php',				'/mobile/page/3_3.php'),
	array('/page/3_4.php',				'/mobile/page/3_4.php'),
	array('/page/4_2.php',				'/mobile/page/4_1.php'),
	array('/page/4_3.php',				'/mobile/page/4_2.php'),
	array('/page/4_5.php',				'/mobile/page/4_3.php'),
	array('/page/5_1.php',				'/mobile/page/5_1.php'),
	array('/page/5_2.php',				'/mobile/page/5_2.php'),
	array('/page/5_3.php',				'/mobile/page/5_3.php'),
	array('/page/6_1.php',				'/mobile/page/6_1.php'),
	array('/page/6_2.php',				'/mobile/page/6_2.php'),
	array('/page/6_3.php',				'/mobile/page/6_3.php'),
	array('/page/6_4.php',				'/mobile/page/6_4.php')
);
*/
$pc_mobile_match = array();

/*
if ($g5['view_type'] == 'mobile' && strpos($_SERVER['PHP_SELF'], '/mobile/') === false && strpos($_SERVER['PHP_SELF'],'/bbs/') === false) {
	$furl = '';
	foreach ($pc_mobile_match as $val) {
		if ($_SERVER['PHP_SELF'] == $val[0]) {
			$furl = $val[1];
			break;
		}
	}
	// 찾는 파일 없으면 /mobile 로 시작하는 폴더에 파일 있는지 확인
	if (!$furl) {
		if (file_exists("../mobile{$_SERVER['PHP_SELF']}")) 
			$furl = "/mobile{$_SERVER['PHP_SELF']}";
	}
	if ($furl) {
		if ($_SERVER["QUERY_STRING"] != '') $furl .= "?".$_SERVER["QUERY_STRING"];
		header("Location: {$furl}");
		exit;
	}
	// 찾는 모바일 페이지 없으면 PC버전으로
	if (!$furl && strpos($_SERVER['PHP_SELF'], '/page/') === 0) $g5['view_type'] = '';
	// 모바일로 보기인데 매칭되는 파일 없으면 메인으로
	if ($_GET['device_view'] == 'mobile' && $bo_table) {
	}
	else if ($_GET['device_view'] == 'mobile' && $furl == '' && strpos($_SERVER['PHP_SELF'], '/mobile/index') === false) {
		header("Location: /mobile/?".$_SERVER["QUERY_STRING"]);
		exit;
	}
}
*/
/************* 모바일 버전 대응 *******************/



// head.sub.php 에 로딩할 css
$load_css = array();
// tail.sub.php 에 로딩할 js 파일
$load_js = array();

function ext_info_tag($gubn, $val, $val2 = null) {
	global $member;
	$row2 = sql_fetch("SELECT * FROM g4_ext_info WHERE gubn = '{$gubn}' ");
	$row2 = unserialize(base64_decode($row2['data']));
	if ($val != '' && $row2[$val] != '') {
		if ($gubn == 'conv_tag') {
			$row2[$val] = str_replace('{회원아이디}', $member['mb_id'], $row2[$val]);
			$row2[$val] = str_replace('{회원이름}', $member['mb_name'], $row2[$val]);
		}
		return $row2[$val];
	}
	else 
		$row2 = '';
	return $row2;
}







function tb_str($data) {
	$tb_str = ' 
	<table>
	<colgroup>
	<col width="" />
	<col width="13%" />
	<col width="13%" />
	<col width="13%" />
	<col width="13%" />
	<col width="13%" />
	<col width="13%" />
	<col width="13%" />
	</colgroup>
	<thead>
	<tr>
		<th scope="col">구분</th>
		<th scope="col">월</th>
		<th scope="col">화</th>
		<th scope="col">수</th>
		<th scope="col">목</th>
		<th scope="col">금</th>
		<th scope="col">토</th>
		<th scope="col">일</th>
	</tr>
	</thead>
	<tbody>';
	if (isset($data['a'])) {
		$tb_str .= '<tr><th scope="row">오전</th>';
		for ($i=0; $i<=6; $i++) {
			$str = $data['a'][$i];
			if ($str == '진료')
				$tb_str .= "<td class=\"col1\">{$str}</td>";
			else if ($str == '수술')
				$tb_str .= "<td class=\"col2\">{$str}</td>";
			else 
				$tb_str .= "<td>{$str}</td>";
		}
		$tb_str .= '</tr>';
		$tb_str .= '<tr><th scope="row">오후</th>';
		for ($i=0; $i<=6; $i++) {
			$str = $data['p'][$i];
			if ($str == '진료')
				$tb_str .= "<td class=\"col1\">{$str}</td>";
			else if ($str == '수술')
				$tb_str .= "<td class=\"col2\">{$str}</td>";
			else 
				$tb_str .= "<td>{$str}</td>";
		}
		$tb_str .= '</tr>';
	}
	else 
		return '';
	$tb_str .= '</tbody></table>';
	return $tb_str;
}




function doctor_schedule_color($str) {
	global $doctor_schedule;
	foreach ($doctor_schedule as $val) {
		if ($val[0] == $str) {
			return "<span style='color:{$val[1]}'>{$val[0]}</span>";
		}
	}
}

