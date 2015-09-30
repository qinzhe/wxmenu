/**
 * Created by zhco on 15/9/14.
 */
exports.get = function(url, params, cb) {
    if (params !== null && params !== {}) {
        var tempParam = [];
        for (var name in params) {
            if (params.hasOwnProperty(name)) {
                tempParam.push(name + '=' + encodeURIComponent(params[name]));
            }
        }
        url += (url.indexOf("?") > -1 ? "&" : "?") + tempParam.join("&");
    }
    exports.send(url, 'GET', null, cb);
};

exports.post = function(url, params, cb) {
    exports.send(url, 'POST', params, cb);
};

exports.send = function(url, method, params, cb) {
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            var data = xhr.responseText;
            try {
                data = JSON.parse(data);
            } catch (exc) {
            }
            if (cb) {
                cb(data);
            }
        }
    };

    var body;
    if (params) {
        var bodies = [];
        for (var name in params) {
            if (params.hasOwnProperty(name)) {
                bodies.push(name + '=' + encodeURIComponent(params[name]));
            }
        }

        body = bodies.join('&');
        if (body.length) {
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        }
    }

    xhr.send(body);
};