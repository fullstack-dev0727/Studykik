<?php

<a href="page-24387.php"> INVOICE RECEIPTS </a>
ob_start();
if ( is_user_logged_in() ) {
	 
	  $user_ID = get_current_user_id();
           $user_info = get_userdata($user_ID);
           $user_roles = implode(', ', $user_info->roles);
} else {
	 wp_redirect( site_url().'/login/', 301 ); exit;
}
//$user_ID = 505;
?>
<?php //get_header('dashboard');?>
<?php 
//$user_roles = "manager_username";
if ($user_roles == "manager_username"){

        get_header('responsive');?>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/jquery-ui.css">
			<script src="<?php bloginfo('template_url');?>/combobox/jquery-1.10.2.js"></script>
	<script src="<?php bloginfo('template_url');?>/combobox/jquery-ui.js"></script>
<link href="<?php bloginfo('template_url');?>/css/dashboard.css" rel="stylesheet">
<style>
    .nav li a {
   margin-right: 13px !important;
    padding: 9px 5px !important;
    font-size: 15px !important;

}
.navbar-nav > li > a{text-transform: none !important;}
.nav > li {

    padding: 0px 0px !important;

}
.nav li a.midsection {
    margin-right: 250px !important;
}

.dashboard_banner {
    background: #fff none repeat scroll 0 0;
    border-radius: 5px 5px 0 0;
    box-shadow: 0 -4px 9px #4a4e45;
    float: left;
    margin: 40px 0 0;
    padding: 30px 0 !important;
    width: 100%;
}
#top {
    display: block;
    margin-bottom: 0;
    position: relative;
}
h1 {
    color: #7e8766;
    font-family: "Helvetica Neue",Helvetica,sans-serif;
    font-size: 4.34em;
    font-weight: 700;
    line-height: 1.6em;
}
#top h1 a {
    display: block;
    height: 110px;
    left: 500px;
    margin: 0;
    padding: 0;
    position: absolute;
    text-indent: -9999px;
    top: -22px;
    width: 140px;
    z-index: 9999;
}
#top h1 img {
    display: block;
    left: 500px;
    margin: 0;
    padding: 0;
    position: absolute;
    text-indent: -9999px;
    top: -22px;
    width: 140px;
    z-index: 9999;
}
.table-hover > tbody > tr:hover > td,

