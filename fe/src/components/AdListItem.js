/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import Ajax from "./../utils/AjaxUtil";
import Constants from "./../constants/Constants";
import ActionCreator from "./../actions/ActionCreator";
import AdStateStore from "./../stores/AdStateStore";
import "./../less/adlistitem.less";

var adEditUrl = "/adedit.html";
var CHANGE_EVENT = "change_event";
var adStateType = Constants.AdState;

const AdListItem = React.createClass({
    getInitialState() {
        return {
            isShow: true
        };
    },

    componentDidMount() {
        AdStateStore.addChangeListener(this.handleAdStateChange);
    },

    render() {
        var className = this.state.isShow ? "show" : "";
        return(
            <div className={"AdListItem-container " + className} title={this.props.adTitle} onClick={this._onClick}>
                <div className="AdListItem-text">{this.props.adTitle}</div>
                <div className="AdListItem-control-container">
                    <a href={this.props.adLink} target="_blank" className="AdListItem-control AdListItem-control-visit">访问</a>
                    <a href={adEditUrl + "?adId=" + this.props.adId} className="AdListItem-control AdListItem-control-mod">编辑</a>
                    <a href="javascript:" className="AdListItem-control AdListItem-control-del" onClick={this.handleDel}>删除</a>
                </div>
            </div>
        )
    },

    handleDel(e) {
        if (window.confirm("确定要删除这条广告嘛？")) {
            ActionCreator.delAd(this.props.adId);
        }
    },

    handleAdStateChange(payloads) {
        if (!payloads || !payloads.adId)
            return false;
        if (payloads.adId !== this.props.adId)
            return false;
        if (payloads.adState === adStateType.DEL_FAIL)
            return false;
            this.setState({isShow: false});
    }
});

export default AdListItem;