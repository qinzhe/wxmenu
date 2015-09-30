/**
 * Created by aaron on 15/9/18.
 */
import React from 'react';
import Constants from "./../constants/Constants";
import WxMenuActionCreator from "./../actions/WxMenuActionCreator";
import WxMenuStateStore from "./../stores/WxMenuStateStore";
import "./../less/wxmenuedit.less";

var WxMenuStateType = Constants.WxMenuState;

const WxMenuEdit = React.createClass({
    getInitialState(){
        return {
            mainid: "0",
            subid: "0",
            wxMenuName: null,
            wxMenuKeyOrUrl: null,
            showKeyOrUrl: "init",
            saveshow: "hidden"
        };
    },

    componentDidMount() {
        WxMenuStateStore.addChangeListener(this.handleWxMenuStateChange);
    },

    render(){
        var edit = [];
        var key = 0;
        var wxMenuSubId = this.state.subid;
        var wxMenuMainid = this.state.mainid;
        var showKeyOrUrl = this.state.showKeyOrUrl;
        var isShow = "hidden";
        var isMain = "show";
        var noMain = "show";
        var keyorurlshow = "show";
        var handleChangeName = this.handleChangeName;
        var handleChangeType = this.handleChangeType;
        var handleChangeKeyOrUrl = this.handleChangeKeyOrUrl;
        var wxMenuNameInit = this.state.wxMenuName;
        var wxMenuKeyOrUrlInit = this.state.wxMenuKeyOrUrl;
        this.props.items.map(function (item) {
            if(showKeyOrUrl === "init"){
                if(item.wxMenuType === "sub"){
                    keyorurlshow = "hidden";
                }else{
                    keyorurlshow = null;
                }
            }else{
                keyorurlshow = null;
            }
            if (item.wxMenuId === wxMenuMainid) {
                isShow = "show";
                isMain = "show";
                noMain = "hidden";
            } else if (item.wxMenuId.split(".")[0] === wxMenuSubId && item.wxMenuId.split(".")[1] != null) {
                isShow = "show";
                isMain = "hidden";
                noMain = "show";
            } else {
                isShow = "hidden";
                isMain = "hidden";
                noMain = "hidden";
            }
            var wxMenuName = wxMenuNameInit ? wxMenuNameInit : item.wxMenuName;
            var wxMenuKeyOrUrl = wxMenuKeyOrUrlInit ? wxMenuKeyOrUrlInit : item.wxMenuKeyOrUrl;
            edit.push(<div className={"input "+isShow} key={++key} id={key}>
                <input type="text" onChange={handleChangeName} defaultValue={wxMenuName} ref={"name"+wxMenuSubId+key}/>
                <select onChange={handleChangeType} defaultValue={item.wxMenuType} ref={"type"+wxMenuSubId+key}>
                    <option value="" className={noMain} >空</option>
                    <option value="sub" className={isMain}>二级菜单入口</option>
                    <option value="click">命令</option>
                    <option value="view">网页</option>
                </select>
                <input type="text" onChange={handleChangeKeyOrUrl} defaultValue={wxMenuKeyOrUrl}
                       ref={"keyorurl"+wxMenuSubId+key} className={keyorurlshow+" "+showKeyOrUrl}/>
                <input type="hidden" defaultValue={item.wxMenuId} ref={"id"+wxMenuSubId+key}/>
            </div>);
        });
        return (
            <div className="wxMenuEdit-container">
                <div className="input">
                    <span>名称</span>
                    <span>类型</span>
                    <span>命令或链接</span>
                </div>
                <form action="post" method="" name="myform">
                    {edit}
                    <div className={"save "+this.state.saveshow}>
                        <div onClick={this.handleSave}>保存</div>
                    </div>
                </form >
            </div>
        )
    },

    handleChangeName: function (event) {
        this.setState({wxMenuName: event.target.value});
    },
    handleChangeType: function (event) {
        if (event.target.value === "sub") {
            this.setState({showKeyOrUrl: "hidden"});
        } else {
            this.setState({showKeyOrUrl: null});
        }
    },
    handleChangeKeyOrUrl: function (event) {
        this.setState({wxMenuKeyOrUrl: event.target.value});
    },

    handleSave: function (event) {
        event.preventDefault();
        var wxMenuSubId = this.state.subid;
        var wxMenuMainId = this.state.mainid;
        var wxMenuJson = {};
        switch (wxMenuMainId) {
            case "1":
                wxMenuJson = {
                    wxMenuName: this.refs.name016.getDOMNode().value,
                    wxMenuType: this.refs.type016.getDOMNode().value,
                    wxMenuKeyOrUrl: this.refs.keyorurl016.getDOMNode().value
                };
                break;
            case "2":
                wxMenuJson = {
                    wxMenuName: this.refs.name017.getDOMNode().value,
                    wxMenuType: this.refs.type017.getDOMNode().value,
                    wxMenuKeyOrUrl: this.refs.keyorurl017.getDOMNode().value
                };
                break;
            case "3":
                wxMenuJson = {
                    wxMenuName: this.refs.name018.getDOMNode().value,
                    wxMenuType: this.refs.type018.getDOMNode().value,
                    wxMenuKeyOrUrl: this.refs.keyorurl018.getDOMNode().value
                };
                break;
            case "0":
                switch (wxMenuSubId) {
                    case "1":
                        wxMenuJson = [{
                            wxMenuName: this.refs.name11.getDOMNode().value,
                            wxMenuType: this.refs.type11.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl11.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name12.getDOMNode().value,
                            wxMenuType: this.refs.type12.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl12.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name13.getDOMNode().value,
                            wxMenuType: this.refs.type13.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl13.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name14.getDOMNode().value,
                            wxMenuType: this.refs.type14.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl14.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name15.getDOMNode().value,
                            wxMenuType: this.refs.type15.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl15.getDOMNode().value
                        }];
                        break;
                    case "2":
                        wxMenuJson = [{
                            wxMenuName: this.refs.name26.getDOMNode().value,
                            wxMenuType: this.refs.type26.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl26.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name27.getDOMNode().value,
                            wxMenuType: this.refs.type27.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl27.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name28.getDOMNode().value,
                            wxMenuType: this.refs.type28.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl28.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name29.getDOMNode().value,
                            wxMenuType: this.refs.type29.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl29.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name210.getDOMNode().value,
                            wxMenuType: this.refs.type210.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl210.getDOMNode().value
                        }];
                        break;
                    case "3":
                        wxMenuJson = [{
                            wxMenuName: this.refs.name311.getDOMNode().value,
                            wxMenuType: this.refs.type311.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl311.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name312.getDOMNode().value,
                            wxMenuType: this.refs.type312.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl312.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name313.getDOMNode().value,
                            wxMenuType: this.refs.type313.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl313.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name314.getDOMNode().value,
                            wxMenuType: this.refs.type314.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl314.getDOMNode().value
                        }, {
                            wxMenuName: this.refs.name315.getDOMNode().value,
                            wxMenuType: this.refs.type315.getDOMNode().value,
                            wxMenuKeyOrUrl: this.refs.keyorurl315.getDOMNode().value
                        }];
                        break;
                    default :
                        wxMenuJson = {};
                        break;
                }
                break;
            default :
                wxMenuJson = {};
                break;
        }
        if(window.confirm('确定保存？')) {
            WxMenuActionCreator.saveWxMenu(wxMenuMainId, wxMenuSubId, JSON.stringify(wxMenuJson));
        }
    },

    handleWxMenuStateChange(payloads) {
        if (!payloads || !payloads.wxMenuId)
            return false;
        if (payloads.WxMenuState === WxMenuStateType.SHOW_MAIN_SUCC) {
            this.setState({mainid: payloads.wxMenuId});
            this.setState({subid: "0"});
            this.setState({saveshow: "show"});
            this.setState({showKeyOrUrl: "init"});
        } else {
            this.setState({subid: payloads.wxMenuId});
            this.setState({mainid: "0"});
            this.setState({saveshow: "show"});
            this.setState({showKeyOrUrl: "init"});
        }
    }
});

export default WxMenuEdit;