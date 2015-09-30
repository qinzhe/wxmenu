/**
 * Created by aaron on 15/9/18.
 */
import React from 'react';
import WxMenuListItem from './WxMenuListItem';
import "./../less/wxmenulist.less";

const WxMenuList = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        var list = [];
        var key = 0;
        this.props.items.map(function (item) {
            list.push(<WxMenuListItem key={++key} wxMenuId={item.wxMenuId} wxMenuName={item.wxMenuName}
                                      wxMenuType={item.wxMenuType} wxMenuKeyOrUrl={item.wxMenuKeyOrUrl}/>);
        });
        return (
            <div className="WxMenuList-container" id="columns">
                <div className="WxMenuList-item-container column" draggable="true">
                    {list}
                </div>
            </div>
        )
    }
});

export default WxMenuList;