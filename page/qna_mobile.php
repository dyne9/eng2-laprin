<style>
.cont-title {margin:45px 0 20px;text-align:center;font-weight:700;font-size:32px;display:block;line-height:1em}
.accordion-list {border-top:1px solid #9c9c9c;}
.accordion-list li {border-bottom:1px solid #9c9c9c;}
.accordion-list li .question-btn {position:relative;border:0;padding:0;padding:25px 10px 16px;width:100%;outline:0;background:transparent;}
.accordion-list li .question-btn .text {position:relative;display:block;padding-left:20px;line-height:1.4em;text-align:left;font-weight:700;color:#2b2b2b;}
.accordion-list li .question-btn .text .icon {position:absolute;left:0;top:0;font-style:normal}
.accordion-list li .answer-box {padding:15px 10px 37px;width:100%;display:none;}
.accordion-list li:first-child .answer-box {display:block;}
.accordion-list li .answer-box .text {position:relative;display:block;padding-left:20px;line-height:1.4em;font-weight:300;color:#2b2b2b;}
.accordion-list li .answer-box .text .icon {position:absolute;left:0;top:0;font-weight:700;font-style:normal}
</style>
		<section class="qna-accordion inner-box w94">
            <h2 class="cont-title fadeInTop">
                Q&amp;A
            </h2>
            <ul class="accordion-list fadeInTop">
                <li class="active">
                    <button type="button" class="question-btn">
                        <span class="text">
                            <i class="icon">Q.</i>
                            What is the difference of LaPrin’s subfacial breast augmentation compared to other hospital’s breast augmentation?
                        </span>
                    </button>
                    <p class="answer-box">
                        <span class="text">
                            <i class="icon">A.</i>
                            The subfacial breast augmentation is the most recent breast reconstruction method developed by Dr. Ruth Graf,<br>
                            the head of the Brazilian Breast Surgery, in 2004. It is the latest method of breast surgery that<br>
                            utilizes both the advantages of submammary implantation and intramusclar implantation.
                        </span>
                    </p>
                </li>
                <li>
                    <button type="button" class="question-btn">
                        <span class="text">
                            <i class="icon">Q.</i>
                            Why do you prefer subfacial surgery method in Laprin?
                        </span>
                    </button>
                    <p class="answer-box">
                        <span class="text">
                            <i class="icon">A.</i>
                            The subfacial breast augmentation is the most recent breast reconstruction method developed by Dr. Ruth Graf,<br>
                            the head of the Brazilian Breast Surgery, in 2004. It is the latest method of breast surgery that<br>
                            utilizes both the advantages of submammary implantation and intramusclar implantation.
                        </span>
                    </p>
                </li>
                <li>
                    <button type="button" class="question-btn">
                        <span class="text">
                            <i class="icon">Q.</i>
                            What determines natural soft texture of breast after surgery?
                        </span>
                    </button>
                    <p class="answer-box">
                        <span class="text">
                            <i class="icon">A.</i>
                            The subfacial breast augmentation is the most recent breast reconstruction method developed by Dr. Ruth Graf,<br>
                            the head of the Brazilian Breast Surgery, in 2004. It is the latest method of breast surgery that<br>
                            utilizes both the advantages of submammary implantation and intramusclar implantation.
                        </span>
                    </p>
                </li>
                <li>
                    <button type="button" class="question-btn">
                        <span class="text">
                            <i class="icon">Q.</i>
                            In other hospitals, why do they recommend to avoid heavy lifting or exercising for two months after the surgery?
                        </span>
                    </button>
                    <p class="answer-box">
                        <span class="text">
                            <i class="icon">A.</i>
                            The subfacial breast augmentation is the most recent breast reconstruction method developed by Dr. Ruth Graf,<br>
                            the head of the Brazilian Breast Surgery, in 2004. It is the latest method of breast surgery that<br>
                            utilizes both the advantages of submammary implantation and intramusclar implantation.
                        </span>
                    </p>
                </li>
                <li>
                    <button type="button" class="question-btn">
                        <span class="text">
                            <i class="icon">Q.</i>
                            People complain of severe pain after breast augmentation. Why is it so painful?
                        </span>
                    </button>
                    <p class="answer-box">
                        <span class="text">
                            <i class="icon">A.</i>
                            The subfacial breast augmentation is the most recent breast reconstruction method developed by Dr. Ruth Graf,<br>
                            the head of the Brazilian Breast Surgery, in 2004. It is the latest method of breast surgery that<br>
                            utilizes both the advantages of submammary implantation and intramusclar implantation.
                        </span>
                    </p>
                </li>
                <li>
                    <button type="button" class="question-btn">
                        <span class="text">
                            <i class="icon">Q.</i>
                            When I go to sauna, I can tell women who had breast surgery, why is that?
                        </span>
                    </button>
                    <p class="answer-box">
                        <span class="text">
                            <i class="icon">A.</i>
                            The subfacial breast augmentation is the most recent breast reconstruction method developed by Dr. Ruth Graf,<br>
                            the head of the Brazilian Breast Surgery, in 2004. It is the latest method of breast surgery that<br>
                            utilizes both the advantages of submammary implantation and intramusclar implantation.
                        </span>
                    </p>
                </li>
                <li>
                    <button type="button" class="question-btn">
                        <span class="text">
                            <i class="icon">Q.</i>
                            There are a lot of commercials for different types implants like Microtexture, motiva, and Bellagel Implants.<br>
                            Does implant material really affect the post-operative results?
                        </span>
                    </button>
                    <p class="answer-box">
                        <span class="text">
                            <i class="icon">A.</i>
                            The subfacial breast augmentation is the most recent breast reconstruction method developed by Dr. Ruth Graf,<br>
                            the head of the Brazilian Breast Surgery, in 2004. It is the latest method of breast surgery that<br>
                            utilizes both the advantages of submammary implantation and intramusclar implantation.
                        </span>
                    </p>
                </li>
            </ul>
        </section>

<script>
$(document).on('click','.accordion-list .question-btn',function() {
    var thisList = $(this).parent('li');
    if(thisList.hasClass('active')) {
        thisList.removeClass('active');
        $(this).siblings('.answer-box').slideUp(300);
    } else {
        thisList.siblings('li').removeClass('active');
        thisList.siblings('li').find('.answer-box').slideUp(300);

        thisList.addClass('active');
        $(this).siblings('.answer-box').slideDown(300);
    }
});
</script>