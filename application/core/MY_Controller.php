<?php

class MY_Controller extends CI_Controller
{
    protected $data;
    public function __construct()
    {
        parent::__construct();
        $this->data["base_url"] = base_url();
        header('Content-Type:text/html; charset=utf-8');
        header("Cache-Control:no-cache,no-store,must-revalidate");
        header("pragma:no-cache");
        header("Expires:0");
    }

    public function response($data)
    {
        echo ($data);
        exit();
    }

    public function need_and_check_param($param, $checker = DEFAULT_CHECKER)
    {
        $value = $this->input->get_post($param);
        if ($value === false) {
            $this->response("缺少参数" . $param);
        }
        $value = trim($value, " \t\n\r\0,");
        if ($checker($value) === ERR) {
            $this->response("参数" . $param . "错误");
        }
        return $value;
    }

    public function optional_and_check_param($param, $checker = DEFAULT_CHECKER)
    {
        $value = $this->input->get_post($param);
        if ($value === false || strlen($value) === 0) {
            return NO;
        }
        $value = trim($value, " \t\n\r\0,");
        if ($checker($value) === ERR) {
            $this->response("参数" . $param . "错误");
        }
        return $value;
    }

    public function check_login()
    {
        $user_email = $this->session->userdata("user_email");
        if ($user_email !== ADMIN_EMAIL) {
            redirect(base_url() . "login/index");
        }
        $this->data["user_email"] = $user_email;
    }

    public function set_last_url($url)
    {
        $this->session->set_userdata("last_url", $url);
    }

    public function get_last_url()
    {
        $last_url = $this->session->userdata("last_url");
        if ($last_url === false) {
            return base_url();
        }
        return $last_url;
    }
}
