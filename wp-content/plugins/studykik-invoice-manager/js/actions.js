/**
 * Created by kp on 1/5/16.
 */

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
//        console.log(remote_url);
        $('#user_name').autocomplete({
            minLength: 2,
            source:
                function( request, response ) {
                    $.ajax({
                        url: remote_url,
                        method: "get",
                        data: {
                            term: request.term
                        },
                        success: function( data ) {
                            response( JSON.parse(data));
                        }
                    });
                },
            focus: function( event, ui ) {
                $( "#user_name" ).val( ui.item.label );
                return false;
            },
            close: function( event, ui ) {
                if ($("#user_name").val() != $( "#user_login" ).val()) {
                    $("#user_name").val($( "#user_login" ).val());
                }
                console.log("close");
            },
            select: function( event, ui ) {
                console.log("select");
                $( "#user_login" ).val( ui.item.label );
                $( "#user_id" ).val( ui.item.value );
                return false;
            }
        });
        $('#user_name').on("keyup", function(){
            console.log($("#user_name").val());
            if ($("#user_name").val() == "") {
                $( "#user_login" ).val( "" );
                $( "#user_id" ).val( "" );
            }
        });
//        console.log(ajaxurl);

//            .autocomplete( "instance" )._renderItem = function( ul, item ) {
//            return $( "<li>" )
//                .append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
//                .appendTo( ul );
//        };

        $(".limit").on("change", function(){
            setGetParameter("limit", $(this).val());
        });
        $(".page_num").on("change", function(){
            setGetParameter("page_num", $(this).val());
        });
        $("#invoice-delete-form").on("submit", function(){
            if (confirm("Are you sure to delete this invoice?")) {
                return true;
            } else {
                return false;
            }
        });

//        $("#full_date").on("click", function(){
//           alert("dsf");
//        });
        if ($( "#full_date").length > 0) {
            $( "#full_date" ).datepicker();
        }

//        $.ajax({
//            type: "post",
//            dataType: "json",
//            timeout: 30000,
//            url: wpajaxurl,
//            data: {action: 'my_embedplus_glance_count'},
//            success: function (response) {
//                if (response.type == "success") {
//                    $(response.container).append(response.data);
//                    $(".ytprefs_glance_button").click(widen_ytprefs_glance);
//                    $(window).resize(widen_ytprefs_glance);
//                    if (typeof ep_do_pointers == 'function')
//                    {
//                        //ep_do_pointers($);
//                    }
//                }
//                else {
//                }
//            },
//            error: function (xhr, ajaxOptions, thrownError) {
//
//            },
//            complete: function () {
//            }
//        });

    });

})(jQuery);