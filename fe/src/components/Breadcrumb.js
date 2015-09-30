/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import BreadcrumbItem from "./BreadcrumbItem.js"
import "./../less/breadcrumb.less";

const Breadcrumb = React.createClass({
    getInitialState() {
        return {};
    },

    render() {
        var breadcrumbList = [];
        var k = 0;
        this.props.children.forEach(function (child) {
            breadcrumbList.push(child);
            if (++k !== this.props.children.length) {
                breadcrumbList.push(<span>/</span>);
            }
        }.bind(this));
        return (
            <div className="Breadcrumb-container">
                {breadcrumbList}
            </div>
        )
    }
});

export default Breadcrumb;