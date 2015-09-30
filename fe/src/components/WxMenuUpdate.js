/**
 * Created by aaron on 15/9/24.
 */
import React from 'react';
import Ajax from "./../utils/AjaxUtil";
import Constants from "./../constants/Constants";
import WxMenuActionCreator from "./../actions/WxMenuActionCreator";
import WxMenuStateStore from "./../stores/WxMenuStateStore";
import "./../less/wxmenuupdate.less";

const WxMenuUpdate = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        return (
            <div className="WxMenuUpdate-container" onClick={this.handleWxMenuUpdate}>更新</div>
        )
    },

    handleWxMenuUpdate() {
        if(window.confirm('确定更新？')) {
            WxMenuActionCreator.updateWxMenu();
        }
    }
});

export default WxMenuUpdate;