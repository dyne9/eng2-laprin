<article id="m<?=$pageIndex?>">
	<div data-aos="fade-up" data-aos-once="true">
		<img src="/img/mobile/17/3-1.png" alt="" class="w100">
	</div>
	<div class="w94 image-wrap">
		<img src="/img/mobile/17/3/b1.jpg" alt="" class="w100" id="big-img" />
		<ul>
			<li><a href="#B1" class="on"><span><strong>B1</strong> Aseptic operating room /<br>Stem cell extraction room<br>/ Recovery room</span><i></i></a></li>
			<li><a href="#1F"><span><strong>1F</strong> Information Desk /<br>Consultation Room /<br>Waiting Room / Cafe</span><i></i></a></li>
			<li><a href="#6F"><span><strong>6F</strong> Dermatology / Gynecology /<br>Administration / Laser Treatement</span><i></i></a></li>
			<li><a href="#7F"><span><strong>7F</strong> Skin care room</span><i></i></a></li>
		</ul>
		
	</div>
	<div class="w94"><div id="image-list"></div></div>
</article>




<script>
$(function () {
	$('.image-wrap a').on('click', function () {
		$(this).closest('ul').find('a').removeClass('on');
		$(this).addClass('on');
		var str = '';
		$('#image-list *').remove();
		if ( $(this).attr('href') == '#B1' ) {
			$('#big-img').attr('src', '/img/mobile/17/3/b1.jpg');
			$('#image-list').append('<div class="floor-text"><span>B1</span></div>');
			for (var i=1; i<=7; i++) {
				str += '<li><img src="/img/mobile/17/3/b1-' + i.toString() + '.jpg"></li>';
			}
			str = '<ul>' + str + '</ul>';
			$('#image-list').append(str);
		}
		else if ( $(this).attr('href') == '#1F' ) {
			$('#big-img').attr('src', '/img/mobile/17/3/1f.jpg');
			$('#image-list').append('<div class="floor-text"><span>1F</span></div>');
			for (var i=1; i<=7; i++) {
				str += '<li><img src="/img/mobile/17/3/1f-' + i.toString() + '.jpg"></li>';
			}
			str = '<ul>' + str + '</ul>';
			$('#image-list').append(str);
		}
		else if ( $(this).attr('href') == '#6F' ) {
			$('#big-img').attr('src', '/img/mobile/17/3/6f.jpg');
			$('#image-list').append('<div class="floor-text"><span>6F</span></div>');
			for (var i=1; i<=7; i++) {
				str += '<li><img src="/img/mobile/17/3/6f-' + i.toString() + '.jpg"></li>';
			}
			str = '<ul>' + str + '</ul>';
			$('#image-list').append(str);
		}
		else if ( $(this).attr('href') == '#7F' ) {
			$('#big-img').attr('src', '/img/mobile/17/3/7f.jpg');
			$('#image-list').append('<div class="floor-text"><span>7F</span></div>');
			for (var i=1; i<=5; i++) {
				str += '<li><img src="/img/mobile/17/3/7f-' + i.toString() + '.jpg"></li>';
			}
			str = '<ul>' + str + '</ul>';
			$('#image-list').append(str);
		}
		return false;
	}).eq(0).trigger('click');
});
</script>