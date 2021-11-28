var icms = icms || {};

icms.favorites = (function ($) {

    var self  = this;

    this.onDocumentReady = function(){
        $('.icms-favorites__btn').each(function(){
            self.bindWidget($(this));
        });
    };

    this.bindWidget = function(widget){

        var click_btn = $('a', widget);
        if(widget.prop('tagName') === 'A'){
            click_btn = $(widget);
        }

        click_btn.on('click', function (){

            var link = this;

            $(widget).addClass('is-busy');

            $.post($(this).attr('href'), {csrf_token: icms.forms.getCsrfToken()}, function (result) {

                $(widget).removeClass('is-busy');

                if(result.error){

                    alert(result.message);

                    return;
                }

                if(result.data.is_added){
                    $(widget).addClass('text-success');
                } else {
                    $(widget).removeClass('text-success');
                }

                $(link).attr('href', result.data.href);

                if($.trim($(link).text()).length > 0){
                    $(link).text(result.data.html);
                } else {
                    $(link).attr('title', result.data.html);
                }

            }, 'json');

            return false;
        });

    };

    return this;

}).call(icms.favorites || {},jQuery);