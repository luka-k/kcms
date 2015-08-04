<script>
function autocomp(){
			var data = {};
			data.r = " ";
			var json_str = JSON.stringify(data);
			$.post("/ajax/autocomplete/", json_str, autocomp_answer, 'json');
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
		}
</script>

<script>
	function search_focus(){
		document.forms['filter-form'].setAttribute('action','<?=base_url()?>shop/search');
		document.forms['filter-form'].setAttribute('method', 'get');
			
		$('.secondcolumn').fadeOut('slow');
		$('.lm-item').removeClass('active');
		$('.lm-item').stop().animate({width:'258px'},'slow');
		var inputs = $('#filter-form').find('input');
					
		inputs.each(function () {
			var element = $(this);
			
			if(element.hasClass("search") == false) 
			{
				element.prop("disabled", 'disabled');
			}
		});
	}
				
	function search_blur(){
		document.forms['filter-form'].setAttribute('action','<?=base_url()?>catalog');
		document.forms['filter-form'].setAttribute('method', 'post');
					
		var inputs = $('#filter-form').find('input');
					
		inputs.each(function () {
			var element = $(this);
						
			if(element.hasClass("search") == false){
				element.prop("disabled", '');
			}
		});
	}

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
		