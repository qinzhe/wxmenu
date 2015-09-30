<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 15/9/21
 * Time: 15:08
 */
class wxmenu_manage extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
    }

    private function check_wechat()
    {
        switch ($this->session->userdata("wechat")) {
            case "zy":
                $hset = "zy";
                break;
            case "fq":
                $hset = "fq";
                break;
            default:
                $hset = "";
                break;
        }
        return $hset;
    }

    public function index()
    {
        $this->check_login();
        $this->session->set_userdata(["wechat" => $this->input->get("wechat")]);
        $data = [];
        $this->parser->parse("wxmenu", $data);
    }

    public function show_wxmenu()
    {
        $hset = $this->check_wechat();
        $wx_menu_one_arr = json_decode($this->ad_cache->get_wx_menu($hset, "1"), true);
        $wx_menu_two_arr = json_decode($this->ad_cache->get_wx_menu($hset, "2"), true);
        $wx_menu_three_arr = json_decode($this->ad_cache->get_wx_menu($hset, "3"), true);
        $wx_menu_list = generate_wx_menu_list($wx_menu_one_arr, $wx_menu_two_arr, $wx_menu_three_arr);
        $result['edit'] = array($wx_menu_list[1], $wx_menu_list[2], $wx_menu_list[3], $wx_menu_list[4], $wx_menu_list[5], $wx_menu_list[6], $wx_menu_list[7], $wx_menu_list[8], $wx_menu_list[9], $wx_menu_list[10], $wx_menu_list[11], $wx_menu_list[12], $wx_menu_list[13], $wx_menu_list[14], $wx_menu_list[15], $wx_menu_list[16], $wx_menu_list[17], $wx_menu_list[18]);
        $result["list"] = array($wx_menu_list[16], $wx_menu_list[17], $wx_menu_list[18]);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function save_wxmenu()
    {
        $hset = $this->check_wechat();
        $wx_menu_main_id = $this->input->post('wxMenuMainId');
        $wx_menu_sub_id = $this->input->post('wxMenuSubId');
        $wx_menu_new_arr = json_decode($this->input->post('wxMenuJson'), true);
        if ($wx_menu_sub_id == "0") {
            $wx_menu_old_json = $this->ad_cache->get_wx_menu($hset, $wx_menu_main_id);
            $wx_menu_old_arr = generate_wx_main_menu($wx_menu_new_arr, json_decode($wx_menu_old_json, true));
            $this->ad_cache->save_wx_menu($hset, $wx_menu_main_id, json_encode($wx_menu_old_arr, JSON_UNESCAPED_UNICODE));
            echo "保存一级菜单成功";
        } else {
            $wx_menu_old_json = $this->ad_cache->get_wx_menu($hset, $wx_menu_sub_id);
            $wx_menu_old_arr = json_decode($wx_menu_old_json, true);
            $wx_menu_old_arr = generate_wx_sub_menu($wx_menu_new_arr, $wx_menu_old_arr);
            $this->ad_cache->save_wx_menu($hset, $wx_menu_sub_id, json_encode($wx_menu_old_arr, JSON_UNESCAPED_UNICODE));
            echo "保存二级菜单成功";
        }
    }

    public function update_wxmenu()
    {
        $hset = $this->check_wechat();
        $data = [];
        for ($i = 1; $i <= 3; $i++) {
            $data[$i] = json_decode($this->ad_cache->get_wx_menu($hset, $i), true);
        }
        $menu = generate_menu_from_redis($data);
        $access_token = get_access_token(APPID, APPSECRET);
        $info = json_decode(post_tab($access_token, json_encode($menu, JSON_UNESCAPED_UNICODE)), true);
        if ($info["errcode"] == "0") {
            $res = "更新自定义菜单成功";
        } else {
            $res = "更新自定义菜单失败\n错误代码：" . $info["errcode"] . "\n错误信息：" . $info["errmsg"];
        }
        echo $res;
    }

    public function preview_wxmenu()
    {
        $hset = $this->check_wechat();
        $data = [];
        for ($i = 1; $i <= 3; $i++) {
            $data[$i] = json_decode($this->ad_cache->get_wx_menu($hset, $i), true);
        }
        $menu = generate_menu_from_redis($data);
        echo json_encode($menu, JSON_UNESCAPED_UNICODE);
        dump($menu);
    }
}