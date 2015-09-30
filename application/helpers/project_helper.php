<?php
// decode json并获取某一个key
function json_decode_and_get_key($json_str, $key)
{
    $json_array = json_decode($json_str, true);
    return $json_array[$key];
}

//  二维数据中每个指定元素jsondecond
function json_decode_for_key($array, $for_key)
{
    $array_return = [];
    foreach ($array as $key => $value) {
        $value[$for_key] = json_decode($value[$for_key], true);
        $array_return[$key] = $value;
    }
    return $array_return;
}

// 对ueditor提交的内容进行过滤，以方便手机使用
function content_filter($html_str)
{
    // 去掉默认的table和td宽度
    $html_str = str_replace("<table width=\"960\">", "<table width=\"100%\">", $html_str);
    $html_str = str_replace("<td width=\"299\"", "<td", $html_str);
    // 重新设置标题下划线的颜色
    $html_str = str_replace("border-bottom-color:#cccccc", "border-bottom-color:#2A75D0", $html_str);
    // 去掉img标签的长度、宽度
    $html_str = preg_replace("/width=\"\d*\"/i", '', $html_str, -1);
    $html_str = preg_replace("/height=\"\d*\"/i", '', $html_str, -1);
    $html_str = preg_replace("/width:\d*px;/i", '', $html_str, -1);
    $html_str = preg_replace("/height:\d*px;/i", '', $html_str, -1);
    $html_str = str_replace("font-size:32px;", "font-size:16px;", $html_str);

    return $html_str;
}

// province list
function print_province_select_list()
{
    $plist = config_item('province_list');
    foreach ($plist as $key => $value) {
        echo "<option value='$value'>$value</option>";
    }
    return;
}

function year_list()
{
    $array_return = [];
    $array_return[] = date('Y', strtotime("+1 year"));
    for ($i = 0; $i < 10; $i++) {
        $year = date('Y', strtotime("-$i year"));
        $array_return[] = $year;
    }
    return $array_return;
}

function get_url_from_weibo_text($text)
{
    //preg_replace('/@[\x80-\xff\w]+ /','',$str);
    preg_match_all('/http:\/\/t.cn\/\w{7}/i', $text, $arr);
    return isset($arr[0][0]) ? $arr[0][0] : false;
}

function get_title_from_html($text)
{
    preg_match_all('/<title>(.*)<\/title>/isU', $text, $arr);
    return isset($arr[1][0]) ? $arr[1][0] : false;
}

function clear_weibo_text($text)
{
    if (count(trim($text)) == 0) {
        return false;
    }
    $text = preg_replace('/@[\x80-\xff\w]+/', '', $text);
    $text = preg_replace('/http:\/\/t.cn\/\w{7}/isU', '', $text);
    return $text;
}

function clear_weibo_url_content($text)
{
    if (count(trim($text)) == 0) {
        return false;
    }
    $text = preg_replace('/<div.*?id="controlbar_container"/i',
        '<div id="controlbar_container" style="display:none;"', $text);
    $text = preg_replace('/<div.*?id="footer"/i',
        '<div id="footer" style="display:none;"', $text);
    return $text;
}

function get_real_url_301_redirect($url)
{
    $header = get_headers($url, 1);
    if (strpos($header[0], '301') || strpos($header[0], '302')) {
        if (is_array($header['Location'])) {
            return $header['Location'][count($header['Location']) - 1];
        } else {
            return $header['Location'];
        }
    } else {
        return $url;
    }
}

function delete_file($file_path)
{
    if (file_exists($file_path)) {
        unlink($file_path);
    }
}

function get_from_gongzhong_id($gongzhong_id)
{
    $from = GZ_OTHER;
    switch ($gongzhong_id) {
        case WXID_WODI:
            $from = GZ_WODI;
            break;
        case WXID_ZHUOYOU:
            $from = GZ_ZHUOYOU;
            break;
        case WXID_TEST:
            $from = GZ_TEST;
            break;
        case WXID_YY:
            $from = GZ_YY;
            break;
        default:
            break;
    }
    return $from;
}

function get_access_token($appid, $secret)
{
    $TOKEN_URL = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $secret;
    $json = file_get_contents($TOKEN_URL);
    $result = json_decode($json, true);
    $ACC_TOKEN = $result['access_token'];
    return $ACC_TOKEN;
}

