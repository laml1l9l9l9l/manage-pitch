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
    	activeMenu('#menu', '#dashboardOverview');
    	activeMenu('#profile', '#profile');
    	console.log(nameLink);

    	function activeMenu(id_menu, id_collapse) {
			var $response = $(id_menu);
			var $links    = $response.find("a[href$='"+nameLink+"']").parent().addClass('active');

		    $links.closest(id_collapse).removeClass('collapse out').addClass('collapse in');
	    	// Active collapse
	    	$links.closest(id_collapse).closest('li').addClass('active');
    	}
    }
};