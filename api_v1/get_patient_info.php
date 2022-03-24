<?php
require_once "config.php";
if (! pc_validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Suvoda API"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
}else{

    if (isset($_POST["guid"]) && $_POST['guid']) {
        $result = getPatientInfo( (isset($_POST["phone"]) && $_POST['phone'])?editPhoneNumber($_POST['phone']):null,
    		isset($_POST['study_id'])?$_POST['study_id']:null,$_POST['guid']
    	);
        echo json_encode($result);
    } elseif (isset($_POST["phone"]) && $_POST['phone']) {
        $result = getPatientInfo(editPhoneNumber($_POST['phone']),
    		isset($_POST['study_id'])?$_POST['study_id']:null
    	);
        echo json_encode($result);
    }else{
	$result = array('result' => 'error', 'message' => 'Nor phone nor guid are passed. Either one needs to be passed to perform this operation.');
        echo json_encode($result);    
    }
}

function getPatientInfo($phone, $study_id = null, $guid = null){
    $result = array();
    
    $sql_select = 'SELECT s.*, p.id as post_id, p.post_title, t.meta_value AS meta_protocol, m.meta_value, g.guid AS guid';
    
    if($guid){
	    $sql_from = 'FROM 0gf1ba_subscriber_list as s JOIN 0gf1ba_posts as p ON (p.id = s.post_id) JOIN 0gf1ba_postmeta as m ON (s.post_id = m.post_id AND m.meta_key = \'suvoda_protocol_id\') INNER JOIN 0gf1ba_postmeta as t ON (s.post_id = t.post_id AND t.meta_key = \'protocol_no\') INNER JOIN 0gf1ba_api_patient_guids AS g ON (g.subscriber_id = s.id AND g.study_post_id = s.post_id)';
        $sql_where = 'WHERE g.guid = \''.mysql_real_escape_string($guid).'\'' . ($phone?'  s.clear_phone = \''.mysql_real_escape_string($phone).'\'' : '');
    }else{
        $sql_from = 'FROM 0gf1ba_subscriber_list as s JOIN 0gf1ba_posts as p ON (p.id = s.post_id) JOIN 0gf1ba_postmeta as m ON (s.post_id = m.post_id AND m.meta_key = \'suvoda_protocol_id\') INNER JOIN 0gf1ba_postmeta as t ON (s.post_id = t.post_id AND t.meta_key = \'protocol_no\') LEFT JOIN 0gf1ba_api_patient_guids AS g ON (g.subscriber_id = s.id AND g.study_post_id = s.post_id)';
        $sql_where = 'WHERE (s.clear_phone = \''.mysql_real_escape_string($phone).'\') OR (s.phone = \''.mysql_real_escape_string($phone).'\' AND s.clear_phone = \'\')';
    }

    if ($study_id) { $sql_where .= ' AND m.meta_value = \''.mysql_real_escape_string($study_id).'\''; }
    $sql = $sql_select . ' ' . $sql_from . ' ' . $sql_where;

//    echo $sql;

    if(!$guid && $phone){
        // add search for phone number, which could be used in past by patient
        $sql_from_past_ph = $sql_from . ' INNER JOIN 0gf1ba_subscriber_list_phone_old AS po ON (po.subscriber_id = s.id AND po.post_id = s.post_id AND po.phone = \''.mysql_real_escape_string($phone).'\')';
        $sql_select_past_ph = $sql_select . ', po.phone AS old_phone, po.when_changed AS old_phone_changed_from';

        $sql = $sql_select . ', NULL AS old_phone, NULL AS old_phone_changed_from ' . $sql_from . ' ' . $sql_where;
        $sql = '(' . $sql . ') UNION (' . $sql_select_past_ph . ' ' . $sql_from_past_ph . 
        ($study_id ? ' WHERE m.meta_value = \''.mysql_real_escape_string($study_id).'\'' : '' ) .  ')';
    }
    $sql_result = mysql_query($sql);

    if ($sql_result){
        if (mysql_num_rows($sql_result)==0){
            $result['result'] = 'error';
            $result['message'] = 'Phone number not found.';
        }else if(mysql_num_rows($sql_result) > 0){
            while ($row = mysql_fetch_assoc($sql_result)) {
                $token = createToken($row['id'], $row['post_id']);
                $now = new DateTime('now', new DateTimeZone('UTC'));
                $expires_dt = new DateTime('now', new DateTimeZone('UTC'));
                $minutes_to_add = 15;
                $expires_dt->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                $sql = 'INSERT INTO 0gf1ba_api_tokens (patient_id, research_id, create_dt, expire_dt, value)'
                    .' VALUES ('
                    .' \''.mysql_real_escape_string($row['id']).'\', '
                    .' \''.mysql_real_escape_string($row['post_id']).'\', '
                    .' \''.$now->format('Y-m-d H:i:s').'\', '
                    .' \''.$expires_dt->format('Y-m-d H:i:s').'\', '
                    .' \''.mysql_real_escape_string($token).'\' '
                    .');';
                mysql_query($sql);


                $result['result'] = 'success';
                
                if(!is_null($row['guid'])){
            	    $guid = $row['guid'];
                }else{
            	    $guid = createGuid($row['id'],0,32);
            	    $sql = 'INSERT INTO 0gf1ba_api_patient_guids (subscriber_id, study_post_id, guid) VALUES (\''.mysql_real_escape_string($row['id']).'\',\''.mysql_real_escape_string($row['post_id']).'\',\''.mysql_real_escape_string($guid).'\');';
            	    mysql_query($sql);
                }

                $datum = array(
                    'studyid' => $row['meta_value'],
                    'protocolid' => $row['meta_protocol'],
                    'token' => $token,
                    'phone' => $row['phone'],
                    'phoneNumberMatchType' => (isset($row['old_phone']) && !is_null($row['old_phone'])) ? 'used_in_past' : 'currently_used',
                    'research' => $row['post_title'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'guid' => $guid
                );

                $result['data'][] = $datum;
            }
        }

        mysql_free_result($sql_result);
    }else{
        $result['result'] = 'error';
        $result['message'] = 'Phone number not found.';
    }
    return $result;
}

function editPhoneNumber($phone){

    $edited_phone = preg_replace("/[^0-9]+/", '', $phone);
    if (strlen($edited_phone) == 11 && substr($edited_phone,0,1) == '1'){
        $edited_phone = substr($edited_phone, 1);
    }
    return $edited_phone;
}

function createToken($patient_id, $research_id, $length = 10){

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $token = '';
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, $charactersLength - 1)];
    }

    if ( (! isUniqueToken($token, $patient_id, $research_id)) ) {
        $token = createToken($patient_id, $research_id, $length);
    }

    return $token;

}

