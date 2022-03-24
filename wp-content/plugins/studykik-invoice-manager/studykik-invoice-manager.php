<?php
/*
 * Plugin Name: Studykik Invoice Manager
 * Plugin URI:  https://wordpress.org/plugins/studykik-invoice-manager/
 * Description: Studykik Invoice Manager lets you manage invoices in Studykik system.
 * Author:      Kosta Petrov <utopia2050.kosta@gmail.com>
 * Version:     1.0
 * Text Domain: studykik-invoice-manager
 * Domain Path: /languages/
 * License:     GPL v2 or later
 */

/**
 * Studykik Invoice Manger let you to edit/delete invoices created in studykik system.
 *
 *
 * @package    StudyKik Invoice Manager
 * @author     Kosta Petrov <utopia2050.kosta@gmail.com>
 * @copyright  Copyright 2016 Studykik
 * @license
 * @link
 * @since      1.0
 */

defined( 'ABSPATH' ) or die();

class SK_Invoice_Manager {

    /**
     * Hook onto all of the actions and filters needed by the plugin.
     */
    protected function __construct() {

        $plugin_file = plugin_basename( __FILE__ );

        add_action( 'init',                               array( $this, 'action_init' ) );
        add_action( 'admin_menu',                         array( $this, 'action_admin_menu' ) );

        add_action("wp_ajax_get_user_name_id",array($this, 'ajax_get_user_name_id'));
        add_action("wp_ajax_nopriv_get_user_name_id",array($this, 'ajax_get_user_name_id'));


        register_activation_hook( __FILE__, array( $this, 'action_activate' ) );
    }

    /**
     * Run using the 'init' action.
     */
    public function action_init() {
        $plugin_dir = plugins_url()."/studykik-invoice-manager/";
//        print_r($plugin_dir);
//        print_r(get_bloginfo("url"));exit;
        if (is_admin()) {
            wp_enqueue_script("jquery-ui-js", "//code.jquery.com/ui/1.11.4/jquery-ui.js");
            wp_enqueue_script("im-action-js", $plugin_dir."js/actions.js");
            wp_enqueue_style("jquery-ui-css", "//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css");
            wp_enqueue_style("im-style-css", $plugin_dir."css/style.css");
        }

        //load_plugin_textdomain( 'wp-crontrol', false, dirname( plugin_basename( __FILE__ ) ) . '/gettext' );
    }

    public function ajax_get_user_name_id() {
        global $wpdb;
        $term = $_REQUEST['term'];
        $tb_users = $wpdb->prefix."users";
        $results = $wpdb->get_results("select $tb_users.user_login as label, $tb_users.ID as value from $tb_users where $tb_users.user_login like '%{$term}%'");
        echo json_encode($results);
        exit;
    }

    /**
     * Sets up the plugin environment upon first activation.
     *
     * Run using the 'activate_' action.
     */
    public function action_activate() {
//        add_option( 'crontrol_schedules', array() );
//
//        // if there's never been a cron event, _get_cron_array will return false
//        if ( _get_cron_array() === false ) {
//            _set_cron_array( array() );
//        }
        return;
    }

    /**
     * Adds options & management pages to the admin menu.
     *
     * Run using the 'admin_menu' action.
     */

    public function action_admin_menu() {
        add_menu_page( esc_html__( 'Studykik Invoice Manage', 'studykik-invoice-manage' ), esc_html__( 'Studykik Invoice Manage', 'studykik-invoice-manage' ), 'manage_options', 'invoice_manage_page', array( $this, 'invoice_manage_page' ) );
//        add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
        add_submenu_page( null, esc_html__( 'Studykik Invoice Manage', 'studykik-invoice-manage' ), null, 'manage_options', 'invoice_edit_page', array( $this, 'invoice_edit_page' ) );
        add_submenu_page( null, esc_html__( 'Studykik Invoice Manage', 'studykik-invoice-manage' ), null, 'manage_options', 'invoice_delete_page', array( $this, 'invoice_delete_page' ) );
    }

