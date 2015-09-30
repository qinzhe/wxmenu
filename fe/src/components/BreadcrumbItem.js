/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import "./../less/breadcrumbitem.less";

const BreadcrumbItem = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        return this.props.href ?
            <a className="BreadcrumbItem" href={this.props.href}>{this.props.children}</a> :
            <span className="BreadcrumbItem">{this.props.children}</span>;
    }
});

export default BreadcrumbItem;