<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: zhco
 * Date: 4/14/15
 * Time: 17:18
 */
class Login extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
    }

    public function index()
    {
        $this->parser->parse("login/login", $this->data);
    }

    public function submit()
    {
        $user_email = $this->need_and_check_param("email");
        $user_password = $this->need_and_check_param("password");
        if ($user_email == ADMIN_EMAIL && $user_password == ADMIN_PASSWORD) {
            $this->session->set_userdata(["user_email" => $user_email]);
            redirect(base_url() . "wxmenu_manage/index");
        }
        redirect(base_url() . "login");
    }
}