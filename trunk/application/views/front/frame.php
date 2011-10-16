<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sane-Web</title>
<link rel=stylesheet href="<?php echo site_url("assets/css/default/sane.css");?>" type="text/css" media="screen">
</head>

<body>

<div id="top">
    <ul>
    <li id="logo">Sane-web</li>
    <li>
        <button id='btn_export'>Export</button>
    </li>
    <li>
        <button id='btn_scanner_setting'>Scaner Setting</button>
    </li>
    <li class="right" id="status">
        Scanner Status: Running
    </li>
</div>

<div id="main_container" class="saneweb_container"></div>

<script src='<?php echo site_url("assets/js/jquery-1.6.2.min.js");?>'></script>
<script src='<?php echo site_url("assets/js/jquery-ui-1.8.16.custom.min.js");?>'></script>
<script src='<?php echo site_url("assets/jquery/saneweb.plugin.js");?>'></script>
<script language="javascript">
var APPURL = "<?php echo site_url('/');?>";

$(document).ready(function(){
    $('#main_container').css('padding-top', $('#top').outerHeight()*1.5);

    $.getJSON('<?php echo site_url("service/get_documents");?>', function(data){
        $(data).each(function(i,v){
            var img = $('<img/>')
                .attr('preview', v['preview'])
                .attr('thumb', v['thumb'])
                .attr('label', v['doc'])
                .attr('src', v['thumb'])
            ;
            var label = $('<div/>')
                .addClass('label')
                .text( v['doc'] )
                .click(function(){
                    alert($(this).text());
                    event.stopPropagation();
                })
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
                .appendTo('#main_container') 
                ;
        });
    });

});
</script>

</body>
</html>
