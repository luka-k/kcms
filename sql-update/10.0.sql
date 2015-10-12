ALTER TABLE `child_users` ADD `visit_sms_debiting` DATE NOT NULL AFTER `visit_sms_enabled_date`;
ALTER TABLE `child_users` ADD `cabinet_debiting` DATE NOT NULL AFTER `visit_sms_debiting`;