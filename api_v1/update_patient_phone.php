<?php
require_once "config.php";
header('Content-Type: application/json');
if (! pc_validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Suvoda API"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
}else{
    //$_POST['patient_token'] = 'NyD6uOU67n';
    //$_POST['status'] = 'randomization';
    //$_POST['status'] = 'screen_fail';
    addRequestLog();
    if (isset($_POST["patient_token"]) && $_POST['patient_token'] && isset($_POST["phone"]) && $_POST['phone'] )
    {
        $result = updatePatientStatus($_POST["patient_token"], $_POST["phone"]);

        echo json_encode($result);
    }
}

function updatePatientStatus($patient_token, $phone){
    $result = array();

    $token_info = getTokenInfoIfValid($patient_token);
    if (!$token_info){
        $result['result'] = 'error';
        $result['message'] = 'Invalid token.';
        return $result;
    }

    $clear_phone=editPhoneNumber($phone);

    $id = $token_info['patient_id'];
    $mysql_result = mysql_query('SELECT * FROM 0gf1ba_subscriber_list ' . "WHERE id='$id' LIMIT 1");
    $row = mysql_fetch_assoc($mysql_result);
    mysql_free_result($mysql_result);
    if($row){
        if($row['clear_phone']!=$clear_phone){ // log phone number has been changed
            $sql = 'INSERT INTO 0gf1ba_subscriber_list_phone_old (subscriber_id, post_id, phone, when_changed) VALUES (\'' . mysql_real_escape_string($id) . '\',\'' . mysql_real_escape_string($row['post_id']) . '\', \'' . mysql_real_escape_string(editPhoneNumber($row['phone'])) . '\', NOW());';
            mysql_query($sql);
        }
    }

    $sql = 'UPDATE 0gf1ba_subscriber_list SET phone = \''.mysql_escape_string($phone).'\', clear_phone=\''.mysql_escape_string(editPhoneNumber($phone)).'\' WHERE id = \''.mysql_escape_string($token_info['patient_id']).'\' AND post_id = \''.mysql_real_escape_string($token_info['research_id']).'\';';
    mysql_query($sql);

    $result['result'] = 'success';
    return $result;
}

function getTokenInfoIfValid($token){
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $sql = 'SELECT * FROM 0gf1ba_api_tokens WHERE '
        .' value = \''.mysql_escape_string($token).'\' '
        .' AND expire_dt > \''.$now->format('Y-m-d H:i:s').'\' ';
    $sql_result = mysql_query($sql);

    if (mysql_num_rows($sql_result)==0){
        return false;
    }else{
        return mysql_fetch_assoc($sql_result);
    }
}


function addRequestLog(){
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $sql = 'INSERT INTO 0gf1ba_api_request_log (post_info, get_info, request, date)'
        .' VALUES ('
        .' \''.mysql_escape_string(serialize($_POST)).'\', '
        .' \''.mysql_escape_string(serialize($_GET)).'\', '
        .' \''.mysql_escape_string(serialize($_REQUEST)).'\', '
        .' \''.$now->format('Y-m-d H:i:s').'\' '
        .');';
    mysql_query($sql);
}


function editPhoneNumber($phone){
    $edited_phone = preg_replace("/[^0-9]+/", '', $phone);
    if (strlen($edited_phone) == 11 && substr($edited_phone,0,1) == '1'){
        $edited_phone = substr($edited_phone, 1);
    }
    return $edited_phone;
}