ALTER TABLE users ADD valid_email boolean NOT NULL default '0' AFTER address;

UPDATE `emails` SET `description` = '<p>%user_name%, ������� �� ����������� � ����� ��������.</p> <p>��� ������������� email ��������� �� <a href="%site_url%account/set_valid?email=%login%" target="_blank">������</a></p>' WHERE `id` =4;