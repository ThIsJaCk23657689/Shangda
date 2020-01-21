$(function(){
    $('#copycompany1').click(function(e){   
        if($(this).prop("checked")) {
            $('#deliveryAddress').val($('#companyAddress').val());
        }else{
            $('#deliveryAddress').val('');
        }
    });

    $('#copycompany2').click(function(e){        
        if($(this).prop("checked")) {
            $('#invoiceAddress').val($('#companyAddress').val());
        }else{
            $('#invoiceAddress').val('');
        }
    });

    $('#monthlyCheck').change(function(e){
        if($(this).prop("checked")) {
            $('#monthlyCheckDate').val("");
            $('#monthlyCheckDate').attr('disabled', true);
        }else{
            $('#monthlyCheckDate').val("");
            $('#monthlyCheckDate').attr('disabled', false);
        }
    });
});