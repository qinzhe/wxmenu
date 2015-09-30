/**
 * Created by aaron on 15/9/18.
 */
import WebAPIUtils from "./../utils/WebAPIUtils";
import Constants from "./../constants/Constants";
import Dispatcher from "./../dispatcher/dispatcher";
import URLUtil from "./../utils/URLUtil";
import Events from 'events';
import Assign from "object-assign";

var CHANGE_EVENT = "change_event";
var WxMenuStateType = Constants.WxMenuState;
var WxMenuState = WxMenuStateType.IDLE;
var url = window.location.href;
var getQueryParam = URLUtil.getQueryParam;

var wxMenuId = getQueryParam(url, "wxMenuId");
var wxMenuName = getQueryParam(url, "wxMenuName");
var wxMenuType = getQueryParam(url, "wxMenuType");
var wxMenuKeyOrUrl = getQueryParam(url, "wxMenuKeyOrUrl");

var WxMenuStateStore = Assign({}, Events.EventEmitter.prototype, {
    emitChange(payloads) {
        this.emit(CHANGE_EVENT, payloads);
    },

    addChangeListener(callback) {
        this.on(CHANGE_EVENT, callback);
    },

    removeChangeListener(callback) {
        this.removeListener(CHANGE_EVENT, callback);
    },

    getWxMenuState() {
        return WxMenuState;
    },

    setWxMenuState(state) {
        WxMenuState = state;
    },
});

WxMenuStateStore.dispatchToken = Dispatcher.register(function (action) {
    switch (action.type) {
        case WxMenuStateType.DEL_WXMENU:
            WebAPIUtils.delWxMenu(action.wxMenuId);
            break;
        case WxMenuStateType.DEL_SUCC:
            WxMenuStateStore.setWxMenuState(WxMenuStateType.DEL_SUCC);
            WxMenuStateStore.emitChange({
                WxMenuState: WxMenuStateType.DEL_SUCC,
                wxMenuId: action.wxMenuId
            });
            break;
        case WxMenuStateType.DEL_FAIL:
            WxMenuStateStore.setWxMenuState(WxMenuStateType.DEL_FAIL);
            WxMenuStateStore.emitChange({
                WxMenuState: WxMenuStateType.DEL_FAIL,
                wxMenuId: action.wxMenuId
            });
            break;
        case WxMenuStateType.SHOW_MAIN_WXMENU:
            WxMenuStateStore.setWxMenuState(WxMenuStateType.SHOW_MAIN_SUCC);
            WxMenuStateStore.emitChange({
                WxMenuState: WxMenuStateType.SHOW_MAIN_SUCC,
                wxMenuId: action.wxMenuId
            });
            break;
        case WxMenuStateType.SHOW_WXMENU:
            WxMenuStateStore.setWxMenuState(WxMenuStateType.SHOW_SUCC);
            WxMenuStateStore.emitChange({
                WxMenuState: WxMenuStateType.SHOW_SUCC,
                wxMenuId: action.wxMenuId
            });
            break;
        case WxMenuStateType.SAVE_WXMENU:
            WebAPIUtils.saveWxMenu(action.wxMenuMainId, action.wxMenuSubId, action.wxMenuJson);
            break;
        case WxMenuStateType.UPDATE_WXMENU:
            WebAPIUtils.updateWxMenu();
            break;
        default:
            break;
    }
});

module.exports = WxMenuStateStore;