<?php
	/*
Template Name: Contact Main
*/

get_header(); ?>
<style>



/*********************************shoping_section css***********************************/
#shoping_section {
	background:url(../images/shoping_back.png) repeat-x;
	height: 18px;
	position: relative;
	width:100%;
}
.shoping_background {
	background:#f5f5f5;
	float:left;
	width:100%;
}
.shoping_text {
	float:right;
}
.shoping_text h4 {
	color:#9fcf67;
	font:22px/40px 'helveticaregular';
	border-bottom:2px solid #9fcf67;
	margin:10px 0 20px;
	float:right;
}
.billing_text h4 {
	color:#959ca1;
	font:22px/40px 'helveticaregular';
	border-bottom:2px solid #959ca1;
	margin:10px 0 20px;
	float:left;
}
.check_btn {
	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
	border: medium none;
	display: block;
	margin: 25px auto;
}
#table_background {
	background:#f5f5f5;
	float:left;
}
.table_top {
	background:#a0cf68;
}
.table_top tr {
	height:20px;
}
.platinum_table {
	background:#d9d9d9;
}
.quantity {
	border: 1px solid #959ca1;
	border-radius: 6px;
	padding: 7px 22px;
	float:left;
}
.diamond {
	float:left;
}
.diamond img {
	width: 80%;
}
.delete_btn {
	color:#fff;
	background:#f78f1e;
	padding:4px;
	font: 14px "helveticaregular" !important;
}
.table_bottum {
	background:#a0cf68;
}
.code_search {
	color:#FFF !important;
	float: left;
}
.search_box {
	border: 1px solid #959ca1;
	border-radius: 6px;
	color:#959ca1;
	padding: 2px 12px;
	width: 274px;
}
.total {
	color:#FFF !important;
	float: left;
	font:18px 'helveticabold' !important;
}
.total_left_border {
	border-left:1px solid #FFF;
}
.total_left_border {
	border-right: 1px solid #fff !important;
}
.table td {
	border-right: 1px solid #b5b5b5;
	color: #959ca1;
	font: 18px "helveticaregular" !important;
	padding: 14px !important;
	text-align: center;
	vertical-align: middle !important;
}
.table th {
	padding:12px !important;
	color:#FFF;
	font:18px 'helveticaregular' !important;
	border-right: 1px solid #fff !important;
}
.table td:last-child {
	border: medium none;
}
/*shopping cart css end*/
.right_section {
	float:right;
	width:30%;
}
.side-bar {
	background: #959ca1 none repeat scroll 0 0;
	float: right;
	min-height: 2996px;
	height:2996px;
	position: absolute;
	z-index: 9999;
}
.side-bar .order-summary table {
	width:100%;
}
.side-bar caption {
	background:#00afef;
	padding:25px;
	color:#FFF;
	font-family: 'helveticaregular';
	font-size:30px;
}
.side-bar table td {
	padding: 12px;
	color:#feffff;
	font:18px 'helveticaregular';
}
.diamond_listing {
	color:#9fcf67;
	font:18px 'helveticaregular';
}
.coupon_discount {
	color:#c5c5c5;
	font:18px 'helveticaregular';
}
.total_bold {
	color:#ffffff;
	font:22px 'helveticabold';
}
.order-summary tr {
	border-bottom: 1px solid #fff;
}
/****right_section****/
#post_background {
	background:url(../images/background_patern.png) repeat-x;
	height:72px;
	width:100%;
	float:left;
}
.choose_number {
	float:left;
	width:100%;
	background:#60cdf6;
}
.choose_heading h2 {
	color: rgb(255, 255, 255) !important;
	font:20px 'helveticaregular';
	font-weight: bold;
	line-height: 34px;
	margin: 20px 0 27px;
	text-transform: uppercase;
	text-align:center;
	border-bottom:1px solid #FFF;
}
.col-sm-12.col-md-12.col-xs-12.contact_heading a {
    font: 18px "helveticaregular";
}
#diamond_post {
	width: 96%;
}
.background_color {
	background:#00afef;
	width:100%;
	float:left;
}
/*post_background css end*/
.trial_text {
	width:100%;
	float:left;
	margin:15px auto;
}
.trial_text h1 {
	font-size:24px;
	color:#f78f1e;
	text-align:center;
	font-family: 'helveticaregular';
	margin:0;
	text-transform:uppercase;
}
.listing_bottum {
	width:58px;
	height:1px;
	background:#949ca1;
	text-align:center;
	margin:0 auto;
}
.block_1 {
	width:100%;
	float:left;
	margin-bottom: 29px;
}
.search_left {
	width:22%;
	float:left;
}
.search_left img {
	width:100%;
}
.right_text {
	float: right;
	position: relative;
	top: 40px;
	width: 73%;
}
.right_text h3 {
	color: #949ca1;
	float: left;
	font-family: 'helveticaregular';
	font-size: 26px;
	font-weight: normal;
	margin: 18px 0 0;
	text-align: left;
}
.search_line {
	float: right;
	left: 329px;
	position: absolute;
	top: 46px;
}
.search_line img {
	width:100%;
}
.search_line_2 {
	float: right;
	left: 163px;
	position: absolute;
	top: 48px;
}
.search_line_2 img {
	width:100%;
}
.search_line_3 {
	float: right;
	left: 158px;
	position: absolute;
	top: 43px;
}
.search_line_3 img {
	width:100%;
}
.search_line_4 {
	float: right;
	left: 122px;
	position: absolute;
	top: 48px;
}
.search_line_4 img {
	width:100%;
}
.search_line_5 {
	float: right;
	left: 65px;
	position: absolute;
	top: 45px;
}
.search_line_5 img {
	width:100%;
}
.search_line_6 {
	float: right;
	left: 106px;
	position: absolute;
	top: 47px;
}
.search_line_6 img {
	width:100%;
}
.search_line_7 {
	float: right;
	left: 2px;
	position: absolute;
	top: 45px;
}
.search_line_7 img {
	width:100%;
}

