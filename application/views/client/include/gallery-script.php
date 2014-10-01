<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.tools.min.js"></script>	
<script type="text/javascript" src="<?=base_url()?>template/client/js/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>template/client/js/highslide-full.packed.js"></script>

<script type="text/javascript">
	
	var myJ = jQuery.noConflict();
	
	hs.align = 'center';
	hs.dimmingOpacity = 0.75;
	hs.graphicsDir = '<?=base_url()?>template/client/images/graphics/';
	hs.wrapperClassName = 'borderless';
	hs.showCredits = false;
	hs.enableKeyListener = false;
	
	// Add the controlbar
	hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions:{
			opacity: .75,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
	
	$(function(){
		// initialize scrollable 
		myJ("div.scrollable").scrollable({
			vertical:true, 
			size: 3,
			clickable :false
		})
	});
</script>