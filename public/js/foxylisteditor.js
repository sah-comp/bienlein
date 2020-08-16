/* Ready, Set, Go. */
$(document).ready(function() {
    /**
     * Editable table when user has foxylisteditor.
     *
     * @see https://github.com/nathancahill/table-edits
     */
    $('table.scaffold tr').editable({
        save: function(values) {
            var type = $(this).data('type');
            var id = $(this).data('id');
            $.post('/api/update/' + type + '/' + id, values);
        }
    });
});
