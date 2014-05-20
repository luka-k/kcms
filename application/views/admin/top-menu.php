	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
	<div id="menu" class="col_12">
				<ul class="menu">
					<li class="current"><a href="<?=base_url()?>admin/admin_main">Главная</a></li>
					<li><a href="">Пользователи</a></li>
					<li><a href="">Страницы</a>
						<ul>
							<li><a href="<?=base_url()?>admin/pages"><i class="icon-edit"></i>Редактировать</a></li>
							<li><a href="<?=base_url()?>admin/page/"><i class="icon-pencil"></i>Создать</a></li>
						</ul>
					</li>
					<li><a href="">Категории</a>
						<ul>
							<li><a href="<?=base_url()?>admin/categories"><i class="icon-edit"></i>Редактировать</a></li>
							<li><a href="<?=base_url()?>admin/category"><i class="icon-pencil"></i>Создать</a></li>
						</ul>
					</li>
					<li><a href="">Меню</a>
						<ul>
							<li><a href="<?=base_url()?>admin/menus"><i class="icon-edit"></i>Все меню</a></li>
							<li><a href="<?=base_url()?>admin/menu"><i class="icon-pencil"></i>Создать меню</a></li>
						</ul>
					</li>
					<li><a href="<?=base_url()?>admin/settings">Настройки</a></li>
					
					<li class="right"><a href="<?=base_url()?>admin/do_exit"><i class="icon-remove"></i>Выйти</a></li>
					<li class="right"><a href="#"><i class="icon-user"></i><?=$name?></a></li>
					<li class="right"><a href="<?=base_url()?>" target = "_blanc"><i class="icon-signout"></i>Перейти на сайт</a></li>
					
				</ul>
			</div>