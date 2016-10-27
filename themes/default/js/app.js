$(document).ready(function () {
    $('.nav-time > span.time').text(moment().format('HH:mm'))
    $('.nav-time > span.date').text(moment().format('dddd, Do MMMM YYYY'))
    setInterval(function () {
        if ($('.nav-time > span.time').text().indexOf(':') > -1) {
            $('.nav-time > span.time').text(moment().format('HH mm'))
        }
        else {
            $('.nav-time > span.time').text(moment().format('HH:mm'))
        }
        $('.nav-time > span.date').text(moment().format('dddd, Do MMMM YYYY'))
    }, 1000)
})