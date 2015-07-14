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
});