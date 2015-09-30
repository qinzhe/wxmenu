/**
 * Created by zhco on 15/9/14.
 */
import Contants from "./../constants/Constants";
import Dispatcher from "./../dispatcher/dispatcher";

var actionType = Contants.ActionType;

module.exports = {
    delAd: function (adId) {
        Dispatcher.dispatch({
            type: actionType.DEL_AD,
            adId: adId
        });
    },
    delAdSucc: function (adId) {
        Dispatcher.dispatch({
            type: actionType.DEL_SUCC,
            adId: adId
        });
    },
    delAdFail: function (adId) {
        Dispatcher.dispatch({
            type: actionType.DEL_FAIL,
            adId: adId
        });
    },
    editAd: function (adId, adInfo) {
        Dispatcher.dispatch({
            type: actionType.EDIT_AD,
            adId: adId,
            adInfo: adInfo
        });
    },
    editAdSucc: function (adId) {
        Dispatcher.dispatch({
            type: actionType.EDIT_SUCC,
            adId: adId
        });
    },
    editAdFail: function (adId) {
        Dispatcher.dispatch({
            type: actionType.EDIT_FAIL,
            adId: adId
        });
    },
    addAd: function (adType, adInfo) {
        Dispatcher.dispatch({
            type: actionType.ADD_AD,
            adId: adType,
            adInfo: adInfo
        });
    },
    addAdSucc: function (adType) {
        Dispatcher.dispatch({
            type: actionType.ADD_SUCC,
            adId: adType
        });
    },
    addAdFail: function (adType) {
        Dispatcher.dispatch({
            type: actionType.ADD_FAIL,
            adId: adType
        });
    }
};

