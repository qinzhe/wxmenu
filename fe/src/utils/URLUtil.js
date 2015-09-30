/**
 * Created by zhco on 15/8/4.
 */
const URLUtil = {
    getQueryParam(url, paramName) {
        var reg = new RegExp("[?&]" + paramName + "=([^?&#]*)[&#]?", "i"),
            match = url.match(reg);
        if (!match || !match[1]) {
            return "";
        }
        return decodeURIComponent(match[1]);
    }
};

export default URLUtil;