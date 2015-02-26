$(function() {
			if (window.PIE) {
				$('.rounded, button, input').each(function() {
					PIE.attach(this);
				});
			}
		});
		
$(document).ready(function(){
			$('#st-accordion').accordion();
		});

		function cssmenuhover()
		{
			if(!document.getElementById("menu-top_menu")) return;
			var lis = document.getElementById("menu-top_menu").getElementsByTagName("LI");
			for (var i=0;i<lis.length;i++)
			{
                lis[i].onmouseover=function(){this.className+=" iehover";}
                lis[i].onmouseout=function() {this.className=this.className.replace(new RegExp(" iehover\\b"), "");}
			}
		}
		
		if (window.attachEvent) window.attachEvent("onload", cssmenuhover);
		
function subscribe(){
			var form = $('#subscribe-form'),
			inputs = form.find('input.sub_input'),
			data = {},
			item = {};
			
			inputs.each(function () {
				var element = $(this);
				if(element.attr('type') == 'checkbox' && $(this).prop("checked")){
					item[element.attr('name')] = element.val();
				}
				if(element.attr('name') == 'email'){
					item[element.attr('name')] = element.val();
				}
			});
			data.subscribe = item;
			var json_str = JSON.stringify(data);
			$.post ("/admin/admin_ajax/subscribe/", json_str, sub_answer, "json");
		}
		
		function sub_answer(res){
			$('.message').text(res.message);
		}