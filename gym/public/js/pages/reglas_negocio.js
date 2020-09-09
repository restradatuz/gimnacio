$(document).ready(function(){
    $(".timepicker-horario").timepicker({
        timeFormat: 'HH:mm:ss',
        interval: 30
    });
    $(".timepicker-tiempo").timepicker({
        timeFormat: 'HH:mm:ss',
        interval: 1,
        maxTime: '1:00am'
    });
});
