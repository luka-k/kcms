<script>
function change_field(id, value, type){
	data = new Object();
	data.id = id;
	console.log(id);
	data.value = value;
	data.type = type;
	var json_str = JSON.stringify(data);
	$.post ("/admin/admin_orders/change_field/", json_str, callback_message, "json");
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