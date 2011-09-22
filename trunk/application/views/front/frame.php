<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sane-Web</title>
<style>
html, body{
    margin:0;
    height: 100%;
    padding:0;
    background-color: white;
}

*{
    font: 13px/1.5 Verdana, Arial, Simsun, sans-serif;
}

ul, li {
    margin:0px;
    padding:0px;
}

div#top{
    position: fixed;
    top: 0;
    width: 100%;
    display:block;
    background-color: #336600;
    color: #BABABA;
    padding-top:4px;
    padding-bottom:4px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
    z-index: 100;
}


div#top li{
   float: left; 
   margin-left: 20px;
   display: block;
   padding:0;
   margin-top:0;
   margin-right:0;
   margin-bottom:0;
}

div#top li button {
    cursor: pointer;
    border-width:0px;
    background-color: transparent;
    color: #BABABA;
}

div#top li button:hover{
    color:white;
}

div#top li.right {
   float: right; 
   margin-right: 20px;
}

div#main_container{
    z-index: 10;

}

div#main_container img{
    position: relative;
    float: left ;
    display: block ;
}

div#action_box{
}

span#action_box_label {
    position: relative;
    background-color: white;
    color: black ;
}

div.thumbtick_selected {
    background-position: 0% 0%;
}

div.thumbtick_not_selected {
    background-position:100% 0%;
}

</style>
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

<div id="main_container"></div>

<script src='<?php echo site_url(APPPATH."assets/jquery/jquery-1.6.2.min.js");?>'></script>
<script src='<?php echo site_url(APPPATH."assets/jquery/saneweb.plugin.js");?>'></script>
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
                .text( v['doc'] )
                .css('z-index', '555')
                .css('position', 'absolute')
                .css('background-color', 'white')
                .css('border', '1px solid lightgrey')
                .css('padding', '1px 2px')
                .css('bottom', '0px')
                .css('right', '0px')
                .css('cursor', 'pointer')
                .click(function(){
                    alert($(this).text());
                    event.stopPropagation();
                })
            ;
            var tick = $('<div/>')
                .addClass('thumbtick')
                .addClass('thumbtick_not_selected')
                .css('z-index', "555")
                .css('position', "absolute")
                .css('background-color', "white")
                .css('top', "0px")
                .css('left', "0px")
                .css('width', "48px")
                .css('height', "48px")
                .css('cursor', "pointer")
                .css('background-image', "url(<?php echo site_url(APPPATH.'assets/images/tick.png')?>)")
                .css('background-repeat', "no-repeat")
                .css('background-scroll', "scroll")
                .css('background-color', "transparent")
                .fadeTo('fast', 0.0)
                .click(function(){
                    $(this).toggleClass('thumbtick_selected thumbtick_not_selected');
                })
            ;
 
            $('<div/>')
                .css('cursor', 'pointer')
                .css('position', 'relative')
                .css('display', 'block')
                .css('padding', '16px 0 0 16px')
                .css('margin', '4px')
                .css('float', 'left')
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
