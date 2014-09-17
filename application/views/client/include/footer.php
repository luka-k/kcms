    <section>
        <div class="contact clearfix" >
            <div class="wrap">
                <div class="content clearfix">
				
				<?require('top-menu.php')?>
						<div class="content">
							<form action="" id="form_3" method="post" class="js-form">
								<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/>
								<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/>
								<a href="#" class="btn-2" onClick="$('#form_3').submit();return false;">Получить консультацию</a>
							</form>
						</div>
					<div class="copyr">
						&copy; 2014<br/>
						<span style="color:#999">ремонт-гаража.рф</span>
					</div>
					<div class="riba">
						Made in <a href="http://www.ribaweb.ru" target="_blanc">RIBA</a>
					</div>
                </div>
            </div>
        </div>
    </section>
	
    <div id="callrequest" class="popup">
      
		<div class="popup-top">
			<div class="title">Заказать звонок</div>
		</div>
        <div id="overlay_form" class="popup-body clearfix">
            <form action="" id="formpopup" method="post" class="js-form">
				<div style="margin-bottom:20px;">
					<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/><br/>
					<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/><br/>
					<select id="time" name="time">
						<option value="9:00-12:00">9:00 - 12:00</option>
						<option value="12:00-15:00">12:00 - 15:00</option>
						<option value="15:00-18:00">15:00 - 18:00</option>
						<option value="18:00-21:00">18:00 - 21:00</option>
					</select>
				</div>
				<a href="" onclick="$('#formpopup').submit();return false;" class="btn-3">Отправить</a>
            </form>
        </div>
			
        </div>
        
    </div>
	
    <div id="vacancy-popup" class="popup">
		<div class="popup-top">
			<div class="title">Отправить резюме</div>
		</div>
        <div id="overlay_form" class="popup-body clearfix">
            <form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="formpopup-2" action="<?=base_url()?>pages/resume/" >
				<div style="margin-bottom:10px;">
					<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/><br/>
					<input type="text" name="email" data-id="email" placeholder="e-mail" data-necessarily="true"/><br/>
					<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/><br/>
				</div>
				<div class="file_upload clearfix">
					<a href="#" id="psevdoInput" class="upload">Загрузите резюме</a>
					<input id="psevdoFileValue" class="inputFileText" type="text"/>
					<input type="file" name="resume" accept="application/msword" onchange="document.getElementById('psevdoFileValue').value = this.value; document.getElementById('psevdoInput').style.display='none'"/>
				</div>
				<div style="margin-bottom:10px;">
					<textarea placeholder="Или напишите о себе" name="about"></textarea>
				</div>
				<a href="#" onclick="sub_form();" class="btn-3">Отправить</a>
            </form>
        </div>
    </div>	

</body>
</html>