ALTER TABLE users ADD vk_uid varchar(50) after zip_code;

/*
Я подумал что загружать авватар на сайт не имеет смысла если уж мы имеем ссылку на авватар контакта
но вообщем то загрузку сделать 5-ти мунутное дело по идее
*/
ALTER TABLE users ADD vk_avatar TEXT after vk_uid;