﻿<ul>
<?php foreach ($tree as $branch): ?>
	<li><a href = "<?base_url()?>/admin/category/<?=$branch->id?>"><?=$branch->title?></a></li>
	<?php if(!empty($branch->childs)):?>
		<ul>
			<?php foreach ($branch->childs as $bran): ?>
				<li><a href = "<?base_url()?>/admin/category/<?=$bran->id?>"><?=$bran->title?></a></li>
			<?php endforeach ?>	
		</ul>
	<?php endif;?>
<?php endforeach;?>
</ul>
