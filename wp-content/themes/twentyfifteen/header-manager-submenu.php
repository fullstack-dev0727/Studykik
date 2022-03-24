<style>
    .nav > li {
        padding: 5px !important;
    }
    #top h1 img {
        left: 480px !important;
    }
    .nav li a {
        border-radius: 4px;
        color: #777c7f;
        display: block;
        float: left;
        font-size: 15px;
        font-weight: 700;
        margin-right: 13px;
        padding: 9px 5px;
        text-decoration: none;
        text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.85);
        text-transform: none;
    }
    .nav li a.midsection {
        margin-right: 250px;
    }
    #top {
        display: block;
        margin-bottom: 0px;
        position: relative;
    }
    .dashboard_banner {
        background: #FFF;
        float: left;
        width: 100%;
        border-radius: 5px;
        margin: 40px 0 0;
        -moz-box-shadow: -1px 1px 9px #4a4e45;
        -webkit-box-shadow: -1px 1px 9px #4a4e45;
        box-shadow: 0px -4px 9px #4a4e45;
        padding: 30px 0;
        border-radius: 5px 5px 0 0;
    }
    .studykik_contact {
        float: right;
        margin: 20px 28px 0 0;
        width: 92%;
    }
    body {
        margin: 0 auto;
        padding: 0;
        font-family: "Helvetica Neue", Helvetica, sans-serif;
    }
    /*                #clientmeta placeholder{color: #88dd25;} */

</style>
<!--<div class="row">-->
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
                        <li class='<?= ( get_page_link() == site_url()."/dashboard/" ) ? "active" : ""?>'>
                            <a href="<?php echo site_url();?>/dashboard/" style="margin-top:12px">HOME
                            </a>
                        </li>
                        <li class='<?= ( get_page_link() == site_url()."/clinical-study-information-dashboard/" ) ? "active" : ""?>'>
                            <a href="<?php echo site_url();?>/clinical-study-information-dashboard/">LIST A<br>
                                NEW STUDY</a>
                        </li>
                        <li class='<?= ( get_page_link() == site_url()."/add-site/" ) ? "active" : ""?>'>
                            <a  href="<?php echo site_url();?>/add-site/" style="margin-top:12px">ADD SITE</a>
                        </li>
                        <li class='<?= ( get_page_link() == site_url()."/refer-listing/" ) ? "active" : ""?>' style="border:none;">
                            <a class="midsection" href="<?php echo site_url();?>/refer-listing/">REFER<br>
                                A LISTING</a>
                        </li>
                        <li class='<?= ( get_page_link() == site_url()."/rewards/" ) ? "active" : ""?>' >
                            <a style ="margin-top: 12px;" href="<?php echo site_url();?>/rewards/">REWARDS</a>
                        </li>
                        <!--                                        <li><a href="javascript:void:0();"> ADD<br> PREFERRED<br> IRBs</a></li>-->
                        <li class='<?= ( get_page_link() == site_url()."/proposal/" ) ? "active" : ""?>'>
                            <a href="<?php echo site_url();?>/proposal/">CREATE <br/> PROPOSAL</a>
                        </li>
                        <li class='<?= ( get_page_link() == site_url()."/invoice-receipts/" ) ? "active" : ""?>'>
                            <a href="<?php echo site_url();?>/invoice-receipts/">INVOICE <br />
                                RECEIPTS</a>
                        </li>
                        <li class='<?= ( get_page_link() == site_url()."/your-profile/" ) ? "active" : ""?>'>
                            <a href="<?php echo site_url();?>/your-profile/?idp=Profile" style="margin-top:12px">MY ACCOUNT
                            </a>
                        </li>
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
<!--</div>-->