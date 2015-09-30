/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import "./../less/tabmenuitem.less";

const TabMenuItem = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        return(
            <span className="TabMenuItem" title={this.props.tabName} onClick={this._onClick}>{this.props.tabName}</span>
        )
    },

    _onClick(e) {
        // 改变状态，传输tabId this.props.tabId
    }
});

export default TabMenuItem;