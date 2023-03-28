$(document).ready(function () {

});

function validateEmail(input) {
    let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (input.match(validRegex)) {
        return true;
    } else {
        return false;
    }
}

function floatVal ( i ) {
    return typeof i === 'string' ?
    parseFloat(i.replace(/[\,]/g, '')) :
    typeof i === 'number' ?
    i : 0;
};

function formatNumber(x) {
    let result = "";
    let degit = "00";
    const xarray = x.split(".");
    if (xarray[1] != "" && xarray[1] != undefined) { degit = xarray[1]; }
    result = xarray[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"."+degit;

    return result;
}

function roundNotUp(num) {
    var data = 0.00;
    var with2Decimals = 0.00;
    if (!isNaN(num) && num != 0) {
        with2Decimals = num.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
        data = with2Decimals;
    }
    return data.toString();
}

function formatDatetoDB(date) { //   DD/MM/YYYY => YYYY-MM-DD
    let newdate = date.split("/").reverse().join("-");
    return newdate.toString();
}

function formatTimetoPage(time) { //  00:00:00 => 00:00
    let newtime = time.split(":")
    let timeF = newtime[0]+":"+newtime[1];
    return timeF.toString();
}
