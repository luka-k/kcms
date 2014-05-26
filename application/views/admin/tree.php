<ul>
	<?php if (is_array($cats) and isset($cats[$pid])):?>
		<?php foreach ($cats[$pid] as $cat): ?>
			<li><a href = "<?base_url()?>/admin/pages/<?=$cat['id']?>"><?=$cat['title']?></li>
				<?=$this->tree->build_tree($cat['id'])?>
		<?php endforeach ?>
	<?php endif;?>
	     <!--   $tree = '<ul>';
        foreach($cats[$parent_id] as $cat)
		{
            $tree .= '<li><a href="'.base_url().'admin/pages/'.$cat->id.'">'.$cat->title.'</a>';
			
			//if ($this->build_tree($cats,$cat['id'])<>NULL)
			//{
				//$tree .= '<span class="up"><i class="icon-sort-down"></i></span>';
			//}
            $tree .=  $this->build_tree($cat->id);
           $tree .= '</li>';
        }
		$tree .= '</ul>';-->
</ul>