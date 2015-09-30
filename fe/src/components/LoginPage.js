/**
 * Created by zhco on 15/9/11.
 */
import React from 'react';
import "./../less/loginform.less";

const LoginForm = React.createClass({
    getInitialState() {
        return {}
    },

    render() {
        return(
            <form className="LoginForm-form ant-form-horizontal">
                <h2 className="LoginForm-title">欢迎来到宇宙背面</h2>
                <div className="ant-form-item">
                    <label htmlFor="userName" className="col-6" required>用户名：</label>
                    <div className="col-14">
                        <input className="ant-input ant-input-lg" type="text" id="username" placeholder="请输入用户名"/>
                    </div>
                </div>
                <div className="ant-form-item">
                    <label htmlFor="password" className="col-6" required>密码：</label>
                    <div className="col-14">
                        <input className="ant-input ant-input-lg" type="password" id="password" placeholder="请输入密码"/>
                    </div>
                </div>
                <div className="row">
                    <div className="col-offset-6">
                        <input type="submit" className="ant-btn ant-btn-primary ant-btn-lg" value="确 定" />
                    </div>
                </div>
            </form>
        )
    }
});

export default LoginForm;