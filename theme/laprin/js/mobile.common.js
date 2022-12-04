
//	document.write('<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">\x3C/script>');
	document.write('<script type="text/javascript" src="/theme/laprin/js/css_browser_selector.min.js">\x3C/script>');



function popup_open(popup, href) {
	popup_close();
	$('body').append('<div id="inner_bg"></div>');
	$('#inner_bg').height( $(document).height() );
	if (popup == undefined || popup == 'iframe') {
        var src = '';
		if (typeof href != 'undefined') src = href;
		$('#inner_bg').html('<div id="inner_bg_layer"><div id="inner_bg_frame_area"><iframe id="inner_iframe" name="inner_iframe" frameborder="0" border="0" scrolling="0" src="' + src + '"></iframe></div></div></div></div>');
	}
}
function popup_close() {
	$('#inner_bg').remove();
}
function bg_loading() {
	popup_close();
	$('body').append('<div id="inner_bg"></div>');
	$('#inner_bg').height( $(document).height() ).html('<img src="/img/ajax-loader.gif" style="position:fixed;left:50%;top:50%;margin-left:-50px">');
}


// html.nhncorp.com 본문바로가기
(function(){var a=navigator.userAgent.toLowerCase().indexOf("webkit")>-1,b=document;if(!a||!b.querySelectorAll)return;var c=function(a){var b=[],c=0;for(;c<a.length;++c){b.push(a[c])}return Array.prototype.slice.call(b,0)};window.addEventListener("load",function(){c(b.querySelectorAll("a#header_skip")).forEach(function(a){a.addEventListener("click",function(){var a=b.getElementById(this.href.split("#")[1]),c=a.getAttribute("tabindex"),e=b.defaultView.getComputedStyle(a,null).getPropertyValue("outline-width");a.setAttribute("tabindex",0);a.style.outlineWidth=0;a.focus();if(c===null)a.removeAttribute("tabindex");else a.setAttribute("tabindex",c)},false)})},false)})();



function imgProportion($targetWidth, $targetHeight)
{
	var DeviceWidth	= parseInt($(window).width()); //핸드폰의 가로 사이즈를 구합니다.
	var a1 		= DeviceWidth * $targetHeight; //이미지 세로사이즈 계산식
	var newHeight 	= (a1 / $targetWidth); //이미지 세로사이즈 계산식
	var rtnSize		= new Array((DeviceWidth), newHeight);  //리사이징 된 이미지 사이즈 리턴
	return rtnSize;
}