function post_tab($access_token, $data)
{
    $MENU_URL = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $MENU_URL);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $info = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Errno' . curl_error($ch);
    }
    curl_close($ch);
    return $info;
}

function post_qrcode($access_token, $data)
{
    $MENU_URL = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=" . $access_token;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $MENU_URL);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $info = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Errno' . curl_error($ch);
    }
    curl_close($ch);
    return $info;
}


function check_post_obj($post_obj)
{
    if (!$post_obj) {
        my_error_log(__METHOD__, "Post_obj is null!", $post_obj);
        return false;
    }
    if (!property_exists($post_obj, 'FromUserName') || strlen(trim((string)$post_obj->FromUserName)) <= 0) {
        my_error_log(__METHOD__, "Wx_userid doesnt exist or is illegal!", $post_obj);
        return false;
    }
    if (!property_exists($post_obj, 'MsgType') || strlen(trim((string)$post_obj->MsgType)) <= 0) {
        my_error_log(__METHOD__, "MsgType doesnt exist! or is illegal", $post_obj);
        return false;
    }
    if (!property_exists($post_obj, 'ToUserName') || strlen(trim((string)$post_obj->ToUserName)) <= 0) {
        my_error_log(__METHOD__, "Gz_id doesnt exist or is illegal!", $post_obj);
        return false;
    }
    return true;
}

function check_user_info($user_info)
{
    if (!array_key_exists('wx_userid', $user_info) || strlen($user_info['wx_userid']) < 5) {
        return false;
    }
    if (!array_key_exists('gender', $user_info)) {
        return false;
    }
    if (!array_key_exists('gz_id', $user_info)) {
        return false;
    }
    if (!array_key_exists('last_chat_friend', $user_info)) {
        return false;
    }
    if (!array_key_exists('blacklist', $user_info)) {
        return false;
    }
    return true;
}

function unset_user_info_old_field(&$user_info, $field)
{
    if (array_key_exists($field, $user_info)) {
        unset($user_info[$field]);
    }
}

function check_repeat_msg($msg_id, $last_msg_id)
{
    if ($last_msg_id && $msg_id == $last_msg_id) {
        dump_log("check_repeat_msg, msg is repeat", $msg_id, $last_msg_id);
        return true;
    }
    return false;
}

function create_chat_id($wx_userid, $target_id, $start_time)
{
    $chat_id = $wx_userid . ':' . $target_id . ':' . $start_time;
    return $chat_id;
}

function create_chat_data($using_chat_count, $using_chat_user_count, $chat_msg_count, $valid_chat_count, $valid_chat_user_count, $couple_count)
{
    return array(
        "date" => date("Y.m.d"),
        "using_chat_count" => $using_chat_count,
        "using_chat_user_count" => $using_chat_user_count,
        "chat_msg_count" => $chat_msg_count,
        "valid_chat_count" => $valid_chat_count,
        "valid_chat_user_count" => $valid_chat_user_count,
        "couple_count" => $couple_count
    );
}

function create_chat_res_news($title, $description, $url, $pic_url)
{
    return array(
        'title' => $title,
        'description' => $description,
        'url' => $url,
        'picurl' => $pic_url
    );
}

function my_redirect($uri = '', $method = 'location', $http_response_code = 302)
{
    switch ($method) {
        case 'refresh'    :
            header("Refresh:0;url=" . $uri);
            break;
        default            :
            header("Location: " . $uri, TRUE, $http_response_code);
            break;
    }
    exit;
}

/**
 * 获取随机字符串
 * @return string 不长于32位
 */

function get_random_str()
{
    return substr(rand(10, 999) . strrev(uniqid()), 0, 15);
}

function to_object($post_data)
{
    if (!empty($post_data)) {
        $postObj = simplexml_load_string($post_data, 'SimpleXMLElement', LIBXML_NOCDATA);
        return $postObj;
    }
    return null;
}

function get_box_count($cash_fee)
{
    switch ($cash_fee) {
        case WXPAY_1_BOX_PRICE:
            return 1;
        case WXPAY_4_BOX_PRICE:
            return 4;
        case WXPAY_20_BOX_PRICE:
            return 20;
        default:
            return 0;
    }
}

