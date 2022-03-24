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
    if (isset($_POST["patient_token"]) && $_POST['patient_token'] && isset($_POST["status"]) && $_POST['status'] )
    {
        $result = updatePatientStatus($_POST["patient_token"], $_POST["status"]);

        echo json_encode($result);
    }
}

function updatePatientStatus($patient_token, $status){
    $result = array();

    $token_info = getTokenInfoIfValid($patient_token);
    if (!$token_info){
        $result['result'] = 'error';
        $result['message'] = 'Invalid token.';
        return $result;
    }

    $status_row_number = getStatusRowNumber($status);
    if (!$status_row_number){
        $result['result'] = 'error';
        $result['message'] = 'Invalid status.';
        return $result;
    }

    $sql = 'SELECT row_num FROM 0gf1ba_subscriber_list WHERE id = \''.mysql_escape_string($token_info['patient_id']).'\' AND post_id = \''.mysql_escape_string($token_info['research_id']).'\';';
    $before_update_patient_info = mysql_fetch_assoc(mysql_query($sql));
    if ($before_update_patient_info['row_num'] == 6 && $status_row_number != 6){ //Randomized
        $date = date('Y-m-d H:i:s',strtotime('-5 hours'));
        $sql = 'INSERT INTO `0gf1ba_client_notes`(`id`, `note_id`, `notes`, `notes_date`) VALUES (NULL,\''.mysql_escape_string($token_info['patient_id']).'\',\'Early termination\',\''.mysql_escape_string($date).'\')';
        mysql_query($sql);
    }
    $sql = 'UPDATE 0gf1ba_subscriber_list SET row_num = \''.mysql_escape_string($status_row_number).'\' WHERE id = \''.mysql_escape_string($token_info['patient_id']).'\' AND post_id = \''.mysql_escape_string($token_info['research_id']).'\';';
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

function getStatusRowNumber($status){
    switch ($status){
        case 'screen_fail':
            return 8;
            break;
        case 'randomization':
            return 6;
            break;
        case 'consented':
        case 'screening':
            return 5;
            break;
        default:
            return false;
            break;
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