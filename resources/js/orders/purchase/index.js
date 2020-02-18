$(function(){
    $("#expectReceived_at").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        maxDate: new Date,
    });

    var myDate = new Date();
    var date = myDate.getFullYear() + '-' + ('0'+ (myDate.getMonth() + 1) ).slice(-2) + '-' + ('0'+ myDate.getDate()).slice(-2);
    $("#expectReceived_at").val(date);
});