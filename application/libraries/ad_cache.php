<?php

class Ad_cache
{
    private $ci = null;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function get_txt_link_ad()
    {
        $ad_str = $this->ci->my_redis->hget(AD_HSET, TXT_LINK_AD);
        $ad_data = json_decode($ad_str, true);
        return $ad_data;
    }

    function set_txt_link_ad($ad_data)
    {
        $ad_str = json_encode($ad_data, JSON_UNESCAPED_UNICODE);
        return $this->ci->my_redis->hset(AD_HSET, TXT_LINK_AD, $ad_str);
    }

    function del_txt_link_ad()
    {
        return $this->ci->my_redis->hdel(AD_HSET, TXT_LINK_AD);
    }

    function get_tuwen_ad()
    {
        $ad_str = $this->ci->my_redis->hget(AD_HSET, TUWEN_AD);
        $ad_data = json_decode($ad_str, true);
        return $ad_data;
    }

    function set_tuwen_ad($ad_data)
    {
        $ad_str = json_encode($ad_data, JSON_UNESCAPED_UNICODE);
        return $this->ci->my_redis->hset(AD_HSET, TUWEN_AD, $ad_str);
    }

    function del_tuwen_ad($index = "all")
    {
        if ($index === "all") {
            return $this->ci->my_redis->hdel(AD_HSET, TUWEN_AD);
        }
        $ad_data = $this->get_tuwen_ad();
        array_splice($ad_data, $index, 1);
        return $this->set_tuwen_ad($ad_data);
    }

    function get_menu_tab_ad()
    {
        $ad_str = $this->ci->my_redis->hget(AD_HSET, MENU_TAB_AD);
        $ad_data = json_decode($ad_str, true);
        return $ad_data;
    }

    function set_menu_tab_ad($ad_data)
    {
        $ad_str = json_encode($ad_data, JSON_UNESCAPED_UNICODE);
        return $this->ci->my_redis->hset(AD_HSET, MENU_TAB_AD, $ad_str);
    }

    function del_menu_tab_ad()
    {
        return $this->ci->my_redis->hdel(AD_HSET, MENU_TAB_AD);
    }

    function save_wx_menu($hset, $id, $json)
    {
        if ($hset == "zy") {
            return $this->ci->my_redis->hset(WX_MENU_ZY_HSET, $id, $json);
        } else {
            return $this->ci->my_redis->hset(WX_MENU_FQ_HSET, $id, $json);
        }
    }

    function get_wx_menu($hset, $id)
    {
        if ($hset == "zy") {
            return $this->ci->my_redis->hget(WX_MENU_ZY_HSET, $id);
        } else {
            return $this->ci->my_redis->hget(WX_MENU_FQ_HSET, $id);
        }
    }
}