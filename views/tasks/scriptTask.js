function XmlHttp() {
    var xmlhttp;
    try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); }
    catch (e) {
        try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
        catch (E) { xmlhttp = false; }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}


function ajax(param) {
    if (window.XMLHttpRequest) req = new XmlHttp();
    method = (!param.method ? "POST" : param.method.toUpperCase());
    if (method == "GET") {
        send = null;
        param.url = param.url + "&ajax=true";
    }
    else {
        send = "";
        for (var i in param.data) send += i + "=" + param.data[i] + "&";
        send = send + "ajax=true";
    }

    req.open(method, param.url, true);
    console.log(send);
    if (param.statbox) {
        document.getElementById(param.statbox).innerHTML = '<div class="spinner-border id="spinner" text-success" role="status"><span class="sr-only">Loading...</span></div>';
    }
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    console.log(send);
    req.send(send);
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) { //если ответ положительный
            if (param.success) {
                param.success(req.responseText);
            }
        }
    }
}

function changeStatus(event) {
    let target = event.target || event.srcElement;
    console.log(target);
}
