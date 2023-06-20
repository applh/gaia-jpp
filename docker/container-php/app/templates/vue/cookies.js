// add setcookie function
let setCookie = function (cname, cvalue, exdays = 365) {
    // console.log("setCookie", cname, cvalue, exdays);
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    // console.log("d", d);
    var expires = "expires=" + d.toUTCString();
    // console.log("expires", expires);
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
// make setCookie available in global scope
globalThis.setCookie = setCookie;