    public function edit_invoice_pdf($invoice_id, $full_date, $price, $invoice_number, $protocol_number){


        $email_address  = get_post_meta($post_id, 'email_adress', true);
        $contactname    = get_post_meta($post_id, 'email_adress_2', true);
        $contactemail   = get_post_meta($post_id, 'email_adress_3', true);
        $contactemail2  = get_post_meta($post_id, 'email_adress_4', true);
        $contactemail3  = get_post_meta($post_id, 'email_adress_5', true);
        $contactemail4  = get_post_meta($post_id, 'email_adress_6', true);
        $contactphone   = get_post_meta($post_id, 'phone_number', true);
        $boost_type1    = get_post_meta($post_id, 'exposure_level', true);
        $sitename       = get_post_meta($post_id, 'name_of_site', true);
        $studylocation  = get_post_meta($post_id, 'study_full_address', true);
        $study_website  = get_post_meta($post_id, 'website_url_thank_you_page', true);
        $studytype      = get_post_meta($post_id, 'custom_title_(for_thank_you_page)', true);
        $newDate        = get_post_meta($post_id, 'study_end_date_new_study', true);
        $protocolnumber = get_post_meta($post_id, 'protocol_no', true);
        $notes          = get_post_meta($post_id, 'notes_cro', true);
        $sponsorname    = get_post_meta($post_id, 'sponsor_name', true);
        $sponsoremail   = get_post_meta($post_id, 'sponsor_email', true);
        $creditcard     = get_post_meta($post_id, 'creadit_card', true);
        $message_pdf    = '<style type="text/css">
				<!--
				table
				{
				    width:  100%;
					margin:0px 0px 0px 0px;
					padding: 0px 0px 0px 0px;
				}

				th{padding:8px 0px;}
				td
				{
				padding:6px 0px;
				}
				tbody{
				margin:0px 20px 0px 20px;
				padding: 0px 20px 0px 20px;

				}

				h1{ font-size:21px; margin:-15px 0px 10px 0px; padding:0px 0px 0px 0px;}
				tbody tr{ font-size:14px;}
				body{margin:0px 0px 0px 0px;
					padding: 0px 0px 0px 0px;}

				-->
				</style>';

        $message_pdf .= "
				  <page backtop='2mm' backbottom='0mm' backleft='5mm' backright='5mm'>
				 <table cellpadding='0' cellspacing='0'>
				<col style='width: 18%'>
				<col style='width: 57%'>
				<col style='width: 5%'>
				<col style='width: 20%'>

				      <tr>
					<th style='text-align:left; margin-left:20px;' colspan='2'><img style='width:295px; height:52px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/background_top.png'/><p style='font-size:14px; color:#959ca1;font-weight:normal; margin:2px 0px 0px 0px; line-height:18px;'><b>StudyKIK</b><br />1675 Scenic Ave #150<br />Costa Mesa, CA 92626</p></th>
					<th colspan='2' style='text-align:right;margin:0px 20px 0px 0px;font-size:16px; color:#959ca1;font-weight:normal; line-height:20px; font-weight:300px;'>
					<h1>INVOICE RECEIPT</h1>
					Invoice Number: ".$invoice_id."<br />
                    Invoice Date: ".$full_date."<br />
                    Term | Due on Receipt</th>
				    </tr>
				<tbody>
				<tr>
					<th style='text-align:left' colspan='4'><img style='width:100%;' src='".site_url()."/wp-content/themes/twentyfifteen/images/top_full.png'/></th></tr>
				    <tr style='text-align:center; font-size:18px;color:#000;'>
					<th align='left' style='border-bottom:1px solid #000;'>SERVICES:</th>
					<th align='left'style='border-bottom:1px solid #000;'>DESCRIPTION:</th>
					<th style='border-bottom:1px solid #000;'></th>
					<th  align='right' style='border-bottom:1px solid #000;'>AMOUNT:</th>
				    </tr>

				<tr align='center'>
				    <td align='left'>Listing</td>
				    <td align='left'><b>Site Name:</b> ".$sitename."</td>
				    <td align='center'> </td>
				    <td align='right'>".$price." </td>
				</tr>
				<tr align='center'>
				    <td align='left'></td>
				    <td align='left'><b>Study Type:</b> ".$studytype."</td>
				    <td align='center'> </td>
				    <td align='center'></td>
				</tr>
				<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Study Level:</b> ".$boost_type1."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				</tr>";
        if($protocol_number){
            $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Protocol Number:</b> ".$protocol_number."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
        }
        if($contactphone){
            $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Phone:</b> ".$contactphone."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
        }
        $l1=0;
        if (strpos(strtolower($contactname),'@studykik.com') == false) {
            $l1++;
            $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Recruitment Email ".$l1.":</b> ".$contactname."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
        }
        if($contactemail){
            if (strpos(strtolower($contactemail),'@studykik.com') == false) { $l1++;
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email ".$l1.":</b> ".$contactemail."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }
        }


        if($contactemail2){
            if (strpos(strtolower($contactemail2),'@studykik.com') == false) { $l1++;
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email ".$l1.":</b> ".$contactemail2."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }
        }

        if($contactemail3){
            if (strpos(strtolower($contactemail3),'@studykik.com') == false) { $l1++;
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email ".$l1.":</b> ".$contactemail3."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }
        }

        if($contactemail4){
            if (strpos(strtolower($contactemail4),'@studykik.com') == false) { $l1++;
                $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Recruitment Email ".$l1.":</b> ".$contactemail4."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
            }
        }
        $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Study Address:</b> ".$studylocation."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>
				<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>Start Date:</b> ".$full_date."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
        if($startdate !="To be determined"){
            $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>End Date:</b> ".$newDate."</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
        }
        else{
            $message_pdf .= "<tr align='left'>
				<td align='left'> </td>
				<td align='left'><b>End Date:</b>&nbsp;To be determined</td>
				<td align='center'> </td>
				<td align='center'> </td>
				</tr>";
        }

        if($blast_50 == "Yes"){
            $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>Text Blast</td>
				    <td bordercolor='#000' align='left'> </td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='right'>".$text_blast."</td>
				    </tr>";
        }else{

            $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>&nbsp; </td>
				    <td bordercolor='#000' align='left'> &nbsp; </td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    <td bordercolor='#000' align='center'> &nbsp;</td>
				    </tr>";

        }
        if($contactemail == ""){
            $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";
        }
        if($contactemail2 == ""){
            $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					";
        }
        if($contactemail3 == ""){
            $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>
					<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";

        }
        if($contactemail4 == ""){
            $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'> </td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				    </tr>";

        }

        $message_pdf .= "

				<tr class='sub_total' align='left'>
				<td align='center'  style='border-top:1px solid #000;'> </td>
				<td align='left'  style='border-top:1px solid #000;'> </td>
				<td align='right' colspan='2' style='border-top:1px solid #000;'>SUB TOTAL:&nbsp; ".$total_price."</td>
				</tr>
				<tr class='total' align='left'>
				<td align='center'> </td>
				<td align='left'> </td>
				<td align='right' colspan='2'><b>TOTAL:&nbsp; ".$total_price."</b></td>
				</tr>
				</tbody>
				<tr>";

        if($contactemail4 == ""){

            $message_pdf .= "<th colspan='4' style='font-size: 14px;'><img style='width:100%;height:470px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

        }else{

            $message_pdf .= "<th colspan='4' style='font-size: 14px;'><img style='width:100%;height:440px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

        }
        $message_pdf .= "</tr>
				</table></page>";
        require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
        $html2pdf = new HTML2PDF('P', 'A4','en', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($message_pdf);
        $study_cat_name1 = str_replace(' ', '_', $studytype);
        $study_cat_name2 = str_replace("'", "", $study_cat_name1);
        $study_cat_name = stripslashes($study_cat_name2);

        $rand= rand();
        $html2pdf->Output( dirname(__FILE__)."/pdf/".$final_num.' '.$studytype.' '.$boost_type1.' Invoice'.".pdf", "f");
        $html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.$study_cat_name.'_'.$boost_type1.'_Invoice'.".pdf", "f");
        $pdf_attachment_path = dirname(__FILE__).'/pdf/'.$final_num.' '.$studytype.' '.$boost_type1.' Invoice.pdf';
        $pdf_attachment_path_db = '/pdf/'.$final_num.'_'.$study_cat_name.'_'.$boost_type1.'_Invoice.pdf';
        $attachments[] = dirname(__FILE__).'/pdf/'.$final_num.' '.$studytype.' '.$boost_type1.' Invoice.pdf';
        update_post_meta($post_id, 'pdfpath', $pdf_attachment_path);
    }

