<?php
/*
 * Template Name: order manage page
 */
?>

<?php
$current_year = intval(date("Y"));
?>
    <h2>Manage Orders</h2>
    <div class="im-search-form">
        <div>
            <input type="hidden" name="user_login" id="user_login" value="<?= $user_login?$user_login:""?>"/>
            <form action="" method="GET">
                <input type="hidden" name="page" value="order_manage_page" />
                <input type="hidden" name="user_id" id="user_id" value="<?= $user_id?$user_id:""?>"/>

                <input type="text" name="customer" id="customer" value="<?= $customer?$customer:""?>" placeholder="customer or invoice #"/>
                <select class="month_select" name="month_select">
                    <option value="">SELECT MONTH</option>
                    <option value="1" <?php if($month == "1"){ echo 'selected="selected"';}?>>January</option>
                    <option value="2" <?php if($month == "2"){ echo 'selected="selected"';}?>>February</option>
                    <option value="3" <?php if($month == "3"){ echo 'selected="selected"';}?>>March</option>
                    <option value="4" <?php if($month == "4"){ echo 'selected="selected"';}?>>April</option>
                    <option value="5" <?php if($month == "5"){ echo 'selected="selected"';}?>>May</option>
                    <option value="6" <?php if($month == "6"){ echo 'selected="selected"';}?>>June</option>
                    <option value="7" <?php if($month == "7"){ echo 'selected="selected"';}?>>July</option>
                    <option value="8" <?php if($month == "8"){ echo 'selected="selected"';}?>>August</option>
                    <option value="9" <?php if($month == "9"){ echo 'selected="selected"';}?>>September</option>
                    <option value="10" <?php if($month == "10"){ echo 'selected="selected"';}?>>October</option>
                    <option value="11" <?php if($month == "11"){ echo 'selected="selected"';}?>>November</option>
                    <option value="12" <?php if($month == "12"){ echo 'selected="selected"';}?>>December</option>
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
                for ($i = 1; $i <= ($total_count) / $limit + 1; $i ++) {
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
                <th class="protocal">Invoice Number</th>
                <th class="protocal">Date</th>
                <th class="protocal">Customer</th>
                <th class="protocal">Total</th>
                <th class="protocal">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php
            if($query_orders){
                foreach($query_orders as $index => $query_orders_value)
                {
                    $order_user = get_userdata($query_orders_value->user_id);
                    ?>
                    <tr>
                        <td class="second_row"><?= $index + 1?></td>
                        <td class="second_row"><?php echo $order_user->data->user_login   ?></td>
                        <td class="second_row">
                            <?php
                            $invoice_number = $query_orders_value->invoice_number;
                            if ($invoice_number == "" || $invoice_number == "0" || $invoice_number == null) {
                                if ($query_orders_value->total == 0)
                                    $invoice_number = "Free";
                                else
                                    $invoice_number = "Check";
                            }
                            echo $invoice_number;
                            ?>
                        </td>
                        <td class="second_row"><?php echo $query_orders_value->created_at   ?></td>
                        <td class="second_row"><?php echo $query_orders_value->customer;   ?></td>
                        <td class="second_row">$<?php echo number_format( $query_orders_value->total ,  2 ,  '.' ,  ',' );?></td>
                        <td class="second_row"><a href="<?= add_query_arg(array("id" => $query_orders_value->id), menu_page_url("order_detail_page", false))?>">View</a></td>
                    </tr>
                <?php   }



            }else{?>
                <tr>
                    <td colspan="7" class="second_row" style="border-right:none !important;"> No Orders found!</td>
                </tr>

            <?php }?>

            </tbody>
        </table>
    </div>

<script type="text/javascript">
    (function ($)
    {
        function setGetParameter(paramName, paramValue)
        {
            var url = window.location.href;
            if (url.indexOf(paramName + "=") >= 0)
            {
                var prefix = url.substring(0, url.indexOf(paramName));
                var suffix = url.substring(url.indexOf(paramName));
                suffix = suffix.substring(suffix.indexOf("=") + 1);
                suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
                url = prefix + paramName + "=" + paramValue + suffix;
            }
            else
            {
                if (url.indexOf("?") < 0)
                    url += "?" + paramName + "=" + paramValue;
                else
                    url += "&" + paramName + "=" + paramValue;
            }
            window.location.href = url;
        }

        $(document).ready(function () {
            remote_url = ajaxurl + "?action=get_user_name_id";


            $(".limit").on("change", function(){
                setGetParameter("limit", $(this).val());
            });
            $(".page_num").on("change", function(){
                setGetParameter("page_num", $(this).val());
            });


        });

    })(jQuery);
</script>