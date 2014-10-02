<?require_once 'include/head.php'?>

<div id="parent" class="clearfix">
	<?require_once 'include/header.php'?>
		<div id="breadcrumbs"><a href="">Home</a> > Order and Delivery</div>
		
		<div id="wrapper">
			<?require_once 'include/left_col.php'?>
			
			<div id="main-content">
			
				<div class="title"><?=$content->title?></div>
				
				<div id="content"><?=$content->description?></div>
			</div>
			<?require_once 'include/right_col.php'?>
		</div>
	<?require_once 'include/footer.php'?>
</div>	

</body>
</html>