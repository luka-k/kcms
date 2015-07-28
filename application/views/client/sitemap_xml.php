<?=$open_tag?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

	<url>
		<loc>http://brightbuild.ru/</loc>
	</url>
	<url>
		<loc>http://brightbuild.ru/bb/</loc>
	</url>
	<url>
		<loc>http://brightbuild.ru/contacts/</loc>
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
					<priority>0.5</priority>
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