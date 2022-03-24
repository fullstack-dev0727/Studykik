<link href="<?php bloginfo('template_url');?>/css/wp-invoice.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/fonts/font.css" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
<link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/wp-invoice.js"></script>
<?php
$user_ID = $_REQUEST['user'];
$user_info = get_userdata($user_ID);
$user_roles = implode(', ', $user_info->roles);
$invoice = customInvoice_load();
$decodeData = json_decode(//default object with all required fields, that contains empty values
    '{"rows":{
    "diamond":{"quantity":"","product":"Diamond Listing","price":"3059"},
    "platinum":{"quantity":"","product":"Platinum Listing","price":"1559"},
    "gold":{"quantity":"","product":"Gold Listing","price":"559"},
    "silver":{"quantity":"","product":"Silver Listing","price":"209"},
    "bronze":{"quantity":"","product":"Bronze Listing","price":"59"},
    "irb":{"quantity":"","product":"IRB Ad Creation","price":"150"},
    "custom_1":{"quantity":"","product":"","price":""}},"total":0}', true);

if(isset($_GET['user']) && $_GET['user'] != ''){

    $sql_result = $invoice->getDraft($_GET['user']);
    $drafts = array();
    $paid = array();
    while ($row = mysql_fetch_assoc($sql_result)) {
        if($row['is_paid'] == 0){
            array_push($drafts, $row);
        }else{
            array_push($paid, $row);
        }
    }
?>
<div class="main-container">
    <span class="user-heading"><?php echo get_user_meta($_GET['user'], 'nickname', true);?> Invoices</span>
    <ul id="myTabs" class="nav nav-tabs" role="tablist">
        <li <?php if(isset($_GET['action']) && $_GET['action'] == 'invite' && !isset($_REQUEST['show_hide_input2']) && !isset($_REQUEST['show_hide_input'])){ ?>class="active"<?php } ?>>
            <a href="#invoice" id="invoice-tab" role="tab" data-toggle="tab" aria-controls="invoice" aria-expanded="true">New Invoice</a>
        </li>
        <li <?php if(!isset($_GET['action'])){ ?>class="active"<?php } ?>>
            <a href="#drafts" id="drafts-tab" role="tab" data-toggle="tab" aria-controls="drafts" aria-expanded="true">Drafts</a>
        </li>
        <li class="">
            <a href="#paid" role="tab" id="paid-tab" data-toggle="tab" aria-controls="paid" aria-expanded="false">Paid</a>
        </li>
        <li class="<?= (isset($_REQUEST['show_hide_input2']) || isset($_REQUEST['show_hide_input'])) ? "active":""?>">
            <a href="#new-study" role="tab" id="new-study-tab" data-toggle="tab" aria-controls="new-study" aria-expanded="false">List a New Study</a>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade <?php if(isset($_GET['action']) && $_GET['action'] == 'invite' && !isset($_REQUEST['show_hide_input2']) && !isset($_REQUEST['show_hide_input'])){ ?> active in<?php } ?>" id="invoice" aria-labelledby="invoice-tab">
            <article class="shoping_background wp-admin-invoice-background tab">
                <input id="hiddden-total" type="hidden" value="<?php echo $decodeData["total"]?>">
                <div class="container">
                    <div class="col-md-12 col-xs-12 account_heading">
                        <h2>PAYMENT INFO</h2>
                    </div>
                    <div class="col-sm-8 col-xs-12 right_payment">
                        <div class="panel-group" id="accordion" role="tablist" >
                            <input type="hidden" value="1">
                            <div class="group-container">
                                <div class="checkbox-container">
                                    <input type="checkbox" class="cart-select cart-1">
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
                                            <span>
                                                <img src="<?php bloginfo('template_url'); ?>/images/visa.png" alt="" class="img-responsive visa_left">
                                                <p>Visa ending in 5678<small>01/2017</small><strong></strong></p>
                                            </span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="left_panel">
                                                <strong>Name on Card</strong>
                                                <b>John Doe</b>
                                            </div>
                                            <div class="right_panel">
                                                <strong>Billing Address</strong>
                                                <b>John Doe<br>12345 Address<br>City, CA 67890, US</b>
                                                <button class="delete_btn"><img src="<?php bloginfo('template_url'); ?>/images/delete.png" alt="" class="img-responsive"></button>
                                                <button class="update_btn"><img src="<?php bloginfo('template_url'); ?>/images/edit_bnt.png" alt="" class="img-responsive"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="2">
                            <div class="group-container">
                                <div class="checkbox-container">
                                    <input type="checkbox" class="cart-select cart-2">
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                                    <span>
                                        <img src="<?php bloginfo('template_url'); ?>/images/visa.png" alt="" class="img-responsive visa_left">
                                        <p>
                                            Visa ending in 5678<small>01/2017</small>
                                            <strong></strong>
                                        </p>
                                    </span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="left_panel">
                                                <strong>Name on Card</strong>
                                                <b>John Doe</b>
                                            </div>
                                            <div class="right_panel">
                                                <strong>Billing Address</strong>
                                                <b>John Doe<br>12345 Address<br>City, CA 67890, US</b>
                                                <button class="delete_btn"><img src="<?php bloginfo('template_url'); ?>/images/delete.png" alt="" class="img-responsive"></button>
                                                <button class="update_btn"><img src="<?php bloginfo('template_url'); ?>/images/edit_bnt.png" alt="" class="img-responsive"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="3">
                            <div class="group-container">
                                <div class="checkbox-container">
                                    <input type="checkbox" class="cart-select cart-3">
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                                    <span>
                                        <img src="<?php bloginfo('template_url'); ?>/images/visa.png" alt="" class="img-responsive visa_left">
                                        <p>
                                            Visa ending in 9101<small>01/2018</small>
                                            <strong></strong>
                                        </p>
                                    </span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="left_panel">
                                                <strong>Name on Card</strong>
                                                <b>John Doe</b>
                                            </div>
                                            <div class="right_panel">
                                                <strong>Billing Address</strong>
                                                <b>John Doe<br>12345 Address<br>City, CA 67890, US</b>
                                                <button class="delete_btn"><img src="<?php bloginfo('template_url'); ?>/images/delete.png" alt="" class="img-responsive"></button>
                                                <button class="update_btn"><img src="<?php bloginfo('template_url'); ?>/images/edit_bnt.png" alt="" class="img-responsive"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 add-new-card">
                        <input type="submit" name="new_cart" id="new_cart" class="button delete button-large add_btn" value="Add New Card">
                    </div>
                    <article class="shoping_background">
                        <div class="container">
                            <div class="table-responsive">
                                <table id="table_background" class="table wp-admin-invoice-table">
                                    <thead>
                                    <tr class="table_top invoice">
                                        <th style="width: 10%">Quantity</th>
                                        <th style="width: 40%">Product</th>
                                        <th style="width: 20%">Price</th>
                                        <th style="width: 20%">Total</th>
                                        <th style="width: 10%">Remove</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($decodeData["rows"] as $key => $row) {
                                        switch ($key) {
                                            case 'diamond':
                                                $imageName = 'diamond';
                                                break;
                                            case 'platinum':
                                                $imageName = 'platinum_new';
                                                break;
                                            case 'gold':
                                                $imageName = 'gold_new';
                                                break;
                                            case 'silver':
                                                $imageName = 'silver_new';
                                                break;
                                            case 'bronze':
                                                $imageName = 'bronze_new';
                                                break;
                                            case 'irb':
                                                $imageName = 'irb';
                                                break;
                                            default:
                                                $imageName = false;
                                                break;
                                        }
                                        ?>
                                            <tr class="<?php echo 'row_'.$key; ?>">
                                                <td>
                                                    <input class="quantity" name="quantity" type="number" min="0" <?php echo 'value="'.$row['quantity'].'"';?>/>
                                                </td>
                                                <td>
                                                    <?php if($imageName){ ?>
                                                        <span class="<?php echo $key; ?>">
                                                            <img src="<?php bloginfo('template_url'); ?>/images/<?php echo $imageName;?>.png" alt="" class="img-responsive">
                                                        </span>
                                                        <span class="name-el"><?php echo $row['product']; ?></span>
                                                    <?php }else{ ?>
                                                        <input name="product" type="text" class="product" <?php echo 'value="'.$row['product'].'"'; ?>/>
                                                    <?php } ?>
                                                </td>
                                                <td class="td-rell">
                                                    <span class="visible-lg">$</span>
                                                    <input name="price" type="text" class="price" <?php echo 'value="'.$row['price'].'"'; ?>/>
                                                </td>
                                                <td class="row-total">
                                                    <?php
                                                    if(is_int($row['quantity']*$row['price'])){
                                                        echo '$'.$row['quantity']*$row['price'].'.00';
                                                    }else{
                                                        echo '$'.$row['quantity']*$row['price'];
                                                    }
                                                    ?>
                                                </td>
                                                <?php if($action != 'view'){ ?>
                                                    <td>
                                                        <span class="delete preview button">Delete</span>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr  class="table_bottum invoice">
                                        <td colspan="5">
                                            <span class="add-row preview button">Add Row</span>
                                            <span class="invoice total"></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 col-xs-12 invoice-submit">
                                <input type="submit" name="save_draft" id="save_draft" class="button button-primary button-large" value="Save Draft">
                                <input type="submit" name="submit_payment" id="submit_payment" class="button button-primary button-large" value="Pay for Order">
                            </div>
                        </div>
                    </article>
                </div>
            </article>
        </div>
        <div role="tabpanel" class="tab-pane fade <?php if(!isset($_GET['action'])){ ?> active in<?php } ?>" id="drafts" aria-labelledby="drafts-tab">
            <article class="shoping_background wp-admin-invoice-background tab">
                <div class="container">
                    <table id="table_background" class="table old wp-list-invoice-table">
                        <thead>
                            <tr class="table_top invoice">
                                <th style="width: 20%">Number</th>
                                <th style="width: 30%">Updated</th>
                                <th style="width: 20%">Total</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($drafts as $val) { ?>
                                <tr>
                                    <td>
                                        <?php echo $val["id"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $val["last_modify"]; ?>
                                    </td>
                                    <td class="row-total">
                                        <?php
                                        if(is_float($val["total"]/100)){
                                            echo '$'.$val["total"]/100;
                                        }else{
                                            echo '$'.($val["total"]/100).'.00';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="users.php?page=custom-invoice&action=modify&from_user=<?php echo $_GET['user']; ?>&invoice=<?php echo $val["id"]; ?>" id="modify_<?php echo $val["id"]; ?>" class="modify preview button">Modify/Pay</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="col-md-12 col-xs-12 invoice-submit">
                        <a class="button button-primary button-large" href="users.php?page=custom-invoice&from_user=<?php echo $_GET['user']; ?>&invoice=new">New Invoice</a>
                    </div>
                </div>
            </article>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="paid" aria-labelledby="paid-tab">
            <article class="shoping_background wp-admin-invoice-background tab">
                <div class="container">
                    <table id="table_background" class="table old wp-list-invoice-table">
                        <thead>
                        <tr class="table_top invoice">
                            <th style="width: 8%">Number</th>
                            <th style="width: 20%">Updated</th>
                            <th style="width: 20%">Paid</th>
                            <th style="width: 20%">Refund</th>
                            <th style="width: 20%">Total</th>
                            <th style="width: 12%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($paid as $val) { ?>
                            <tr>
                                <td>
                                    <?php echo $val["id"]; ?>
                                </td>
                                <td>
                                    <?php echo $val["last_modify"]; ?>
                                </td>
                                <td>
                                    <?php echo $val["paid"]; ?>
                                </td>
                                <td>
                                    <?php echo $val["refund"]; ?>
                                </td>
                                <td class="row-total">
                                    <?php
                                    if(is_float($val["total"]/100)){
                                        echo '$'.$val["total"]/100;
                                    }else{
                                        echo '$'.($val["total"]/100).'.00';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="users.php?page=custom-invoice&action=view&from_user=<?php echo $_GET['user']; ?>&invoice=<?php echo $val["id"]; ?>" id="modify_<?php echo $val["id"]; ?>" class="modify preview button">View</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </article>
        </div>
        <div role="tabpanel" class="tab-pane fade <?= (isset($_REQUEST['show_hide_input2']) || isset($_REQUEST['show_hide_input']))?"active in":""?>" id="new-study" aria-labelledby="new-study-tab">
            <article class="shoping_background wp-admin-invoice-background tab">
                <div class="container">
                    <div class="row">
                        <section class="container_current">
                            <div class="col-12 col-md-12" style="padding-left:10px !important;padding-top:10px !important;">
                                <div class="collapse navbar-collapse" id="navbarCollapse">
                                    <div class="row">
                                        <div class="current_heading">
                                            <h4>Clinical Study Information </h4>
                                        </div>
                                    </div>
                                </div>
                                <div id="data">
                                    <div class="scroll-area" data-spy="scroll" data-target="#myNavbar" data-offset="0">
                                        <div class="inner-form">
                                            <p>1.) Select the number of studies you would like to purchase.<br>
                                                2.) Select the level of exposure (Platinum/Gold etc).<br>
                                                3.) Enter all study information.<br>
                                                4.) Click “List My Studies”</p>
                                            <p>Once Completed, your card on file will be charged and your studies will be live in 24 hours. We look forward to helping you enroll your clinical trials!</p>
                                            <?php

                                            if (isset($_REQUEST['show_hide_input2'])) {
                                            $number_of_studies = $_REQUEST['number_of_studies'];
                                            ?>
                                            <form id="contactform" enctype="multipart/form-data" method="post">
                                                <div class="fisrt_step" id="third_step">
                                                <h2 style="background:#f78f1e;color: #fff; text-transform: uppercase; margin: 15px 0; padding: 5px; float:left; width:100%;">Enter Study Details</h2>
                                                <div class="inner_cont" id="third_step_cont">
                                                <input type="hidden" name="total_entries" value="<?php echo $number_of_studies; ?>" />
                                                <?php
                                                for ($x = 1; $x <= $number_of_studies; $x++) {
                                                    ?>
                                                    <script type="text/javascript">
                                                        $(function () {
                                                            $("#datepicker<?php echo $x; ?>").datepicker();
                                                        });

                                                        function addNew<?php echo $x; ?>(asa) {
                                                            var addDiv<?php echo $x; ?> = $('#addinput<?php echo $x; ?>');
                                                            var i = $('#addinput<?php echo $x; ?> p').size() + 1;
                                                            if (i == 5) {
                                                                $(".addd_new<?php echo $x; ?>").hide();
                                                            } else {
                                                                $(".addd_new<?php echo $x; ?>").show();
                                                            }
                                                            $('<p><label>Recruitment Email #' + i + ': </label><span class="wpcf7-form-control-wrap email-577"><input style="margin-bottom:0px;" type="email"  aria-required="true" size="40" value="" name="contactemail' + i + '<?php echo $x; ?>"><a style="position: absolute; top: 52px; right: -20px;" href="javascript:void();" onClick="return aaaaa<?php echo $x; ?>(this);" id="remNew"><img style="width: 12px;"  src="<?php bloginfo('template_url'); ?>/images-dashboard/delete_icon.png" /></a></span></p>').appendTo(addDiv<?php echo $x; ?>);
                                                            i++;
                                                            return false;
                                                        }
                                                        function aaaaa<?php echo $x; ?>(el) {
                                                            $(el).parents('p').remove();
                                                            var i = $('#addinput<?php echo $x; ?> p').size() - 1;
                                                            if (i == 5) {
                                                                $(".addd_new<?php echo $x; ?>").hide();
                                                            } else {
                                                                $(".addd_new<?php echo $x; ?>").show();
                                                            }
                                                            $('#addinput<?php echo $x; ?> p:nth-child(1) label').html("Recruitment Email #1:");
                                                            $('#addinput<?php echo $x; ?> p:nth-child(2) label').html("Recruitment Email #2:");
                                                            $('#addinput<?php echo $x; ?> p:nth-child(3) label').html("Recruitment Email #3:");
                                                            $('#addinput<?php echo $x; ?> p:nth-child(4) label').html("Recruitment Email #4:");
                                                            $('#addinput<?php echo $x; ?> p:nth-child(5) label').html("Recruitment Email #5:");
                                                            return false;
                                                        }
                                                        $(document).ready(function () {
                                                            $('#contactform').submit(function () {
                                                                var errors = 0;
                                                                $("#contactform .required").map(function () {
                                                                    if (!$(this).val()) {
                                                                        $(this).addClass('warning');
                                                                        errors++;
                                                                        if (errors == 1)
                                                                        {
                                                                            //alert("Please fill required fields.");
                                                                            //$("#err_msgg").show();
                                                                            //$("#fade").show();
                                                                        }
                                                                    } else if ($(this).val()) {
                                                                        $(this).removeClass('warning');
                                                                    }
                                                                });
                                                                if (errors > 0) { //alert()
                                                                    //$('#errorwarn').text("All fields are required");
                                                                    return false;
                                                                }
                                                                // do the ajax..
                                                            });







                                                        });

                                                    </script>
                                                    <div class="study<?php echo $x; ?> study" >
                                                    <h2 style="background: #00afef; float:left; width:100%; color: #fff; font-size: 20px;margin: 0 0 10px;padding: 9px; text-transform: uppercase;">Study #<?php echo $x; ?></h2>
                                                    <?php
                                                    if ($user_roles == "manager_username"){ ?>
                                                        <p>
                                                            <label>Select Site:<br>
                                                            </label>
                          <span class="wpcf7-form-control-wrap">
                              <div class="ui-widget">
                                  <select class="required" aria-required="true" name="client_user<?php echo $x; ?>" id="combobox<?php echo $x; ?>">

                                      <?php
                                      $options="";

                                      natcasesort($authors_ids);
                                      $fr_user_id=0;
                                      $cnu=1;
                                      foreach($authors_ids as $in=>$auth){
                                          if($cnu==1){
                                              $fr_user_id=$in;
                                          }
                                          echo '<option value="'.$in.'">'.$auth.'</option>';
                                          $cnu++;
                                      }

                                      ?>

                                  </select>
                              </div>
                                   </span>
                                                        <div id="suggesstion-box"></div>
                                                        </p> <?php } ?>
                                                    <p>
                                                        <label>Study Type:<br>
                                                        </label>
                          <span class="wpcf7-form-control-wrap">
                          <select class="required" aria-required="true" name="studytype<?php echo $x; ?>" id="studymeta">
                              <option value="">Make a Selection</option>
                              <?php
                              $args = array(
                                  'orderby' => 'name',
                                  'parent' => 6,
                                  'hide_empty' => 0,
                                  'order' => 'ASC'
                              );
                              $categories = get_categories($args);
                              foreach ($categories as $category) {
                                  ?>
                                  <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                              <?php } ?>
                              <option value="Other Study Type">Other Study Type</option>
                          </select>
                          </span> </p>

                                                    <p>
                                                        <label>Site Name: </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
			<?php
            $sitename=$fr_user_id;

            $sqlsite=mysql_query("SELECT * FROM 0gf1ba_users INNER JOIN 0gf1ba_usermeta ON 0gf1ba_users.ID=0gf1ba_usermeta.user_id WHERE 0gf1ba_users.ID='$sitename' and 0gf1ba_usermeta.meta_key='sitename';");
            while($row = mysql_fetch_assoc($sqlsite)) {
                //print_r($row);
                $metavalue=$row["meta_value"];

            }?>
                              <input class="required" aria-required="true"  type="text" size="40" value="<?php echo $metavalue;?>" name="sitename<?php echo $x; ?>" id="sitenamemeta_<?php echo $x; ?>">
                          </span></p>
                                                    <p>
                                                        <?php
                                                        $sqlsite=mysql_query("SELECT * FROM 0gf1ba_users INNER JOIN 0gf1ba_usermeta ON 0gf1ba_users.ID=0gf1ba_usermeta.user_id WHERE 0gf1ba_users.ID='$sitename' and 0gf1ba_usermeta.meta_key='address';");
                                                        while($row = mysql_fetch_assoc($sqlsite)) {
                                                            //print_r($row);
                                                            $metavalue=$row["meta_value"];

                                                        }
                                                        ?>
                                                        <label>Study Address: </label>
                          <span class="wpcf7-form-control-wrap text-848">
                          <input class="required" aria-required="true"  type="text" size="40" value="<?php echo $metavalue ; ?>" name="studylocation<?php echo $x; ?>" id="addressmeta_<?php echo $x; ?>">
                          </span></p>
                                                    <p>
                                                        <label>Study Details: </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <textarea  aria-required="true"  rows="6" cols="50" name="studydetails<?php echo $x; ?>"></textarea>
                          </span></p>
                                                    <p>
                                                        <label>Protocol Number: </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input aria-required="true" class="required" type="text" size="40" value="" name="protocolnumber<?php echo $x; ?>" >
                          </span></p>
                                                    <p>
                                                    <p>
                                                        <label>Sponsor Name: </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input class="required"  aria-required="true"  type="text" size="40" value="" name="sponsorname<?php echo $x; ?>" >
                          </span></p>
                                                    <p>
                                                    <p>
                                                        <label>Sponsor Email: </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input aria-required="true"  type="text" size="40" value="" name="sponsoremail<?php echo $x; ?>" >
                          </span></p>
                                                    <p>
                                                        <label>CRO Name: </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input type="text" size="40" value="" name="croname<?php echo $x; ?>" >
                        </span>
                                                    </p>
                                                    <p>
                                                        <label>CRO Email: </label>
                        <span class="wpcf7-form-control-wrap textarea-350">
                        <input  type="text" size="40" value="" name="croemail<?php echo $x; ?>" >
                        </span>
                                                    </p>
                                                    <div id="addpicker<?php echo $x; ?>">
                                                        <p>
                                                            <label>Start Date: </label>
                                <span class="wpcf7-form-control-wrap textarea-350">
                                <input class="required" id="datepicker<?php echo $x; ?>"  aria-required="true"  type="text" size="40" value="<?php echo date('m/d/Y');?>" name="startdate<?php echo $x; ?>" >
                                </span>
                                                        </p>
                                                    </div>
                                                    <p class="addd_new<?php echo $x; ?>"><label></label>  <span class="wpcf7-form-control-wrap text-426"><a class="determine_start" unique_id="<?php echo $x; ?>" style="float: left; display: block; font-size: 16px; font-weight: bold; margin-bottom: 6px;margin-top: -6px;" href="javascript:void(0);">To be determined</a></span></p>
                                                    <p>
                                                        <label>Recruitment Phone: </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input class="required" aria-required="true"  type="text" size="40" value="" name="contactphone<?php echo $x; ?>" >
                          </span></p>
                                                    <div id="addinput<?php echo $x; ?>">
                                                        <p>
                                                            <label>Recruitment Email #1: </label>
                            <span class="wpcf7-form-control-wrap text-426">
                            <input class="required" style="margin-bottom:0px;" type="email"  aria-required="true"  size="40" value="" name="contactname<?php echo $x; ?>">
                            </span> </p>
                                                    </div>
                                                    <p class="addd_new<?php echo $x; ?>">
                                                        <label></label>
                                                        <span class="wpcf7-form-control-wrap text-426"><a style="float: left; display: block; font-size: 16px; font-weight: bold; margin: 7px 0px;" onclick="return addNew<?php echo $x; ?>(this);" href="javascript:void();">Add another recruitment email</a></span></p>
                                                    <p>
                                                        <label>Study Website: </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input aria-required="true"  type="text" size="40" value="" name="study_website<?php echo $x; ?>" >
                          </span></p>
                                                    <p>
                                                        <label>Exposure Level: </label>
                          <span class="wpcf7-form-control-wrap">
                          <select class="required" aria-required="true" name="boost_type<?php echo $x; ?>">
                              <option value="">Make a Selection</option>
                              <option value="Diamond">Diamond: $3059</option>
                              <option value="Platinum">Platinum: $1559</option>
                              <option value="Gold">Gold: $559</option>
                              <option value="Silver">Silver: $209</option>
                              <option value="Bronze">Bronze: $59</option>
                          </select>
                          </span> </p>
                                                    <p>
                                                        <label style="line-height: 24px;">Add Patient Messaging<br />
                                                            Suite ($247): </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <input style="width:auto;" type="checkbox" name="message_suite_247<?php echo $x; ?>" />
                          <span style="color: #00afef;line-height: 25px;margin-left: 10px;font-weight: bold;">Yes</span> </span></p>
                                                    <p>
                                                        <label style="line-height: 24px;">Condense to 2 <br />
                                                            Weeks (Free): </label>
                          <span class="wpcf7-form-control-wrap">
                          <input style="width:auto;" type="checkbox" name="condense_2_weeks<?php echo $x; ?>" />
                          <span style="color: #00afef;line-height: 25px;margin-left: 10px;font-weight: bold;">Yes</span> </span> </p>
                                                    <p>
                                                        <label style="line-height: 24px;">Upload Study Ad <br />
                                                            (not required) :</label>
                          <span class="wpcf7-form-control-wrap your-file">
                          <input type="file" class="attachment" size="40" name="attachment<?php echo $x; ?>">
                          </span></p>

                                                    <div>
                                                        <p>
                                                            <label>Coupon: </label>
                                <span class="wpcf7-form-control-wrap textarea-350">
                                    <input aria-required="true"  type="text" size="40" value="" name="study_coupon<?php echo $x; ?>" >
                                </span>
                                                        </p>

                                                    </div>
                                                    <div style="clear:both;"></div>

                                                    <p>
                                                        <label>Notes: </label>
                          <span class="wpcf7-form-control-wrap textarea-350">
                          <textarea aria-required="true"  rows="6" cols="50" name="notes<?php echo $x; ?>"></textarea>
                          </span></p>
                                                    </div>
                                                    <input type="hidden" value="total_studies<?php echo $x; ?>" name="total_studies<?php echo $x; ?>" />
                                                <?php } ?>
                                                <p>

                                                    <label></label>
                                                    <input type="submit" class="show_hide_input" name="show_hide_input" value="List My Studies">

                                                </p>
                                                </div>
                                                </div>
                                                </form>
                                            <?php
                                            } else {
                                            ?>
                                            <form class="add_Study" action="" method="post">
                                                <p>
                                                    <label>Number of studies: </label>
                                                    <select name="number_of_studies">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                    </select>
                                                    <input type="submit" class="show_hide_input" name="show_hide_input2" value="Add">
                                                </p>
                                            </form>
                                            <?php }?>
                                            <?php
                                            $invoice_num = $wpdb->get_var( "SELECT max(invoice_number) FROM `0gf1ba_invoice_number`");
                                            $inc_nummm=$invoice_num;
                                            if (isset($_REQUEST['show_hide_input'])) {

                                                $user_id = $user_ID;
                                                $current_user = wp_get_current_user();
                                                $current_user_email = $current_user->user_email;
                                                $fullname = $current_user->user_firstname;
                                                $total_entries = $_REQUEST['total_entries'];
                                                for ($y = 1; $y <= $total_entries; $y++) {

                                                    $final_num =  $inc_nummm+1;
                                                    $inc_nummm=$inc_nummm+1;
                                                    $studytype = stripslashes($_REQUEST['studytype' . $y]);
                                                    $sitename = $_REQUEST['sitename' . $y];
                                                    $studylocation = $_REQUEST['studylocation' . $y];
                                                    $studydetails = $_REQUEST['studydetails' . $y];
                                                    $protocolnumber = $_REQUEST['protocolnumber' . $y];
                                                    $startdate = $_REQUEST['startdate' . $y];
                                                    $notes = $_REQUEST['notes' . $y];
                                                    $contactname = $_REQUEST['contactname' . $y];
                                                    $contactemail = $_REQUEST['contactemail2' . $y];
                                                    $contactemail2 = $_REQUEST['contactemail3' . $y];
                                                    $contactemail3 = $_REQUEST['contactemail4' . $y];
                                                    $contactemail4 = $_REQUEST['contactemail5' . $y];
                                                    $contactphone = $_REQUEST['contactphone' . $y];
                                                    $study_website = $_REQUEST['study_website' . $y];
                                                    $boost_type1 = $_REQUEST['boost_type' . $y];
                                                    $sponsorname = $_REQUEST['sponsorname' . $y];
                                                    $sponsoremail = $_REQUEST['sponsoremail' . $y];
                                                    $croname = $_REQUEST['croname'.$y];
                                                    $croemail = $_REQUEST['croemail'.$y];
                                                    $coupon = $_REQUEST['study_coupon' . $y];
                                                    if ($boost_type1 == "Diamond") {
                                                        $boost_type_pr1=$boost_type1." $3059";
                                                        $price = '$3,059.00';
                                                        $price2 = '3059.00';
                                                    }
                                                    if ($boost_type1 == "Platinum") {
                                                        $boost_type_pr1=$boost_type1." $1559";
                                                        $price = '$1,559.00';
                                                        $price2 = '1559.00';
                                                    }
                                                    if ($boost_type1 == "Gold") {
                                                        $boost_type_pr1=$boost_type1." $559";
                                                        $price = '$559.00';
                                                        $price2 = '559.00';
                                                    }
                                                    if ($boost_type1 == "Silver") {
                                                        $boost_type_pr1=$boost_type1." $209";
                                                        $price = '$209.00';
                                                        $price2 = '209.00';
                                                    }
                                                    if ($boost_type1 == "Bronze") {
                                                        $boost_type_pr1=$boost_type1." $59";
                                                        $price = '$59.00';
                                                        $price2 = '59.00';
                                                    }
                                                    $message_suite_247 = $_REQUEST['message_suite_247' . $y];
                                                    if ($message_suite_247 == true) {
                                                        $message_suite_247 = "Yes";
                                                        $patient_message_suite = "$247.00";
                                                        $patient_message_suite2 = "247.00";
                                                    } else {
                                                        $message_suite_247 = "No";
                                                        $patient_message_suite = " ";
                                                        $patient_message_suite2 = " ";
                                                    }
                                                    $condense_2_weeks = $_REQUEST['condense_2_weeks' . $y];
                                                    if ($condense_2_weeks == true) {
                                                        $condense_2_weeks = "Yes";
                                                        $end_date = "15 days";
                                                        if($startdate != 'To be determined'){
                                                            $newDate = date("m/d/Y", strtotime($startdate . " +15 day"));
                                                            $wpFormatNewDate = date("Ymd", strtotime($startdate . " +15 day"));
                                                            $condense = true;
                                                        }else{
                                                            $newDate = 'To be determined';
                                                        }
                                                    } else {
                                                        $condense_2_weeks = "No";
                                                        $end_date = "30 days";
                                                        if($startdate != 'To be determined'){
                                                            $newDate = date("m/d/Y", strtotime($startdate . " +30 day"));
                                                            $wpFormatNewDate = date("Ymd", strtotime($startdate . " +30 day"));
                                                            $condense = false;
                                                        }else{
                                                            $newDate = 'To be determined';
                                                        }
                                                    }
                                                    $sub_total = $price2 + $patient_message_suite2;
                                                    //setlocale(LC_MONETARY, "en_US");
                                                    $sub_price = money_format("%i", $sub_total);
                                                    //$total_price = str_ireplace("USD", "$", $sub_price);
                                                    $sub_price="$".$sub_price;
                                                    $total_price = str_ireplace(" ", "", $sub_price);
                                                    $point_transfer=0;
                                                    $transfer_id=$user_id;
                                                    $act_txt='';
                                                    if ($boost_type1 == "Gold"){
                                                        $point_transfer=5;
                                                        $act_txt='Gold';
                                                    }
                                                    if ($boost_type1 == "Platinum") {
                                                        $point_transfer=15;
                                                        $act_txt='Platinum';
                                                    }
                                                    if ($boost_type1 == "Diamond") {
                                                        $point_transfer=30;
                                                        $act_txt='Diamond';
                                                    }
                                                    if($user_roles!='editor'){
                                                        $client_username = $_REQUEST['client_user' . $y];
                                                        $transfer_id=$client_username;
                                                    }
                                                    if($point_transfer > 0 && $transfer_id !=0 ){
                                                        $rewards_datetime = date('Y-m-d H:i:s',strtotime('-4 hours'));
                                                        $result1=mysql_query("SELECT `balance` FROM `0gf1ba_rewards_details` WHERE user_id='$transfer_id' and is_last=1  ORDER BY `id` DESC LIMIT 1");
                                                        $balance = 0;
                                                        while($row = mysql_fetch_assoc($result1)) {
                                                            //print_r($row);
                                                            $balance=$row["balance"];
                                                        }

                                                        if($balance == 0)
                                                        {
                                                            $new_balance=$point_transfer;
                                                        }
                                                        else{
                                                            $new_balance=$point_transfer+$balance;
                                                        }
                                                        //echo $balance.'ccccccccccccc';
                                                        $boost_type2='List of Study'.'('.$boost_type1 .')';
                                                        $activity='List a new study'.' ('.$act_txt .')';
                                                        $is_rewards_allowed = get_user_meta($transfer_id, 'rewards_allowed', true);
                                                        if ((bool) $is_rewards_allowed){
                                                            mysql_query("UPDATE 0gf1ba_rewards_details SET is_last=0 WHERE user_id='$transfer_id'");
                                                            $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_rewards_details`(`id`, `user_id`, `activity_of_points`,`rewards_date_time`,`credit`,`debit`,`balance`,`is_last`) VALUES (NULL,'$transfer_id','$activity','$rewards_datetime','$point_transfer',0,'$new_balance',1)",array()));
                                                            update_user_meta($transfer_id, 'rewards', $new_balance);
                                                        }
                                                    }
                                                    $subject = "cro/sponsors focus (".$final_num.")";
                                                    $message .= "
                                        <body>
                                                <table width='600' border='0' align='center' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif;'>
                                                          <tr>
                                                            <td colspan='3' align='center' valign='middle' style='color:#FD1631; font-size:20px; border-bottom:1px solid #D4D4D4; font-style: italic;'><strong>CRO/SPONSORS FOCUS STUDY #" . $y . "</strong></td>
                                                          </tr>
                                                          <tr>
                                                            <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Type:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $studytype . "</td>
                                                          </tr>
                                                           <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Site Name:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $sitename . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Address:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $studylocation . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Study Details:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $studydetails . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Protocol Number:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $protocolnumber . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Name:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $sponsorname . "</td>
                                                          </tr>";
                                                    if (strpos(strtolower($sponsoremail),'@studykik.com') == false) {
                                                        $message .= "  <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Sponsor Email:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $sponsoremail . "</td>
                                                          </tr>";
                                                    }
                                                    $message .= "<tr style='color:#000; font-size:12px;'>
                                                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> CRO Name:</strong></td>
                                                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$croname."</td>
                                                            </tr>
                                                            <tr style='color:#000; font-size:12px;'>
                                                                <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> CRO Email:</strong></td>
                                                                <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$croemail."</td>
                                                            </tr>";

                                                    $message .= " <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none;  border-left:none;'><strong> Start Date:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $startdate . "</td>
                                                          </tr>";
                                                    $l2=0;
                                                    if (strpos(strtolower($contactname),'@studykik.com') == false) { $l2++;
                                                        $message .= " <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactname . "</td>
                                                          </tr>";
                                                    }
                                                    if (strpos(strtolower($contactemail),'@studykik.com') == false) { $l2++;
                                                        $message .= "  <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail . "</td>
                                                          </tr>";
                                                    }
                                                    if (strpos(strtolower($contactemail2),'@studykik.com') == false) { $l2++;
                                                        $message .= " <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail2 . "</td>
                                                          </tr>";
                                                    }
                                                    if (strpos(strtolower($contactemail2),'@studykik.com') == false) { $l2++;
                                                        $message .= "   <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail3 . "</td>
                                                          </tr>";
                                                    }
                                                    if (strpos(strtolower($contactemail4),'@studykik.com') == false) { $l2++;
                                                        $message .= "    <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment Email #".$l2.":</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactemail4 . "</td>
                                                          </tr>";
                                                    }
                                                    $message .= "    <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Recruitment  Phone:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $contactphone . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Study Website:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $study_website . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Exposure Level:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $boost_type_pr1 . "</td>
                                                          </tr>
                                                           <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Add Patient Messaging Suite $247:</strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $message_suite_247 . "</td>
                                                          </tr>
                                                           <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Condense to 2 Weeks: </strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $condense_2_weeks . "</td>
                                                          </tr>
                                                           <tr style='color:#000; font-size:12px;'>
                                                            <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Notes: </strong></td>
                                                            <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>" . $notes . "</td>
                                                          </tr>
                                                          <tr style='color:#000; font-size:12px;'>
				    <td align='left' valign='middle' style='color:#000; border:1px solid #D4D4D4; border-top:none; border-left:none;'><strong>Invoice Number: </strong></td>
				    <td align='left' valign='middle' style='border:1px solid #D4D4D4; border-left:none; border-top:none; border-right:none;'>".$final_num."</td>
				</tr>
                                                          <tr>
                                                            <td height='5' colspan='3' align='right' valign='middle'></td>
                                                          </tr>
                                                          <tr>
                                                            <td height='5' colspan='3' align='right' valign='middle' bgcolor='#1A0806'></td>
                                                          </tr>
                                                        </table>
                                                        </body>";
                                                    $category_id = get_cat_ID($studytype);
                                                    $final_titile = $sitename . ' ' . $studytype . ' Study - Location: ' . $studylocation;
                                                    if($user_roles=='editor'){
                                                        $my_post = array(
                                                            'post_title' => $final_titile,
                                                            'post_content' => $studydetails,
                                                            'post_status' => 'pending',
                                                            'post_author' => $user_id,
                                                            'post_category' => array($category_id)
                                                        );
                                                        $post_id=wp_insert_post($my_post);
                                                    }
                                                    else{
                                                        $client_username = $_REQUEST['client_user' . $y];
                                                        $add_by_site=get_user_meta($client_username, 'add_manager_id', true);
                                                        if($add_by_site !=""){
                                                            add_user_meta($client_username, 'is_site_used', 'yes');
                                                        }
                                                        $my_post = array(
                                                            'post_title' => $final_titile,
                                                            'post_content' => $studydetails,
                                                            'post_status' => 'pending',
                                                            'post_author' => $client_username,
                                                            'post_category' => array($category_id)
                                                        );
                                                        $post_id=wp_insert_post($my_post);

                                                    }

                                                    if($user_roles=='manager_username'){

                                                        update_post_meta($post_id, 'manager_username', $user_id);
                                                    }
                                                    update_post_meta($post_id, 'email_adress', 'info@studyKIK.com');
                                                    update_post_meta($post_id, 'email_adress_2', $contactname);
                                                    update_post_meta($post_id, 'email_adress_3', $contactemail);
                                                    update_post_meta($post_id, 'email_adress_4', $contactemail2);
                                                    update_post_meta($post_id, 'email_adress_5', $contactemail3);
                                                    update_post_meta($post_id, 'email_adress_6', $contactemail4);
                                                    update_post_meta($post_id, 'phone_number', $contactphone);
                                                    update_post_meta($post_id, 'exposure_level', $boost_type1);
                                                    update_post_meta($post_id, 'name_of_site', $sitename);
                                                    update_post_meta($post_id, 'study_full_address', $studylocation);
                                                    update_post_meta($post_id, 'website_url_thank_you_page', $study_website);
                                                    update_post_meta($post_id, 'custom_title_(for_thank_you_page)', $studytype);
                                                    update_post_meta($post_id, 'study_end_date_new_study', $newDate);
                                                    update_post_meta($post_id, 'protocol_no', $protocolnumber);
                                                    update_post_meta($post_id, 'notes_cro', $notes);
                                                    update_post_meta($post_id, 'sponsor_name', $sponsorname);
                                                    update_post_meta($post_id, 'sponsor_email', $sponsoremail);
                                                    update_post_meta($post_id, 'cro_name', $croname);
                                                    update_post_meta($post_id, 'cro_email', $croemail);
                                                    update_post_meta($post_id, 'creadit_card', $creditcard);
                                                    update_post_meta($post_id, 'coupon', $coupon);
                                                    update_post_meta($post_id, 'condence', $condense);
                                                    if($newDate != 'To be determined'){
                                                        update_post_meta($post_id, 'study_start_date', date("Ymd", strtotime($startdate)));
                                                        update_post_meta($post_id, 'study_end_date', $wpFormatNewDate);
                                                    }else{
                                                        update_post_meta($post_id, 'study_start_date', $newDate);
                                                    }
                                                    global $wpdb;
                                                    $date = date('Y-m-d H:i:s');
                                                    $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_coupons` (`user_id`,`post_id`,`date`,`action`,`coupon_code`) VALUES ('$user_ID','$post_id','$date','list_study','$coupon')",array()));
                                                    $f_attchment1 = $_FILES["attachment" . $y]["tmp_name"];
                                                    move_uploaded_file($_FILES["attachment" . $y]["tmp_name"], WP_CONTENT_DIR . '/uploads/' . basename($_FILES['attachment' . $y]['name']));
                                                    $attachments[] = WP_CONTENT_DIR . "/uploads/" . $_FILES["attachment" . $y]["name"];
                                                    $attachments111 = site_url()."/wp-content/uploads/" . $_FILES["attachment" . $y]["name"];
                                                    $wp_filetype = wp_check_filetype(basename($attachments111), null);
                                                    if($user_roles=='editor'){
                                                        $attachment = array(
                                                            'post_mime_type' => $wp_filetype['type'],
                                                            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                                            'post_content' => '',
                                                            'post_status' => 'inherit',
                                                            'post_author' => $user_id
                                                        );
                                                    }
                                                    else {
                                                        $attachment = array(
                                                            'post_mime_type' => $wp_filetype['type'],
                                                            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                                            'post_content' => '',
                                                            'post_status' => 'inherit',
                                                            'post_author' => $client_username
                                                        );

                                                    }
                                                    $attach_id = wp_insert_attachment($attachment, $attachments111, $post_id);
                                                    set_post_thumbnail($post_id, $attach_id);
                                                    update_post_meta($post_id, 'file_url', $attachments111);
                                                    $message_pdf .= '<style type="text/css">
											<!--
											table
											{
												width:  100%;
												margin:0px 0px 0px 0px;
												padding: 0px 0px 0px 0px;
											}

											th{padding:2px 0px;}
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
					Invoice Number: ".$final_num."<br />
                    Invoice Date: ".$currdate."<br />
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
				    <td align='left'><b>Study Level:</b> ".$boost_type_pr1."</td>
				    <td align='center'> </td>
				    <td align='center'> </td>
				</tr>";
                                                    if($protocolnumber){
                                                        $message_pdf .= "<tr align='left'>
				    <td align='left'> </td>
				    <td align='left'><b>Protocol Number:</b> ".$protocolnumber."</td>
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
				</tr>";
                                                    if($startdate !="To be determined"){
                                                        $message_pdf .= "<tr align='left'>
					<td align='left'> </td>
					<td align='left'><b>Start Date:</b> ".$startdate."</td>
					<td align='center'> </td>
					<td align='center'> </td>
					</tr>";
                                                    }
                                                    else{
                                                        $message_pdf .= "<tr align='left'>
					<td align='left'> </td>
					<td align='left'><b>Start Date:</b>&nbsp;To be determined</td>
					<td align='center'> </td>
					<td align='center'> </td>
					</tr>";
                                                    }
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

                                                    if($message_suite_247 == "Yes"){
                                                        $message_pdf .= "<tr align='left'>
				    <td bordercolor='#000' align='left'>Patient Messaging Suite</td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='center'> </td>
				    <td bordercolor='#000' align='right'>".$patient_message_suite."</td>
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

                                                        $message_pdf .= "<th colspan='4' style='font-size: 14px;'><img style='width:100%;height:440px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

                                                    }else{

                                                        $message_pdf .= "<th colspan='4' style='font-size: 14px;'><img style='width:100%;height:440px;' src='".site_url()."/wp-content/themes/twentyfifteen/images/bottum_background.png'/></th>";

                                                    }
                                                    $message_pdf .= "</tr>
				</table></page>";

                                                    $subject_pdf_email = "Thank You for Listing " . $studytype . " " . $protocolnumber . "";
                                                    $pdf_email_text .= "
                                                    Hi " . $fullname . ",<br /><br />
                                                    Thank you for listing your " . $studytype . " " . $protocolnumber . " study with StudyKIK.<br /><br />
                                                    Please see invoice attached with detailed information.<br /><br />
                                                    If you have any questions please contact your project manager or call us at 1-877-627-2509.<br /><br />
                                                    Thank you!<br /><br />
                                                    StudyKIK<br />
                                                    1675 Scenic Ave #150, Costa Mesa, Ca, 92626<br />
                                                    info@studykik.com<br />
                                                    1-877-627-2509<br /><br /><br />
                                                    <img src='".site_url()."/wp-content/themes/twentyfifteen/images/logo.png'>";
                                                    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
                                                    $headers_pdf[] = 'From: StudyKIK <info@studykik.com>';
                                                    $headers_pdf[] = "MIME-Version: 1.0\r\n";
                                                    $headers_pdf[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                    require_once(dirname(__FILE__) . '/html2pdf/html2pdf.class.php');
                                                    $html2pdf = new HTML2PDF('P', 'A4','en', true, 'UTF-8', array(0, 0, 0, 0));
                                                    $html2pdf->setDefaultFont('Arial');
                                                    $html2pdf->writeHTML($message_pdf);
                                                    //ob_end_clean();
                                                    $study_cat_name1 = str_replace(' ', '_', $studytype);
                                                    $study_cat_name2 = str_replace("'", "", $study_cat_name1);
                                                    $study_cat_name = stripslashes($study_cat_name2);
                                                    $rand = rand();
                                                    $html2pdf->Output( dirname(__FILE__)."/pdf/".$final_num.' '.$studytype.' '.$boost_type1.' Invoice'.".pdf", "f");
                                                    $html2pdf->Output($_SERVER['DOCUMENT_ROOT']."/pdf/".$final_num.'_'.str_replace("'","",$study_cat_name).'_'.$boost_type1.'_Invoice'.".pdf", "f");
                                                    $pdf_attachment_path = dirname(__FILE__).'/pdf/'.$final_num.' '.$studytype.' '.$boost_type1.' Invoice.pdf';
                                                    $pdf_attachment_path_db = '/pdf/'.$final_num.'_'.str_replace("'","",$study_cat_name).'_'.$boost_type1.'_Invoice.pdf';
                                                    $attachments[] = dirname(__FILE__).'/pdf/'.$final_num.' '.$studytype.' '.$boost_type1.' Invoice.pdf';
                                                    update_post_meta($post_id, 'pdfpath', $pdf_attachment_path);
                                                    if($user_ID == 70 || $user_ID == 532 || $user_ID == 534 ){
//                                $user_info = get_userdata(70);
//                                $cromail=$user_info->user_email ;
                                                        wp_mail('mo.tan@studykik.com',$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
                                                    }
                                                    else{
                                                        wp_mail($current_user_email,$subject_pdf_email, $pdf_email_text,$headers_pdf,$pdf_attachment_path);
                                                    }

                                                    $pdf_email_text = "";
                                                    $message_pdf = "";
                                                    $current_month = date('M');
                                                    $current_year = date('Y');
                                                    $full_date = date('m/d/y');

//                                if($user_roles=='editor'){
//                                    $rewardpoints=get_the_author_meta('rewards', $user_id);
//                                }
//                                else
//                                {
//                                     $client_username = $_REQUEST['client_user' . $y];
//                                      $rewardpoints = get_the_author_meta('rewards', $client_username);
//                                }
                                                    if ($user_roles == "manager_username"){
                                                        $authh_id=get_post_field( 'post_author', $post_id);
                                                        $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES (NULL,'$authh_id','$post_id','$pdf_attachment_path_db','$protocolnumber','$final_num','$total_price','$current_month','$current_year','Study Information','$full_date')"));
                                                    }
                                                    else{
                                                        $wpdb->query($wpdb->prepare("INSERT INTO `0gf1ba_invoice_number`(`id`, `user_id`, `post_id`, `pdf_name`, `protocol_no`, `invoice_number`, `price`, `month`, `year`, `page_name`, `full_date`) VALUES (NULL,'$user_id','$post_id','$pdf_attachment_path_db','$protocolnumber','$final_num','$total_price','$current_month','$current_year','Study Information','$full_date')"));
                                                    }


                                                }


                                                $headers[] = 'From: New Study <info@studykik.com>';
                                                $headers[] = "MIME-Version: 1.0\r\n";
                                                $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                if($user_ID == 70 || $user_ID == 532 || $user_ID == 534 ){
                                                    //$user_info = get_userdata(70);
                                                    //$cromail=$user_info->user_email ;
                                                    $SendEmail = wp_mail('mo.tan@studykik.com', $subject, $message, $headers, $attachments);

                                                }
                                                else{
                                                    $SendEmail = wp_mail("info@studykik.com", $subject, $message, $headers, $attachments);
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
    <?php
    if ($SendEmail) {?>
        <div id="err_msgg" class="white_content" style="display:block;">
            <h2 class="heading">Thank you!</h2>
            <p id="msg_box" style="color: #000; padding: 15px; font-size: 16px; text-align: center;font-weight: bold;">Thank You, Your Studies Have Been Sent Successfully and Will Be Live in 24 Hours!</p>
            <a onclick="document.getElementById('err_msgg').style.display = 'none';document.getElementById('fade').style.display = 'none';" href="javascript:void(0)" class="closepop">Close</a> </div>
        <div id="fade" class="black_overlay" style="display:block;"></div>
    <?php } ?>
<?php
}elseif(isset($_GET['invoice']) && $_GET['invoice'] != ''){
    $action = (isset($_GET['action']) && $_GET['action'] == 'view') ? 'view' : 'modify';

    if($_GET['invoice'] !== 'new'){
        $sql_result = $invoice->getCurDraft($_GET['invoice']);

        while ($row = mysql_fetch_assoc($sql_result)) {
            $draft = $row;
            $decodeData = json_decode($draft["data"], true);
        }
    }
?>
<div class="main-container">
    <span class="user-heading"><?php echo get_user_meta($_GET['from_user'], 'nickname', true);?> Invoice</span>
    <article class="shoping_background wp-admin-invoice-background">
        <input id="hiddden-total" type="hidden" value="<?php echo $decodeData["total"]?>">
        <div class="container">
        <?php if($action != 'view'){ ?>
            <div class="col-md-12 col-xs-12 account_heading">
                <h2>PAYMENT INFO</h2>
            </div>
            <div class="col-sm-8 col-xs-12 right_payment">
                <div class="panel-group" id="accordion" role="tablist" >
                    <input type="hidden" value="1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
                                    <span>
                                        <img src="<?php bloginfo('template_url'); ?>/images/visa.png" alt="" class="img-responsive visa_left">
                                        <p>Visa ending in 5678<small>01/2017</small><strong></strong></p>
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="left_panel">
                                    <strong>Name on Card</strong>
                                    <b>John Doe</b>
                                </div>
                                <div class="right_panel">
                                    <strong>Billing Address</strong>
                                    <b>John Doe<br>12345 Address<br>City, CA 67890, US</b>
                                    <button class="delete_btn"><img src="<?php bloginfo('template_url'); ?>/images/delete.png" alt="" class="img-responsive"></button>
                                    <button class="update_btn"><img src="<?php bloginfo('template_url'); ?>/images/edit_bnt.png" alt="" class="img-responsive"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                                    <span>
                                        <img src="<?php bloginfo('template_url'); ?>/images/visa.png" alt="" class="img-responsive visa_left">
                                        <p>
                                            Visa ending in 5678<small>01/2017</small>
                                            <strong></strong>
                                        </p>
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="left_panel">
                                    <strong>Name on Card</strong>
                                    <b>John Doe</b>
                                </div>
                                <div class="right_panel">
                                    <strong>Billing Address</strong>
                                    <b>John Doe<br>12345 Address<br>City, CA 67890, US</b>
                                    <button class="delete_btn"><img src="<?php bloginfo('template_url'); ?>/images/delete.png" alt="" class="img-responsive"></button>
                                    <button class="update_btn"><img src="<?php bloginfo('template_url'); ?>/images/edit_bnt.png" alt="" class="img-responsive"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                                    <span>
                                        <img src="<?php bloginfo('template_url'); ?>/images/visa.png" alt="" class="img-responsive visa_left">
                                        <p>
                                            Visa ending in 9101<small>01/2018</small>
                                            <strong></strong>
                                        </p>
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="left_panel">
                                    <strong>Name on Card</strong>
                                    <b>John Doe</b>
                                </div>
                                <div class="right_panel">
                                    <strong>Billing Address</strong>
                                    <b>John Doe<br>12345 Address<br>City, CA 67890, US</b>
                                    <button class="delete_btn"><img src="<?php bloginfo('template_url'); ?>/images/delete.png" alt="" class="img-responsive"></button>
                                    <button class="update_btn"><img src="<?php bloginfo('template_url'); ?>/images/edit_bnt.png" alt="" class="img-responsive"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xs-12 add-new-card">
                <input type="submit" name="new_cart" id="new_cart" class="button delete button-large add_btn" value="Add New Card">
            </div>
            <?php } ?>
            <div class="table-responsive">
                <?php if($action == 'view'){ ?>
                    <span class="order-paid">
                        <?php
                            echo 'This order is paid on '.date_format(date_create($draft["paid"]), 'd/m/Y g:ia');
                            if($draft["refund"] != ''){
                                echo '<br /><span class=\'refund-note\'>This order refunded on '.date_format(date_create($draft["refund"]), 'd/m/Y g:ia').'</span>';
                            }
                        ?>
                    </span>
                <?php } ?>
                <table id="table_background" class="table wp-admin-invoice-table">
                    <thead>
                    <tr class="table_top invoice">
                        <th style="width: 10%">Quantity</th>
                        <th style="width: 40%">Product</th>
                        <th style="width: 20%">Price</th>
                        <th style="width: 20%">Total</th>
                        <?php if($action != 'view'){ ?><th style="width: 10%">Remove</th><?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($decodeData["rows"] as $key => $row) {
                            switch ($key) {
                                case 'diamond':
                                    $imageName = 'diamond';
                                    break;
                                case 'platinum':
                                    $imageName = 'platinum_new';
                                    break;
                                case 'gold':
                                    $imageName = 'gold_new';
                                    break;
                                case 'silver':
                                    $imageName = 'silver_new';
                                    break;
                                case 'bronze':
                                    $imageName = 'bronze_new';
                                    break;
                                case 'irb':
                                    $imageName = 'irb';
                                    break;
                                default:
                                    $imageName = false;
                                    break;
                            }
                            if($row["quantity"] != '' || $row["product"] != '' || $row["price"] != '' || $_GET['invoice'] == 'new'){
                    ?>
                        <tr class="<?php echo 'row_'.$key; ?>">
                            <td>
                                <input class="quantity" name="quantity" type="number" min="0" <?php echo 'value="'.$row['quantity'].'"';?><?php if($action == 'view'){ echo 'disabled="disabled"';} ?>/>
                            </td>
                            <td>
                                <?php if($imageName){ ?>
                                    <span class="<?php echo $key; ?>">
                                        <img src="<?php bloginfo('template_url'); ?>/images/<?php echo $imageName;?>.png" alt="" class="img-responsive">
                                    </span>
                                    <span class="name-el"><?php echo $row['product']; ?></span>
                                <?php }else{ ?>
                                    <input name="product" type="text" class="product" <?php echo 'value="'.$row['product'].'"'; ?>/>
                                <?php } ?>
                            </td>
                            <td class="td-rell">
                                <span class="visible-lg">$</span>
                                <input name="price" type="text" class="price" <?php echo 'value="'.$row['price'].'"'; ?> <?php if($action == 'view'){ echo 'disabled="disabled"';} ?>/>
                            </td>
                            <td class="row-total">
                                <?php
                                    if(is_int($row['quantity']*$row['price'])){
                                        echo '$'.$row['quantity']*$row['price'].'.00';
                                    }else{
                                        echo '$'.$row['quantity']*$row['price'];
                                    }
                                ?>
                            </td>
                            <?php if($action != 'view'){ ?>
                                <td>
                                    <span class="delete preview button">Delete</span>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php
                            }
                        }
                    ?>
                    <tr  class="table_bottum invoice">
                        <td colspan="5">
                            <?php if($action != 'view'){ ?><span class="add-row preview button">Add Row</span><?php } ?>
                            <span class="invoice total"></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php if($action != 'view'){ ?>
                <div class="col-md-12 col-xs-12 invoice-submit">
                    <input type="submit" name="save_draft" id="save_draft" class="button button-primary button-large" value="Save Draft">
                    <input type="submit" name="submit_payment" id="submit_payment" class="button button-primary button-large" value="Pay for Order">
                </div>
            <?php }else{ ?>
                <?php if($draft["refund"] == ''){ ?>
                    <div class="col-md-12 col-xs-12 invoice-refund">
                        <input type="submit" name="refund_draft" id="refund_draft" class="button button-primary button-large" value="Refund">
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </article>
</div>
<?php
}else{
?>
<div class="main-container">
    <span>Please go to <a href="">all users</a> and use "Invoice" button.</span>
</div>
<?php
}
?>
<!--   popup   -->
<div id="embed" class="add_payment_popup">
    <div class="container">
        <div class="Add_cart">
            <div class="col-md-12 col-xs-12 add_new_cart">
                <h2>Add New Card</h2>
            </div>
            <div class="col-md-12 col-xs-12 card_text">
                <p>Please note that any changes made here will affect future orders.</p>
            </div>
            <div class="col-md-6 col-xs-12">
                <form>
                    <input type="email" class="form-control" id="card_number" placeholder="Card Number">
                </form>
            </div>
            <div class="col-md-6 col-xs-12">
                <form>
                    <input type="email" class="form-control" id="card_number" placeholder="Name on Card">
                </form>
            </div>
            <div class="col-sm-4 col-xs-12">
                <select class="Expiration_Month">
                    <option value="Expiration Month">Expiration Month</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                </select>
            </div>
            <div class="col-sm-4 col-xs-12">
                <select class="Expiration_Month">
                    <option value="Expiration Year">Expiration Year</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                </select>
            </div>
            <div class="col-sm-4 col-xs-12">
                <select class="Expiration_Month">
                    <option value="CVC">CVC</option>
                    <option value="CVC">CVC</option>
                    <option value="CVC">CVC</option>
                    <option value="CVC">CVC</option>
                </select>
            </div>
            <div class="col-md-12 col-xs-12 horizontal_line">
            </div>
            <div class="col-md-6 col-xs-12">
                <form>
                    <input type="email" class="form-control" id="card_number" placeholder="Address">
                </form>
            </div>
            <div class="col-md-6 col-xs-12">
                <form>
                    <input type="email" class="form-control" id="card_number" placeholder="Address 2">
                </form>
            </div>
            <div class="col-md-3 col-xs-12">
                <form>
                    <input type="email" class="form-control" id="card_number" placeholder="City">
                </form>
            </div>
            <div class="col-md-3 col-xs-12">
                <form>
                    <input type="email" class="form-control" id="card_number" placeholder="Zip">
                </form>
            </div>
            <div class="col-md-6 col-xs-12">
                <form>
                    <input type="email" class="form-control" id="card_number" placeholder="State">
                </form>
            </div>
            <div class="col-sm-6 col-xs-12 add_cancel_btn">
                <img src="<?php bloginfo('template_url');?>/images/cancel.png" alt="" class="img-responsivem pull-right">
            </div>
            <div class="col-sm-6 col-xs-12 add_save_btn">
                <img src="<?php bloginfo('template_url');?>/images/save.png" alt="" class="img-responsive pull-left">
            </div>

        </div>
    </div>
</div>
<div id="fade" class="black_overlay"></div>
