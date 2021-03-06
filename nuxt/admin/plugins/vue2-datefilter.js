import Vue from 'vue'
import moment from 'moment'

Vue.filter('format-date', function (value) {
    const date = moment(value);
    return date.format("YYYY.MM.DD");
})

Vue.filter('date', function (value) {
    const date = moment(value);
    return date.format("YYYY/MM/DD");
})