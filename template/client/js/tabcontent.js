$(document).ready(function() {

	//When page loads...
	$(".tabswitcher").hide(); //Hide all content
	$("ul.tabs1 li:first").addClass("active").show(); //Activate first tab
	$(".tabswitcher:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs1 li").click(function() {
		$("ul.tabs1 li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tabswitcher").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

	//When page loads...
	//$(".tabswitcher2").hide(); //Hide all content
	//$(".tabswitcher2").show(); //Hide all content
	$("ul.tabs2 li:first").addClass("active").show(); //Activate first tab
	$(".tabswitcher2:first").show(); //Show first tab content
	//$(".tabcontents").css('height', 202); //Show first tab content
	//$(".tabcontents").css('overflow', 'hidden'); //Show first tab content

	//On Click Event
	$("ul.tabs2 li").click(function() {
		$('#google').css('height', 380);
		$('#vk').css('height', 220);
		$('#tab3').css('height', 380);
		
		$("ul.tabs2 li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tabswitcher2").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		
		//$(activeTab).show();
		return false;
	});

	//When page loads...
	$(".tabswitcher3").hide(); //Hide all content
	$("ul.tabs3 li:first").addClass("active").show(); //Activate first tab
	$(".tabswitcher3:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs3 li").click(function() {

		$("ul.tabs3 li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tabswitcher3").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + contentz
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});