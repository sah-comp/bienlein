/* Ready, Set, Go. */
$(document).ready(function() {

    /**
     * The notifications section will animate a little to catch atttention by users.
     */
    $(".notification").slideDown("slow");
    
    $(document).bind("ajaxSend", function(){
       $("body").addClass("loading");
     }).bind("ajaxComplete", function(){
       $("body").removeClass("loading");
     });
    
    /**
     * Plugin idTabs.
     */
    if ($(".tabs").length) {
        $(".tabs").each(function() {
            $("#"+$(this).attr("id")+" ul").idTabs($(this).attr("data-default"));
        });
    }
    
    /**
     * Fixes the header with account and main navigation
     */
    if ($("#header-top").length) {
        $("#header-top").scrollToFixed({
            zIndex: 1000
        });
    }
    
    /**
     * Fixes the header with toolbar
     */
    if ($("#header-toolbar").length) {
        $("#header-toolbar").scrollToFixed({
            marginTop: 79,
            zIndex: 999
        });
    }
    
    /**
     * Click on a sitemap link will load the domain and fill the content-container.
     */
    $(document).on("click", '#sitemap a', function(event) {
        event.preventDefault();
        $.get($(this).attr("href"), function(data) {
            $("#content-container").empty();
            $("#content-container").append(data);
        }, "html");
        $("#sitemap a").removeClass("active");
        $(this).addClass("active");
    });
    
    /**
     * Click on a pages-container link will load the page and fill the page-container.
     */
    $(document).on("click", '#pages-container a', function(event) {
        event.preventDefault();
        $.get($(this).attr("href"), function(data) {
            $("#page-container").empty();
            $("#page-container").append(data);
        }, "html");
        $("#pages-container a").removeClass("active");
        $(this).addClass("active");
    });
    
    /**
     * Click on a element with class slice-container loads editable slice.
     */
    $(document).on("click", ".slice-container:not('.active')", function(event) {
        event.preventDefault();
        var container = $(this).attr("data-container");
        $.get($(this).attr("data-href"), function(data) {
            $("#"+container).empty();
            $("#"+container).append(data);
        }, "html");
        //$(".slice-container").removeClass("active");
        $(this).addClass("active");
    });
    
	/**
	 * Form with class inplace will be ajaxified by jQuery form plugin and
	 * the response is placed into the element given in data-container.
	 */
    $(document).on("submit", ".inline, .inline-add", function(event) {
        var form = $(this);
        var container = form.attr("data-container");
        if ($("#"+container).hasClass("active")) $("#"+container).removeClass("active");
        form.ajaxSubmit({
            success: function(response) {
                if ( ! form.hasClass("inline-add")) $("#"+container).empty();
                $("#"+container).append(response);
            }
        });
        return false;
        /*
        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),
            success: function(response) {
                if ( ! form.hasClass("inline-add")) $("#"+container).empty();
                $("#"+container).append(response);
            }
        });
        */
    });
    
    /**
	 * all and future detach links send a post request and then
	 * fade out and finally detach the element.
	 */
	$(document).on("click", ".detach", function(event) {
	    event.preventDefault();
		var target = $(this).attr("data-target");
		var url = $(this).attr("href");
		$.post(url, function(data) {
	        $('#'+target).fadeOut('fast', function() {
				$('#'+target).detach();
			});
	    });
	});
	
	/**
	 * all and future attach links post request a url and
	 * insert a new element into the *-additional zone.
	 */
	$(document).on("click", ".attach", function(event) {
	    event.preventDefault();
		var target = $(this).attr("data-target");
		var url = $(this).attr("href");
		$.post(url, function(data) {
			$("#"+target).append(data);
	    });
	});
    
    /**
     * A input element of type checkbox with class name all will toggle all checkboxes
     * with the class name selector.
     *
     * @todo This does not work with jQuery version > 1.8.3
     */
    $("input.all[type=checkbox]").click(function() {
        var state = $(this).is(":checked");
        $("input.selector[type=checkbox]").each(function() {
            $(this).attr("checked", state);
        });
    });

});
