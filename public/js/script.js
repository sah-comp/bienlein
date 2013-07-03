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
    if ($(".tabs").length > 0) {
        $(".tabs").each(function() {
            $("#"+$(this).attr("id")+" ul").idTabs($(this).attr("data-default"));
        });
    }
    
    /**
     * Click on a sitemap link will load the domain and fill the content-container.
     */
    $("#sitemap a").live("click", function(event) {
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
    $("#pages-container a").live("click", function(event) {
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
    $(".slice-container:not('.active')").live("click", function(event) {
        event.preventDefault();
        var container = $(this).attr("data-container");
        $.get($(this).attr("data-href"), function(data) {
            $("#"+container).empty();
            $("#"+container).append(data);
        }, "html");
        $(".slice-container").removeClass("active");
        $(this).addClass("active");
    });
    
	/**
	 * Form with class inplace will be sent as POST and update an element in the DOM
	 * given by the data-container attribute.
	 */
    $(".inline, .inline-add").live("submit", function(event) {
        event.preventDefault();
        // submit the form
        var form = $(this);
        var container = form.attr("data-container");
        if ($("#"+container).hasClass("active")) $("#"+container).removeClass("active");
        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),
            success: function(response) {
                if ( ! form.hasClass("inline-add")) $("#"+container).empty();
                $("#"+container).append(response);
            }
        });
    });
    
    /**
	 * all and future detach links send a post request and then
	 * fade out and finally detach the element.
	 */
	$(".detach").live("click", function(event) {
	    event.preventDefault();
		var target = $(this).attr("data-target");
		$("#"+target).fadeOut("fast", function() {
			$("#"+target).detach();
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