function chat_profile_form_validation($chat_user_profile)
{
    if (!$chat_user_profile["location"]) {
        my_error_log(__METHOD__, "Location is missing!", $chat_user_profile);
        return false;
    }
    if (!$chat_user_profile["gender"]) {
        my_error_log(__METHOD__, "Gender is missing!", $chat_user_profile);
        return false;
    }
    if ($chat_user_profile["gender"] != GENDER_FEMALE && $chat_user_profile["gender"] != GENDER_MALE) {
        my_error_log(__METHOD__, "Gender is invalid!", $chat_user_profile);
        return false;
    }
    if (!$chat_user_profile["status"]) {
        my_error_log(__METHOD__, "Status is missing!", $chat_user_profile);
        return false;
    }
    if (!$chat_user_profile["wx_userid"] || strlen($chat_user_profile["wx_userid"]) < 5) {
        my_error_log(__METHOD__, "Chat_openid is missing!", $chat_user_profile);
        return false;
    }
    if (!$chat_user_profile["gz_id"] || strlen($chat_user_profile["gz_id"]) < 5) {
        my_error_log(__METHOD__, "Gz_id is missing!", $chat_user_profile);
        return false;
    }
    if (isset($chat_user_profile["dating_declaration"]) && strlen($chat_user_profile["dating_declaration"]) > 100) {
        my_error_log(__METHOD__, "Dating_declaration's length exceeded!", $chat_user_profile);
        return false;
    }
    return true;
}

function get_extension_by_mimetype($mimetype)
{
    switch ($mimetype) {
        case "audio/amr":
            return "amr";
        case "audio/mp3":
            return "mp3";
        case "audio/x-speex-with-header-byte":
            dump_log(__METHOD__, "Voice Format is speex.");
            return "speex";
        default:
            return false;
    }
}

function get_mimetype_by_extension($extension)
{
    switch ($extension) {
        case "amr":
            return "audio/amr";
        case "mp3":
            return "audio/mp3";
        case "speex":
            return "audio/x-speex-with-header-byte";
        default:
            return false;
    }
}

