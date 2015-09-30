<?php
if (!function_exists('dump')) {
    function dump($var, $echo = true, $label = null, $strict = true)
    {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
            } else {
                $output = $label . " : " . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        } else
            return $output;
    }
}
function array_sort($arr, $keys, $type = 'desc')
{
    $keysvalue = $new_array = array();
    foreach ($arr as $k => $v) {
        $keysvalue[$k] = $v[$keys];
    }
    if ($type == 'asc') {
        asort($keysvalue);
    } else {
        arsort($keysvalue);
    }
    reset($keysvalue);
    foreach ($keysvalue as $k => $v) {
        $new_array[$k] = $arr[$k];
    }
    return $new_array;
}

function http_get_async($domain, $path)
{
    dump_log("global_helper,http_get_async", $domain, $path);
    $fp = fsockopen($domain, 80, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br />\n";
    } else {
        $out = "GET $path HTTP/1.1\r\n";
        $out .= "Host: " . $domain . "\r\n";
        $out .= "Connection: Close\r\n\r\n";
        fwrite($fp, $out);
        fclose($fp);
    }
}

function curl_async($url, $payload = "{}")
{
    $cmd = "curl -X POST -H 'Content-Type: application/json'";
    $cmd .= " -d '" . $payload . "' " . "'" . $url . "'";
    $cmd .= " > /dev/null 2>&1 &";
    exec($cmd, $output, $exit);
    return $exit == 0;
}

function data_log()
{
    $args = func_get_args();
    $str = "";
    foreach ($args as $arg) {
        if (is_array($arg) || is_object($arg)) {
            $str .= json_encode($arg);
        } else {
            $str .= $arg;
        }
        $str .= "; ";
    }
    $fp = fopen('log/data_log_' . date("m_d"), 'a+');
    if ($fp) {
        fwrite($fp, date("Y-m-d H:i:m") . "[INFO]" . $str . "\n");
        fclose($fp);
    }
}

function dump_log()
{
    $args = func_get_args();
    $str = "";
    foreach ($args as $arg) {
        if (is_array($arg) || is_object($arg)) {
            $str .= json_encode($arg);
        } else {
            $str .= $arg;
        }
        $str .= "; ";
    }
    $fp = fopen('log/dump_log_' . date("m_d"), 'a+');
    if ($fp) {
        fwrite($fp, date("Y-m-d H:i:m") . "[INFO]" . $str . "\n");
        fclose($fp);
    }
}

function my_error_log()
{
    $e = new Exception;
    $stack_trace = $e->getTraceAsString();
    $args = func_get_args();
    $str = "";
    foreach ($args as $arg) {
        if (is_array($arg) || is_object($arg)) {
            $str .= json_encode($arg);
        } else {
            $str .= $arg;
        }
        $str .= "; ";
    }
    $str .= "\n" . $stack_trace;
    $fp = fopen('log/error_log_' . date("m_d"), 'a+');
    if ($fp) {
        fwrite($fp, date("Y-m-d H:i:s") . "[ERROR]" . $str . "\n");
        fclose($fp);
    }
}

function x_substr($str, $start, $len, $suffix = '...')
{
    return mb_strlen($str) > $len ? mb_substr($str, $start, $len) . $suffix : $str;
}

function is_null2($var)
{
    if (is_array($var)) {
        if (count($var) == 0)
            return true;
        else
            return false;
    }
    if (!isset($var))
        return true;
    if ($var == false || $var == null || strlen($var) == 0)
        return true;
    return false;
}

function ampm_replace($timestamp)
{
    $ret = str_replace(array('AM', 'PM'), array('上午', '下午'), date("AH:i", $timestamp));
    if ($ret == "下午12:00")
        $ret = "中午12:00";
    return $ret;
}

function qr_code($str)
{
    $widthHeight = '150';
    $EC_level = 'L';
    $margin = '0';
    $size = '150';
    $url = urlencode($str);
    return '<img src="http://chart.apis.google.com/chart?chs=' . $widthHeight . 'x' . $widthHeight . '&cht=qr&chld=' . $EC_level . '|' . $margin . '&chl=' . $url . '" alt="QR code" widhtHeight="' . $size . '" widhtHeight="' . $size . '"/>';
}

function time_str_replace($time_str, $format = 'Y-m-d')
{
    $today_str = date($format, time());
    $yesterday_str = date($format, time() - 24 * 60 * 60);
    $bigyesterday_str = date($format, time() - 48 * 60 * 60);
    $str_return = str_replace($today_str, "今天", $time_str);
    $str_return = str_replace($yesterday_str, "昨天", $str_return);
    $str_return = str_replace($bigyesterday_str, "前天", $str_return);
    return $str_return;
}

function nl2br2($str)
{
    $str = str_replace("\r\n", "<br />", $str);
    return $str;
}

function time_now_formysql($time_str = false)
{
    if (!$time_str)
        return date('Y-m-d H:i:s', time());
    else
        return date('Y-m-d H:i:s', strtotime($time_str));
}

function valid_phone($tel)
{
    if (preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/", $tel)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function clear_form_error($str)
{
    $str = str_replace("<p>", ";", $str);
    $str = str_replace("</p>", "", $str);
    $str = str_replace(".", "", $str);
    return $str;
}

function clean_prov_city($str)
{
    $str = str_replace("省", "", $str);
    $str = str_replace("市", "", $str);
    $str = str_replace(" ", "", $str);
    return $str;
}

function get_miliseconds()
{
    return floor(microtime(true) * 1000);
}

function is_creatter_blocked($wx_userid)
{
    if ($wx_userid == "oOWHXjjJg6P3k113mqx2zxXGsXNQ") {
        return true;
    }
    return false;
}

function is_dev()
{
    return config_item("dev") === true;
}

function delnull($v)
{
    if ($v == null) {
        return false;
    } else {
        return true;
    }
}