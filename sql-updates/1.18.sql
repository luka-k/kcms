ALTER TABLE `categories` ADD `in_catalog` INT NOT NULL AFTER `is_active`;

-- ��� ��� �� ��� ������������ ����������� ������. �� ���� �� ��� ��������
UPDATE `categories` SET `in_catalog` =1 WHERE `in_catalog` =0