.table-hover > tbody > tr:hover > th {
background-color: none !important;

}
#invoice_receipts{
	background:#f5f5f5;
	width:100%;
	float:left;
	padding-bottom: 122px;
	-moz-box-shadow:inset 1px 1px 9px #d9d9d9;
	-webkit-box-shadow:inset 1px 1px 9px #d9d9d9;
	box-shadow:inset 1px 1px 9px #d9d9d9;
}
#invoice_receipts img{
	margin: 22px  auto 26px;
}
#invoice_receipts h4{
	font-size:33px;
	color:#f78e1e;
	font-family: 'helveticaregular';
	text-align:center;
	text-decoration:underline;
}
.month_select{
	-webkit-appearance:none;
  -moz-appearance:none;
  -o-appearance:none;
   appearance:none;
    background: #00afef url("<?php bloginfo('template_url');?>/images-dashboard/drop_menu.png") no-repeat scroll 92% 55%;
    border: medium none;
    border-radius: 8px;
    color: #ffffff;
    height: 48px;
    margin-left: 28px;
    width: 186px;
	padding: 0 12px;
	-moz-box-shadow: 1px 1px 9px #c5c5c5;
	-webkit-box-shadow: 1px 1px 9px #c5c5c5;
	box-shadow: 1px 1px 9px #c5c5c5;
	font:26px 'alternate';
	cursor:pointer;
}
.month_select.active{
	-webkit-appearance:none;
  -moz-appearance:none;
  -o-appearance:none;
   appearance:none;
    background: #fff url("<?php bloginfo('template_url');?>/images/up_menu.png") no-repeat scroll 92% 55% !important;
    border: medium none;
    border-radius: 8px 8px 0px 0px !important;
    color: #00afef !important;
    height: 48px;
    width: 186px;
	padding: 0 12px;
	-moz-box-shadow: 1px 1px 9px #c5c5c5;
	-webkit-box-shadow: 1px 1px 9px #c5c5c5;
	box-shadow: 1px 1px 9px #c5c5c5;
	font:26px 'alternate';
	cursor:pointer;
}
input, textarea, select, a { outline: none; }
*:focus {
    outline: 0;
}
.year_select.active{
	-webkit-appearance:none;
  -moz-appearance:none;
  -o-appearance:none;
   appearance:none;
    background: #fff url("<?php bloginfo('template_url');?>/images/up_menu.png") no-repeat scroll 92% 55% !important;
    border: medium none;
    border-radius: 8px 8px 0px 0px !important;
    color: #00afef !important;
    height: 48px;
    width: 171px;
	padding: 0 12px;
	margin: 0 0 0 35px;
	-moz-box-shadow: 1px 1px 9px #c5c5c5;
	-webkit-box-shadow: 1px 1px 9px #c5c5c5;
	box-shadow: 1px 1px 9px #c5c5c5;
	font:26px 'alternate';cursor:pointer; border:none !important;
}
.year_select{
	-webkit-appearance:none;
  -moz-appearance:none;
  -o-appearance:none;
   appearance:none;
    background: #00afef url("<?php bloginfo('template_url');?>/images-dashboard/drop_menu.png") no-repeat scroll 92% 55%;
    border: medium none;
    border-radius: 8px;
    color: #ffffff;
    height: 48px;
    width: 171px;
	padding: 0 12px;
	margin: 0 0 0 10px;
	-moz-box-shadow: 1px 1px 9px #c5c5c5;
	-webkit-box-shadow: 1px 1px 9px #c5c5c5;
	box-shadow: 1px 1px 9px #c5c5c5;
	font:26px 'alternate';cursor:pointer; border:none !important;
}
.full_dropdown{
	float:left;
	width:100%;
	margin: 25px 0 0;
}
.download_invoice{
	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    float: right;
	margin: 0 5px 0 0;
}
.download_invoice img{
	margin: 0 !important;
}
.protocol_number{
	float:left;
	width:100%;
	margin: 0 0 -122px;
}
.protocal:nth-child(1) {
	background:#a9afb3;
	color:#ffffff;
	font:26px alternate;
	text-align: center;
	padding: 10px 0 !important;
	width: 12% !important;
}
.protocal:nth-child(2) {
	background:#a9afb3;
	color:#ffffff;
	font:26px alternate;
	text-align: center;
	padding: 10px 0 !important;
	width: 15% !important;
}
.protocal:nth-child(3) {
	background:#a9afb3;
	color:#ffffff;
	font:26px alternate;
	text-align: center;
	padding: 10px 0 !important;
	width: 20% !important;
}
.protocal:nth-child(4) {
	background:#a9afb3;
	color:#ffffff;
	font:26px alternate;
	text-align: center;
	padding: 10px 0 !important;
	width: 20% !important;
	border-right:none !important;
}
.second_row:nth-child(1) {
	color:#959ca1;
	font:16px helveticaregular;
	text-align:center;
	padding: 10px 0 !important;
}
.second_row:nth-child(2) {
	color:#959ca1;
	font:16px helveticaregular;
	text-align:center;
	padding: 10px 0 !important;
}
.second_row:nth-child(3),.second_row:nth-child(3) a {
	color:#f78f1e;
	font:16px helveticaregular;
	text-align:center;
	text-decoration:underline;
	padding: 10px 0 !important;
}
.second_row:nth-child(4) {
	color:#959ca1;
	font:16px helveticaregular;
	text-align:center;
	padding: 10px 0 !important;
	border-right:none !important;
}
tr:nth-child(even) {background: #d9d9d9}
tr:nth-child(odd) {background: #f5f5f5}
table tr th{ border-right:1px solid #dddddd;}
table tr td{ border-right:1px solid #a9afb3;}
.submit_get
{

    background: url("<?php bloginfo('template_url');?>/images-dashboard/invoices.png") no-repeat;
   border: medium none !important;
    color: #ffffff;
    cursor: pointer;
    font-size: 0;
    height: 70px;
    width: 191px;
	margin-left:10px;
}
.white_content {
    background-color: white;
    border: 1px solid #f78e1e;
    border-radius: 10px;
    cursor: auto;
    display: none;
    left: 23% !important;
    overflow: auto;
    position: fixed !important;
    top: 25% !important;
    width: 55% !important;
    z-index: 99999 !important;
}
h2.heading {
    background: #f78e1e none repeat scroll 0 0;
    color: #fff;
    font-family: alternate;
    font-size: 44px;
    margin: 0;
    padding: 5px;
    text-align: center;
    text-decoration: none;
}
.closepop {
    background: transparent url("<?php bloginfo('template_url'); ?>/images-dashboard/close2.png") no-repeat scroll 0 0 !important;
}
.black_overlay {
    background: #000000 none repeat scroll 0 0;
    display: none;
    height: 3400px;
    left: 0;
    opacity: 0.8;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}
.project_manager {
    float: right;
    margin-top: 25px;
    padding: 0 12px;
}
.project_manager h5 {
    color: #9da2a6;
    font: 18px helveticaregular;
}
.project_manager span {
    color: #9fce64;
    font: 18px helveticaregular;
}
.project_manager small {
    color: #00aff0;
    font: 18px helveticaregular !important;
    margin: 0 !important;
}
.project_manager cite {
    color: #f68d20;
    font: 18px helveticaregular !important;
    margin: 0 !important;
}
.project_manager span:last-child {
    color: #00aff0;
    font: 18px helveticaregular;
}
/*#top {
    display: block;
    margin-bottom: 45px;
    position: relative;
}*/
h1 {
    color: #7e8766;
    font-family: "Helvetica Neue",Helvetica,sans-serif;
    font-size: 4.34em;
    font-weight: 700;
    line-height: 1.6em;
}
/*#top h1 a {
    display: block;
    height: 110px;
    left: 500px;
    margin: 0;
    padding: 0;
    position: absolute;
    text-indent: -9999px;
    top: -22px;
    width: 140px;
    z-index: 9999;
}*/
/*#top h1 img {
    display: block;
    left: 540px;
    margin: 0;
    padding: 0;
    position: absolute;
    text-indent: -9999px;
    top: -22px;
    width: 140px;
    z-index: 9999;
}*/
/*.nav.navbar-nav.sponsor {
    float: left;
    margin: 0 170px;
}*/
.project_manager {
    float: right;
    margin-top: 25px;
    padding: 0 12px;
}
.project_manager h5 {
    color: #9da2a6;
    font: 18px helveticaregular;
}
.project_manager span {
    color: #9fce64;
    font: 18px helveticaregular;
}
.project_manager small {
    color: #00aff0;
    font: 18px helveticaregular !important;
    margin: 0 !important;
}
.project_manager cite {
    color: #f68d20;
    font: 18px helveticaregular !important;
    margin: 0 !important;
}
.project_manager span:last-child {
    color: #00aff0;
    font: 18px helveticaregular;
}
.dashboard_banner {
    background: #fff none repeat scroll 0 0;
    border-radius: 5px 5px 0 0;
    box-shadow: 0 -4px 9px #4a4e45;
    float: left;
    margin: 40px 0 0;
    padding: 30px 0 0;
    width: 100%;
}
/*.second_row:nth-child(1) {
	color:#959ca1;
	font:16px helveticaregular;
	text-align:center;
	padding: 10px 0 !important;
}
.second_row:nth-child(2) {
	color:#959ca1;
	font:16px helveticaregular;
	text-align:center;
	padding: 10px 0 !important;
}
.second_row:nth-child(3),.second_row:nth-child(3) a {
	color:#f78f1e;
	font:16px helveticaregular;
	text-align:center;
	text-decoration:underline;
	padding: 10px 0 !important;
}
.second_row:nth-child(4) {
	color:#959ca1;
	font:16px helveticaregular;
	text-align:center;
	padding: 10px 0 !important;
	border-right:none !important;
}*/
/*tr:nth-child(even) {background: #d9d9d9}
tr:nth-child(odd) {background: #f5f5f5}*/
</style>
  <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
<!--    <link href="<?php echo get_template_directory_uri(); ?>/css/slider.css" rel="stylesheet">-->

<!--<link href="<?php bloginfo('template_url');?>/css/dashboard_media.css" rel="stylesheet">-->
         <?php }?>
  <?php if ($user_roles == "editor"){
        get_header('responsive');?>

<style type="text/css">
#invoice_receipts{
	background:#f5f5f5;
	width:100%;
	float:left;
	padding-bottom: 122px;
	-moz-box-shadow:inset 1px 1px 9px #d9d9d9;
	-webkit-box-shadow:inset 1px 1px 9px #d9d9d9;
	box-shadow:inset 1px 1px 9px #d9d9d9;
}
#invoice_receipts img{
	margin: 22px auto 26px;
}
#invoice_receipts h4{
	font-size:33px;
	color:#f78e1e;
	font-family: 'helveticaregular';
	text-align:center;
	text-decoration:underline;
}
.month_select{
	-webkit-appearance:none;
  -moz-appearance:none;
  -o-appearance:none;
   appearance:none;
    background: #00afef url("<?php bloginfo('template_url');?>/images-dashboard/drop_menu.png") no-repeat scroll 92% 55%;
    border: medium none;
    border-radius: 8px;
    color: #ffffff;
    height: 48px;
    margin-left: 28px;
    width: 186px;
	padding: 0 12px;
	-moz-box-shadow: 1px 1px 9px #c5c5c5;
	-webkit-box-shadow: 1px 1px 9px #c5c5c5;
	box-shadow: 1px 1px 9px #c5c5c5;
	font:26px 'alternate';
	cursor:pointer;
}
.month_select.active{
	-webkit-appearance:none;
  -moz-appearance:none;
  -o-appearance:none;
   appearance:none;
    background: #fff url("<?php bloginfo('template_url');?>/images/up_menu.png") no-repeat scroll 92% 55% !important;
    border: medium none;
    border-radius: 8px 8px 0px 0px !important;
    color: #00afef !important;
    height: 48px;
    width: 186px;
	padding: 0 12px;
	-moz-box-shadow: 1px 1px 9px #c5c5c5;
	-webkit-box-shadow: 1px 1px 9px #c5c5c5;
	box-shadow: 1px 1px 9px #c5c5c5;
	font:26px 'alternate';
	cursor:pointer;
}
input, textarea, select, a { outline: none; }
*:focus {
    outline: 0;
}
.year_select.active{
	-webkit-appearance:none;
  -moz-appearance:none;
  -o-appearance:none;
   appearance:none;
    background: #fff url("<?php bloginfo('template_url');?>/images/up_menu.png") no-repeat scroll 92% 55% !important;
    border: medium none;
    border-radius: 8px 8px 0px 0px !important;
    color: #00afef !important;
    height: 48px;
    width: 171px;
	padding: 0 12px;
	margin: 0 0 0 35px;
	-moz-box-shadow: 1px 1px 9px #c5c5c5;
	-webkit-box-shadow: 1px 1px 9px #c5c5c5;
	box-shadow: 1px 1px 9px #c5c5c5;
	font:26px 'alternate';cursor:pointer; border:none !important;
}
.year_select{
	-webkit-appearance:none;
  -moz-appearance:none;
  -o-appearance:none;
   appearance:none;
    background: #00afef url("<?php bloginfo('template_url');?>/images-dashboard/drop_menu.png") no-repeat scroll 92% 55%;
    border: medium none;
    border-radius: 8px;
    color: #ffffff;
    height: 48px;
    width: 171px;
	padding: 0 12px;
	margin: 0 0 0 10px;
	-moz-box-shadow: 1px 1px 9px #c5c5c5;
	-webkit-box-shadow: 1px 1px 9px #c5c5c5;
	box-shadow: 1px 1px 9px #c5c5c5;
	font:26px 'alternate';cursor:pointer; border:none !important;
}
.full_dropdown{
	float:left;
	width:100%;
	margin: 25px 0 0;
}
.download_invoice{
	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    float: right;
	margin: 0 5px 0 0;
}
.download_invoice img{
	margin: 0 !important;
}
.protocol_number{
	float:left;
	width:100%;
	margin: 0 0 -122px;
}
.protocal:nth-child(1) {
	background:#a9afb3;
	color:#ffffff;
	font:26px alternate;
	text-align: center;
	padding: 10px 0 !important;
	width: 12% !important;
}
.protocal:nth-child(2) {
	background:#a9afb3;
	color:#ffffff;
	font:26px alternate;
	text-align: center;
	padding: 10px 0 !important;
	width: 15% !important;
}
.protocal:nth-child(3) {
	background:#a9afb3;
	color:#ffffff;
	font:26px alternate;
	text-align: center;
	padding: 10px 0 !important;
	width: 20% !important;
}
.protocal:nth-child(4) {
	background:#a9afb3;
	color:#ffffff;
	font:26px alternate;
	text-align: center;
	padding: 10px 0 !important;
	width: 20% !important;
	border-right:none !important;
}
.second_row:nth-child(1) {
	color:#959ca1;
	font:16px helveticaregular;
	text-align:center;
	padding: 10px 0 !important;
}
.second_row:nth-child(2) {
	color:#959ca1;
	font:16px helveticaregular;
	text-align:center;
	padding: 10px 0 !important;
}
.second_row:nth-child(3),.second_row:nth-child(3) a {
	color:#f78f1e;
	font:16px helveticaregular;
	text-align:center;
	text-decoration:underline;
	padding: 10px 0 !important;
}
.second_row:nth-child(4) {
	color:#959ca1;
	font:16px helveticaregular;
	text-align:center;
	padding: 10px 0 !important;
	border-right:none !important;
}
tr:nth-child(even) {background: #d9d9d9}
tr:nth-child(odd) {background: #f5f5f5}
table tr th{ border-right:1px solid #dddddd;}
table tr td{ border-right:1px solid #a9afb3;}
.submit_get
{

    background: url("<?php bloginfo('template_url');?>/images-dashboard/invoices.png") no-repeat;
   border: medium none !important;
    color: #ffffff;
    cursor: pointer;
    font-size: 0;
    height: 70px;
    width: 191px;
	margin-left:10px;
}
.white_content {
    background-color: white;
    border: 1px solid #f78e1e;
    border-radius: 10px;
    cursor: auto;
    display: none;
    left: 23% !important;
    overflow: auto;
    position: fixed !important;
    top: 25% !important;
    width: 55% !important;
    z-index: 99999 !important;
}
h2.heading {
    background: #f78e1e none repeat scroll 0 0;
    color: #fff;
    font-family: alternate;
    font-size: 44px;
    margin: 0;
    padding: 5px;
    text-align: center;
    text-decoration: none;
}
.closepop {
    background: transparent url("<?php bloginfo('template_url'); ?>/images-dashboard/close2.png") no-repeat scroll 0 0 !important;
}
.black_overlay {
    background: #000000 none repeat scroll 0 0;
    display: none;
    height: 3400px;
    left: 0;
    opacity: 0.8;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}
.project_manager {
    float: right;
    margin-top: 25px;
    padding: 0 12px;
}
.project_manager h5 {
    color: #9da2a6;
    font: 18px helveticaregular;
}
.project_manager span {
    color: #9fce64;
    font: 18px helveticaregular;
}
.project_manager small {
    color: #00aff0;
    font: 18px helveticaregular !important;
    margin: 0 !important;
}
.project_manager cite {
    color: #f68d20;
    font: 18px helveticaregular !important;
    margin: 0 !important;
}
.project_manager span:last-child {
    color: #00aff0;
    font: 18px helveticaregular;
}
#top {
    display: block;
    margin-bottom: 45px;
    position: relative;
}
h1 {
    color: #7e8766;
    font-family: "Helvetica Neue",Helvetica,sans-serif;
    font-size: 4.34em;
    font-weight: 700;
    line-height: 1.6em;
}
#top h1 a {
    display: block;
    height: 110px;
    left: 500px;
    margin: 0;
    padding: 0;
    position: absolute;
    text-indent: -9999px;
    top: -22px;
    width: 140px;
    z-index: 9999;
}
#top h1 img {
    display: block;
    left: 540px;
    margin: 0;
    padding: 0;
    position: absolute;
    text-indent: -9999px;
    top: -22px;
    width: 140px;
    z-index: 9999;
}
.nav.navbar-nav.sponsor {
    float: left;
    margin: 0 170px;
}
.project_manager {
    float: right;
    margin-top: 25px;
    padding: 0 12px;
}
.project_manager h5 {
    color: #9da2a6;
    font: 18px helveticaregular;
}
.project_manager span {
    color: #9fce64;
    font: 18px helveticaregular;
}
.project_manager small {
    color: #00aff0;
    font: 18px helveticaregular !important;
    margin: 0 !important;
}
.project_manager cite {
    color: #f68d20;
    font: 18px helveticaregular !important;
    margin: 0 !important;
}
.project_manager span:last-child {
    color: #00aff0;
    font: 18px helveticaregular;
}
.dashboard_banner {
    background: #fff none repeat scroll 0 0;
    border-radius: 5px 5px 0 0;
    box-shadow: 0 -4px 9px #4a4e45;
    float: left;
    margin: 40px 0 0;
    padding: 30px 0 0;
    width: 100%;
}
.nav li a.midsection {
    margin-right: 160px !important;
}
.nav li a {
    font-size: 17px !important;
    padding: 9px 8px !important;
}
.nav > li {
    padding: 0 11px !important;
}
#top {
    margin-bottom: 0 !important;
  }
  .padtop, .navbar-nav.padtop {
    margin-top: 15px !important;
}
.top_right {
    margin-top: 40px !important;
}

</style>
 <?php }?>

