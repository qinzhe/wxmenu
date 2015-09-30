/**
 * Created by aaron on 15/9/18.
 */
import React from 'react';
import Constants from "./../constants/Constants";
import WxMenuActionCreator from "./../actions/WxMenuActionCreator";
import WxMenuStateStore from "./../stores/WxMenuStateStore";
import "./../less/wxmenulistitem.less";

var WxMenuStateType = Constants.WxMenuState;

const WxMenuListItem = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        var isShow = "hidden";
        if(this.props.wxMenuType == "sub"){
            isShow = "show";
        }else{
            isShow = "hidden";
        }
        return (
            <div className="WxMenuItem-container">
                <div className="WxMenuItem-text" onClick={this.handleMainEdit}>{this.props.wxMenuName}</div>
                <div className={"WxMenuItem-control-container "+isShow}>
                    <a className="WxMenuItem-control WxMenuItem-control-mod" onClick={this.handleEdit}>编辑子菜单</a>
                </div>
            </div>
        )
    },

    handleMainEdit() {
        WxMenuActionCreator.showMainWxMenu(this.props.wxMenuId);
    },

    handleEdit(){
        WxMenuActionCreator.showWxMenu(this.props.wxMenuId);
    }
});

export default WxMenuListItem;