    public function invoice_edit_page() {
        global $wpdb;

        $invoice_id = $_REQUEST['id'];
        $tb_invoice_number = $wpdb->prefix."invoice_number";
        $tb_users = $wpdb->prefix."users";
        $current_link = get_bloginfo("url").$_SERVER[REQUEST_URI];

        $message = "";

        if ($_POST && $_POST["update"]) {
            $user_name = $_POST['user_name'];
            $full_date = $_POST['full_date'];
            $price = $_POST['price'];
            $invoice_number = $_POST['invoice_number'];
            $protocol_no = $_POST['protocol_no'];
            $pdf_name = $_POST['pdf_name'];
            $validate = true;

            if (!$full_date) {
                $validate = false;
                $message .= "<div>Please enter date field.</div>";
            }
            if (!$price) {
                $validate = false;
                $message .= "<div>Please enter price field.</div>";

            }
            if (!$invoice_number) {
                $validate = false;
                $message .= "<div>Please enter invoice number field.</div>";
            }
            if (!$protocol_no) {
                $validate = false;
                $message .= "<div>Please enter protocol number field.</div>";
            }
            $invoice_number_check = $wpdb->get_results("select * from $tb_invoice_number where invoice_number = $invoice_number and id != $invoice_id");

            if ($invoice_number_check) {
                $validate = false;
                $message .= "<div>Invoice number already exists.</div>";
            }
            if ($validate == true) {
                if (!$full_date) {
                    $date_str = "";
                } else {
                    $date = DateTime::createFromFormat('m/d/Y', $full_date);
                    $date_str = $date->format('m/j/y');
                }

                $current_month = $date->format('M');
                $current_year = $date->format('Y');

                $insert_data = array(
                    'full_date'         => $date_str,
                    "price"             => "$" . $price,
                    "invoice_number"    => $invoice_number,
                    "protocol_no"    => $protocol_no,
                    "month"    => $current_month,
                    "year"    => $current_year,
                );
                $wpdb->update( $tb_invoice_number, $insert_data, array( "id"=>$invoice_id ) );
                $message = "<div>The invoice is updated successfully.</div>";
            }

        } else {
//            print_r("hello");
            $sql = $wpdb->prepare("select $tb_invoice_number.*, $tb_users.user_login from $tb_invoice_number left join $tb_users on ($tb_invoice_number.user_id = $tb_users.ID) where $tb_invoice_number.id=$invoice_id");
            $invoice_record = $wpdb->get_results($sql);
            $user_name = $invoice_record[0]->user_login;
            if ($invoice_record[0]->full_date) {
                $date = DateTime::createFromFormat('m/j/y', $invoice_record[0]->full_date);
                $full_date = $date->format('m/d/Y');
            } else {
                $full_date = "";
            }
            $price = substr($invoice_record[0]->price, 1, strlen($invoice_record[0]->price) - 1);
            $invoice_number = $invoice_record[0]->invoice_number;
            $protocol_no = $invoice_record[0]->protocol_no;
            $pdf_name = $invoice_record[0]->pdf_name;

//            print_r($invoice_record);
        }


        include("views/invoice-edit-page.php");
    }

