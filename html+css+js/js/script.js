$(window).load(function(){
	$("#children_col").height($(window).height() - 16);
});

function set_status(type){
	var status = $('#'+type+'_ch').prop('checked');
	if(status){
		$('.'+type+'_status').html('включено');
		$('.'+type+'_status').addClass('green');
		$('.'+type+'_status').removeClass('red');
	}else{
		$('.'+type+'_status').html('выключено');
		$('.'+type+'_status').addClass('red');
		$('.'+type+'_status').removeClass('green');
	}
}