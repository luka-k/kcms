ALTER TABLE users ADD vk_uid varchar(50) after zip_code;

/*
� ������� ��� ��������� ������� �� ���� �� ����� ������ ���� �� �� ����� ������ �� ������� ��������
�� ������� �� �������� ������� 5-�� �������� ���� �� ����
*/
ALTER TABLE users ADD vk_avatar TEXT after vk_uid;