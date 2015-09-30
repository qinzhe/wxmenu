<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <title>修改广告信息</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <h2 class="center-block">文字链广告</h2>

    <form id="txt-link-ad-form">
        <table id="txt-link-ad-table" class="table table-bordered">
            <thead>
            <tr>
                <th>文案</th>
                <th>链接</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($txt_link_ad)) {
                foreach ($txt_link_ad as $ad_item) {
                    if (!isset($ad_item["text"])) continue;
                    $checked = +$ad_item["is_active"] ? "checked" : "";
                    echo '<tr>
                    <td>
                    <div class="form-group">
                    <input type="text" class="form-control txt-link-ad-text" placeholder="文案" value="' . $ad_item["text"] . '">
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                    <input type="url" class="form-control txt-link-ad-link" placeholder="链接" value="' . $ad_item["link"] . '">
                    </div>
                    </td>
                    <td>
                    <div class="checkbox">
                    <label>
                    <input class="txt-link-ad-status" type="checkbox" ' . $checked . '> 活跃
                    </label>
                    </div>
                    </td>
                    </tr>';
                }
            }
            ?>
            </tbody>
        </table>
        <a href="javascript:" id="add-txt-link-ad" class="btn btn-default"><span class="glyphicon glyphicon-plus"
                                                                                 aria-hidden="true"></span> 添加</a>
        <button type="submit" id="submit-txt-link-ad" class="btn btn-default">Submit</button>
    </form>
    <h2 class="center-block">图文广告</h2>

    <form id="tuwen-ad-form">
        <table id="tuwen-ad-table" class="table table-bordered">
            <thead>
            <tr>
                <th>文案</th>
                <th>链接</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($tuwen_ad)) {
                foreach ($tuwen_ad as $ad_item) {
                    if (!isset($ad_item["text"])) continue;
                    $checked = +$ad_item["is_active"] ? "checked" : "";
                    echo '<tr>
                    <td>
                    <div class="form-group">
                    <input type="text" class="form-control tuwen-ad-text" placeholder="文案" value="' . $ad_item["text"] . '">
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                    <input type="url" class="form-control tuwen-ad-link" placeholder="链接" value="' . $ad_item["link"] . '">
                    </div>
                    </td>
                    <td>
                    <div class="checkbox">
                    <label>
                    <input class="tuwen-ad-status" type="checkbox" ' . $checked . '> 活跃
                    </label>
                    </div>
                    </td>
                    </tr>';
                }
            }
            ?>
            </tbody>
        </table>
        <a href="javascript:" id="add-tuwen-ad" class="btn btn-default"><span class="glyphicon glyphicon-plus"
                                                                              aria-hidden="true"></span> 添加</a>
        <button type="submit" id="submit-tuwen-ad" class="btn btn-default">Submit</button>
    </form>
    <h2 class="center-block">自定义菜单栏广告</h2>

    <form id="menu-tab-ad-form">
        <div class="form-group">
            <label for="menu-tab-ad-text">文案</label>
            <input type="text" class="form-control" id="menu-tab-ad-text" placeholder="文案" value="<?php
            echo isset($menu_tab_ad) && isset($menu_tab_ad[0]) && isset($menu_tab_ad[0]["text"]) ?
                $menu_tab_ad[0]["text"] : "" ?>">
        </div>
        <div class="form-group">
            <label for="menu-tab-ad-link">链接</label>
            <input type="text" class="form-control" id="menu-tab-ad-link" placeholder="链接" value="<?php
            echo isset($menu_tab_ad) && isset($menu_tab_ad[0]) && isset($menu_tab_ad[0]["link"]) ?
                $menu_tab_ad[0]["link"] : "" ?>">
        </div>
        <button type="submit" id="submit-menu-tab-ad" class="btn btn-default">Submit</button>
        <a href="http://zhuoyouwx.weapp.me/util/tab" id="update-wx-menu-tab" class="btn btn-default">更新自定义菜单</a>
    </form>
