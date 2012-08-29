$(function() {
    // Redirect on ajax calls to unauthorized pages (fixes expired session problem)
    $('body').bind(
        'ajaxError',
        function(event, request, settings, error) {
            console.debug(request.status);
            if (request.status == '403') {
                location.reload();
            }
        }
    );
});

