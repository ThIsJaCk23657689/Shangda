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
            $('#monthlyCheckDate').val(1);
            $('#monthlyCheckDate').attr('disabled', true);
        }else{
            $('#monthlyCheckDate').val(1);
            $('#monthlyCheckDate').attr('disabled', false);
        }
    });
});