    public function invoice_delete_page() {
        global $wpdb;

        $invoice_id = $_REQUEST['id'];
        $tb_invoice_number = $wpdb->prefix."invoice_number";
        $tb_users = $wpdb->prefix."users";
        $current_link = get_bloginfo("url").$_SERVER[REQUEST_URI];
        $msg = "";
        if ($_POST && $_POST["delete"]) {
            $sql = $wpdb->prepare("select $tb_invoice_number.*, $tb_users.user_login from $tb_invoice_number left join $tb_users on ($tb_invoice_number.user_id = $tb_users.ID) where $tb_invoice_number.id=$invoice_id");
            $invoice_record = $wpdb->get_results($sql);
            $user_name = $invoice_record[0]->user_login;
            $date = DateTime::createFromFormat('m/j/y', $invoice_record[0]->full_date);
            $full_date = $date->format('m/d/Y');
            $price = substr($invoice_record[0]->price, 1, strlen($invoice_record[0]->price) - 1);
            $invoice_number = $invoice_record[0]->invoice_number;
            $protocol_no = $invoice_record[0]->protocol_no;
            $pdf_name = $invoice_record[0]->pdf_name;
            $wpdb->delete( $tb_invoice_number, array( "id"=>$invoice_id ) );
            $msg = "This invoice is deleted successfully";
        } else {
//            print_r("hello");
            $sql = $wpdb->prepare("select $tb_invoice_number.*, $tb_users.user_login from $tb_invoice_number left join $tb_users on ($tb_invoice_number.user_id = $tb_users.ID) where $tb_invoice_number.id=$invoice_id");
//            print_r($sql);
            $invoice_record = $wpdb->get_results($sql);
//            print_r($invoice_record);
            $user_name = $invoice_record[0]->user_login;
            if ($invoice_record[0]->full_date) {
                $date = DateTime::createFromFormat('m/j/y', $invoice_record[0]->full_date);
                $full_date = $date->format('m/d/Y');
            } else {
                $full_date = "";
            }

            $price = substr($invoice_record[0]->price, 1, strlen($invoice_record[0]->price) - 1);
            $invoice_number = $invoice_record[0]->invoice_number;
            $protocol_no = $invoice_record[0]->protocol_no;
            $pdf_name = $invoice_record[0]->pdf_name;

//            print_r($invoice_record);
        }



        include("views/invoice-delete-page.php");
    }

