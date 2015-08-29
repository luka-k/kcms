<!-- jquery + modules -->
<script src="<?=base_url()?>template/client/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?=base_url()?>template/client/js/jquery/jquery-ui.min.js"></script>
<script src="<?=base_url()?>template/client/js/jquery/jquery.maskedinput.min.js"></script>
<script src="<?=base_url()?>template/client/js/jquery/jquery.form.min.js"></script>
<script src="<?=base_url()?>template/client/js/jquery/jquery.validate.min.js"></script>
<script src="<?=base_url()?>template/client/js/jquery/jquery.cookie.js"></script>
<!-- etimer -->
<script src="<?=base_url()?>template/client/js/etimer.js"></script>
<!-- main -->
<script src="<?=base_url()?>template/client/js/main.js"></script>

<!-- jQuery library (served from Google) -->
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
<!-- bxSlider Javascript file -->
<script src="<?=base_url()?>template/client/js/jquery.bxslider.js"></script>
<!-- bxSlider CSS file -->
<link href="<?=base_url()?>template/client/css/jquery.bxslider.css" rel="stylesheet" />

<? include'baner.php'; ?>
<? include'book-form.php'; ?>

<!-- slider -->
<script>
    $('.bxslider').bxSlider({
		adaptiveHeight: true,
        mode: 'fade',
        captions: true
    });
</script>

<!--  -->

<script type="text/javascript">
	$('.navigation li').each(function () {
		if (this.getElementsByTagName("a")[0].href == location.href) this.className = "active";
	});
</script>


    <!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter23961652 = new Ya.Metrika({id:23961652,
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
<noscript><div><img src="//mc.yandex.ru/watch/23961652" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->