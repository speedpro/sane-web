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

    return this.each(function(index){
        var $this = $(this);
        $this.text('');
        var d = new Date();
        var daysInMonth = (new Date( d.getFullYear(), d.getMonth()+1, 0)).getDate();

        $('<div/>').text(d.getFullYear() + ' / ' + (d.getMonth()>=9 ? (1+d.getMonth()) : ('0'+(1+d.getMonth())) ) ).appendTo($this).css({'text-align':'center'});
        var t = $("<table class='simpleCalendar_container'/>");
        t.append($("<tr class='simpleCalendar_header'> <th class='simpleCalendar_weekend'>Su</th> <th>Mo</th> <th>Tu</th> <th>We</th> <th>Th</th> <th>Fr</th> <th class='simpleCalendar_weekend'>Sa</th> </tr>"));
        var tr= $('<tr/>').appendTo(t);
        for(var i=0;i<42;i++)
        {
            var dt=i-(new Date(d.getFullYear(), d.getMonth(), 1)).getDay()+1;
            $('<td/>')
                .text(dt>0&&dt<=daysInMonth ? dt : '')
                .addClass( 'simpleCalendar_day' )
                .addClass( (i%7==0 || i%7==6) ? 'simpleCalendar_weekend' : '')
                .addClass( (dt==d.getDate())  ? 'simpleCalendar_today'   : '')
                .appendTo(tr);
            if(i%7==6) tr= $('<tr/>').appendTo(t);
        }
        $this.append(t);
        
    });
};

})(jQuery);

