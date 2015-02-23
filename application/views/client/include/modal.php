<div class="modal" id="modal-gallery">
	<div class="modal__content">
		<a href="#close" class="modal__close">Закрыть</a>
		<a href="#callback" class="modal__ask ask"><span class="ask__text">Задать вопрос</span></a>
			
		<div class="modal__gallery" id="modal-gallery-frame"> </div> <!-- /.modal__gallery -->
	</div> <!-- /.modal__content -->
</div> <!-- /.modal -->

<div class="modal" id="success">
	<div class="modal__content">
		<a href="#close" class="modal__close">Закрыть</a>
		<div class="modal__title">
			Спасибо за оставленную заявку!
		</div> <!-- /.modal__title -->
		
		<div class="modal__text">
			<p>
				Наш менеджер свяжется <br />
				с вами в ближайшее время.
			</p>
		</div> <!-- /.modal__text -->
	</div> <!-- /.modal__content -->
</div> <!-- /.modal -->

<div class="modal" id="callback">
	<div class="modal__content">
		<a href="#close" class="modal__close">Закрыть</a>
			<div class="modal__title">
				Задать вопрос
			</div> <!-- /.modal__title -->
			
			<div class="modal__form">
				
				<form action="#" class="form" method="post">
					<div class="form__line">
						<label class="form__label">Ваше имя</label>
						
						<div class="form__input-border">
							<input type="text" class="form__input required" name="name" placeholder="" />
						</div> <!-- /.form__input-border -->
						
					</div> <!-- /.form__line -->
					
					<div class="form__line">
						<label class="form__label">E-mail</label>
						
						<div class="form__input-border">
							<input type="text" class="form__input required email" name="email" placeholder="" />
						</div> <!-- /.form__input-border -->
					</div> <!-- /.form__line -->
					
					<div class="form__line">
						<label class="form__label">Телефон</label>
						
						<div class="form__input-border">
							<input type="text" class="form__input required" name="phone" placeholder="" />
						</div> <!-- /.form__input-border -->
					</div> <!-- /.form__line -->
					
					<div class="form__line">
						<label class="form__label">Ваш вопрос</label>
						
						<div class="form__input-border">
							<textarea name="message" class="form__textarea required" placeholder=""></textarea>
						</div> <!-- /.form__input-border -->
					</div> <!-- /.form__line -->
					
					<div class="form__button">
						<button type="submit" class="button button--submit">Отправить</button>
					</div> <!-- /.form__button -->
				</form> <!-- /.form -->
			</div> <!-- /.modal__form -->
	</div> <!-- /.modal__content -->
</div> <!-- /.modal -->