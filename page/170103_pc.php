    <main id="container">
        <div class="laprin-about-tab">
            <div class="tab-title inner-box">
                <ul class="clearfix">
                    <li>
                        <a href="/page.php?pageIndex=170101" class="table">
                            <span class="table-cell">
                                Medical Staff
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/page.php?pageIndex=170102" class="table">
                            <span class="table-cell">
                                LaPrin's Story + Main Medical Devices
                            </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="/page.php?pageIndex=170103" class="table">
                            <span class="table-cell">
                                LaPrin Tour
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/page.php?pageIndex=170104" class="table">
                            <span class="table-cell">
                                Hours of Operation &amp; Direction
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="cont-area tour-area">
                <h2 class="cont-title fadeInTop">
                    Tour of LaPrin
                </h2>
                <p class="desc-box fadeInTop">
                    LaPrin promises to be warm, caring, and<br>
                    kind hospital that always thinks from the patient's point of view.
                </p>

                <section class="inner-box">
                    <div class="image-wrap fadeInTop">
                        <img src="./img/sub/menu7_tour_b1.jpg" alt="" id="big-img">
                        <ul class="clearfix">
                            <li>
                                <a href="#B1" class="on">
                                    <span>
                                        <strong>B1</strong>
                                        Aseptic operating room /<br>
                                        Stem cell extraction room /<br>
                                        Recovery room
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#1F">
                                    <span>
                                        <strong>1F</strong>
                                        Information Desk /<br>
                                        Consultation Room /<br>
                                        Waiting Room / Cafe
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#6F">
                                    <span>
                                        <strong>6F</strong>
                                        Dermatology / Gynecology /<br>
                                        Administration / Laser Treatement
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#7F">
                                    <span>
                                        <strong>7F</strong>
                                        Skin care room
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div id="image-list"></div>
                    <script type="text/javascript">
                        $(function () {
                            $('.image-wrap a').on('click', function () {
                                $(this).closest('ul').find('a').removeClass('on');
                                $(this).addClass('on');
                                var str = '';
                                $('#image-list *').remove();
                                if ( $(this).attr('href') == '#B1' ) {
                                    $('#big-img').attr('src', './img/sub/menu7_tour_b1.jpg');
                                    $('#image-list').append('<img src="./img/sub/menu7_tour_b1.png" alt="B1">');
                                    for (var i=1; i<=7; i++) {
                                        str += '<li><img src="./img/sub/menu7_tour_b1-' + i.toString() + '.jpg" alt=""></li>';
                                    }
                                    str = '<ul class="clearfix">' + str + '</ul>';
                                    $('#image-list').append(str);
                                }
                                else if ( $(this).attr('href') == '#1F' ) {
                                    $('#big-img').attr('src', './img/sub/menu7_tour_1f.jpg');
                                    $('#image-list').append('<img src="./img/sub/menu7_tour_1f.png" alt="1F">');
                                    for (var i=1; i<=7; i++) {
                                        str += '<li><img src="./img/sub/menu7_tour_1f-' + i.toString() + '.jpg" alt=""></li>';
                                    }
                                    str = '<ul class="clearfix">' + str + '</ul>';
                                    $('#image-list').append(str);
                                }
                                else if ( $(this).attr('href') == '#6F' ) {
                                    $('#big-img').attr('src', './img/sub/menu7_tour_6f.jpg');
                                    $('#image-list').append('<img src="./img/sub/menu7_tour_6f.png" alt="6F"">');
                                    for (var i=1; i<=7; i++) {
                                        str += '<li><img src="./img/sub/menu7_tour_6f-' + i.toString() + '.jpg" alt=""></li>';
                                    }
                                    str = '<ul class="clearfix">' + str + '</ul>';
                                    $('#image-list').append(str);
                                }
                                else if ( $(this).attr('href') == '#7F' ) {
                                    $('#big-img').attr('src', './img/sub/menu7_tour_7f.jpg');
                                    $('#image-list').append('<img src="./img/sub/menu7_tour_7f.png" alt="7F">');
                                    for (var i=1; i<=5; i++) {
                                        str += '<li><img src="./img/sub/menu7_tour_7f-' + i.toString() + '.jpg" alt=""></li>';
                                    }
                                    str = '<ul class="clearfix">' + str + '</ul>';
                                    $('#image-list').append(str);
                                }
                                return false;
                            }).eq(0).trigger('click');
                        });
                    </script>
                </section>
            </div>
        </div>
    </main>