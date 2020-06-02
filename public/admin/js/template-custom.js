template_custom = {

    getTitlePageCurrent: function(){

        $("#title_page").text($("title").text());


    },

    activeMenuSelected: function() {
    	// Get link
		var keyString    = "manager/";
		var pageURL      = $(location).attr("href");
		var indexOfURL   = pageURL.indexOf(keyString);
		var stringLength = keyString.length;
		indexOfURL       += stringLength;
		var nameLink     = pageURL.substring(indexOfURL);
    	// Get link - check submenu
    	if(nameLink.includes("/")){
			indexOfURL = nameLink.indexOf("/");
			nameLink   = nameLink.substring(0, indexOfURL);    		
    	}

    	// Check link
		var $response = $('#menu');
		var $links    = $response.find("a[href$='"+nameLink+"']").parent().addClass('active');

	    $links.closest('#dashboardOverview').removeClass('collapse out').addClass('collapse in');
    	// Active collapse
    	$links.closest('#dashboardOverview').closest('li').addClass('active');
    	
    	console.log(nameLink);
    }
};