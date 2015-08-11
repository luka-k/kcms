<div id="social">
	<ul class="tabs2 tabs">
		<li id="tab_1" class="ltpro"><a href="#tab2" class="rounded"><i class="icon-ltpro"></i></a></li>
		<li id="tab_2" class="vk"><a href="#tab1" class="rounded"><i class="icon-vk"></i></a></li>
		<li id="tab_3" class="gplus"><a href="#tab3" class="rounded"><i class="icon-google-plus-sign"></i></a></li>
		<li id="tab_4"><a href="#tab4" class="rounded"><i class="icon-facebook-sign"></i></a></li>
		<li id="tab_5"><a href="#tab5" class="rounded"><i class="icon-twitter-sign"></i></a></li>
	</ul>
	
	<div class="tabcontents rounded">
		<div id="tab2" class="tabswitcher2 tab_content ">
		      
			   <?php if (isset($_POST['wysija-email']))
					{
						mysql_query('INSERT INTO wp_wysija_user (email, firstname, status, created_at) VALUES ("'.$_POST['wysija-email'].'", "'.$_POST['wysija-email'].'", 1, '.time().');');
						$q = mysql_query('SELECT * FROM wp_wysija_user ORDER BY user_id DESC LIMIT 0, 1;');
						$r = mysql_fetch_assoc($q);
						if ($_POST['lt-pro'])
							$wpdb->insert('wp_wysija_user_list', array('list_id' => 6, 'user_id' => $r['user_id'], 'sub_date' => time()));
						if ($_POST['cambr'])
							$wpdb->insert('wp_wysija_user_list', array('list_id' => 3, 'user_id' => $r['user_id'], 'sub_date' => time()));
						if ($_POST['pears'])
							$wpdb->insert('wp_wysija_user_list', array('list_id' => 5, 'user_id' => $r['user_id'], 'sub_date' => time()));
						if ($_POST['ielts'])
							$wpdb->insert('wp_wysija_user_list', array('list_id' => 4, 'user_id' => $r['user_id'], 'sub_date' => time()));
						
						header('Location: /uspeshnaya-podpiska/');
					}
				?> 
			   <h3 style="text-align: center;">Подписаться на новости</h3><br />
			   <form id="form-wysija-2" method="post" action="#wysija" class="widget_wysija form-inline">
					<center>
			   <table >
			   <tr><td>
					<label for="lt-pro"><input type="checkbox" name="lt-pro" id="lt-pro" checked> LT-Pro</label><br />
					<label for="cambr"><input type="checkbox" name="cambr" id="cambr"> Cambridge</label>
				</td><td>&nbsp;</td><td>
					<label for="pears"><input type="checkbox" name="pears" id="pears"> Pearson</label><br />
					<label for="ielts"><input type="checkbox" name="ielts" id="ielts"> IELTS</label>
				</td></tr></table>
					<br />
					<label style="width:100%"></label>
					<input type="email" style="width:190px;" name="wysija-email" id="" placeholder="E-mail"><br /> <br />
					<button class="send_submit" onclick="$('#form-wysija-2').submit()" >Подписаться</button>
					</center>
				</form>
				<br>
             </div>
            <div id="tab1" class="tabswitcher2 tab_content ">
			<div id="vk" style="height:0px; overflow: hidden" >
			  <script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>
              <!-- VK Widget -->
              <div id="vk_groups"></div>
              <script type="text/javascript">
                VK.Widgets.Group("vk_groups", {mode: 0, width: "200", height: "180"}, 57836557);
              </script>
            </div>
			</div>
			<div id="tab3" class="tabswitcher2 tab_content ">
			<div id="google" style="height:0px; overflow: hidden" >
<!-- Поместите этот тег туда, где должна отображаться виджет. -->
<div class="g-page" data-width="231" data-href="https://plus.google.com/109068643756743354375" data-rel="publisher"></div>

<!-- Поместите этот тег за последним тегом виджета виджет. -->
<script type="text/javascript">
  window.___gcfg = {lang: 'ru'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
	</div>
            </div>
            <div id="tab4" class="tabswitcher2 tab_content " style="display:none">
			<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1&appId=647768688600746";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like-box" data-href="https://www.facebook.com/pages/LT-Pro/432787190158921" data-width="240" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div> 
            </div>
            <div id="tab5" class="tabswitcher2 tab_content " style="display:none">
			<a href="https://twitter.com/IELTSspb" class="twitter-follow-button" data-show-count="false" data-lang="ru" data-size="large">Читать @IELTSspb</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

            </div>
        </div>
	  </div>	