/*********************************************************billing_payment css start****************************************************/
#name_section {
	float:left;
	margin:26px 0 0;
	width:100%;
}
.horizontal_line {
	width:100%;
	float:left;
	height:1px;
	background:#cfd1d3;
	margin:40px 0;
}
.name_first {
	padding:0 5px !important;
}
#phone_number {
	margin-bottom: 14px;
}
#check_information {
	color:#a0cf68;
	font:16px 'helveticaregular' !important;
}
.drop_btn {
	background: #ffffff url("../images/drop_menu.png") no-repeat scroll 90% 60%;
	border: 1px solid #cccccc;
	border-radius: 6px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
	color: #959ca1;
	display: block;
	font-size: 17px;
	font-family: 'helveticaregular' !important;
	height: 47px;
	line-height: 1.42857;
	padding: 6px 12px;
	transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
	vertical-align: middle;
	width: 100%;
}
select {
	-moz-appearance: none;
	appearance: none;
	text-overflow: ''; /* this is important! */
}
textarea.form-control {
	height: 167px !important;
	color: #999999;
}
.center_number h4 {
	text-align:center;
	font:22px 'helveticabold';
	color:#f78f1e;
	margin:34px 0;
}
.submit_btn {
	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
	border: medium none;
	display: block;
	margin-left: auto;
	margin-right: auto;
	padding: 0;
	text-align: center;
}
.billing_payment {
	background:#f5f5f5;
	float:left;
	width:100%;
	height:2543px;
	min-height:2543px;
}
.form-control {
	background-color: #ffffff;
	background-image: none;
	border: 1px solid #cccccc;
	border-radius: 6px !important;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
	color: #959ca1 !important;
	display: block;
	font-size: 17px !important;
	height: 47px !important;
	font-family: 'helveticaregular' !important;
	line-height: 1.42857;
	padding: 6px 12px;
	transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
	vertical-align: middle;
	width: 100%;
}
/***********studykik team css start***********************/
#contact_banner {
	float:left;
	width:100%;
}
.contact_heading {
	float:left;
	width:100%;
}
.contact_heading h4 {
	color:#00afef;
	font:27px "helveticabold";
	text-align:center;
	margin:26px 0;
}
.contact_heading p {
	color:#959ca1;
	font:18px 'helveticaregular';
	text-align:center;
	margin-bottom:20px;
}
.contact_heading a {
	color:#9fcf67;
	font:20px 'helveticabold';
	text-align:center;
}
#patern_background {
	background:rgba(0, 0, 0, 0) url(https://studykik.com/wp-content/themes/twentyfifteen/images/patern_contact.png) repeat-x scroll 0 0;
	float:left;
	height:47px;
	width:100%;  
}
#contact_location {
	float:left;
	width:100%;
	background:#f5f5f5;
}
.staff_member {
	top:0px;
	left:20px;
	position:relative;
	height:446px;
}
.staff_friendly_member {
	position: absolute;
	right: 210px;
	top: 60px;
	width: 41%;
}
.staff_friendly_member p {
	color:#afb5b9;
	font:20px 'helveticaregular';
	margin-bottom: 20px;
}
.call_client {
	float:left;
}
.call_client p {
	color: #f78f1e;
	font: 22px "helveticaregular";
	margin: 0;
}
.client_email {
	float:right;
}
.client_email p {
	color:#00afef;
	font:22px 'helveticaregular';
	margin:0;
}
.call_client span img {
	float: left;
	margin: 0 14px 0 0;
	width: 14%;
}
.client_email span img {
	float: left;
	margin: 0 14px 0 0;
	width: 14%;
}
.call_client small {
	border-bottom:2px solid #f78f1e;
	font:20px "helveticabold" !important;
	font-weight:bold!important;
}
.client_email a {
    font: 20px "helveticabold";
}
.client_email small {
	border-bottom:2px solid #00afef;
}
.staff_friendly_member img {
	float: left;
	margin: 30px 0;
}
.location_address {
	float:left;
	width:100%;
	
}
.location_address p {
	color: #afb5b9;
    font: 20px "helveticaregular";
	margin-left:43%;
	margin-bottom: 0;
	
}
.location_address small {
	float:left;
	margin:0 14px 0 0
}
.location_address b {
	color:#9fcf67;
	font:20px 'helveticabold';
	margin:0;
	text-decoration:underline;
}
.location_address small {
	float: left;
	margin: 15px 0 0 31%;
	
}
.location_address > small img {
	float: left;
	margin: 5px 10px 60px 0;
}
#center_logo {
	float:left;
	width:100%;
}
#tfnewsearch {
	float:left;
	width:100%;
}
.tftextinput {
	margin: 0;
	padding: 5px 15px;
	font-family: 'helveticabold';
	font-size:14px;
	border:1px solid #e8e8e8;
	border-right:0px;
	border-top-left-radius:0;
	background:#e8e8e8;
	border-bottom-left-radius:0;
	width: 68%;
	height:44px;
	color:#959ca1;
}
.tfbutton {
	margin: 0;
	padding: 5px 15px;
	font-family: 'helveticabold';
	font-size:14px;
	outline: none;
	cursor: pointer;
	text-align: center;
	text-decoration: none;
	color: #ffffff;
	height:44px;
	background:url(../images/email_arrow.png) no-repeat #9fcf67;
	border: solid 1px #9fcf67;
	border-right:0px;
	background-position:40% 50%;
	border-top-right-radius: 0;
	border-bottom-right-radius: 0;
}
.tfbutton:hover {
	text-decoration: none;
}
	/* Fixes submit button height problem in Firefox */
	.tfbutton::-moz-focus-inner {
 border: 0;
}
.tfclear {
	clear:both;
}
#footer span {
    color: #00729c;
    float: left;
	font:16px 'helveticaregular';
    margin: 10px 0;
}
@media screen and (max-width:980px) {
header {
 padding: 0;
}
ul.head-social {
 text-align: left;
 width: 16% !important;
}
ul.navbar-nav.padtop {
 text-align: center;
 width: 85% !important;
}
ul.head-social {
 margin: 0 !important;
 width: 14% !important;
}
.right_section {
 float: right;
 width: 29%;
}
.side-bar {
 min-height: 2636px !important;
}
.right_text h3 {
 font-size: 22px;
}
.search_line {
 left: 166px;
}
.search_line_5 img {
 width: 60%;
}
.search_line img {
 width: 60%;
}
.search_line_2 img {
 width: 60%;
}
.search_line_3 img {
 width: 60%;
}
.search_line_4 img {
 width: 60%;
}
.search_line_6 img {
 width: 60%;
}
.search_line_7 img {
 width: 60%;
}
.search_box {
 width: 207px;
}
.code_search {
 font-size: 16px;
}
.choose_heading h2 {
 font: bold 16px/34px "helveticaregular";
}
.completed_text {
 font: 16px "helveticaregular";
 margin: 0 0 20px;
}
.purchased br {
 display:none;
}
.purchased_two br {
 display:none;
}
.purchased_three br {
 display:none;
}
.heading_clinical h3 {
 font: 32px "alternate";
}
.side-bar caption {
 font-size: 26px;
}
.side-bar {
 height: 2626px;
}
}
@media screen and (max-width:800px) {
 .side-bar table td {
 font: 15px "helveticaregular";
 padding: 5px;
}
.coupon_discount {
 font: 16px "helveticaregular";
}
.total_bold {
 font: 18px "helveticabold";
}
.right_section {
 width: 27%;
}
.side-bar caption {
 padding: 5px;
}
.completed_text br {
 display:none;
}
.table td {
 padding: 2px !important;
 font: 14px "helveticaregular" !important;
}
.code_search {
 font-size: 14px;
}
.search_box {
 width: 170px;
}
.choose_heading h2 {
 font: bold 14px/22px "helveticaregular";
}
.right_text {
 top: 0;
 width: 75%;
}
.right_text h3 {
 font-size: 18px;
}
.navbar-nav.navbar-right:last-child {
 margin-right: 0 !important;
}
.nav.navbar-nav.padtop > li a {
 padding: 17px 12px !important;
}
ul.navbar-nav.padtop {
 width: 80% !important;
}
ul.head-social {
 width: 19% !important;
}
.side-bar table td {
 padding: 3px;
}
.right_section {
 width: 26%;
}
.side-bar {
 min-height: 2254px !important;
 height:2254px !important;
}
.staff_member {
    left: 0;
}
.staff_friendly_member {
    position: absolute;
    right: 34px;
    top: 40px;
    width: 61%;
}
.staff_friendly_member p {
    margin-bottom: 8px;
}
.staff_friendly_member img {
    margin: 12px 0;
}
}
@media screen and (max-width:768px) {
.side-bar {
 height: 2235px !important;
 min-height: 2235px !important;
}
.heading_clinical span {
 font: 15px "helveticabold";
}
.heading_clinical p {
 font: 15px "helveticaregular";
}
.right_section {
 width: 29%;
}
.nav.navbar-nav.padtop > li a {
 padding: 17px 8px !important;
}
}
@media screen and (max-width:767px) {
 ul.navbar-nav.padtop {
 margin: 0 !important;
 width: 100% !important;
}
.left_section {
 float: left;
 width: 100%;
}
ul.head-social {
 width: 100% !important;
}
#footer h1.first {
 margin: 0;
 text-align: left;
}
.side-bar {
 min-height: 2401px !important;
}
.right_section {
 float: left;
 width: 100%;
}
.side-bar {
 min-height: auto !important;
 position: inherit;
 width: 100%;
}
.side-bar {
 height: auto !important;
}
.right_text {
 top: 30px;
 width: 75%;
}
.side-bar table td {
 padding: 10px;
}
#diamond_post {
 width: 100%;
}
.purchased h4 {
 font: 17px "helveticaregular";
}
.name_first {
 margin-bottom: 14px;
 padding: 0 5px !important;
}
}
@media screen and (max-width:480px) {
.diamond {
 width: 16%;
}
.search_box {
 width: 113px;
}
.heading_studykik {
 margin: 0 0 20px;
}
.right_text {
 top: 0;
 width: 75%;
}
.delete_btn {
 font: 12px "helveticaregular" !important;
 padding: 2px;
}
.purchased {
 margin: 0;
}
.staff_friendly_member {
    position: absolute;
    right: 34px;
    top: 17px;
    width: 57%;
}
.staff_friendly_member p {
    font: 14px "helveticaregular";
}
.call_client p {
    font: 16px "helveticaregular";
    margin: 0;
}
.client_email {
    float: left;
}
.client_email p {
    color: #00afef;
    font: 14px "helveticaregular";
}
.staff_friendly_member img {
    margin: 5px 0;
}
.location_address p {
    font: 14px "helveticaregular";
}
.location_address small {
    float: left;
    margin: 0;
}
.location_address > small img {
    float: left;
    margin: 5px 10px 6px 0;
}
.location_address b {
    color: #9fcf67;
    font: 12px "helveticabold";
    margin: 0;
    text-decoration: underline;
}
.location_address br {
    display: none;
}
.staff_member {
    height: 230px;
}
}
@media screen and (max-width:380px) {
.staff_friendly_member img {
    margin: 0;
}
.staff_friendly_member {
    right: 0;
    top: 17px;
    width: 65%;
}
.staff_friendly_member p {
    font: 12px "helveticaregular";
}
.location_address b {
    font: 10px "helveticabold";
}
.location_address > small img {
    margin: 5px 10px 0 0;
    width: 7%;
}
.contact_heading h4 {
    margin: 10px 0;
}
.contact_heading p {
    font: 16px "helveticaregular";
    margin-bottom: 8px;
}
.contact_heading a {
    color: #9fcf67;
    font: 16px "helveticabold";
    text-align: center;
}
}
@media screen and (max-width:360px) {
.search_line_7 {
 top: 32px;
}
.search_line_6 {
 top: 32px;
}
.search_line_5 {
 left: 103px;
 top: 31px;
}
.search_line_3 {
 left: 120px;
 top: 33px;
}
.search_line_3 img {
 width: 40%;
}
.search_line_2 {
 left: 163px;
 top: 30px;
}
.trial_text h1 {
 font-size: 16px;
}
.choose_heading h2 {
 font: bold 13px/22px "helveticaregular";
 margin: 10px 0;
}
.shoping_text h4 {
 font: 16px/40px "helveticaregular";
}
.billing_text h4 {
 font: 16px/40px "helveticaregular";
}
.navbar-nav.navbar-right:last-child {
 padding: 0 30px;
}
.call_client span img {
    width: 12%;
}
.client_email span img {
    width: 12%;
}
.staff_friendly_member p {
    margin-bottom: 4px;
}
.staff_member {
    height: 175px;
}
}
@media screen and (max-width:320px) {
 .heading_clinical h3 {
 font: 24px "alternate";
 margin: 15px 0;
}
.billing_text h4 {
 font: 14px/40px "helveticaregular";
}
.shoping_text h4 {
 font: 14px/40px "helveticaregular";
}
.search_line_7 {
 left: 60px;
 top: 45px;
}
.search_line_5 {
 left: 30px;
 top: 49px;
}
.search_line_2 {
 left: 106px;
 top: 53px;
}
.search_line {
 left: 74px;
 top: 50px;
}
.staff_friendly_member {
    right: 0;
    top: 8px;
    width: 68%;
}
}

	</style>
	
	