</div>
<script>
    $(function () {
        var mod_api_url = "http://zhuoyouwxadmin.weapp.me/ad_manage/mod_api/";
        var txt_link_ad_form = $("#txt-link-ad-form"),
            menu_tab_ad_form = $("#menu-tab-ad-form"),
            tuwen_ad_form = $("#tuwen-ad-form");
        txt_link_ad_form.on("submit", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var data = [];
            var input_elems = $("input", txt_link_ad_form);
            for (var i = 0, len = input_elems.length; i < len; i += 3) {
                if (!$(input_elems[i]).val()) {
                    continue;
                }
                data.push({
                    text: $(input_elems[i]).val(),
                    link: $(input_elems[i + 1]).val(),
                    is_active: input_elems[i + 2].checked ? 1 : 0
                });
            }
            $.post(mod_api_url, {
                target: "txt_link_ad",
                action: "update",
                ad_data: data
            }, function (data) {
                if (data == "ok") {
                    alert("更新文字链接成功");
                } else {
                    alert("更新失败");
                }
            });
        });
        tuwen_ad_form.on("submit", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var data = [];
            var input_elems = $("input", tuwen_ad_form);
            for (var i = 0, len = input_elems.length; i < len; i += 3) {
                if (!$(input_elems[i]).val()) {
                    continue;
                }
                data.push({
                    text: $(input_elems[i]).val(),
                    link: $(input_elems[i + 1]).val(),
                    is_active: input_elems[i + 2].checked ? 1 : 0
                });
            }
            $.post(mod_api_url, {
                target: "tuwen_ad",
                action: "update",
                ad_data: data
            }, function (data) {
                if (data == "ok") {
                    alert("更新图文广告成功");
                } else {
                    alert("更新失败");
                }
            });
        });
        menu_tab_ad_form.on("submit", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var menu_tab_ad_text = $("#menu-tab-ad-text").val();
            var menu_tab_ad_link = $("#menu-tab-ad-link").val();
            var data = [];
            data.push({text: menu_tab_ad_text, link: menu_tab_ad_link});
            $.post(mod_api_url, {
                target: "menu_tab_ad",
                action: "update",
                ad_data: data
            }, function (data) {
                if (data == "ok") {
                    alert("更新自定义菜单配置成功，你还需要点击「更新自定义菜单」应用这个修改");
                } else {
                    alert("更新失败");
                }
            });
        });

        var add_txt_link_ad_btn = $("#add-txt-link-ad"),
            add_tuwen_ad_btn = $("#add-tuwen-ad");
        var txt_link_ad_table = $("#txt-link-ad-table"),
            tuwen_ad_table = $("#tuwen-ad-table");
        add_txt_link_ad_btn.on("click", function (e) {
            e.stopPropagation();
            var child_elem = $('<tr>\
                    <td>\
                    <div class="form-group">\
                    <input type="text" class="form-control txt-link-ad-text" placeholder="文案">\
                    </div>\
                    </td>\
                    <td>\
                    <div class="form-group">\
                    <input type="url" class="form-control txt-link-ad-link" placeholder="链接">\
                    </div>\
                    </td>\
                    <td>\
                    <div class="checkbox">\
                    <label>\
                    <input class="txt-link-ad-status" type="checkbox"> 活跃\
                    </label>\
                    </div>\
                    </td>\
                    </tr>');
            txt_link_ad_table.append(child_elem);
        });
        add_tuwen_ad_btn.on("click", function (e) {
            e.stopPropagation();
            var child_elem = $('<tr>\
                    <td>\
                    <div class="form-group">\
                    <input type="text" class="form-control tuwen-ad-text" placeholder="文案">\
                    </div>\
                    </td>\
                    <td>\
                    <div class="form-group">\
                    <input type="url" class="form-control tuwen-ad-link" placeholder="链接">\
                    </div>\
                    </td>\
                    <td>\
                    <div class="checkbox">\
                    <label>\
                    <input class="tuwen-ad-status" type="checkbox"> 活跃\
                    </label>\
                    </div>\
                    </td>\
                    </tr>');
            tuwen_ad_table.append(child_elem);
        });
    });
</script>
</body>
</html>