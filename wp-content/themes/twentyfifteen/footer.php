<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <h1 class="first">Copyright StudyKIK 2016</h1>
                <h1>Santa Ana, California.</h1>
            </div>
            <div class="col-xs-6 col-sm-3">
                <h1>NAVIGATION.</h1>
                <?php
                /* Primary navigation */
                wp_nav_menu(array(
                    'menu' => 'Footer Menu',
                    'items_wrap' => '<ul class="">%3$s</ul>')
                );
                ?>
            </div>
            <div class="col-xs-6 col-sm-3 fs">
                <h1>SOCIALIZE.</h1>
                <div class="col-md-6">
                    <ul class="foot-social">
                        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?=www.studykik.com&u=www.studykik.com"><img src="<?php echo get_template_directory_uri(); ?>/images/ffb.jpg" alt="" height="32" width="32"></a></li>
                        <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=http://studykik.com/&title=Find%20Clinical%20Trials%20Near%20You&summary=&source="><img src="<?php echo get_template_directory_uri(); ?>/images/flk.jpg" alt="" height="32" width="32"></a></li>
                        <li><a target="_blank" href="https://plus.google.com/share?url=[http://studykik.com]"><img src="<?php echo get_template_directory_uri(); ?>/images/fgp.jpg" alt="" height="32" width="32"></a></li>
                        <li><a target="_blank" href="http://twitter.com/home?status=[Find Clinical Trials Near You]+[http://studykik.com]"><img src="<?php echo get_template_directory_uri(); ?>/images/ftt.jpg" alt="" height="32" width="32"></a></li>
                        <li><a target="_blank" href="http://instagram.com/studykik/#"><img src="<?php echo get_template_directory_uri(); ?>/images/fin.jpg" alt="" height="32" width="32"></a></li>
                        <li><a target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?media=http://studykik.com/wp-content/themes/twentythirteen/images/logo.png&url=http://studykik.com&is_video=false&description=Find Clinical Trials Near You"><img src="<?php echo get_template_directory_uri(); ?>/images/ftp.jpg" alt="" height="32" width="32"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/crousel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        if ($('#carousel')) {
            $('#carousel').carouFredSel({
                responsive: true,
                circular: true,
                auto: true,
                items: {
                    visible: 1,
                    width: 200,
                    height: '56%'
                },
                scroll: {
                    fx: 'directscroll'
                },
                pagination: '#pager'
            });
        }
        if ($('#thumbs')) {
            $('#thumbs').carouFredSel({
                responsive: true,
                circular: true,
                auto: true,
                prev: '#prev',
                next: '#next',
                items: {
                    visible: {
                        min: 0,
                        max: 4
                    },
                    width: 150,
                    height: '66%'
                }
            });
        }
        $('#thumbs a').click(function () {
            $('#carousel').trigger('slideTo', '#' + this.href.split('#').pop());
            $('#thumbs a').removeClass('selected');
            $(this).addClass('selected');
            return false;
        });
    });

</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom-form.js"></script>
<?php wp_footer(); ?>
<script type="text/javascript" src="https://studykik.agilecrm.com/stats/min/agile-min.js"> </script>
<script type="text/javascript" >
    _agile.set_account('cp9epdq67dt60pbtmmb12kmmm1', 'studykik');
    _agile.track_page_view();
    _agile_execute_web_rules();
</script>
<script type="text/javascript">
adroll_adv_id = "C6ZNNPXKDNFDLJT5OZKC6Q";
adroll_pix_id = "HE6GJDWIMFBBDIBTU7L5MB";

(function () {
var _onload = function(){
if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
var scr = document.createElement("script");
var host = (("https:" == document.
location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
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
