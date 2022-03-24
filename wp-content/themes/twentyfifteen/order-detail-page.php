<?php
/*
 * Template Name: INVOICE MANAGEMENT
 */
?>

<h2>Order Detail</h2>
<div class="im-search-form">
    <div>
        <table>
            <tr>
                <td>
                    <span class="label">User Name : </span>
                </td>
                <td>
                    <?= $user_name?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Date : </span>
                </td>
                <td>
                    <?= $created_at?>

                </td>
            <tr>

                <td>
                    <span class="label">Total : </span>
                </td>
                <td>
                    $<?php echo number_format( $total ,  2 ,  '.' ,  ',' );?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Invoice Number : </span>
                </td>
                <td>
                    <?= $invoice_number?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Customer : </span>
                </td>
                <td>
                    <?= $customer?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Invoice Files : </span>
                </td>
                <td>
                    <?php
                    foreach($invoices as $invoice) {
                    ?>
                        <a target="_blank" href="<?php bloginfo('url');?><?php echo $invoice;?>"><?php echo substr($invoice, 5)?></a><br/>
                    <?php
                    }
                    ?>
<!--                    <a target="_blank" href="--><?php //bloginfo('url');?><!----><?php //echo $pdf_name;?><!--">--><?php //echo substr($pdf_name, 5)?><!--</a>-->
                </td>
            </tr>
        </table>
        <a href="<?= $_SERVER['HTTP_REFERER']?>"><input type="button" value="Back" id="go_back" name="go_back" style="margin-left:10px;"/></a>
        <?= $message?>
    </div>

</div>