<section id="contact_banner">
<img src="<?php bloginfo(template_url);?>/images/bannner_team.png" style="width:100%!important;" alt="" class="img-responsive center-block">
</section>
<div class="container">
<div class="col-sm-12 col-md-12 col-xs-12 contact_heading">
<h4>CONTACT</h4>
<p>StudyKIK is dedicated to helping people find clinical trials in their area. </p>
<p>If you wish to have volunteers find your clinical trials,&nbsp;<a href="https://studykik.com/list-your-clinical-trials/">CLICK HERE&nbsp;</a></</p>
</div>
</div>
<section id="patern_background">
</section>
<artical id="contact_location">
<div class="container">
<div class="staff_member">
<img src="<?php bloginfo(template_url);?>/images/client_background.png" alt="" class="img-responsive center-block">
<div class="staff_friendly_member">
<p>To speak with one of our friendly staff members,
please contact us at:</p>
<div class="call_client">
<p><span><img src="<?php bloginfo(template_url);?>/images/call.png" alt="" class="img-responsive"></span><small>877.627.2509</small></p>
</div>
<div class="client_email">
<p><span><img src="<?php bloginfo(template_url);?>/images/email_client.png" alt="" class="img-responsive"></span><a href="mailto:info@studykik.com">info@studykik.com</a></p>
</div>
<img src="<?php bloginfo(template_url);?>/images/dotted_line.png" alt="" class="img-responsive">
<div class="location_address">
<p>Location:</p>
<small><img src="<?php bloginfo(template_url);?>/images/location_address.png" alt="" class="img-responsive"><b>1675 Scenic Ave<br>
Suite 150<br>
Costa Mesa, Ca 92626</b></small>
</div>
</div>
</div>
</div>
</artical>
<section id="center_logo">
<img src="<?php bloginfo(template_url);?>/images/center_logo1.png" alt="" style="width:100%!important;" class="img-responsive center-block">
</section>
<?php
get_footer();?>
