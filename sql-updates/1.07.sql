update `documents` set doc_type=replace(doc_type, '1', 'catalogs');
update `documents` set doc_type=replace(doc_type, '2', 'prices');
update `documents` set doc_type=replace(doc_type, '3', 'collections');
update `documents` set doc_type=replace(doc_type, '4', 'special');
update `documents` set doc_type=replace(doc_type, '5', 'tech');
update `documents` set doc_type=replace(doc_type, '0', 'all');