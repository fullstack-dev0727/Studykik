<?php
//define('MEMCACHE_HOST',      'prod.xuffhd.cfg.use1.cache.amazonaws.com');
$memcache_host = 'prod.xuffhd.cfg.use1.cache.amazonaws.com';
$memcache_port = 11211;

$post_id = isset($_GET['post_id'])?$_GET['post_id']:NULL;
$author_id = isset($_GET['author_id'])?$_GET['author_id']:NULL;
$curl_url = isset($_GET['curl_url'])?$_GET['curl_url']:NULL;

$arr = array();
if ($post_id && $author_id && $curl_url){
    $memcache = new Memcache;
    $is_memcache_connected = $memcache->connect($memcache_host, $memcache_port);
    if ($is_memcache_connected){
        $unread_messages = $memcache->get('unread_messages_'.$post_id);
        $credits = $memcache->get('callfir_credits_'.$author_id);
        if (false /* $unread_messages && $credits !== false*/){
            $arr['messages'] = $unread_messages;
            $arr['callfir_credits'] = $credits;
        }else{
            $fullUrl = $curl_url.'/wp-admin/admin-ajax.php?action=get_unread_messages&post_id='.$post_id;
            $http = curl_init();
            curl_setopt($http, CURLOPT_URL, $fullUrl);
            curl_setopt($http, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($http);
            if (substr($json, -1) === '0'){
                $json = substr($json, 0, (strlen($json)-1));
            }
            $curl_result = json_decode($json);
            if ($curl_result){
                if (isset($curl_result->messages)){
                    $memcache->set('unread_messages_'.$post_id, $curl_result->messages, false, 3600);
                    $arr['messages'] = $curl_result->messages;
                }
                if (isset($curl_result->callfir_credits)){
                    $memcache->set('callfir_credits_'.$author_id, $curl_result->callfir_credits, false, 3600);
                    $arr['callfir_credits'] = $curl_result->callfir_credits;
                }
            }
        }
    }
}

echo json_encode($arr);

