INSERT INTO `dynamic_menus` (`name`, `description`) VALUES
('Меню панели администратора', '');

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort` , `description`, `item_type`, `url`) VALUES
('130', '2', '<i class=icon-home></i>', '0', '0', '', 'link', '/admin'),
('131', '2', 'Статьи', '0', '0', '', 'link', '#'),
('132', '2', 'Все статьи', '131', '0', '', 'link', '/admin/content/items/articles'),
('133', '2', 'Новости', '131', '0', '', 'link', '/admin/content/items/articles/1'),
('134', '2', 'Каталог', '0', '0', '', 'link', '#'),
('135', '2', 'Категории', '134', '0', '', 'link', '/admin/content/items/categories'),
('136', '2', 'Создать категорию', '134', '0', '', 'link', '/admin/content/item/edit/categories'),
('137', '2', 'Товары', '134', '0', '', 'link', '/admin/content/items/products'),
('138', '2', 'Создать товар', '134', '0', '', 'link', '/admin/content/item/edit/products'),
('139', '2', 'Дополнения', '0', '0', '', 'link', '#'),
('140', '2', 'Слайдер', '139', '0', '', 'link', '/admin/content/items/slider'),
('141', '2', 'Видео', '139', '0', '', 'link', '/admin/content/items/video'),
('142', '2', 'Филиалы', '139', '0', '', 'link', '/admin/content/items/filials'),
('143', '2', 'Дилеры', '139', '0', '', 'link', '/admin/content/items/dealers'),
('144', '2', 'Заказы', '0', '0', '', 'link', '/admin/admin_orders'),
('145', '2', 'Настройки', '0', '0', '', 'link', '/admin/content/item/edit/settings/1'),
('146', '2', 'Меню', '0', '0', '', 'link', '/admin/menu_module/menus'),
('147', '2', 'Рассылки', '0', '0', '', 'link', '#'),
('148', '2', 'Шаблоны', '147', '0', '', 'link', '/admin/content/items/emails/2'),
('149', '2', 'Рассылки', '147', '0', '', 'link', '/admin/mailouts_module/'),
('150', '2', 'Системные письма', '147', '0', '', 'link', '/admin/content/items/emails/1'),
('151', '2', 'Пользователи', '0', '0', '', 'link', '#'),
('152', '2', 'Пользователи', '151', '0', '', 'link', '/admin/users_module/'),
('153', '2', 'Группы пользователей', '151', '0', '', 'link', '/admin/content/items/users_groups/');