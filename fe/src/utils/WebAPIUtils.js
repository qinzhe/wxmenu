/**
 * Created by zhco on 15/8/4.
 */
import Ajax from './AjaxUtil';
import ActionCreator from "../actions/ActionCreator";
import WxMenuActionCreator from "../actions/WxMenuActionCreator";
import Constants from "../constants/Constants";

function isObject(obj) {
    var type = typeof obj;
    return type === "function" || type === "object" && !!obj;
}

const DEL_AD_API = Constants.APIUrl.DEL_AD_API;
const EDIT_AD_API = Constants.APIUrl.EDIT_AD_API;

const DEL_WXMENU_API = Constants.APIUrl.DEL_WXMENU_API;
const EDIT_WXMENU_API = Constants.APIUrl.EDIT_WXMENU_API;
const SAVE_WXMENU_API = Constants.APIUrl.SAVE_WXMENU_API;
const UPDATE_WXMENU_API = Constants.APIUrl.UPDATE_WXMENU_API;

var WebAPIUtils = {
    delAd(adId) {
        Ajax.post(DEL_AD_API, {
            adId: adId
        }, function (data) {
            var resData = isObject(data) ? data : JSON.parse(data),
                result = resData.result;
            if (+result === 1) {
                ActionCreator.delAdSucc(adId);
            } else {
                ActionCreator.delAdFail(adId);
            }
        });
    },
    editAd(adId) {
        Ajax.post(EDIT_AD_API, {
            adId: adId
        }, function (data) {
            var resData = isObject(data) ? data : JSON.parse(data),
                result = resData.result;
            if (+result === 1) {
                ActionCreator.editAdSucc(adId);
            } else {
                ActionCreator.editAdFail(adId);
            }
        });
    },
    addAd(adType) {
        Ajax.post(EDIT_AD_API, {
            adType: adType
        }, function (data) {
            var resData = isObject(data) ? data : JSON.parse(data),
                result = resData.result;
            if (+result === 1) {
                ActionCreator.addAdSucc(adType);
            } else {
                ActionCreator.addAdFail(adType);
            }
        });
    },

    delWxMenu(wxMenuId) {
        Ajax.post(DEL_WXMENU_API, {
            wxMenuId: wxMenuId
        }, function (data) {
            var resData = isObject(data) ? data : JSON.parse(data),
                result = resData.result;
            if (+result === 1) {
                WxMenuActionCreator.delWxMenuSucc(wxMenuId);
            } else {
                WxMenuActionCreator.delWxMenuFail(wxMenuId);
            }
        });
    },

    saveWxMenu(wxMenuMainId, wxMenuSubId, wxMenuJson) {
        Ajax.post(SAVE_WXMENU_API, {
            wxMenuMainId: wxMenuMainId,
            wxMenuSubId: wxMenuSubId,
            wxMenuJson: wxMenuJson
        }, function (data) {
            alert(data);
            window.location.reload();
        });
    },

    updateWxMenu() {
        Ajax.get(UPDATE_WXMENU_API, [], function (data) {
            alert(data);
        });
    }
};

module.exports = WebAPIUtils;