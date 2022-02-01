import Vue from 'vue'
const linkify = require('linkifyjs');
const linkifyHtml = require('linkifyjs/html');

Vue.filter('toLowercase', function (value) {
    return value.toLowerCase();
})

Vue.filter('toUppercase', function (value) {
    return value.toUpperCase();
})

Vue.filter('number_format', function (value) {
    return value.toString().replace(/(\d)(?=(\d{3})+$)/g, '$1,');
})

Vue.filter('date_format', function (value) {
    const date = new Date(value.replace(/-/g,"/"))
    return date.getFullYear() + '年' + ("00" + ( date.getMonth()+1 )).slice(-2) + '月' + ("00" + ( date.getDate() )).slice(-2) + '日'
})


Vue.filter('datetime_format', function (value) {
    const date = new Date(value.replace(/-/g,"/"))
    return date.getFullYear() + '年' + ("00" + ( date.getMonth()+1 )).slice(-2) + '月' + ("00" + ( date.getDate() )).slice(-2) + '日 '
     + ("00" + ( date.getHours() )).slice(-2) + ':' + ("00" + ( date.getMinutes() )).slice(-2) 
})

Vue.filter('prepend_yen', function (value) {
    return '¥' + value;
})

Vue.filter('digit', function (num) {
    if(num == undefined){
        return num
    }
    const si = [
        { value: 1, symbol: "" },
        { value: 1E3, symbol: "K" },
        { value: 1E6, symbol: "M" },
        { value: 1E9, symbol: "G" },
        { value: 1E12, symbol: "T" },
        { value: 1E15, symbol: "P" },
        { value: 1E18, symbol: "E" }
    ];
    const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
    let i;
    for (i = si.length - 1; i > 0; i--) {
        if (num >= si[i].value) {
            break;
        }
    }
    if(i == 0){
        return num.toString().replace(/(\d)(?=(\d{3})+$)/g, '$1,')
    }
    return (num / si[i].value).toFixed(1).replace(rx, "$1") + si[i].symbol;
})

Vue.filter('linkify', (value) => {
    return linkifyHtml(value, {defaultProtocol: 'https',target: {url: '_blank'},})
});
Vue.filter('escape', (value) => {
    return (value + '')
        .replace(/&/g,'&amp;')
        .replace(/"/g,'&quot;')
        .replace(/'/g,'&#039;')
        .replace(/</g,'&lt;')
        .replace(/>/g,'&gt;'); 
});

Vue.filter('nl2br', value => value.replace(/\n/g, '<br>'));