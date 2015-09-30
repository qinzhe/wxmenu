/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import TopBar from './TopBar';
import TabMenu from './TabMenu';
import AdList from './AdList';
import "./../less/adlistpage.less";

const AdListPage = React.createClass({
    getInitialState() {
        return {}
    },

    render() {
        return (
            <div>
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
                <AdList type="tuwenLink" title="图文广告" items={[
                    {
                        adId: 1,
                        adTitle: "今天我们都是微派人",
                        adLink: "http://www.wgame.weapp.me"
                    },
                    {
                        adId: 2,
                        adTitle: "马总说了：不要把用户体验当成实习生的练兵场",
                        adLink: "http://www.wgame.weapp.me"
                    }
                ]} />
                <AdList type="textLink" title="文字广告" items={[
                    {
                        adId: 1,
                        adTitle: "今天我们都是微派人",
                        adLink: "http://www.wgame.weapp.me"
                    },
                    {
                        adId: 2,
                        adTitle: "马总说了：不要把用户体验当成实习生的练兵场",
                        adLink: "http://www.wgame.weapp.me"
                    }
                ]} />
            </div>
        )
    }
});

export default AdListPage;