function generate_wx_menu_list($wx_menu_one_arr, $wx_menu_two_arr, $wx_menu_three_arr)
{
    $wx_menu_list = [];
    if (array_key_exists("sub_button", $wx_menu_one_arr)) {
        for ($i = 1; $i <= 5; $i++) {
            $wx_menu_list[$i]["wxMenuId"] = "1." . $i;
            $wx_menu_list[$i]["wxMenuName"] = $wx_menu_one_arr["sub_button"][$i - 1]["name"];
            $wx_menu_list[$i]["wxMenuType"] = $wx_menu_one_arr["sub_button"][$i - 1]["type"];
            switch ($wx_menu_list[$i]["wxMenuType"]) {
                case "click":
                    $wx_menu_list[$i]["wxMenuKeyOrUrl"] = $wx_menu_one_arr["sub_button"][$i - 1]["key"];
                    break;
                case "view":
                    $wx_menu_list[$i]["wxMenuKeyOrUrl"] = $wx_menu_one_arr["sub_button"][$i - 1]["url"];
                    break;
                default:
                    $wx_menu_list[$i]["wxMenuKeyOrUrl"] = "";
                    break;
            }
        }
        $wx_menu_list[16]["wxMenuId"] = "1";
        $wx_menu_list[16]["wxMenuName"] = $wx_menu_one_arr["name"];
        $wx_menu_list[16]["wxMenuType"] = "sub";
        $wx_menu_list[16]["wxMenuKeyOrUrl"] = "";
    } else {
        for ($i = 1; $i <= 5; $i++) {
            $wx_menu_list[$i]["wxMenuId"] = "1." . $i;
            $wx_menu_list[$i]["wxMenuName"] = "";
            $wx_menu_list[$i]["wxMenuType"] = "";
            $wx_menu_list[$i]["wxMenuKeyOrUrl"] = "";
        }
        $wx_menu_list[16]["wxMenuId"] = "1";
        $wx_menu_list[16]["wxMenuName"] = $wx_menu_one_arr["name"];
        $wx_menu_list[16]["wxMenuType"] = $wx_menu_one_arr["type"];
        switch ($wx_menu_list[16]["wxMenuType"]) {
            case "click":
                $wx_menu_list[16]["wxMenuKeyOrUrl"] = $wx_menu_one_arr["key"];
                break;
            case "view":
                $wx_menu_list[16]["wxMenuKeyOrUrl"] = $wx_menu_one_arr["url"];
                break;
            default:
                $wx_menu_list[16]["wxMenuKeyOrUrl"] = "";
                break;
        }
    }
    if (array_key_exists("sub_button", $wx_menu_two_arr)) {
        for ($i = 1; $i <= 5; $i++) {
            $wx_menu_list[$i + 5]["wxMenuId"] = "2." . $i;
            $wx_menu_list[$i + 5]["wxMenuName"] = $wx_menu_two_arr["sub_button"][$i - 1]["name"];
            $wx_menu_list[$i + 5]["wxMenuType"] = $wx_menu_two_arr["sub_button"][$i - 1]["type"];
            switch ($wx_menu_list[$i + 5]["wxMenuType"]) {
                case "click":
                    $wx_menu_list[$i + 5]["wxMenuKeyOrUrl"] = $wx_menu_two_arr["sub_button"][$i - 1]["key"];
                    break;
                case "view":
                    $wx_menu_list[$i + 5]["wxMenuKeyOrUrl"] = $wx_menu_two_arr["sub_button"][$i - 1]["url"];
                    break;
                default:
                    $wx_menu_list[$i + 5]["wxMenuKeyOrUrl"] = "";
                    break;
            }
        }
        $wx_menu_list[17]["wxMenuId"] = "2";
        $wx_menu_list[17]["wxMenuName"] = $wx_menu_two_arr["name"];
        $wx_menu_list[17]["wxMenuType"] = "sub";
        $wx_menu_list[17]["wxMenuKeyOrUrl"] = "";
    } else {
        for ($i = 1; $i <= 5; $i++) {
            $wx_menu_list[$i + 5]["wxMenuId"] = "2." . $i;
            $wx_menu_list[$i + 5]["wxMenuName"] = "";
            $wx_menu_list[$i + 5]["wxMenuType"] = "";
            $wx_menu_list[$i + 5]["wxMenuKeyOrUrl"] = "";
        }
        $wx_menu_list[17]["wxMenuId"] = "2";
        $wx_menu_list[17]["wxMenuName"] = $wx_menu_two_arr["name"];
        $wx_menu_list[17]["wxMenuType"] = $wx_menu_two_arr["type"];
        switch ($wx_menu_list[17]["wxMenuType"]) {
            case "click":
                $wx_menu_list[17]["wxMenuKeyOrUrl"] = $wx_menu_two_arr["key"];
                break;
            case "view":
                $wx_menu_list[17]["wxMenuKeyOrUrl"] = $wx_menu_two_arr["url"];
                break;
            default:
                $wx_menu_list[17]["wxMenuKeyOrUrl"] = "";
                break;
        }
    }
    if (array_key_exists("sub_button", $wx_menu_three_arr)) {
        for ($i = 1; $i <= 5; $i++) {
            $wx_menu_list[$i + 10]["wxMenuId"] = "3." . $i;
            $wx_menu_list[$i + 10]["wxMenuName"] = $wx_menu_three_arr["sub_button"][$i - 1]["name"];
            $wx_menu_list[$i + 10]["wxMenuType"] = $wx_menu_three_arr["sub_button"][$i - 1]["type"];
            switch ($wx_menu_list[$i + 10]["wxMenuType"]) {
                case "click":
                    $wx_menu_list[$i + 10]["wxMenuKeyOrUrl"] = $wx_menu_three_arr["sub_button"][$i - 1]["key"];
                    break;
                case "view":
                    $wx_menu_list[$i + 10]["wxMenuKeyOrUrl"] = $wx_menu_three_arr["sub_button"][$i - 1]["url"];
                    break;
                default:
                    $wx_menu_list[$i + 10]["wxMenuKeyOrUrl"] = "";
                    break;
            }
        }
        $wx_menu_list[18]["wxMenuId"] = "3";
        $wx_menu_list[18]["wxMenuName"] = $wx_menu_three_arr["name"];
        $wx_menu_list[18]["wxMenuType"] = "sub";
        $wx_menu_list[18]["wxMenuKeyOrUrl"] = "";
    } else {
        for ($i = 1; $i <= 5; $i++) {
            $wx_menu_list[$i + 10]["wxMenuId"] = "3." . $i;
            $wx_menu_list[$i + 10]["wxMenuName"] = "";
            $wx_menu_list[$i + 10]["wxMenuType"] = "";
            $wx_menu_list[$i + 10]["wxMenuKeyOrUrl"] = "";
        }
        $wx_menu_list[18]["wxMenuId"] = "3";
        $wx_menu_list[18]["wxMenuName"] = $wx_menu_three_arr["name"];
        $wx_menu_list[18]["wxMenuType"] = $wx_menu_three_arr["type"];
        switch ($wx_menu_list[18]["wxMenuType"]) {
            case "click":
                $wx_menu_list[18]["wxMenuKeyOrUrl"] = $wx_menu_three_arr["key"];
                break;
            case "view":
                $wx_menu_list[18]["wxMenuKeyOrUrl"] = $wx_menu_three_arr["url"];
                break;
            default:
                $wx_menu_list[18]["wxMenuKeyOrUrl"] = "";
                break;
        }
    }
    return $wx_menu_list;
}

