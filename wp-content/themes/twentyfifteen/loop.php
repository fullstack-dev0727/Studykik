<?php

session_start();

$current_listing= $_SESSION["current_listing"];
$post_type= $_SESSION["post_type"];
if($_SESSION["user_ID"] == ""){
    $user_ID = get_current_user_id();
}
else{
    $user_ID = $_SESSION["user_ID"];
}
if(isset($_SESSION["orderby"]) && !empty($_SESSION["orderby"]) || !empty($_SESSION["search_query"]) || !empty($_SESSION["search_study"])){
    if($_SESSION["s"]=='d')
        $sort_hm='DESC';
    else
        $sort_hm='ASC';
    $search_for_patient = $_SESSION["search_for_patient"];
    $ord_hm =$_SESSION["orderby"];
    if(!empty($_SESSION["search_query"]) || !empty($_SESSION["search_study"])){
        $r_color=$_SESSION['color'];
        $r_tier=$_SESSION['tier'];
        $r_level=$_SESSION['level'];
        $search_for_study = $_SESSION["studysearch"];
        $r_catname=$_SESSION['catname'];
        $r_authorid = $_SESSION['ssponsorname'];
        $active_inactive = $_SESSION['active_inactive'];
        $check_vip=$_SESSION['check_vip'];
        if($active_inactive !="" || $r_authorid !="" || $r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || $check_vip == "vip"){
            $search_criteris_ids = $_SESSION["search_criteris_ids"] ;
            $queryArgs = array(
                'post_status' => $post_type,
                'posts_per_page' =>25,
                'post__not_in' => array(108),
                'post__in' => $search_criteris_ids,
                'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
                'post_type'=>  'post',
                'meta_key' => 'study_no',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'fields'=>'id=>parent'
                // 'meta_query' => array(
                //     'relation' => 'OR',
                //     array(
                //         'key' => 'project_manager_1',
                //         'value' => $user_ID,
                //         'compare' => '='
                //     ),
                //     array(
                //         'key' => 'project_manager_2',
                //         'value' => $user_ID,
                //         'compare' => '='
                //     ),
                //     array(
                //         'key' => 'project_manager_3',
                //         'value' => $user_ID,
                //         'compare' => '='
                //     ),
                // )
            );
            $custom_posts= query_posts($queryArgs);
        }
    }
    $search_for_patient = $_SESSION["search_for_patient"];
    $r_color=$_SESSION['color'];
    $r_tier=$_SESSION['tier'];
    $r_level=$_SESSION['level'];
    $search_criteris_ids = $_SESSION["search_criteris_ids"] ;
    $search_id_details=array();
    $search_for_study = $_SESSION["studysearch"];
    $r_catname=$_SESSION['catname'];
    if($r_color !="" || $r_tier !="" || $r_level !="" || $search_for_patient !="" || $search_for_study !="" || $r_catname !="" || $check_vip == "vip"){
        $search_id_details=$search_criteris_ids;
    }

    $search_id_details=$search_criteris_ids;

    if($ord_hm=='site_name'){
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $search_id_details,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'meta_key'          => 'name_of_site',
            'orderby'           => 'meta_value',
            'order'             => $sort_hm,
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )

        );
        $custom_posts= query_posts($queryArgs);
    }
    else if($ord_hm=='sponsor'){
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $search_id_details,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'meta_key'          => 'sponsor_name',
            'orderby'           => 'meta_value',
            'order'             => $sort_hm,
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )

        );
        $custom_posts= query_posts($queryArgs);
    }
    else if($ord_hm=='Category'){
        $catgory_order=$_SESSION["CATO_SORT_ARR"];
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $catgory_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);

    }
    else if($ord_hm=='Location'){

        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__in' => $search_id_details,
            'post__not_in' => array(108),
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'meta_key'          => 'study_full_address',
            'orderby'           => 'meta_value',
            'order'             => $sort_hm,
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }
    else if($ord_hm=='Level'){
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $search_id_details,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'meta_key'          => 'exposure_level',
            'orderby'           => 'meta_value',
            'order'             => $sort_hm,
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }
    else if($ord_hm=='Today'){
        $today_order=$_SESSION["TODAY_SORT_ARR"];
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $today_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);

    }
    else if($ord_hm=='Yesterday'){
        $yesterday_order=$_SESSION["YESTERDAY_SORT_ARR"];
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $yesterday_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }

    else if($ord_hm=='Total'){
        $total_count_order=$_SESSION["TOTAL_SORT_ARR"];
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $total_count_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }

    else if($ord_hm=='Goal'){
        $goal_count_order = $_SESSION["GOAL_SORT_ARR"] ;
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $goal_count_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }

    else if($ord_hm=='End'){
        $end_date_order=$_SESSION["END_DT_SORT_ARR"];
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $end_date_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }

    else if($ord_hm=='CA'){
        $call_attempt_order = $_SESSION["CALL_ATTEMPT_SORT_ARR"] ;
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $call_attempt_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }

    else if($ord_hm=='NQ'){
        $not_qualify_order=$_SESSION["NOT_QUALIFY_SORT_ARR"] ;
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $not_qualify_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }

    else if($ord_hm=='AN'){
        $action_needed_order=$_SESSION["ACTION_NEEDED_SORT_ARR"] ;
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $action_needed_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }

    else if($ord_hm=='S'){
        $scheduled_order=$_SESSION["SCHEDULED_SORT_ARR"] ;
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $scheduled_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }

    else if($ord_hm=='C'){
        $consented_order = $_SESSION["CONSENTED_SORT_ARR"] ;
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $consented_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }

    else if($ord_hm=='R'){
        $randomized_order = $_SESSION["RANDOMIZED_SORT_ARR"] ;
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $randomized_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }







    else if($ord_hm=='NP'){
        $new_patient_order=$_SESSION["NEW_PATIENT_SORT_ARR"];
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $new_patient_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }

    else if($ord_hm=='Views'){
        $views_count_order = $_SESSION["VIEWS_SORT_ARR"];
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $views_count_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);

    }

    else if($ord_hm=='Study_no'){
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'post__in' => $search_id_details,
            'meta_key'          => 'study_no',
            'orderby'           => 'meta_value_num',
            'order'             => $sort_hm,
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }



    else if($ord_hm=='RunningTotal'){
        $running_count_order=$_SESSION["RUNNING_SORT_ARR"] ;
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $running_count_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }
    else if($ord_hm=='RW'){
        $reward_count_order=$_SESSION["RUNNING_SORT_ARR"] ;
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' =>25,
            'post__not_in' => array(108),
            'post__in' => $reward_count_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'orderby'=> 'post__in',
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }
    else if($ord_hm=='DaysLeft'){
        $days_left_order=$_SESSION["DAYSLEFT_SORT_ARR"] ;
        $queryArgs = array(
            'post_status' => $post_type,
            'posts_per_page' => 25,
            'post__not_in' => array(108),
            'post__in' => $days_left_order,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
            'post_type'=>  'post',
            'meta_key'          => 'study_start_date',
            'orderby'           => 'meta_value',
            'order'             => $sort_hm,
            'fields'=>'id=>parent'
            // 'meta_query' => array(
            //     'relation' => 'OR',
            //     array(
            //         'key' => 'project_manager_1',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_2',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            //     array(
            //         'key' => 'project_manager_3',
            //         'value' => $user_ID,
            //         'compare' => '='
            //     ),
            // )
        );
        $custom_posts= query_posts($queryArgs);
    }


}
else
{
    $order_hm='';
    $queryArgs = array(
        'post_status' => $post_type,
        'posts_per_page' =>25,
        'post__not_in' => array(108),
        'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
        'post_type'=>  'post',
        'meta_key'          => 'study_no',
        'orderby'           => 'meta_value_num',
        'order'             => 'DESC',
        'fields'=>'id=>parent',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'project_manager_1',
                'value' => $user_ID,
                'compare' => '='
            ),
            array(
                'key' => 'project_manager_2',
                'value' => $user_ID,
                'compare' => '='
            ),
            array(
                'key' => 'project_manager_3',
                'value' => $user_ID,
                'compare' => '='
            ),
        )
    );
    $custom_posts= query_posts($queryArgs);


}

