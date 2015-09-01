<?php
	require_once('phpthumb.class.php');

	$phpThumb = new phpThumb();
	$phpThumb->resetObject();
	$thumbnail_width = 100;
	
	$phpThumb->setSourceFilename('images/1.jpg');
	$phpThumb->setParameter('w', $thumbnail_width);
	$phpThumb->setParameter('config_output_format', 'jpeg');
	$output_filename = $phpThumb->config_document_root.'/thumbnails/1.'.$phpThumb->config_output_format;
	$phpThumb->GenerateThumbnail();
	$phpThumb->RenderToFile($output_filename);
	//$phpThumb->OutputThumbnail();
	var_dump($phpThumb);
?>