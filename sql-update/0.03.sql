CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users2users_groups` (
  `group_parent_id` int(11) NOT NULL,
  `child_id` varchar(255) NOT NULL
)DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'customer');

INSERT INTO `users2users_groups` (`group_parent_id`, `child_id`) VALUES
(1, 27);

ALTER TABLE `users` DROP `role` ;