<?php

function log_error()
{
    $arg_list = func_get_args();
    log_trace($arg_list, "log/error_log_" . date("m_d"));
}

function log_debug()
{
    if (DEV) {
        $arg_list = func_get_args();
        log_trace($arg_list, "log/debug_log_" . date("m_d"));
    }
}

function log_info()
{
    $arg_list = func_get_args();
    log_simple($arg_list, "log/info_log_" . date("m_d"));
}

function log_cron()
{
    $arg_list = func_get_args();
    log_simple($arg_list, "log/cron_log_" . date("m_d"));
}

function log_trace($arg_list, $path)
{
    $e = new Exception;
    $stack_trace = $e->getTraceAsString();
    $str = "";
    foreach ($arg_list as $arg) {
        if (is_array($arg) || is_object($arg)) {
            $str .= json_encode($arg);
        } else {
            $str .= $arg;
        }
        $str .= "; ";
    }
    $str .= "\n" . $stack_trace;
    $fp = fopen($path, 'a+');
    fwrite($fp, date("Y-m-d H:i:s") . $str . "\n");
    fclose($fp);
}

function log_simple($arg_list, $path)
{
    $str = "";
    foreach ($arg_list as $arg) {
        if (is_array($arg) || is_object($arg)) {
            $str .= json_encode($arg);
        } else {
            $str .= $arg;
        }
        $str .= "; ";
    }
    $fp = fopen($path, 'a+');
    fwrite($fp, date("Y-m-d H:i:s") . $str . "\n");
    fclose($fp);
}
