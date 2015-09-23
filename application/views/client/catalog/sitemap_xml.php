<?=$open_tag?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>http://brightbuild.ru/</loc>
		<priority>0.8</priority>
	</url>
	<url>
		<loc>http://brightbuild.ru/catalog</loc>
		<priority>0.7</priority>
	</url>
	<url>
		<loc>http://brightbuild.ru/vendors</loc>
		<priority>0.7</priority>
	</url>
	<url>
		<loc>http://brightbuild.ru/contractors</loc>
		<priority>0.7</priority>
	</url>
	<url>
		<loc>http://brightbuild.ru/inventory</loc>
		<priority>0.7</priority>
	</url>
	<url>
		<loc>http://brightbuild.ru/articles/novosti/</loc>
		<priority>0.7</priority>
	</url>
	<?foreach($content as $c):?>
		<?foreach($c as $item):?>
			<url>
				<loc><?=$item->full_url?>/</loc>
				<?if(isset($item->lastmod) && !empty($item->lastmod)):?> 
					<lastmod><?=$item->lastmod == '0000-00-00' ? date('Y-m-d') : $item->lastmod?></lastmod>
				<?endif;?>
				<?if(isset($item->changefreq) && ($item->changefreq)):?> 
					<changefreq><?=$item->changefreq?></changefreq>
				<?endif;?>
				<?if(isset($item->priority) && ($item->priority)):?> 
					<priority><?=$item->priority?></priority>
				<?endif;?>
			</url>
			<?if(!empty($item->childs)):?>
				<?foreach($item->childs as $ch):?>
					<url>
						<loc><?=$ch->full_url?>/</loc>
						<?if(isset($ch->lastmod) && !empty($ch->lastmod)):?> 
							<lastmod><?=$ch->lastmod == '0000-00-00' ? date('Y-m-d') : $ch->lastmod?></lastmod>
						<?endif;?>
						<?if(isset($ch->changefreq) && ($ch->changefreq)):?> 
							<changefreq><?=$ch->changefreq?></changefreq>
						<?endif;?>
						<?if(isset($ch->priority) && ($ch->priority)):?> 
							<priority>0.5</priority>
						<?endif;?>
					</url>
				<?endforeach;?>
			<?endif;?>
		<?endforeach;?>
	<?endforeach;?>
</urlset>		