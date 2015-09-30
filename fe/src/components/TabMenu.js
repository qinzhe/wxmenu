/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import TabMenuItem from './TabMenuItem';
import "./../less/tabmenu.less";

const TabMenu = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        var menus = [];
        var key = 0;
        this.props.items.forEach(function (item) {
            menus.push(<TabMenuItem key={++key} tabId={item.tabId} tabName={item.tabName} />);
        });
        return(
            <div className="TabMenu-container">
                {menus}
            </div>
        )
    }
});

export default TabMenu;