    public function invoice_manage_page() {
        global $wpdb;
        if (is_user_logged_in()) {
            $user_ID = get_current_user_id();
        } else {
            wp_redirect(site_url().'/login/', 301);
            exit;
        }

        $month = $_REQUEST['month_select'];
        $year = $_REQUEST['year_select'];
        $user_id = $_REQUEST['user_id'];
        $user_login = $_REQUEST['user_login'];
        $user_name = $_REQUEST['user_name'];

//        $user = $_REQUEST['user'];
        $page_num = $_REQUEST['page_num'] > 0 ? $_REQUEST['page_num'] : 1;
        $limit = $_REQUEST['limit']> 0 ? $_REQUEST['limit'] : 50;
        $offset = ($page_num - 1) * $limit;
        $sel_val ='all';
        if ($_REQUEST['user_id']) {
            $sel_val = $_REQUEST['user_id'];

        }

        $tb_invoice_number = $wpdb->prefix."invoice_number";
        $tb_users = $wpdb->prefix."users";

        $query_invoice_number = array();
        $total_count = 0;
        if($month && $year){
            if($sel_val == 'all') {
                $query_invoice_number = $wpdb->get_results( "SELECT * FROM $tb_invoice_number WHERE month = '$month' and year = '$year' ORDER BY `id` DESC LIMIT $limit OFFSET $offset");
                $total_count = $wpdb->get_var( "SELECT COUNT(*) FROM $tb_invoice_number WHERE month = '$month' and year = '$year' ORDER BY `id` DESC");
            } else {
                $query_invoice_number = $wpdb->get_results( "SELECT * FROM $tb_invoice_number WHERE user_id = '$sel_val' and month = '$month' and year = '$year' ORDER BY `id` DESC LIMIT $limit OFFSET $offset");
                $total_count = $wpdb->get_var( "SELECT COUNT(*) FROM $tb_invoice_number WHERE user_id = '$sel_val' and month = '$month' and year = '$year'");
            }
        } else {
            if($sel_val == 'all') {
                $query_invoice_number = $wpdb->get_results( "SELECT * FROM $tb_invoice_number ORDER BY `id` DESC LIMIT $limit OFFSET $offset");
                $total_count = $wpdb->get_var( "SELECT COUNT(*) FROM $tb_invoice_number");
            } else {
                $query_invoice_number = $wpdb->get_results( "SELECT * FROM $tb_invoice_number WHERE user_id = '".$sel_val."' ORDER BY `id` DESC LIMIT $limit OFFSET $offset");
                $total_count = $wpdb->get_var( "SELECT COUNT(*) FROM $tb_invoice_number WHERE user_id = '".$sel_val."'");
            }
        }

        include("views/invoice-manage-page.php");
    }




