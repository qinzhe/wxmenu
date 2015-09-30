/**
 * Created by zhco on 15/9/14.
 */
import keyMirror from "keymirror";

module.exports = {
    ActionType: keyMirror({
        DEL_AD: null,
        DEL_SUCC: null,
        DEL_FAIL: null,
        EDIT_AD: null,
        EDIT_SUCC: null,
        EDIT_FAIL: null,
        ADD_AD: null,
        ADD_SUCC: null,
        ADD_FAIL: null
    }),
    AdState: keyMirror({
        IDLE: null,
        DEL_SUCC: null,
        DEL_FAIL: null
    }),
    AdType: keyMirror({
        TEXT_AD: null,
        TUWEN_AD: null
    }),
    AdAction: keyMirror({
        ADD_AD: null,
        EDIT_AD: null
    }),

    WxMenuState: keyMirror({
        IDLE: null,
        DEL_SUCC: null,
        DEL_FAIL: null,
        DEL_WXMENU: null,
        SHOW_MAIN_WXMENU: null,
        SHOW_MAIN_SUCC: null,
        SHOW_WXMENU: null,
        SHOW_SUCC: null,
        SAVE_WXMENU: null,
        SAVE_SUCC: null,
        UPDATE_WXMENU: null,
        PREVIEW_WXMENU: null
    }),

    APIUrl: {
        DEL_AD_API: "/ad_manage/del_ad",
        EDIT_AD_API: "/ad_manage/edit_ad",
        DEL_WXMENU_API: "/wxmenu_manage/del_wxmenu",
        EDIT_WXMENU_API: "/wxmenu_manage/edit_wxmenu",
        SAVE_WXMENU_API: "/wxmenu_manage/save_wxmenu",
        UPDATE_WXMENU_API: "/wxmenu_manage/update_wxmenu"
    }
};