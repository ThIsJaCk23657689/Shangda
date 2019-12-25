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
});