$sorting = $_REQUEST['s'];
if($sorting == 'd')
    $sorting_disp = 'a';
else
    $sorting_disp = 'd';
?>
<?php
$post_list_ids=array();
$subs_by_ids=array();
$row_num_ids=array();
$date = date('Y-m-d',strtotime('-4 hours'));
$date_Y = date('Y-m-d',strtotime('-28 hours'));
while ( have_posts() ) : the_post();
    $post_list_ids[]=$post->ID;
endwhile;
if(!empty($post_list_ids)){
    $im_post_list_ids=implode(",",$post_list_ids);
    $query_subs = $wpdb->get_results("SELECT campaign,post_id,row_num,date FROM 0gf1ba_subscriber_list WHERE post_id IN (".$im_post_list_ids.")");
    if($wpdb->num_rows){
        foreach($query_subs as $t_pst){
            $Campaign=$t_pst->campaign;
            if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
                $Campaign=1;
            }
            $subs_by_ids[$t_pst->post_id][$Campaign]+=1;
            $subs_by_ids[$t_pst->post_id]['row_num'][$t_pst->row_num]+=1;
            $dat = date('Y-m-d',strtotime($t_pst->date));
            if($dat==$date){
                $subs_by_ids[$t_pst->post_id]['today'][$Campaign]+=1;
            }
            if($dat==$date_Y){
                $subs_by_ids[$t_pst->post_id]['yesterday'][$Campaign]+=1;
            }
        }

    }
}



