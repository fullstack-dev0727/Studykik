<?php
/*
 * Template Name: INVOICE MANAGEMENT
 */
?>

    <h2>Edit Invoice</h2>
<div class="<?= $validate ? "msg-success" : "msg-error"?>">
    <p>
<?= $message ?>
    </p>
</div>
<div class="im-search-form">
    <div>
        <form action="<?= $current_link?>" method="POST" id="invoice-edit-form">
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
                        <input id="full_date"  aria-required="true"  type="text" size="40" value="<?= $full_date?>" name="full_date" >

                    </td>
                <tr>

                    <td>
                        <span class="label">Total : </span>
                    </td>
                    <td>
                        $<input type="text" name="price" value="<?= $price?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Invoice Number : </span>
                    </td>
                    <td>
                        <input type="text" name="invoice_number" value="<?= $invoice_number?>"/>
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
                        <input type="text" name="protocol_no" value="<?= $protocol_no?>"/>
                    </td>
                </tr>
            </table>
            <input type="hidden" value="<?= $user_name?>" name="user_name"/>
            <input type="hidden" value="<?= $pdf_name?>" name="pdf_name"/>
            <input type="hidden" name="back_url" value="<?= $_POST['back_url'] ? $_POST['back_url'] : $_SERVER['HTTP_REFERER']?>"/>
            <a href="<?= $_POST['back_url'] ? $_POST['back_url'] : $_SERVER['HTTP_REFERER']?>"><input type="button" value="Back" id="go_back" name="go_back" style="margin-left:10px;"/></a>
            <input type="submit" value="Update" name="update" style="margin-left:10px;"/>
        </form>

    </div>

</div>

