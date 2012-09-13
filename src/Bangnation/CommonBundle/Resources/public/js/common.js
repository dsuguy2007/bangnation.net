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
        
    $(document).on('click', '.ajax-link', function(e) {
        e.preventDefault();

        if(this.ajax_call) {
            this.ajax_call.abort();
        }

        var url = $(this).attr('href');
        var dataTarget = $(this).attr('data-content');

        var _this = this;
        _this.dataTarget = dataTarget;

        this.ajax_call = $.ajax({
            dataType : 'html',
            url: url,
            success: function(data) {
                $(_this).closest(_this.dataTarget).replaceWith(data);
            }
        });
    });
});

