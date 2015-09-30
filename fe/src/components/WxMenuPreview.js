/**
 * Created by aaron on 15/9/29.
 */
import React from 'react';
import "./../less/wxmenupreview.less";

const WxMenuPreview = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        return (
            <div className="WxMenuPreview-container" onClick={this.handleWxMenuPreview}>总览</div>
        )
    },

    handleWxMenuPreview() {
        window.open("/wxmenu_manage/preview_wxmenu");
    }
});

export default WxMenuPreview;