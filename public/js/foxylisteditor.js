/* Ready, Set, Go. */
$(document).ready(function() {
    /**
     * Editable table when user has foxylisteditor.
     *
     * @see https://github.com/nathancahill/table-edits
     */
    $('table.scaffold tr').editable({
        buttonSelector: '.action-inline-edit',
        dropdowns: {
            'enabled': [{
                    val: 0,
                    text: 'Nein'
                },
                {
                    val: 1,
                    text: 'Ja'
                }
            ]
        },
        save: function(values) {
            var type = $(this).data('type');
            var id = $(this).data('id');
            $.post('/api/update/' + type + '/' + id, values, function(data) {
                console.log(data.result);
                if (data.result == 'bad') {
                    //what shall we do with the drunken sailor?
                }
            }, 'json');
        },
        edit: function(values) {
            $(this).find("input[type=text]").filter(":first").focus();
        },
        cancel: function(values) {
            //user cancel editing by pressing ESC key.
        }
    });
});
