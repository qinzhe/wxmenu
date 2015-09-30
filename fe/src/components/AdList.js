/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import AdListItem from './AdListItem';
import "./../less/adlist.less";

const AdList = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        var menus = [];
        var key = 0;
        this.props.items.forEach(function (item) {
            menus.push(<AdListItem key={++key} adId={item.adId} adTitle={item.adTitle} adLink={item.adLink} />);
        });
        return(
            <div className="AdList-container">
                <h2 className="AdList-title">{this.props.title}</h2>
                <div className="AdList-item-container">
                    {menus}
                </div>
                <a href="javascript:" className="AdList-control-add" onClick={this._onClick}>新 增</a>
            </div>
        )
    },

    _onClick(e) {

    }
});

export default AdList;