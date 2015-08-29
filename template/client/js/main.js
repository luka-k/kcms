var order_id = 0;
 
function showResponse(responseText, statusText, xhr, $form)
{
	//document.location='success.php';
	document.location= window.location.pathname.toString()+'#win3';
}

function bookLoad(responseText, statusText, xhr, $form)
{
	document.location='books/ribabook.pdf';
}
  
function getPromoPixel()
{
	/*
	if (document.location.href.indexOf('from=qxplus') != -1 || $.cookie('promo') == 'qxplus')
		return '<img src="http://www.qxplus.ru/scripts/sale.php?AccountId=cc42a0f9&TotalCost=2590.00&OrderID='+order_id+'&ProductID=healthyeyes_default" width="1" height="1" >';
	if (document.location.href.indexOf('utm_source=actionpay') != -1 || $.cookie('promo') == 'actionpay')
	{
		window.APRT_SEND({
			pageType: 6,
			purchasedProducts: [{
			id: 1,
			name: "HealthyEyes",
			price: 2590,
			quantity: 1
			}],
		});
		return '<img src="//n.actionpay.ru/ok/6574.png?actionpay='+$.cookie('actionpay')+'&apid='+order_id+'&price=2590" height="1" width="1" />';
	}*/
	return '';
}

function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}

function initCookies()
{
	var options = { expires: 365 };
	if (document.location.href.indexOf('from=qxplus') != -1)
	{
		$.cookie('promo', 'qxplus', options);
	}
	if (document.location.href.indexOf('utm_source=actionpay') != -1)
	{
		options = { expires: 30 };
		$.cookie('promo', 'actionpay', options);
		$.cookie('utm_source', 'actionpay', options);
		$.cookie('utm_campaign', 'actionpay', options);
		$.cookie('actionpay', getQueryVariable('actionpay'), options);
	}
}

function initTimer()
{
	var time = new Date().getTime();
	var hour = new Date().getHours();
	time = time + 1000 * 3600 * 24;
	var date = new Date();
	date.setTime(time);
	if (hour > 22)
	{
		var dateString = date.getDate() + "." + (1+date.getMonth()) + "." + date.getFullYear() + ".4.0";
	} else {
		var dateString = date.getDate() + "." + (1+date.getMonth()) + "." + date.getFullYear() + ".0.0";
	}
	
	$(".eTimer").eTimer({
		etType: 0, etDate: dateString, etTitleText: "До окончания акции осталось:", etTitleSize: 20, etShowSign: 1, etSep: " ", etFontFamily: "Arial", etTextColor: "#a3a3a3", etPaddingTB: 5, etPaddingLR: 15, etBackground: "#333333", etBorderSize: 0, etBorderRadius: 2, etBorderColor: "white", etShadow: " 0px 0px 10px 0px #333333", etLastUnit: 3, etNumberFontFamily: "Impact", etNumberSize: 35, etNumberColor: "white", etNumberPaddingTB: 0, etNumberPaddingLR: 8, etNumberBackground: "#11abb0", etNumberBorderSize: 0, etNumberBorderRadius: 5, etNumberBorderColor: "white", etNumberShadow: "inset 0px 0px 10px 0px rgba(0, 0, 0, 0.5)"
	});
}

function doOrder(f, form, options)
{

	yaCounter23961652.reachGoal('order');
	
	
	var promoCode = '';
	var promoInfo = '';
	var _product_name = '';
	if (f[0].currentForm[2])
		_product_name = f[0].currentForm[2].value;
	var _summ = '';
	if (f[0].currentForm[3])
		_summ = f[0].currentForm[3].value;
	$.post( "proxy.php", { product_name: _product_name, summ: _summ, name: f[0].currentForm[0].value, phone: f[0].currentForm[1].value, promo: promoCode, promo_info: promoInfo, email: ""}, function(data) {order_id=data.id;$(form).ajaxSubmit(options);}, "json");

}

(function(){

	$(document).ready(function() {
  
		initCookies();
		initTimer();
		$('[name="phone"]').mask("+7 (999) 999-9999"); 

		//Настройки для отправки форм
		var options = {
		  url: "ajax/contact.php",
		  timeout: 3000,
		  datatype: 'json',
		  success: showResponse 
		};
		var optionsBook = {
		  url: "ajax/contact.php",
		  timeout: 3000,
		  datatype: 'json',
		  success: bookLoad 
		};

		//Сообщения об ошибках ввода в поля
		$.extend($.validator.messages, {
			required: "",
			email: "",
		});

		//Валидация форм
		$('form').each(function() {  // attach to all form elements on page
			
			if ($(this).attr('id') == 'loadbook')
			{
				$(this).validate({
					//errorPlacement: function(error, element) {},
					submitHandler: function(form) {
						doOrder($(this), form, optionsBook);
					}
				});
			} else {
				$(this).validate({
					//errorPlacement: function(error, element) {},
					submitHandler: function(form) {
						doOrder($(this), form, options);
					}
				});
			}
		});

  });
  

}());