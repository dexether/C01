var ajax = function(url, data, callback, type) {
    var data_array, data_string, idx, req, value;
    if (data == null) {
        data = {};
    }
    if (callback == null) {
        callback = function() {
        };
    }
    if (type == null) {
        //default to a GET request
        type = 'GET';
    }
    data_array = [];
    for (idx in data) {
        value = data[idx];
        data_array.push("" + idx + "=" + value);
    }
    data_string = data_array.join("&");
    req = new XMLHttpRequest();
    req.open(type, url, false);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.onreadystatechange = function() {
        if (req.readyState === 4 && req.status === 200) {
            return callback(req.responseText);
        }
    };
    req.send(data_string);
    return req;
};
var url = '../../report_equity_getdata.php?checktanggal=to';
ajax(url, {'send': true, 'lemons': 'sour'}, function(data) {
    //do something with the data like:
    self.postMessage(data);
}, 'POST');