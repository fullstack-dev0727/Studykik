<?php
/*
 * Template Name: INVOICE RECEIPTS
 */
?>

<?php
$current_year = intval(date("Y"));
?>
<h2>Manage Invoices</h2>
<div class="im-search-form">
    <div>
        <input type="hidden" name="user_login" id="user_login" value="<?= $user_login?$user_login:""?>"/>
        <form action="" method="GET">
            <input type="hidden" name="page" value="invoice_manage_page" />
            <input type="hidden" name="user_id" id="user_id" value="<?= $user_id?$user_id:""?>"/>

            <input type="text" name="user_name" id="user_name" value="<?= $user_name?$user_name:""?>"/>
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
                <?php
                for ($i = $current_year; $i >= 2014; $i --) {
                    echo "<option value='$i' " . (($year == $i) ? 'selected="selected"' : "") . ">$i</option>";
                }
                ?>
            </select>
            <input type="submit" value="Search" name="search" style="margin-left:10px;"/>
        </form>

    </div>
    <div style="float:right;">

        <span> Number of items per page : </span>
        <select class="limit" name="limit">
            <option value="50" <?php if($limit == 50){ echo 'selected="selected"';}?>>50</option>
            <option value="100" <?php if($limit == 100){ echo 'selected="selected"';}?>>100</option>
            <option value="250" <?php if($limit == 250){ echo 'selected="selected"';}?>>250</option>
            <option value="500" <?php if($limit == 500){ echo 'selected="selected"';}?>>500</option>
            <option value="1000" <?php if($limit == 1000){ echo 'selected="selected"';}?>>1000</option>
        </select>

        <span> Page : </span>
        <select class="page_num" name="page_num">
            <?php
            for ($i = 1; $i <= $total_count / $limit + 1; $i ++) {
                ?>
                <option value="<?= $i?>" <?php if($page_num == $i){ echo 'selected="selected"';}?>><?= $i?></option>
            <?php
            }
            ?>
        </select>
        <span>Total : <?= $total_count." Items"?></span>

    </div>

</div>
<div class="im-content">
    <table>
        <thead>
        <tr>
            <th class="protocal">No.</th>
            <th class="protocal">User</th>
            <th class="protocal">Date</th>
            <th class="protocal">Total</th>
            <th class="protocal">Invoice Number</th>
            <th class="protocal">Protocol Number</th>
            <th class="protocal">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if($query_invoice_number){
            foreach($query_invoice_number as $index => $query_invoice_number_value)
            {
                $file_to_download[] = site_url().$query_invoice_number_value->pdf_name;
                $invoice_user = get_userdata($query_invoice_number_value->user_id);
                ?>
                <tr>
                    <td class="second_row"><?= $index + 1?></td>
                    <td class="second_row"><?php echo $invoice_user->data->user_login   ?></td>
                    <td class="second_row"><?php echo $query_invoice_number_value->full_date;   ?></td>
                    <td class="second_row"><?php echo $query_invoice_number_value->price;?></td>
                    <td class="second_row"><a target="_blank" href="<?php bloginfo('url');?><?php echo $query_invoice_number_value->pdf_name;?>"><?php echo $query_invoice_number_value->invoice_number;?></a></td>
                    <td class="second_row"><?php echo $query_invoice_number_value->protocol_no;?></td>
                    <td class="second_row"><a href="<?= add_query_arg(array("id" => $query_invoice_number_value->id), menu_page_url("invoice_edit_page", false))?>">Edit</a> / <a href="<?= add_query_arg(array("id" => $query_invoice_number_value->id), menu_page_url("invoice_delete_page", false))?>">Delete</a></td>
                </tr>
            <?php   }



        }else{?>
            <tr>
                <td colspan="7" class="second_row" style="border-right:none !important;"> No Invoice found!</td>
            </tr>

        <?php }?>

        </tbody>
    </table>
</div>
<?php //get_footer('dashboard'); ?>