<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// 是否显示sql
$config['show_sql'] = false;

// 版本控制
$config['v'] = 2;
$config["need_by_ci"] = false;

define("ADMIN_EMAIL", "weapp2013@gmail.com");
define("ADMIN_PASSWORD", "wetwoby2012");
define("YES", 1);
define("NO", 0);
define("ERR", -1);
define("GAME_TAB", 1);
define("BANNER_TAB", 2);
define("ACTIVITY_TAB", 3);
define("MASK_TAB", 4);
define("OPEN_TAB", 5);
define("CODE_SUCCESS", 200);
define("CODE_NOT_MODIFIED", 304);
define("CODE_NEED_LOGIN", 401);
define("CODE_NEED_UPDATE", 402);
define("CODE_INTERNAL_ERROR", 500);
define("GENDER_MAN", 1);
define("GENDER_WOMAN", 2);
define("GENDER_UNKNOWN", 3);
define("DEFAULT_AVATAR_URL", "http://77fzlw.com1.z0.glb.clouddn.com/gcdefaulticon.png");
define("RET_TYPE_INT", 1);
define("RET_TYPE_STR", 2);
define("RET_TYPE_FLOAT", 3);
define("RET_TYPE_OBJ", 4);
define("RECENT_PLAY_LIMIT", 4);
define("FRIEND_RECENT_PLAY_LIMIT", 3);
define("FRIEND_RECENT_PLAY_LIMIT_MAX", 100);
define("HOT_GAME_LIMIT", 4);
define("PLAY_FROM_CLIENT", 1);
define("PLAY_FROM_SHARE_URL", 2);
define("PLAY_FROM_CLIENT_WEB_VIEW", 3);
define("BANNER_TYPE_ACTIVITY", 1);
define("BANNER_TYPE_GAME", 2);
define("WORLD_SCORE_TOP_LIST_LIMIT", 500);
define("SESSION_EXPIRE_TIME", 60 * 24 * 60 * 60);
define("USER_INFO_EXPIRE_TIME", 7 * 24 * 60 * 60);
define("GAME_SOURCE_WEAPP", 1);
define("GAME_SOURCE_EGRET", 2);
define("GAME_SOURCE_NICI", 3);
define("HOUR_SECOND", 60 * 60);

define("KV_USER_INFO", "gc_user_info:");
define("KV_USER_SESSION", "gc_user_session:");
define("KV_HOT_GAME", "gc_hot_game");
define("HSET_USER_GAME", "gc_user_game:");
define("HSET_GAME_USER", "gc_game_user:");
define("KV_GAME_INFO", "gc_game_info:");
define("HSET_FRIEND_INFO", "gc_friend_info:");
define("ZSET_GAME_TOP_LIST", "gc_game_top_list:");
define("HSET_OPEN_INFO", "gc_open_info");
define("KV_ACCESS_TOKEN", "gc_access_token:");
define("KV_JS_TICKET", "gc_js_ticket:");
define("KV_IAPPPAY_STATE", "gc_iapppay:");
define("KV_ACTIVITY_REWARD_INFO", "gc_activity_reward_info");
define("HSET_ACTIVITY_REWARD_INFO", "gc_activity_reward_info_v2");
define("KV_BANNER_INFO", "gc_banner_info");
define("ZSET_ACTIVITY_INFO", "gc_activity_info");
define("HSET_CHANNEL_VERSION", "gc_channel_version:");

define("APPID", "wxce1fff14f1989d01");
define("APPSECRET", "ccead13545ece0ea702c1d158a339b33");