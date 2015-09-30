/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import Breadcrumb from "./Breadcrumb";
import BreadcrumbItem from "./BreadcrumbItem";
import AdStateStore from "./../stores/AdStateStore";
import ActionCreator from "./../actions/ActionCreator";
import Constants from "./../constants/Constants";
import "./../less/adeditform.less";

var adAction = AdStateStore.getAdAction();
var adType = AdStateStore.getAdType();
var adId = AdStateStore.getAdId();
var globalTimeout = null;

var adActionType = Constants.AdAction;

const AdEditForm = React.createClass({
    getInitialState() {
        return {
            isShowHint: false
        }
    },

    render() {
        return (
            <div className="AdEditForm-container">
                <Breadcrumb>
                    <BreadcrumbItem>首页</BreadcrumbItem>
                    <BreadcrumbItem href="/adList.html">广告系统</BreadcrumbItem>
                    <BreadcrumbItem>修改广告</BreadcrumbItem>
                </Breadcrumb>
                <h1 className="AdEditForm-title">{this.props.title}</h1>
                <form className="AdEditForm-form" id="form-edit-ad" onSunmit={this._onSubmit}>
                    <div className="AdEditForm-item">
                        <label htmlFor="ad-text" className="AdEditForm-label" required>标题</label>
                        <input className="AdEditForm-input" ref="adText" type="text" id="ad-text" placeholder="广告文字"/>
                    </div>
                    <div className="AdEditForm-item">
                        <label htmlFor="ad-url" className="AdEditForm-label" required>链接</label>
                        <input className="AdEditForm-input" ref="adLink" type="url" id="ad-url" placeholder="广告链接"/>
                    </div>
                    <div className="AdEditForm-item">
                        <input type="submit" className="AdEditForm-submit-btn" value="确 定" />
                    </div>
                </form>
            </div>
        )
    },

    _onSubmit(e) {
        e.preventDefault();
        e.stopPropagation();
        var adText = React.findDOMNode(this.refs.adText).value;
        var adLink = React.findDOMNode(this.refs.adLink).value;
        if (!adText || !adLink || adText.length <= 0 || adLink.length <= 0) {
            this.showHint("输入的不对，不要瞎提交！");
            return false;
        }
        var adInfo = {
            adText: adText,
            adLink: adLink
        };
        switch (adAction) {
            case adActionType.ADD_AD:
                if (adType === void 0)
                    this.showHint("不好意思，缺少参数 adType");
                ActionCreator.addAd(adType);
                break;
            case adActionType.EDIT_AD:
                if (adId === void 0)
                    this.showHint("不好意思，缺少参数 adId");
                ActionCreator.editAd(adId);
        }
    },

    showHint(msg, time) {
        time  = time === void 0 ? 10000 : time;
        this.setState({
            isShowHint: true,
            hintMsg: msg
        }, function () {
            clearTimeout(globalTimeout);
            globalTimeout = setTimeout(function() {
                this.setState({
                    isShowHint: false
                });
            }.bind(this), time);
        });
    }
});

export default AdEditForm;