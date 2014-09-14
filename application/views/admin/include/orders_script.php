<script>
function change_field(order_id, value, type){
	data = new Object();
	data.order_id = order_id;
	data.value = value;
	data.type = type;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/change_field/", json_str, callback_message, "json");
}

function callback_message(res){
	$.fancybox('<div id="res"><p style="color: #634f6a;font-family: Georgia;font-size: 24px; text-align:center;  padding-top:30px;"></p></div>', {
		autoSize: false,
		autoHeight: false,
		autoWidth: false,
		autoResize: false,
		width: 400,
		height: 150
	});	
	$('#res p').text(res.message);
	setTimeout(function () {
		$.fancybox.close();
	}, 6000);
}
</script>