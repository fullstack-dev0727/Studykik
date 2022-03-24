<?php
/*
* FOOTER TEMPLATE FOR DASHBOARD
*/
?>
<footer>
<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-12 clo-lg-6">
<ul>
<li><a target="_blank"  href="<?php bloginfo('url');?>">HOME PAGE</a></li>
<li><a target="_blank"  href="<?php bloginfo('url');?>/contact/">CONTACT US</a></li>
<li><a target="_blank" href="<?php bloginfo('url');?>/clinical-trial-patient-recruitment-patient-enrollment/">LIST YOUR TRIAL</a></li>
</ul>
</div>
</div>
</footer>
<!--<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>-->
<?php wp_footer(); ?>

<script type="text/javascript">
adroll_adv_id = "C6ZNNPXKDNFDLJT5OZKC6Q";
adroll_pix_id = "HE6GJDWIMFBBDIBTU7L5MB";

(function () {
var _onload = function(){
if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
var scr = document.createElement("script");
var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
            scr.setAttribute('async', 'true');
            scr.type = "text/javascript";
            scr.src = host + "/j/roundtrip.js";
            ((document.getElementsByTagName('head') || [null])[0] ||
                document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
        };
        if (window.addEventListener) {window.addEventListener('load', _onload, false);}
        else {window.attachEvent('onload', _onload)}
    }());
</script>

</body>
</html>