$sumyesterday=0;
$sumtoal=0;
$sumtoday=0;
$sumnum1=0;
$sumnum2=0;
$sumnum3=0;
$sumnum4=0;
$sumnum5=0;
$sumnum6=0;
$sumnum7=0;
$sumnum8=0;


while ( have_posts() ) : the_post(); $i++;

    $Campaign = get_post_meta($post->ID, 'renewed',true );
    if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
        if(isset($subs_by_ids[$post->ID][1])){
            $toal_counted=$subs_by_ids[$post->ID][1];
        }
        else{
            $toal_counted =  0;
        }
    }
    else{
        if(isset($subs_by_ids[$post->ID][$Campaign])){
            $toal_counted=$subs_by_ids[$post->ID][$Campaign];
        }
        else{
            $toal_counted =  0;
        }
    }
    $sumtoal+=$toal_counted;


    if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
        $Cam=1;
    }
    else{
        $Cam=$Campaign;
    }
    if(isset($subs_by_ids[$post->ID]['today'][$Cam])){
         $today = $subs_by_ids[$post->ID]['today'][$Cam];
    }
    else{
         $today = 0;
    };
    $sumtoday+=$today;
    if(isset($subs_by_ids[$post->ID]['yesterday'][$Cam])){
         $yesterday = $subs_by_ids[$post->ID]['yesterday'][$Cam];
    }
    else{
         $yesterday = 0;
    }
    $sumyesterday+=$yesterday;
    $num_1=0;


    if(isset($subs_by_ids[$post->ID]['row_num'][1])){
        $num_1=$subs_by_ids[$post->ID]['row_num'][1];
        $sumnum1+=$num_1;
    }

    $num_2=0;
    if(isset($subs_by_ids[$post->ID]['row_num'][2])){
        $num_2=$subs_by_ids[$post->ID]['row_num'][2];
        $sumnum2+=$num_2;
    }
    $num_3=0;
                    if(isset($subs_by_ids[$post->ID]['row_num'][3])){
        $num_3=$subs_by_ids[$post->ID]['row_num'][3];
        $sumnum3+=$num_3;
    }
    $num_4=0;
    if(isset($subs_by_ids[$post->ID]['row_num'][4])){
        $num_4=$subs_by_ids[$post->ID]['row_num'][4];
        $sumnum4+=$num_4;
    }
    $num_5=0;
    if(isset($subs_by_ids[$post->ID]['row_num'][5])){
        $num_5=$subs_by_ids[$post->ID]['row_num'][5];
        $sumnum5+=$num_5;
    }
    $num_6=0;
    if(isset($subs_by_ids[$post->ID]['row_num'][6])){
        $num_6=$subs_by_ids[$post->ID]['row_num'][6];
        $sumnum6+=$num_6;
    }
    $num_7=0;
    if(isset($subs_by_ids[$post->ID]['row_num'][7])){
        $num_7=$subs_by_ids[$post->ID]['row_num'][7];
        $sumnum7+=$num_7;
    }

    //14column
    $author_id = get_post_field( 'post_author', $post->ID );
    $current_points=0;

    $current_points=get_user_meta($author_id, 'rewards', true);
    $sumcurrent+=$current_points;

    //12column
    $sumclick;
    if($Campaign == 1 || $Campaign == 0 || $Campaign == "")
     {

        $sumclick+=get_post_meta($post->ID, 'views', true);
     }else
     {
         $sumclick+=get_post_meta($post->ID, 'views_'.$Campaign, true);

     }
