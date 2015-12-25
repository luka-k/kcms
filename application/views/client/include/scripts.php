<script src="<?= base_url()?>template/client/js/jquery-1.11.2.min.js"></script>
<script src="<?= base_url()?>template/client/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>template/client/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?= base_url()?>template/client/js/owl.carousel.min.js"></script>
<script src="<?= base_url()?>template/client/js/perfect-scrollbar.min.js"></script>
<script src="<?= base_url()?>template/client/js/jquery-ui.min.js"></script>
<script src="<?= base_url()?>template/client/js/jquery.customSelect.min.js"></script>    
<script src="<?= base_url()?>template/client/js/jquery.easing-1.3.min.js"></script>
<script src="<?= base_url()?>template/client/js/wow.min.js"></script>
<script src="<?= base_url()?>template/client/js/echo.min.js"></script>
<script src="<?= base_url()?>template/client/js/scripts.js"></script>
<script src="<?= base_url()?>template/client/js/cart.js"></script>
<script src="<?= base_url()?>template/client/js/viewmore.js"></script>
<script src="<?= base_url()?>template/client/js/script.js"></script>
<script src="<?= base_url()?>template/client/js/account.js"></script>

<script>
	$(document).ready(function(){
		<?if(isset($is_main)):?>
			$('.viewmore_input').val(10);
		<?else:?>
			$('.viewmore_input').val(12);
		<?endif;?>
	});
</script>