<div id="banner_login">
  <div class="container">
    <div class="row">
        <?php if ($user_roles == "editor"){?>

      <div class="dashboard_banner">
        <header id="top">
        <h1> <a href="index.html">Kitchy Food</a><img src="<?php bloginfo('template_url'); ?>/images-dashboard/logout_logo.png" alt=""></h1>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

               <ul class="nav navbar-nav">
            <li ><a style="margin-top: 12px;" href="<?php echo site_url();?>/dashboard/">HOME</a></li>
            <li><a href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A <br>
              NEW STUDY</a></li>
                 <li ><a   href="<?php echo site_url();?>/refer-listing/">REFER <br>
              A LISTING</a></li>
            <li style="border:none;"><a  class="midsection" href="<?php echo site_url();?>/rewards/">REWARDS</a></li>

            <li><a style="margin-top: 12px;" href="<?php echo site_url();?>/proposal/">PROPOSAL</a></li>
            <li><a href="/invoice-receipts/"  style="color:#00afef;">INVOICE <br />
              RECEIPTS</a></li>
            <li><a href="<?php echo site_url();?>/your-profile/?idp=Profile">MY <br/>
              ACCOUNT</a></li>
          </ul>

            </div>
            <!-- /.navbar-collapse -->
            <div class="project_manager">
              <h5>Stud<small>y</small><cite>KIK</cite> Project Manager: <span><?php echo get_user_meta($user_ID, 'project_manager', true); ?></span> - <span><?php echo get_user_meta($user_ID, 'phone_number', true); ?></span></h5>
            </div>
          </div>
          <!-- /.container-fluid -->
        </nav>
      </div>

      <?php }?>
                 <?php if ($user_roles == "manager_username"){?>
        <style>
         .nav > li {
    padding: 8px !important;
 }
 #top h1 img {
    left: 480px !important;
 }