    /**
     * Displays the manage page for the plugin.
     */
    public function admin_manage_page() {
        $messages = array(
            '1' => __( 'Successfully executed the cron event %s', 'wp-crontrol' ),
            '4' => __( 'Successfully edited the cron event %s', 'wp-crontrol' ),
            '5' => __( 'Successfully created the cron event %s', 'wp-crontrol' ),
            '6' => __( 'Successfully deleted the cron event %s', 'wp-crontrol' ),
            '7' => __( 'Failed to the delete the cron event %s', 'wp-crontrol' ),
            '8' => __( 'Failed to the execute the cron event %s', 'wp-crontrol' ),
        );
        if ( isset( $_GET['crontrol_name'] ) && isset( $_GET['crontrol_message'] ) && isset( $messages[ $_GET['crontrol_message'] ] ) ) {
            $hook = wp_unslash( $_GET['crontrol_name'] );
            $msg = sprintf( esc_html( $messages[ $_GET['crontrol_message'] ] ), '<strong>' . esc_html( $hook ) . '</strong>' );

            printf( '<div id="message" class="updated notice is-dismissible"><p>%s</p></div>', $msg ); // WPCS:: XSS ok.
        }
        $events = $this->get_cron_events();
        $doing_edit = ( isset( $_GET['action'] ) && 'edit-cron' == $_GET['action'] ) ? wp_unslash( $_GET['id'] ) : false ;
        $time_format = 'Y-m-d H:i:s';

        $tzstring = get_option( 'timezone_string' );
        $current_offset = get_option( 'gmt_offset' );

        if ( $current_offset >= 0 ) {
            $current_offset = '+' . $current_offset;
        }

        if ( '' === $tzstring ) {
            $tz = sprintf( 'UTC%s', $current_offset );
        } else {
            $tz = sprintf( '%s (UTC%s)', str_replace( '_', ' ', $tzstring ), $current_offset );
        }

        $this->show_cron_status();

        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'WP-Cron Events', 'wp-crontrol' ); ?></h1>
            <p></p>
            <table class="widefat striped">
                <thead>
                <tr>
                    <th><?php esc_html_e( 'Hook Name', 'wp-crontrol' ); ?></th>
                    <th><?php esc_html_e( 'Arguments', 'wp-crontrol' ); ?></th>
                    <th><?php esc_html_e( 'Next Run', 'wp-crontrol' ); ?></th>
                    <th><?php esc_html_e( 'Recurrence', 'wp-crontrol' ); ?></th>
                    <th colspan="3">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ( is_wp_error( $events ) ) {
                    ?>
                    <tr><td colspan="7"><?php echo esc_html( $events->get_error_message() ); ?></td></tr>
                <?php
                } else {
                    foreach ( $events as $id => $event ) {

                        if ( $doing_edit && $doing_edit == $event->hook && $event->time == $_GET['next_run'] && $event->sig == $_GET['sig'] ) {
                            $doing_edit = array(
                                'hookname' => $event->hook,
                                'next_run' => $event->time,
                                'schedule' => ( $event->schedule ? $event->schedule : '_oneoff' ),
                                'sig'      => $event->sig,
                                'args'     => $event->args,
                            );
                        }

                        if ( empty( $event->args ) ) {
                            $args = __( 'None', 'wp-crontrol' );
                        } else {
                            if ( defined( 'JSON_UNESCAPED_SLASHES' ) ) {
                                $args = wp_json_encode( $event->args, JSON_UNESCAPED_SLASHES );
                            } else {
                                $args = stripslashes( wp_json_encode( $event->args ) );
                            }
                        }

                        echo '<tr id="cron-' . esc_attr( $id ) . '" class="">';

                        if ( 'crontrol_cron_job' == $event->hook ) {
                            echo '<td><em>' . esc_html__( 'PHP Cron', 'wp-crontrol' ) . '</em></td>';
                            echo '<td><em>' . esc_html__( 'PHP Code', 'wp-crontrol' ) . '</em></td>';
                        } else {
                            echo '<td>' . esc_html( $event->hook ) . '</td>';
                            echo '<td>' . esc_html( $args ) . '</td>';
                        }

                        echo '<td>';
                        printf( '%s (%s)',
                            esc_html( get_date_from_gmt( date( 'Y-m-d H:i:s', $event->time ), $time_format ) ),
                            esc_html( $this->time_since( time(), $event->time ) )
                        );
                        echo '</td>';

                        if ( $event->schedule ) {
                            echo '<td>';
                            echo esc_html( $this->interval( $event->interval ) );
                            echo '</td>';
                        } else {
                            echo '<td>';
                            esc_html_e( 'Non-repeating', 'wp-crontrol' );
                            echo '</td>';
                        }

                        $link = array(
                            'page'     => 'crontrol_admin_manage_page',
                            'action'   => 'edit-cron',
                            'id'       => urlencode( $event->hook ),
                            'sig'      => urlencode( $event->sig ),
                            'next_run' => urlencode( $event->time ),
                        );
                        $link = add_query_arg( $link, admin_url( 'tools.php' ) ) . '#crontrol_form';
                        echo "<td><a class='view' href='" . esc_url( $link ) . "'>" . esc_html__( 'Edit', 'wp-crontrol' ) . '</a></td>';

                        $link = array(
                            'page'     => 'crontrol_admin_manage_page',
                            'action'   => 'run-cron',
                            'id'       => urlencode( $event->hook ),
                            'sig'      => urlencode( $event->sig ),
                            'next_run' => urlencode( $event->time ),
                        );
                        $link = add_query_arg( $link, admin_url( 'tools.php' ) );
                        $link = wp_nonce_url( $link, "run-cron_{$event->hook}_{$event->sig}" );
                        echo "<td><a class='view' href='". esc_url( $link ) ."'>" . esc_html__( 'Run Now', 'wp-crontrol' ) . '</a></td>';

                        $link = array(
                            'page'     => 'crontrol_admin_manage_page',
                            'action'   => 'delete-cron',
                            'id'       => urlencode( $event->hook ),
                            'sig'      => urlencode( $event->sig ),
                            'next_run' => urlencode( $event->time ),
                        );
                        $link = add_query_arg( $link, admin_url( 'tools.php' ) );
                        $link = wp_nonce_url( $link, "delete-cron_{$event->hook}_{$event->sig}_{$event->time}" );
                        echo "<td><a class='delete' href='".esc_url( $link )."'>" . esc_html__( 'Delete', 'wp-crontrol' ) . '</a></td>';

                        echo '</tr>';

                    }
                }
                ?>
                </tbody>
            </table>

            <div class="tablenav">
                <p class="description">
                    <?php printf( esc_html__( 'Local timezone is %s', 'wp-crontrol' ), '<code>' . esc_html( $tz ) . '</code>' ); ?>
                    <span id="utc-time"><?php printf( esc_html__( 'UTC time is %s', 'wp-crontrol' ), '<code>' . esc_html( date_i18n( $time_format, false, true ) ) . '</code>' ); ?></span>
                    <span id="local-time"><?php printf( esc_html__( 'Local time is %s', 'wp-crontrol' ), '<code>' . esc_html( date_i18n( $time_format ) ) . '</code>' ); ?></span>
                </p>
            </div>

        </div>
        <?php
        if ( is_array( $doing_edit ) ) {
            $this->show_cron_form( 'crontrol_cron_job' == $doing_edit['hookname'], $doing_edit );
        } else {
            $this->show_cron_form( ( isset( $_GET['action'] ) and 'new-php-cron' == $_GET['action'] ), false );
        }
    }

    public static function init() {

        static $instance = null;

        if ( ! $instance ) {
            $instance = new SK_Invoice_Manager();
        }

        return $instance;

    }
}

// Get this show on the road
SK_Invoice_Manager::init();
