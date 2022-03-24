<html>
    <body>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="jquery.jqplot.js"></script>
        <script type="text/javascript" src="jqplot.pieRenderer.js"></script>
        <link rel="stylesheet" type="text/css" hrf="jquery.jqplot.css" />
        <div id="pie1" style="margin-top:20px; margin-left:20px; width:200px; height:200px;"></div>
        <script class="code" type="text/javascript">$(document).ready(function(){
    var plot1 = $.jqplot('pie1', [[['a',25],['b',14],['c',7]]], {
        gridPadding: {top:0, bottom:38, left:0, right:0},
        seriesDefaults:{
            renderer:$.jqplot.PieRenderer, 
            trendline:{ show:false }, 
            rendererOptions: { padding: 8, showDataLabels: true }
        },
        legend:{
            show:true, 
            placement: 'outside', 
            rendererOptions: {
                numberRows: 1
            }, 
            location:'s',
            marginTop: '15px'
        }       
    });
});</script>
    </body>
<html>