<?=$open_tag?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<?foreach($content as $item ):?>
		<url>
			<loc><?=$item->full_url?></loc>
			<?if(isset($item->lastmod) && !empty($item->lastmod)):?> 
				<lastmod><?=$item->lastmod?></lastmod>
			<?endif;?>
			<?if(isset($item->changefreq) && !empty($item->changefreq)):?> 
				<changefreq><?=$item->changefreq?></changefreq>
			<?endif;?>
			<?if(isset($item->priority) && !empty($item->priority)):?> 
				<priority><?=$item->changefreq?></priority>
			<?endif;?>
		</url>
	<?endforeach;?>
</urlset>		