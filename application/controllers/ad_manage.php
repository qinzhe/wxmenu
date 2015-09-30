<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: zhco
 * Date: 4/14/15
 * Time: 17:18
 */
class Ad_manage extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
    }

    function edit_ad() {
        $this->check_login();
        $data = [];
        $txt_link_ad = $this->ad_cache->get_txt_link_ad();
        if (is_array($txt_link_ad) && count($txt_link_ad) > 0) {
            $data["txt_link_ad"] = $txt_link_ad;
        }
        $menu_tab_ad = $this->ad_cache->get_menu_tab_ad();
        if (is_array($menu_tab_ad) && count($menu_tab_ad) > 0) {
            $data["menu_tab_ad"] = $menu_tab_ad;
        }
        $tuwen_ad = $this->ad_cache->get_tuwen_ad();
        if (is_array($tuwen_ad) && count($tuwen_ad) > 0) {
            $data["tuwen_ad"] = $tuwen_ad;
        }
        $this->parser->parse("edit_ad", $data);
    }

    function mod_api() {
        $this->check_login();
        $target = $this->input->post("target");
        $action = $this->input->post("action");
        $ad_data = $this->input->post("ad_data");
        switch($target) {
            case TXT_LINK_AD:
                $this->ad_cache->set_txt_link_ad($ad_data);
                echo "ok";
                break;
            case MENU_TAB_AD:
                $this->ad_cache->set_menu_tab_ad($ad_data);
                echo "ok";
                break;
            case TUWEN_AD:
                $this->ad_cache->set_tuwen_ad($ad_data);
                echo "ok";
                break;
            default:
                echo "no_update";
                break;
        };
    }
}