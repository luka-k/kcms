<?=$open_tag?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

	<url>
		<loc>http://brightberry.ru/</loc>
		<lastmod>2015-07-20</lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.5</priority>
	</url>
	<url>
		<loc>http://brightberry.ru/works/</loc>
		<lastmod>2015-07-20</lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.5</priority>
	</url>
	<url>
		<loc>http://brightberry.ru/catalog/</loc>
		<lastmod>2015-07-20</lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.5</priority>
	</url>
	<?foreach($content as $item ):?>
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
	<?endforeach;?>
</urlset>		