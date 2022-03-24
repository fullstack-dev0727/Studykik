<?php

wp_enqueue_style('data-table_css', get_site_url().'/wp-content/themes/twentyfifteen/css/datatables.min.css', array(), '1', false);
wp_enqueue_script('data-table_js', get_site_url().'/wp-content/themes/twentyfifteen/js/datatables.min.js', array(), '1', true);

$url = get_site_url().'/main_page_subscribers_json?ajax=1';
$html = "
<table id='myTable' class='display' cellspacing='0' width='100%'>
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Date</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Date</th>
        </tr>
    </tfoot>
</table>
<div style='text-align:center; font-size:20px;'>
    <button onclick='exportToExcel();'>Export To Excel</button>
<div>
<script>
$ = jQuery;
var table = '';
jQuery(document).ready(function(){
    table = jQuery('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '".$url."',
        columns: [
            { data: 'name' },
            { data: 'phone' },
            { data: 'email' },
            { data: 'date' }
        ],
        scrollY:        500,
        scroller: {
            loadingIndicator: true
        },
        scroller:       true,
        stateSave:      true
    });
});

function exportToExcel(){
    var params = $.param( table.state() );
    window.location = \"".get_site_url()."/main_page_subscribers_json?excel=1&\"+params;
}
</script>


";
echo $html;