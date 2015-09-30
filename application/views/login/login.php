<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <title>桌游微信登录</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
</head>
<body>
<form method="post" action="/login/submit" class="center-block" style="width: 92%; max-width: 400px;">
    <h2>欢迎来到宇宙背面！</h2>
    <div class="form-group">
        <label for="admin-email"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Email</label>
        <input type="email" class="form-control" name="email" id="admin-email" placeholder="邮箱">
    </div>
    <div class="form-group">
        <label for="admin-pwd"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Password</label>
        <input type="password" class="form-control" name="password" id="admin-pwd" placeholder="密码">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
</body>
</html>