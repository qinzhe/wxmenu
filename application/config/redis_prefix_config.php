<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['v'] = 2; // 什么鬼

//用户信息列表
define("USER_INFO_KV_PREFIX", "user_info:");
//系统access_token缓存
define("BASE_ACCESS_TOKEN_KV_PREFIX", "access_token:");
//系统js_ticket缓存
define("BASE_JS_TICKET_KV_PREFIX", "js_ticket:");
//用户聊天状态
define("CHAT_USER_HSET", "chat_user");
//用户聊天匹配池
define("WANT_CHAT_POOL_HSET", "want_chat_pool");
//用户聊天优先匹配池
define("PRIOR_WANT_CHAT_POOL_HSET", "prior_want_chat_pool");

define("USING_CHAT_COUNT", "using_chat_count");

define("CHAT_MSG_COUNT", "chat_msg_count");

define("VALID_CHAT_COUNT", "valid_chat_count");
define("VALID_CHAT_USER_COUNT", "valid_chat_user_count");

define("COUPLE_COUNT", "couple_count");

define("AD_HSET", "advertising");

define("TXT_LINK_AD", "txt_link_ad");
define("TUWEN_AD", "tuwen_ad");
define("MENU_TAB_AD", "menu_tab_ad");

define("WX_MENU_ZY_HSET", "wx_menu_zy");
define("WX_MENU_FQ_HSET", "wx_menu_fq");