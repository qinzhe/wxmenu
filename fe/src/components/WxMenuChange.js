/**
 * Created by aaron on 15/9/30.
 */
import React from 'react';
import "./../less/wxmenuchange.less";

const WxMenuChange = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        return (
            <div className="WxMenuChange-container" onClick={this.handleWxMenuPreview}>切换</div>
        )
    },

    handleWxMenuPreview() {
        window.location.href = "/wxmenu_manage/zy";
    }
});

export default WxMenuChange;