function generate_wx_main_menu($wx_menu_new_arr, $wx_menu_old_arr)
{
    if ($wx_menu_new_arr['wxMenuName'] == null) {
        echo "保存一级菜单失败\n名称不能为空！";
        die();
    }
    $wx_menu_old_arr['name'] = $wx_menu_new_arr['wxMenuName'];
    if ($wx_menu_new_arr['wxMenuType'] != "sub") {
        unset($wx_menu_old_arr["sub_button"]);
        $wx_menu_old_arr['type'] = $wx_menu_new_arr['wxMenuType'];
        switch ($wx_menu_old_arr['type']) {
            case "click":
                $wx_menu_old_arr['key'] = $wx_menu_new_arr['wxMenuKeyOrUrl'];
                break;
            case "view":
                $wx_menu_old_arr['url'] = $wx_menu_new_arr['wxMenuKeyOrUrl'];
                break;
            default:
                break;
        }
    } else {
        unset($wx_menu_old_arr['key']);
        unset($wx_menu_old_arr['url']);
        unset($wx_menu_old_arr['type']);
        if (!array_key_exists("sub_button", $wx_menu_old_arr)) {
            $wx_menu_old_arr["sub_button"] = array(null, null, null, null, null);
        }
    }
    return $wx_menu_old_arr;
}

function generate_wx_sub_menu($wx_menu_new_arr, $wx_menu_old_arr)
{
    if (!array_key_exists("sub_button", $wx_menu_old_arr)) {
        echo "保存二级菜单失败\n请确保一级菜单的类型正确！";
        die();
    }
    $wx_menu_new_sub_arr = [];
    for ($i = 0; $i < 5; $i++) {
        if ($wx_menu_new_arr[$i]['wxMenuName'] != "" && $wx_menu_new_arr[$i]['wxMenuType'] != "" && $wx_menu_new_arr[$i]['wxMenuKeyOrUrl'] != "") {
            $wx_menu_new_sub_arr[$i]['name'] = $wx_menu_new_arr[$i]['wxMenuName'];
            $wx_menu_new_sub_arr[$i]['type'] = $wx_menu_new_arr[$i]['wxMenuType'];
            switch ($wx_menu_new_sub_arr[$i]['type']) {
                case "click":
                    $wx_menu_new_sub_arr[$i]['key'] = $wx_menu_new_arr[$i]['wxMenuKeyOrUrl'];
                    break;
                case "view":
                    $wx_menu_new_sub_arr[$i]['url'] = $wx_menu_new_arr[$i]['wxMenuKeyOrUrl'];
                    break;
                default:
                    break;
            }
            $wx_menu_old_arr['sub_button'][$i] = $wx_menu_new_sub_arr[$i];
        } else {
            $wx_menu_old_arr['sub_button'][$i] = null;
        }
    }
    return $wx_menu_old_arr;
}

function generate_menu_from_redis($data)
{
    for ($i = 1; $i <= 3; $i++) {
        if (array_key_exists("sub_button", $data[$i])) {
            $data[$i]["sub_button"] = array_filter($data[$i]["sub_button"], "delnull");
            $data[$i]["sub_button"] = array_values($data[$i]["sub_button"]);
        }
    }
    $menu = array(
        "button" => array(
            $data[1],
            $data[2],
            $data[3]
        )
    );
    return $menu;
}