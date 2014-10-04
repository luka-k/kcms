<?require_once 'include/head.php'?>

	<div id="parent" class="clearfix">
		<?require_once 'include/header.php'?>
		
		<div id="wrapper">
			<?require_once 'include/left_col.php'?>
			<div id="main-content">
				<?if(isset($category)):?>
					<div class="title"><?=$category->title?></div>
					<div id="content">
						<?=$category->description?>
					</div>
				<?endif;?>
				<div class="title">Error 404</div>
				Page is not found. Return to <a href="<?=base_url()?>" style="color:#843a36;">home page</a>
			</div>
			<?require_once 'include/right_col.php'?>
		</div>
		<?require_once 'include/footer.php'?>
	</div>
</body>
</html>