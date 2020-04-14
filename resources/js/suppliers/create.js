$(function(){
    $('#companyAddress_twzipcode').twzipcode({
        'readonly': true
    });

    $('#monthlyCheck').change(function (e) {
        if ($(this).prop("checked")) {
            $('#monthlyCheckDate').val(0);
            $('#monthlyCheckDate').attr('disabled', true);
        } else {
            $('#monthlyCheckDate').val(0);
            $('#monthlyCheckDate').attr('disabled', false);
        }
    });

    $('#isSameAsName').click(function (e) {
        if ($(this).prop("checked")) {
            $('#bank_account_name').val($('#name').val());
        } else {
            $('#bank_account_name').val('');
        }
    });
});