.custom-combobox {
    margin-left: 673px !important;
    width: 100%;
}
.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input {
  height: 40px;
  width: 310px;
  margin-left:131px;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
  background: #e6e6e6 url("images/ui-bg_glass_75_e6e6e6_1x400.png") repeat-x scroll 50% 50% !important;
   
}
.ui-button.ui-widget.ui-state-default.ui-button-icon-only.custom-combobox-toggle.ui-corner-right {
    border-radius: 0;
    height: 40px;
    position: absolute;
    width: 17px;
}
.ui-widget {
    margin-top: 10px;
    padding: 0 3px 1px 2px;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
	background:white !important;
}
.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input {
    padding: 9px;
}
.ui-button.ui-widget.ui-state-default.ui-button-icon-only.custom-combobox-toggle.ui-corner-right {
    background: rgba(0, 0, 0, 0) linear-gradient(to top, #dadada 0%, #ededed 100%) repeat scroll 0 0 !important;
    border: 1px solid #717171  !important;
}
.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input {
    border-radius: 0;
}
        </style>
			<script>
	(function( $ ) {
		$.widget( "custom.combobox", {
			_create: function() {
				this.wrapper = $( "<span>" )
					.addClass( "custom-combobox" )
					.insertAfter( this.element );

				this.element.hide();
				this._createAutocomplete();
				this._createShowAllButton();
			},

			_createAutocomplete: function() {
				var selected = this.element.children( ":selected" ),
					value = selected.val() ? selected.text() : "";

				this.input = $( "<input>" )
					.appendTo( this.wrapper )
					.val( value )
					.attr( "title", "" )
					.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy( this, "_source" )
					})
					.tooltip({
						tooltipClass: "ui-state-highlight"
					});

				this._on( this.input, {
					autocompleteselect: function( event, ui ) {
						ui.item.option.selected = true;
						this._trigger( "select", event, {
							item: ui.item.option
						});
					},

					autocompletechange: "_removeIfInvalid"
				});
			},

			_createShowAllButton: function() {
				var input = this.input,
					wasOpen = false;

				$( "<a>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "" )
					.tooltip()
					.appendTo( this.wrapper )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "custom-combobox-toggle ui-corner-right" )
					.mousedown(function() {
						wasOpen = input.autocomplete( "widget" ).is( ":visible" );
					})
					.click(function() {
						input.focus();

						// Close if already visible
						if ( wasOpen ) {
							return;
						}

						// Pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
					});
			},

			_source: function( request, response ) {
				var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
				response( this.element.children( "option" ).map(function() {
					var text = $( this ).text();
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
				}) );
			},

			_removeIfInvalid: function( event, ui ) {

				// Selected an item, nothing to do
				if ( ui.item ) {
					return;
				}

				// Search for a match (case-insensitive)
				var value = this.input.val(),
					valueLowerCase = value.toLowerCase(),
					valid = false;
				this.element.children( "option" ).each(function() {
					if ( $( this ).text().toLowerCase() === valueLowerCase ) {
						this.selected = valid = true;
						return false;
					}
				});

				// Found a match, nothing to do
				if ( valid ) {
					return;
				}

				// Remove invalid value
				this.input
					.val( "" )
					.attr( "title", value + " didn't match any item" )
					.tooltip( "open" );
				this.element.val( "" );
				this._delay(function() {
					this.input.tooltip( "close" ).attr( "title", "" );
				}, 2500 );
				this.input.autocomplete( "instance" ).term = "";
			},

			_destroy: function() {
				this.wrapper.remove();
				this.element.show();
			}
		});
	})( jQuery );


	</script>
	<script>
	 $(function() {
		 
$( "#combobox" ).combobox({
		select: function( event, ui ) {
				var selected_idd=ui.item.value;
						  
		var url      = window.location.href;
	  if(selected_idd == "" ||selected_idd == ""){}else{
	  location.search = "aid="+selected_idd;
	 }
					
					}
	 
});
});
  
 
	</script>
                    <div class="dashboard_banner">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                </div>
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <header id="top">
                                        <h1><a href="index.html">Kitchy Food</a><img src="<?php echo get_template_directory_uri(); ?>/images-dashboard/logout_logo.png" alt=""></h1>
                                    </header>
                                 <ul class="nav navbar-nav">
                                        <li><a href="<?php echo site_url();?>/dashboard/" style="margin-top:12px">HOME
                                            </a></li>
                                            <li><a href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A<br>
                                                NEW STUDY</a></li>
                                                <li><a  href="<?php echo site_url();?>/add-site/">ADD<br>
                                                SITE</a></li>
                                        <li style="border:none;"><a class="midsection" href="<?php echo site_url();?>/refer-listing/">REFER<br>
                                                A LISTING</a></li>
                                        <li ><a href="<?php echo site_url();?>/rewards/" style="margin-top:12px">REWARDS</a></li>
