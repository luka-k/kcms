ALTER TABLE users ADD valid_email boolean NOT NULL default '0' AFTER address;

UPDATE `emails` SET `description` = '<p>%user_name%, спасибо за регистрацию в нашем магазине.</p> <p>Для подтверждения email перейдите по <a href="%site_url%account/set_valid?email=%login%" target="_blank">ссылке</a></p>' WHERE `id` =4;