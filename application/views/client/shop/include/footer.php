<script>
function autocomp(){
			$.post("/shop/catalog/autocomplete/", $('#filter-form').serialize(), autocomp_answer, 'json');
		}
		
		function autocomp_answer(res){
			var availableTags = res.available_tags;
		
			$("#search_input").autocomplete({
				source: availableTags,
				select: function( event, ui ) {
					$('.search').val(ui.item.value);
					$('#filter-form').submit();
				}
			});
			
			$(".ui-autocomplete").height($(window).height() - 135);
			
			$(".ui-autocomplete").mCustomScrollbar({
				axis:"y", 
				advanced:{ autoExpandHorizontalScroll:true } //auto-expand content to accommodate floated elements
			});
		}
		
	$('.modal_product').on('click', function(){
		var productId = $(this).attr('data-product-id');
		$(this).attr('href', '<?= base_url()?>catalog/flypage/'+productId);
		$('#shadow').css('display', 'none');
		$('#full-shadow').css('display', 'block');
	});
	
	var flypage_width = $(window).width();

	$('.modal_product').fancybox({
		overlayOpacity: 0.8,
		width: flypage_width,
		overlayColor: '#000',
		margin: [70, 25, 15, 290]
	});
	
	$('.shadow-btn').on('click', function(){
		$.fancybox.close();
		$('#shadow').css('display', 'block');
		$('#full-shadow').css('display', 'none');
	});

</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
	(function (d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter23976124 = new Ya.Metrika({id:23976124,
				webvisor:true,
				clickmap:true,
				trackLinks:true,
				accurateTrackBounce:true});
			} catch(e) { }
		});

		var n = d.getElementsByTagName("script")[0],
			s = d.createElement("script"),
			f = function () { n.parentNode.insertBefore(s, n); };

		s.type = "text/javascript";
		s.async = true;
		s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/23976124" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
		