<!--                                        <li><a href="javascript:void:0();"> ADD<br> PREFERRED<br> IRBs</a></li>-->
                                       <li><a href="<?php echo site_url();?>/proposal/">CREATE <br/> PROPOSAL</a></li>
                                         <li><a href="<?php echo site_url();?>/invoice-receipts/"  style="color:#00afef;">INVOICE <br />
                                         RECEIPTS</a></li>
                                        <li><a href="<?php echo site_url();?>/your-profile/?idp=Profile" style="margin-top:12px">MY ACCOUNT
                                                </a></li>
                                    </ul>
                                    <div class="studykik_contact">
                                        <p>Stud<span class="blue_text">y</span><span class="orange_text">KIK</span> Team Member: <span class="green_text"><?php echo get_user_meta($user_ID, 'project_manager', true); ?></span> - <span class="blue_text"><?php echo get_user_meta($user_ID, 'phone_number', true); ?></span></p>

                                    </div>
                                </div>
                                <!-- /.navbar-collapse -->
                            </div>
                            <!-- /.container-fluid -->
                        </nav>
                    </div>

                 <?php }?>
      <?php
	  $month = $_REQUEST['month_select'];
	  $year = $_REQUEST['year_select'];

	  ?>
	
      <section id="invoice_receipts">
		 
								<?php 
								$sel_val ='all';
								
								 
								
									if ($user_roles == 'manager_username') {
                                        $post_author_id = get_post_field('post_author', $post->ID);
                                        if ($post_author_id) {
                                            if ($post_author_id > 0) {
                                                $user = get_user_by('id', $post_author_id);
                                                if ($user->user_login != "") {
                                                    $authors_ids[$post_author_id] = $user->user_login;
                                                }
                                            }
                                        }
                                    }
													 
													?>
							  <?php if ($user_roles == "manager_username"){?>
									<div class="ui-widget">
			 <select id="combobox">
			
                        <?php
						natcasesort($_SESSION['authors_ids']);
						$k=1;
                        foreach($_SESSION['authors_ids'] as $auid => $qry){
if($k==1){
	$sel_val=$auid;
}
$k=$k+1;
if(isset($_REQUEST['aid'])){
									$sel_val = $_REQUEST['aid'];
									if($sel_val==""){
										$sel_val ='all';
									}
								}
						?>
                            <option <?php if($auid == $sel_val){echo 'selected="selected"';}?> value="<?php echo $auid;?>"><?php echo $qry;?></option>
                        <?php 
						
						} 
					  
					 
						?>

                            </select>
							</div>
							  <?php } ?>
        <img class="img-responsive center-block" alt="" src="<?php bloginfo('template_url');?>/images-dashboard/invoice.png">
        <h4>INVOICE RECEIPTS</h4>
        <div class="full_dropdown">
        <form action="" method="post" style="float:left;">
        <select class="month_select" name="month_select">
  <option value="">SELECT MONTH</option>
  <option value="Jan" <?php if($month == "Jan"){ echo 'selected="selected"';}?>>January</option>
  <option value="Feb" <?php if($month == "Feb"){ echo 'selected="selected"';}?>>February</option>
  <option value="Mar" <?php if($month == "Mar"){ echo 'selected="selected"';}?>>March</option>
   <option value="Apr" <?php if($month == "Apr"){ echo 'selected="selected"';}?>>April</option>
    <option value="May" <?php if($month == "May"){ echo 'selected="selected"';}?>>May</option>
     <option value="Jun" <?php if($month == "Jun"){ echo 'selected="selected"';}?>>June</option>
      <option value="Jul" <?php if($month == "Jul"){ echo 'selected="selected"';}?>>July</option>
       <option value="Aug" <?php if($month == "Aug"){ echo 'selected="selected"';}?>>August</option>
        <option value="Sep" <?php if($month == "Sep"){ echo 'selected="selected"';}?>>September</option>
         <option value="Oct" <?php if($month == "Oct"){ echo 'selected="selected"';}?>>October</option>
          <option value="Nov" <?php if($month == "Nov"){ echo 'selected="selected"';}?>>November</option>
           <option value="Dec" <?php if($month == "Dec"){ echo 'selected="selected"';}?>>December</option>
