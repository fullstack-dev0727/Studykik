<?php
/*
 * Template Name: INVOICE MANAGEMENT
 */
?>

    <h2>Delete Invoice</h2>
<?php if ($msg != "") {?>
<div>
    <?= $msg?>
</div>
<?php }?>
<div class="im-search-form">
    <div>
        <form action="<?= $current_link?>" method="POST" id="invoice-delete-form">
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
                        <?= $full_date?>

                    </td>
                <tr>

                    <td>
                        <span class="label">Total : </span>
                    </td>
                    <td>
                        $<?= $price?>
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
                        <span class="label">Invoice File : </span>
                    </td>
                    <td>
                        <a target="_blank" href="<?php bloginfo('url');?><?php echo $pdf_name;?>"><?php echo substr($pdf_name, 5)?></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Protocol Number : </span>
                    </td>
                    <td>
                        <?= $protocol_no?>
                    </td>
                </tr>
            </table>
            <input type="hidden" value="<?= $user_name?>" name="user_name"/>
            <input type="hidden" value="<?= $pdf_name?>" name="pdf_name"/>
            <input type="hidden" name="back_url" value="<?= $_POST['back_url'] ? $_POST['back_url'] : $_SERVER['HTTP_REFERER']?>"/>
            <a href="<?= $_POST['back_url'] ? $_POST['back_url'] : $_SERVER['HTTP_REFERER']?>"><input type="button" value="Back" id="go_back" name="go_back" style="margin-left:10px;"/></a>
            <?php if ($msg == "") {?>

            <input type="submit" value="Delete" id="delete_invoice" name="delete" style="margin-left:10px;"/>
            <?php }?>
        </form>

    </div>

</div>

