/**
 * Created by zhco on 15/9/14.
 */
import WebAPIUtils from "./../utils/WebAPIUtils";
import Constants from "./../constants/Constants";
import Dispatcher from "./../dispatcher/dispatcher";
import URLUtil from "./../utils/URLUtil";
import Events from 'events';
import Assign from "object-assign";

var CHANGE_EVENT = "change_event";
var ActionType = Constants.ActionType;
var AdStateType = Constants.AdState;
var adState = AdStateType.IDLE;
var url = window.location.href;
var getQueryParam = URLUtil.getQueryParam;

var adType = getQueryParam(url, "adType");
var adId = getQueryParam(url, "adId");
var adAction = getQueryParam(url, "adAction");

var AdStateStore = Assign({}, Events.EventEmitter.prototype, {
    emitChange(payloads) {
        this.emit(CHANGE_EVENT, payloads);
    },

    addChangeListener(callback) {
        this.on(CHANGE_EVENT, callback);
    },

    removeChangeListener(callback) {
        this.removeListener(CHANGE_EVENT, callback);
    },

    getAdState() {
        return adState;
    },

    setAdState(state) {
        adState = state;
    },

    getAdType() {
        return adType;
    },

    getAdId() {
        return adId;
    },

    getAdAction() {
        return adAction;
    }
});

AdStateStore.dispatchToken = Dispatcher.register(function (action) {
    switch (action.type) {
        case ActionType.DEL_AD:
            WebAPIUtils.delAd(action.adId);
            break;
        case ActionType.DEL_SUCC:
            AdStateStore.setAdState(AdStateType.DEL_SUCC);
            AdStateStore.emitChange({
                adState: AdStateType.DEL_SUCC,
                adId: action.adId
            });
            break;
        case ActionType.DEL_FAIL:
            AdStateStore.setAdState(AdStateType.DEL_FAIL);
            AdStateStore.emitChange({
                adState: AdStateType.DEL_FAIL,
                adId: action.adId
            });
            break;
        case ActionType.EDIT_AD:
            WebAPIUtils.editAd(action.adId);
            break;
        case ActionType.EDIT_SUCC:
            AdStateStore.setAdState(AdStateType.EDIT_SUCC);
            AdStateStore.emitChange({
                adState: AdStateType.EDIT_SUCC,
                adId: action.adId
            });
            break;
        case ActionType.EDIT_FAIL:
            AdStateStore.setAdState(AdStateType.EDIT_FAIL);
            AdStateStore.emitChange({
                adState: AdStateType.EDIT_FAIL,
                adId: action.adId
            });
            break;
        case ActionType.ADD_AD:
            WebAPIUtils.addAd(action.adType);
            break;
        case ActionType.ADD_SUCC:
            AdStateStore.setAdState(AdStateType.ADD_SUCC);
            AdStateStore.emitChange({
                adState: AdStateType.ADD_SUCC,
                adType: action.adType
            });
            break;
        case ActionType.ADD_FAIL:
            AdStateStore.setAdState(AdStateType.ADD_FAIL);
            AdStateStore.emitChange({
                adState: AdStateType.ADD_FAIL,
                adType: action.adType
            });
            break;
        default:
            break;
    }
});

module.exports = AdStateStore;