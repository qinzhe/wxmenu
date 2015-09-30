/**
 * Created by aaron on 15/9/18.
 */
import Contants from "./../constants/Constants";
import Dispatcher from "./../dispatcher/dispatcher";
import WxMenuStateStore from "./../stores/WxMenuStateStore";

var WxMenuStateType = Contants.WxMenuState;

module.exports = {
    delWxMenu: function (wxMenuId) {
        Dispatcher.dispatch({
            type: WxMenuStateType.DEL_WXMENU,
            wxMenuId: wxMenuId
        });
    },
    delWxMenuSucc: function (wxMenuId) {
        Dispatcher.dispatch({
            type: WxMenuStateType.DEL_SUCC,
            wxMenuId: wxMenuId
        });
    },
    delWxMenuFail: function (wxMenuId) {
        Dispatcher.dispatch({
            type: WxMenuStateType.DEL_FAIL,
            wxMenuId: wxMenuId
        });
    },
    showMainWxMenu: function (wxMenuId) {
        Dispatcher.dispatch({
            type: WxMenuStateType.SHOW_MAIN_WXMENU,
            wxMenuId: wxMenuId
        });
    },
    showWxMenu: function (wxMenuId) {
        Dispatcher.dispatch({
            type: WxMenuStateType.SHOW_WXMENU,
            wxMenuId: wxMenuId
        });
    },
    saveWxMenu: function (wxMenuMainId, wxMenuSubId, wxMenuJson) {
        Dispatcher.dispatch({
            type: WxMenuStateType.SAVE_WXMENU,
            wxMenuMainId: wxMenuMainId,
            wxMenuSubId: wxMenuSubId,
            wxMenuJson: wxMenuJson
        });
    },
    updateWxMenu: function () {
        Dispatcher.dispatch({
            type: WxMenuStateType.UPDATE_WXMENU
        });
    }
};
