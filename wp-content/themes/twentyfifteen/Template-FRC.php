<?php
/*
 *Template Name: FRC
 */
?>
<?php get_header(); ?>
<div id="cntt-form">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h1 class="form-head">Featured Research Centers</h1>
                <p style="text-align:center;">This is a list of our featured research centers and their services, facilities, and any other information about their <br />
                    clinical investigation experience.</p>
                <div class="center-block-form">
                    <div class="center-form">
                        <?php echo do_shortcode('[gmw form="2"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <?php if (isset($_REQUEST['find_search'])) { ?>
     <div id="trial">
        <div id="trail">
            <div class="container">
                <div class="row">
                    <div class="trail-list">
                        <?php echo do_shortcode('[gmw_results]'); ?>
                    </div>
                </div>
            </div>
        </div></div>
    <?php } ?>
  </div>
    <?php get_footer(); ?>
<!-------------------------------------css added-------------------------------->
<style>
    #cntt-form {
        border-top: 35px solid #9FCF67;
        float: left;
        padding: 20px 0;
        width: 100%;
    }
    .get_frc {
        width: 118px !important;
        background-color: #9fcf67 !important;
        color: #fff !important;
    }
    .form-head {
        font-size: 30px !important;
    }
    .trail-list .col-sm-4 {
        min-height: 279px;
        width: 397px;
    }
    .list-img {
        width: 100%;
        height: 250px;
        background:#fff;
    }
    #trail .container {
        width: 900px;
    }

    .center-form input.btn {
        background: url("<?php echo site_url();?>/wp-content/themes/twentythirteen/images/btn.png") no-repeat scroll 0 0 / 100% 100% rgba(0, 0, 0, 0);
        box-shadow: 3px 4px 5px #c3c3c3;
        font-size: 0;
    }
</style>
<!-------------------------------------css added-------------------------------->