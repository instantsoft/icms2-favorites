DROP TABLE IF EXISTS `{#}favorites`;
CREATE TABLE `{#}favorites` (
  `controller` varchar(32) DEFAULT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  KEY `item_id` (`item_id`),
  KEY `user_id` (`user_id`,`controller`,`subject_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Привязки избранного';

DELETE FROM `{#}menu_items` WHERE `url` = '{favorites:list}';
INSERT INTO `{#}menu_items` (`menu_id`, `parent_id`, `is_enabled`, `title`, `url`, `ordering`, `options`) VALUES
(2, 0, 1, 'Избранное', '{favorites:list}', 2, '---\ntarget: _self\nclass:\nicon: bookmark\n');

DELETE FROM `{#}perms_rules` WHERE `controller` = 'favorites';
INSERT INTO `{#}perms_rules` (`controller`, `name`, `type`, `options`, `show_for_guest_group`) VALUES
('favorites', 'usage', 'flag', NULL, NULL);