function isUniqueToken($token, $patient_id, $research_id){
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $sql = 'SELECT * FROM 0gf1ba_api_tokens WHERE '
            .' patient_id = \''.mysql_real_escape_string($patient_id).'\' '
            .' AND research_id = \''.mysql_real_escape_string($research_id).'\' '
            .' AND value = \''.mysql_real_escape_string($token).'\' '
            .' AND expire_dt > \''.$now->format('Y-m-d H:i:s').'\' ';
    $sql_result = mysql_query($sql);
    $_case = (mysql_num_rows($sql_result)==0);
    mysql_free_result($sql_result);
    if ($_case){
        return true;
    }else{
        return false;
    }
}


$__created_guids = array();
function createGuid($patient_id, $research_id, $length = 32){

    global $__created_guids;

    if(isset($__created_guids[$patient_id])) { return $__created_guids[$patient_id]; }

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!ABCDEFGHIJK$LMNOP|QRST;\":UVWXYZ';
    $charactersLength = strlen($characters);
    $token = '';
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, $charactersLength - 1)];
    }

    if ( (! isUniqueGuid($token, $patient_id, $research_id)) ) {
        $token = createGuid($patient_id, $research_id, $length);
    }

    $__created_guids[$patient_id] = $token;

    return $token;

}

function isUniqueGuid($token, $patient_id, $research_id){
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $sql = 'SELECT * FROM 0gf1ba_api_patient_guids WHERE '
            .' guid = \''.mysql_real_escape_string($token).'\' LIMIT 1;';
    $sql_result = mysql_query($sql);
    $_case = (mysql_num_rows($sql_result)==0);
    mysql_free_result($sql_result);
    if ($_case){
        return true;
    }else{
        return false;
    }
}
