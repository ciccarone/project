// public/js/autocomplete.js

$(document).ready(function() {
    $('#business').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "/business/names", // Ensure this URL matches your route
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error); // Debugging statement
                }
            });
        },
        minLength: 2
    });
    $('.services-select').select2({
        tags: true,
        maximumSelectionLength: 3,
        tokenSeparators: [',', ' '],
        placeholder: "Select or add services",
        allowClear: true
    });


});
