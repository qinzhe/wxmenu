/**
 * Created by aaron on 15/9/18.
 */
import React from 'react';
import TopBar from './TopBar';
import WxMenuList from './WxMenuList';
import WxMenuEdit from './WxMenuEdit';
import WxMenuUpdate from './WxMenuUpdate';
import WxMenuPreview from './WxMenuPreview';
import Ajax from './../utils/AjaxUtil';
import Constants from "./../constants/Constants";
import WxMenuActionCreator from "./../actions/WxMenuActionCreator";
import WxMenuStateStore from "./../stores/WxMenuStateStore";

var WxMenuStateType = Constants.WxMenuState;

const WxMenuPage = React.createClass({
    getInitialState() {
        return {
            wxMenuEdit: [],
            wxMenuList: []
        }
    },

    componentDidMount() {
        Ajax.get("/wxmenu_manage/show_wxmenu", [], function (result) {
            this.setState({
                wxMenuEdit: result.edit,
                wxMenuList: result.list
            });
        }.bind(this));
    },

    render() {
        return (
            <div>
                <TopBar currentId={1} items={[
                    {
                        menuLink: "",
                        menuName: "广告系统"
                    },
                    {
                        menuLink: "",
                        menuName: "占位占位"
                    },
                    {
                        menuLink: "",
                        menuName: "占位占位占位"
                    },
                    {
                        menuLink: "/wxmenu_manage/index?wechat=zy",
                        menuName: "桌游助手菜单"
                    },
                    {
                        menuLink: "/wxmenu_manage/index?wechat=fq",
                        menuName: "番茄游戏菜单"
                    }
                ]}/>
                <WxMenuEdit type="wxSubMenu" items={this.state.wxMenuEdit}/>
                <WxMenuList type="wxMenu" items={this.state.wxMenuList}/>
                <WxMenuPreview />
                <WxMenuUpdate />
            </div>
        )
    },
});

export default WxMenuPage;