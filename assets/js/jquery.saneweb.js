/*!
 * jQuery saneweb plugin: Sane Web
 * Requires jQuery v1.3.2 or later
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Authors: Neil FAN
 */

/**
 *  saneweb() takes no argument
 *
 *  $('#div').saneweb()
 *
 */
;(function($) {

$.fn.saneweb = function(options) {
    // in 1.3+ we can fix mistakes with the ready state
    if (this.length == 0) {
        if (!$.isReady && this.selector) {
            var s = this.selector, c = this.context;
            $(function() {
                $(s,c).saneweb(options);
            });
        }
        return this;
    }

    var config = {
        service: ''
    };
    if (options){$.extend(config, options);}

    saneweb_init();

    var $this = $(this);

    $.getJSON(options.service+'/get_documents', function(data){
        $(data).each(function(i,v){
            var img = $('<img/>')
                .data('preview', v['preview'])
                .data('thumb', v['thumb'])
                .data('label', v['doc'])
                .attr('src', v['thumb'])
                .click(saneweb_showPreview)
            ;
            var label = $('<div/>')
                .addClass('label')
                .text( v['doc'] )
                .data('preview', v['preview'])
            ;
            var tick = $('<div/>')
                .addClass('thumbtick')
                .addClass('thumbtick_not_selected')
                .fadeTo('fast', 0.0)
                .click(function(){
                    $(this).toggleClass('thumbtick_selected thumbtick_not_selected');
                })
            ;
 
            $('<div/>')
                .addClass('pnm')
                .hover(
                    function(){
                        var t = $(this).find('.thumbtick');
                        if( ! t.hasClass('thumbtick_selected'))
                        {
                            t.stop().fadeTo('fast', 1.0);
                        }
                    },
                    function(){
                        var t = $(this).find('.thumbtick');
                        if( ! t.hasClass('thumbtick_selected'))
                        {
                            t.stop().fadeTo('slow', 0.0);
                        }
                    })
                .append(tick)
                .append(label)
                .append(img)
                .appendTo($this) 
                ;
        });
    });

    return this;

};

function saneweb_init(){
    // make sure this method is only called once
    if( ! $('body').data('saneweb_inited') )
    {
        $('body').data('saneweb_inited', true) ;

        // load preview diagram
        $('<div/>')
            .attr('id', 'saneweb_preview')
            .html("<img id='thumb'/><div id='title'></div>")
            .appendTo('body')
            .dialog({
                width: 500,
                height: 500,
                closeOnEscape: true,
                autoOpen: false,
                modal: true,
                stack: true,
                title: 'Preview',
                buttons: {
                    'Apply': saneweb_apply,
                    'Cancel' : function(){$(this).dialog('close');}
                    }
            })
        ;
    }
}

function saneweb_showPreview(e){
    var preview = $(e.currentTarget).data('thumb');
    $('div#saneweb_preview img#thumb').attr('src', preview);
    $('div#saneweb_preview div#title').text(preview);
    $('div#saneweb_preview').dialog('open');
    e.stopPropagation();
};

function saneweb_apply(e)
{
    alert(e);
}

})(jQuery);

