<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
if ($search_href) $list_href = $search_href;

#$tmp = unserialize(urldecode($view['wr_content'])); $write = array_merge($view, $tmp);
?>


<div id="view-content">
	<?php
	if ($view['wr_link1']) echo "<iframe src=\"{$view['wr_link1']}\" frameborder=\"no\" scrolling=\"no\" title=\"NaverVideo\" allow=\"autoplay; gyroscope; accelerometer; encrypted-media\" allowfullscreen></iframe>";

	echo $view['content'];
	?>
</div>
