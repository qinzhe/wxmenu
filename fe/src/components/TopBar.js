/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import "./../less/topbar.less";

const TopBar = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        var menus = [];
        var key = 0;
        var currentId = this.props.currentId;
        this.props.items.forEach(function (item) {
            var tempClassName = "";
            if (++key === currentId) {
                tempClassName = "current";
            }
            menus.push(<li className={"TopBar-menu-item " + tempClassName} key={++key}><a href={item.menuLink} title={item.menuName}>{item.menuName}</a></li>);
        });
        return(
            <div className="TopBar-container">
                <div className="TopBar-inner">
                    <h1 className="TopBar-brand">微信管理后台</h1>
                    <nav className="TopBar-menu-container">
                        <ul className="TopBar-menu-list">
                            {menus}
                        </ul>
                    </nav>
                </div>
            </div>
        )
    }
});

export default TopBar;