endwhile;


$i = 0;
while ( have_posts() ) : the_post(); $i++;?>
    <?php
    $pm_id_1 =  get_post_meta($post->ID, 'project_manager_1',true );
    $pm_id_2 =  get_post_meta($post->ID, 'project_manager_2',true );
    $pm_id_3 =  get_post_meta($post->ID, 'project_manager_3',true );
    $facebook_url =  trim(get_post_meta($post->ID, 'facebook_url',true ));

    if( $pm_id_1 == $user_ID || $pm_id_2 == $user_ID || $pm_id_3 == $user_ID)
    {?>
        <tr class="scrl_<?php echo $paged;?>">
        <?php
        $e_dt=get_field('study_end_date');
        $date = DateTime::createFromFormat('Ymd',$e_dt);

        $category_detail=get_the_category($post->ID);

        foreach($category_detail as $cd){
            $category_id = get_cat_ID( $cd->cat_name );
        }

        $custom_goal="";
        $exposure_level = get_post_meta($post->ID, 'exposure_level',true );
        $custom_goal = get_post_meta($post->ID, 'custom_goal',true );

        if($custom_goal==""){
            if($exposure_level == "Platinum")
            {
                $goal_total =  get_option('category_'.$category_id.'_platinum_goal');

            }elseif($exposure_level == "Gold")
            {
                $goal_total =   get_option('category_'.$category_id.'_gold_goal');

            }elseif($exposure_level == "Silver")
            {
                $goal_total =   get_option('category_'.$category_id.'_silver_goal');

            }elseif($exposure_level == "Bronze")
            {
                $goal_total =   get_option('category_'.$category_id.'_bronze_goal');

            }elseif($exposure_level == "Diamond")
            {
                $goal_total =   get_option('category_'.$category_id.'_diamond_goal');

            }
            else{$goal_total ="";}
        }
        else{
            $goal_total=$custom_goal;
        }

        $Campaign = get_post_meta($post->ID, 'renewed',true );
        if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
            if(isset($subs_by_ids[$post->ID][1])){
                $toal_counted=$subs_by_ids[$post->ID][1];
            }
            else{
                $toal_counted =  0;
            }
        }
        else{
            if(isset($subs_by_ids[$post->ID][$Campaign])){
                $toal_counted=$subs_by_ids[$post->ID][$Campaign];
            }
            else{
                $toal_counted =  0;
            }
        }
        $final_goal =  $goal_total/$toal_counted;
        $post_created_time = human_time_diff( get_the_time('U'), current_time('timestamp') );
        $post_created_time_remove_hours  = str_replace("hours","",$post_created_time);
        $s_dt=get_field('study_start_date');
        if($e_dt && $s_dt){
            $date2 = DateTime::createFromFormat('Ymd', $e_dt);
            $end_date = $date2->format('Y-m-d');
            $datetime1 = date_create(date('Y-m-d'));
            $datetime2 = date_create($end_date);
            $interval = date_diff($datetime1, $datetime2);
            $total_number_of_days = str_replace("+","", $interval->format('%R%a'));
            $datetime3 = date_create(get_the_time('Y-m-d',$post->ID));
            $datetime4 = date_create($end_date);
            $interval2 = date_diff($datetime3, $datetime4);
            $total_number_of_days2 = str_replace("+","", $interval2->format('%R%a'));
            $date_st = DateTime::createFromFormat('Ymd', $s_dt);
            $start_date = $date_st->format('Y-m-d');
            $fr_start_date = $date_st->format('Y-m-d');
            $datetimestart = date_create($start_date);
            $intervalstart = date_diff($datetimestart, $datetime4);
            $total_number_of_days_start = str_replace("+","", $intervalstart->format('%R%a'));
            $daysof_total=$total_number_of_days_start;
            $days_left = $daysof_total-$total_number_of_days;
            $aa = $goal_total/$daysof_total*$days_left;
            $final_result = number_format($toal_counted/$aa,2);
        }
        else{
            $daysof_total=0;
            $total_number_of_days=0;
            $days_left=0;
            $final_result=0;
            $fr_start_date ="n/a";
        }
        $post_link=post_permalink($post->ID);

        ?>
        <td  style="font-weight: bold; text-align: center; <?php if($days_left<=2){echo 'background:#873fbd;';}else{ if($final_result < .87){ echo 'background:#dd0000;';}?><?php if($final_result > 1.2){ echo 'background:#f9ce15;';}}?>">
            <?php
            $number = 25 + $i + (( get_query_var('paged') ? get_query_var('paged') : 1) - 2) * 25;
            if ($facebook_url) {
                echo "<a href='".$facebook_url."' target='_blank' style='color: #fff;'>".$number."</a>";
            } else {
                echo $number;
            }
            echo "<br />";
            ?>
            <a style="color:#fff;" href="<?php echo $post_link; ?>" target="_blank"><?php echo $study_no = get_post_meta($post->ID, 'study_no', true ); ?> </a><br /><span style="<?php if (($days_left>2) && ($final_result < .8)) { echo 'color: black;'; } else { echo 'color:#fff;'; } ?>">(<?php echo $final_result;?>)</span><br />Campaign: <?php if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){ echo '1'; }else{ echo $Campaign; } ?>

            <input type="hidden" name="sumtoday" id="sumtoday" value="<?php echo $sumtoday; ?>" />
            <input type="hidden" name="sumtotal" id="sumtotal" value="<?php echo $sumtoal; ?>" />
            <input type="hidden" name="sumyesterday" id="sumyesterday" value="<?php echo $sumyesterday; ?>" />
            <input type="hidden" name="sumnum1" id="sumnum1" value="<?php echo $sumnum1; ?>" />
            <input type="hidden" name="sumnum2" id="sumnum2" value="<?php echo $sumnum2; ?>" />
            <input type="hidden" name="sumnum3" id="sumnum3" value="<?php echo $sumnum3; ?>" />
            <input type="hidden" name="sumnum4" id="sumnum4" value="<?php echo $sumnum4; ?>" />
            <input type="hidden" name="sumnum5" id="sumnum5" value="<?php echo $sumnum5; ?>" />
            <input type="hidden" name="sumnum6" id="sumnum6" value="<?php echo $sumnum6; ?>" />
            <input type="hidden" name="sumnum7" id="sumnum7" value="<?php echo $sumnum7; ?>" />
            <input type="hidden" name="sumnum8" id="sumnum8" value="<?php echo $sumnum8; ?>" />
            <input type="hidden" name="sumcurrent" id="sumcurrent" value="<?php echo $sumcurrent; ?>" />


            <?php
            if ( get_post_status ($post->ID)=='private' ) {
                  echo "<br />";
                  echo "Inactive";
            } else {
                echo "<br />";
                  echo "Active";
            }
            $social_media_mn_id = $pm_id_1;
            $man_name="";
            if($social_media_mn_id !=""){
                $fnm=get_user_meta($social_media_mn_id, 'first_name', true);
                $lnm=get_user_meta($social_media_mn_id, 'last_name', true);
                $man_name=ucwords($fnm." ".$lnm);
            }

            $pr_manager_id = $pm_id_2;
            $pr_man_name="";
            if($pr_manager_id !=""){
                $fnm_pr=get_user_meta($pr_manager_id, 'first_name', true);
                $lnm_pr=get_user_meta($pr_manager_id, 'last_name', true);
                $pr_man_name=ucwords($fnm_pr." ".$lnm_pr);
            }
            ?>

            <?php
            if($man_name !=""){
                echo "<br />";
                echo $man_name;
            }
            ?>

            <?php
            if($pr_man_name !=""){
                echo "<br />";
                echo $pr_man_name;
            }
            ?>
        </td>

        <td class="acne_cls"><a href="<?php echo $post_link; ?>" target="_blank"><?php echo $study_name =  get_post_meta($post->ID, 'name_of_site',true ); ?></a>
            <?php $sponsor_name = get_post_meta($post->ID, 'sponsor_name',true );
            if($sponsor_name){
                echo '<p style="color:#959ca1;margin-bottom:0;">Sponsor: '.$sponsor_name.'</p>';
            }
            $protocol = get_post_meta($post->ID, 'protocol_no',true );
            if($protocol){
                echo '<p style="color:#959ca1; margin-bottom: 0px;">Protocol: '.$protocol.'</p>';
            }
            $cro_name = get_post_meta($post->ID, 'cro_name',true );
            if ($cro_name) {
                echo '<p style="color:#959ca1; margin:0;">CRO Name: '.$cro_name.'</p>';
            }
            
            ?>
            <?php 
                                $author_id = get_post_field( 'post_author', $post->ID );
                                if ($author_id) {
                                    echo '<p style="color:#959ca1; margin:0; word-wrap: break-word;">Username: ';
                                    the_author_meta( 'user_login' , $author_id );
                                    echo '</p>';

                                }
                                
                            ?>
        </td>
        <td  class="acne_cls"><?php
            foreach($category_detail as $cd){
                $draught_links =  $cd->cat_name. '<br />';

//$category_id = get_cat_ID( $cd->cat_name );

//echo join( ", ", $draught_links );
            }


            ?>
            <a href="<?php echo $post_link; ?>" target="_blank"><?php echo $draught_links; ?></a>
            <?php
            $tier="";
            $tier =  get_option('category_'.$category_id.'_tier');
            if($tier!=""){
                echo '<span>Tier <strong>'.$tier.'</strong></span>';
            }
            $vipst="";
            $vipst = get_post_meta($post->ID, 'vip_study',true );
            if($vipst!=""){
                echo '<p><strong>VIP</strong></p>';
            }
            ?>
        </td>
        <td class="acne_cls"><?php echo get_post_meta($post->ID, 'study_full_address',true ); ?></td>
        <td class="acne_cls"><?php echo $exposure_level; ?></td>
        <td class="acne_cls" id="to_td_<?php echo $post->ID;?>"><?php
            if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){
                $Cam=1;
            }
            else{
                $Cam=$Campaign;
            }
            if(isset($subs_by_ids[$post->ID]['today'][$Cam])){
                echo $today = $subs_by_ids[$post->ID]['today'][$Cam];
            }
            else{
                echo $today = 0;
            }
            ;?></td>
        <td class="acne_cls" id="yes_td_<?php echo $post->ID;?>"><?php

            if(isset($subs_by_ids[$post->ID]['yesterday'][$Cam])){
                echo $yesterday = $subs_by_ids[$post->ID]['yesterday'][$Cam];
            }
            else{
                echo $yesterday = 0;
            }
            ?></td>
        <td class="acne_cls" id="total_td_<?php echo $post->ID;?>"><?php echo $toal_counted; ?></td>
        <td class="acne_cls"><?php echo $goal_total;?></td>
        <td class="acne_cls">
            <?php
            if($fr_start_date !=""){
                echo 'Start Date: '.$fr_start_date; echo '<br/>';
            }
            echo 'Days: '.$daysof_total; echo '<br/>';
            echo 'Days Left: '.$total_number_of_days;  echo '<br/>';
            ?>
        </td>
        <td class="acne_cls"><?php
            if($e_dt)
            {
                $date = DateTime::createFromFormat('Ymd', $e_dt);
                echo $date->format('m/d');
            }else{
                echo '---';
            }
            ?>
        </td>
        <td class="acne_cls"><?php

            if($Campaign == 1 || $Campaign == 0 || $Campaign == "")
            {

                echo get_post_meta($post->ID, 'views', true);
            }else
            {
                echo get_post_meta($post->ID, 'views_'.$Campaign, true);

            }?>
        </td>

        <td class="acne_cls"><?php
            //$sub_results=$wpdb->get_results( "SELECT id,row_num FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID'");
            $num_1=0;
            if(isset($subs_by_ids[$post->ID]['row_num'][1])){
                $num_1=$subs_by_ids[$post->ID]['row_num'][1];
            }
            $num_2=0;
            if(isset($subs_by_ids[$post->ID]['row_num'][2])){
                $num_2=$subs_by_ids[$post->ID]['row_num'][2];
            }
            $num_3=0;
            if(isset($subs_by_ids[$post->ID]['row_num'][3])){
                $num_3=$subs_by_ids[$post->ID]['row_num'][3];
            }
            $num_4=0;
            if(isset($subs_by_ids[$post->ID]['row_num'][4])){
                $num_4=$subs_by_ids[$post->ID]['row_num'][4];
            }
            $num_5=0;
            if(isset($subs_by_ids[$post->ID]['row_num'][5])){
                $num_5=$subs_by_ids[$post->ID]['row_num'][5];
            }
            $num_6=0;
            if(isset($subs_by_ids[$post->ID]['row_num'][6])){
                $num_6=$subs_by_ids[$post->ID]['row_num'][6];
            }
            $num_7=0;
            if(isset($subs_by_ids[$post->ID]['row_num'][7])){
                $num_7=$subs_by_ids[$post->ID]['row_num'][7];
            }
            //if(!empty($sub_results)){
            //  foreach($sub_results as $res ) {
            //      $num = $res->row_num;
            //      if($num==1){
            //          $num_1=$num_1+1;
            //      }
            //      else if($num==2){
            //          $num_2=$num_2+1;
            //      }
            //      else if($num==3){
            //          $num_3=$num_3+1;
            //      }
            //      else if($num==4){
            //          $num_4=$num_4+1;
            //      }
            //      else if($num==5){
            //          $num_5=$num_5+1;
            //      }
            //      else if($num==6){
            //          $num_6=$num_6+1;
            //      }
            //      else if($num==7){
            //          $num_7=$num_7+1;
            //      }
            //  }
            //}
            echo $rto = $num_1+$num_2+$num_3+$num_4+$num_5+$num_6+$num_7;?></td>
        <td class="acne_cls">
            <?php $author_id = get_post_field( 'post_author', $post->ID );
            //$user_ID = get_current_user_id();
            ?>
            <a pst_id="<?php echo $author_id ;?>" class="rew_link" href="javascript://void(0);"><?php
                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '3'");
                echo $current_points=get_user_meta($author_id, 'rewards', true);?></a>
        </td>
        <td class="acne_cls"><?php
            //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '1'");
            echo $num_1;?></td>
        <td class="acne_cls"><?php
            //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '2'");
            echo $num_2;?></td>
        <td class="acne_cls"><a pst_id="<?php echo $post->ID;?>" class="dnq_link" href="javascript://void(0);"><?php
                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '3'");
                echo $num_3;?></a></td>
        <td class="acne_cls"><a pst_id="<?php echo $post->ID;?>" class="action_link" href="javascript://void(0);"><?php
                //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '3'");
                echo $num_7;?></a></td>
        <td class="acne_cls"><?php
            //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '4'");
            echo $num_4;?></td>
        <td class="acne_cls"><?php
            //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '5'");
            echo $num_5;?></td>
        <td class="acne_cls"><?php
            //$wpdb->get_results( "SELECT * FROM 0gf1ba_subscriber_list WHERE post_id = '$post->ID' and row_num = '6'");
            echo $num_6;?></td>
        <td class="acne_cls"><?php //$post_author_id = get_post_field( 'post_author', $post->ID ); //echo get_last_login($post_author_id);?> <?php
            $last_login =    get_user_meta($post->post_author, 'last_login', true);
            $last_login = date("Y-m-d H:i:s", strtotime($last_login . " - 4 hours"));
            $date_format = get_option('date_format') . ' ' . get_option('time_format');
            $the_last_login = mysql2date($date_format, $last_login, false);
            echo $the_last_login; ?></td>
        <td class="acne_cls" style="visibility:none;width:150px !important;"><?php echo $study_name;
            if($sponsor_name){
                echo '<p style="color:#959ca1;margin-bottom:0px;">Sponsor: '.$sponsor_name.'</p>';
            }
            if($protocol){
                echo '<p style="color:#959ca1;">Protocol: '.$protocol.'</p>';
            } ?></td>
        <td class="acne_cls" style="visibility:none;width:150px !important;"><a href="<?php the_permalink(); ?>" target="_blank"><?php echo $draught_links; ?></a>
            <?php

            if($tier!=""){
                echo '<span>Tier <strong>'.$tier.'</strong></span>';
            }
            if($vipst!=""){
                echo '<p><strong>VIP</strong></p>';
            }
            ?></td>
        <td class="acne_cls" style="visibility:none;width:140px !important;">
            <a style="color:#fff;" href="<?php echo $post_link; ?>" target="_blank"><?php echo $study_no = get_post_meta($post->ID, 'study_no', true ); ?> </a><br /> (<?php echo $final_result;?>)<br />Campaign: <?php if($Campaign == 1 || $Campaign == 0 || $Campaign == ""){ echo '1'; }else{ echo $Campaign; } ?>
            <?php
            $social_media_mn_id = $pm_id_1;
            $man_name="";
            if($social_media_mn_id !=""){
                $fnm=get_user_meta($social_media_mn_id, 'first_name', true);
                $lnm=get_user_meta($social_media_mn_id, 'last_name', true);
                $man_name=ucwords($fnm." ".$lnm);
            }

            $pr_manager_id = $pm_id_2;
            $pr_man_name="";
            if($pr_manager_id !=""){
                $fnm_pr=get_user_meta($pr_manager_id, 'first_name', true);
                $lnm_pr=get_user_meta($pr_manager_id, 'last_name', true);
                $pr_man_name=ucwords($fnm_pr." ".$lnm_pr);
            }
            ?>

            <?php
            if($man_name !=""){
                echo "<br />";
                echo $man_name;
            }
            ?>

            <?php
            if($pr_man_name !=""){
                echo "<br />";
                echo $pr_man_name;
            }
            ?>

        </td>
        </tr>

    <?php }   ?>
<?php endwhile;  ?>