</select>
        <select class="year_select" name="year_select">
  <option value="">SELECT YEAR</option>
  <option value="2015" <?php if($year == "2015"){ echo 'selected="selected"';}?>>2015</option>
    <option value="2014" <?php if($year == "2014"){ echo 'selected="selected"';}?>>2014</option>
</select>
<input type="submit" value="Submit" class="submit_get" name="submit_get" style="margin-left:10px;"/>
<a href="<?php the_permalink(); ?>?d=download&aid=<?php echo $sel_val;?>" class="download_invoice" style="margin-left:160px;"><img class="img-responsive" alt="" src="<?php bloginfo('template_url');?>/images-dashboard/downlode_btn.png"></a>
</form>

        </div>
        <div class="protocol_number">
        <table class="table table-hover">
        <thead>
            <tr>
                <th class="protocal">Date</th>
                <th class="protocal">Total</th>
                <th class="protocal">Invoice Number</th>
                <th class="protocal">Protocol Number</th>
            </tr>
        </thead>
        <tbody>

        <?php


		if($month && $year){
			if($sel_val == 'all')
			{
				
		$query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` WHERE user_id = '$user_ID' and month = '$month' and year = '$year' ORDER BY `id` DESC");

				
			}
		 
			else{
				 
				
		$query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` WHERE user_id = '$sel_val' and month = '$month' and year = '$year' ORDER BY `id` DESC");

				
			}

		

		}else{
			//echo $user_ID;
			if($sel_val == 'all')
			{
				
		$query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` WHERE user_id = '$user_ID' ORDER BY `id` DESC");

				
			}
		 
			else{
				 
				
		$query_invoice_number = $wpdb->get_results( "SELECT * FROM `0gf1ba_invoice_number` WHERE user_id = '".$sel_val."' ORDER BY `id` DESC");

				
			}
		
		}
 
		if($query_invoice_number){
			
			
			
		 
		 
		foreach($query_invoice_number as $query_invoice_number_value)
		{

			$file_to_download[] = site_url().$query_invoice_number_value->pdf_name;
			
			

			//$file_to_download2 = 'http://studykik.com'.$query_invoice_number_value->pdf_name;
			//if( is_dir(dirname(__FILE__).'/temp_pdf/StudyKIK_Invoices/'.$query_invoice_number_value->month) === false )
            //{
				//$aaaa= str_replace("/pdf/","",$query_invoice_number_value->pdf_name);
              //  mkdir(dirname(__FILE__).'/temp_pdf/StudyKIK_Invoices/'.$query_invoice_number_value->month.' '.$query_invoice_number_value->year.' Invoices');
			  //  copy(dirname(__FILE__).$query_invoice_number_value->pdf_name, dirname(__FILE__).'/temp_pdf/StudyKIK_Invoices/'.$query_invoice_number_value->month.' '.$query_invoice_number_value->year.' Invoices/'.$aaaa);
          //  }
		?>
         <tr>
        <td class="second_row"><?php echo $query_invoice_number_value->full_date;   ?></td>
        <td class="second_row"><?php echo $query_invoice_number_value->price;?></td>
        <td class="second_row"><a target="_blank" href="<?php bloginfo('url');?><?php echo $query_invoice_number_value->pdf_name;?>"><?php echo $query_invoice_number_value->invoice_number;?></a></td>
        <td class="second_row"><?php echo $query_invoice_number_value->protocol_no;?></td>
        </tr>
	
		<?php   }

			

		}else{?>
         <tr>
        <td colspan="4" class="second_row"> No Invoice found!</td>

        </tr>

        <?php }?>


        </tbody>
        </table>  
        </div>
        </section>
    </div>
  </div>
</div>
<?php
$download_l = $_REQUEST['d'];
if($download_l){
  echo $files = $file_to_download;
    $dirnm=$_SERVER["DOCUMENT_ROOT"].'/list_invoice/StudyKIK_Invoices/';
  $dirs = opendir($dirnm);

    while ($file = readdir($dirs)){

unlink($_SERVER["DOCUMENT_ROOT"].'/list_invoice/StudyKIK_Invoices/'.$file);

}
	 

    foreach($files as $file){
        copy($_SERVER["DOCUMENT_ROOT"].'/pdf/'.basename($file),$_SERVER["DOCUMENT_ROOT"].'/list_invoice/StudyKIK_Invoices/'.basename($file));

    }

$the_folder = $_SERVER["DOCUMENT_ROOT"].'/list_invoice/StudyKIK_Invoices';
$zip_file_name = 'StudyKIK_Invoices.zip';


$download_file= true;
//$delete_file_after_download= true; doesnt work!!


class FlxZipArchive extends ZipArchive {
    /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  **/

    public function addDir($location, $name) {

        $this->addEmptyDir($name);

        $this->addDirDo($location, $name);
     } // EO addDir;

    /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann
     * @access private   **/
    private function addDirDo($location, $name) {
        $name .= '/';
        $location .= '/';

        // Read all Files in Dir
        if($dir = opendir ($location)){
        while ($file = readdir($dir))
        {



            if ($file == '.' || $file == '..') continue;
            // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
            $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
            $this->$do($location . $file, $name . $file);
        }
        }
        else{

        }

    }
}

$za = new FlxZipArchive;
$res = $za->open($zip_file_name, ZipArchive::CREATE);
if($res === TRUE)
{
    $za->addDir($the_folder, basename($the_folder));
    $za->close();
}
else  { echo 'Could not create a zip archive';}

if ($download_file)
{

    ob_get_clean();
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);
    header("Content-Type: application/zip");
    header("Content-Disposition: attachment; filename=" . basename($zip_file_name) . ";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: " . filesize($zip_file_name));
    readfile($zip_file_name);
    unlink($zip_file_name);

}
}


?>
<div style="display: none;" class="white_content" id="embed">
            <h2 class="heading">Oops</h2>

                <p style="color: #000; padding: 15px; font-size: 20px; text-align: center;font-weight: bold;">Must select month and year!</p>

            <a class="closepop" href="javascript:void(0)" onclick="document.getElementById('embed').style.display = 'none';document.getElementById('fade').style.display = 'none';">Close</a>
</div>
<div class="black_overlay" id="fade" style="display: none;"></div>
<script type="text/javascript">

jQuery(document).ready(function(){

 jQuery( "form" ).submit(function() {
	  var month_select = jQuery('.month_select :selected').val();
	 var year_select = jQuery('.year_select :selected').val();

	 if(month_select == "" || year_select == "")
	 {
		//alert('Must select month and year!');
		jQuery('#embed').css('display', 'block');
		jQuery('#fade').css('display', 'block');
		return false;
	 }
});
 });
</script>
<?php get_footer('dashboard');?>