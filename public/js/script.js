/* Ready, Set, Go. */
$(document).ready(function() {

    /**
     * The notifications section will animate a little to catch atttention by users.
     */
    $(".notification").slideDown("slow");
    
    /**
     * Plugin idTabs.
     */
    if ($(".tabs").length > 0) {
        $(".tabs").each(function() {
            $("#"+$(this).attr("id")+" ul").idTabs($(this).attr("data-default"));
        });
    }
    
    /**
	 * all and future detach links send a post request and then
	 * fade out and finally detach the element.
	 */
	$(".detach").live("click", function(event) {
	    event.preventDefault();
		var target = $(this).attr("data-target");
		$("#"+target).fadeOut('fast', function() {
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
