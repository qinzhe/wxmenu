/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import AdEditForm from './AdEditForm';
import TopBar from './TopBar';
import URLUtil from './../utils/URLUtil';
import "./../less/adeditpage.less";

const AdEditPage = React.createClass({
    getInitialState() {
        return {}
    },

    render() {
        return (
            <div className="AdEditPage-container">
                <TopBar currentId={1} items={[
                    {
                        menuLink: "/adList.html",
                        menuName: "广告系统"
                    },
                    {
                        menuLink: "/adList.html",
                        menuName: "占位占位"
                    },
                    {
                        menuLink: "/adList.html",
                        menuName: "占位占位占位"
                    },
                    {
                        menuLink: "/wxMenu.html",
                        menuName: "自定义菜单"
                    }
                ]}/>
                <AdEditForm title="修改广告" adId={1} />
            </div>
        )
    }
});

export default AdEditPage;