$(function () {

    $('#individual_btn').click(function(e){
        $('#individual_form').slideDown();
        $('#individual_btn').attr('disabled', true);
        $('#company_btn').attr('disabled', true);
        $('#step1').slideUp();
        $('#goback2step1').slideDown();
        $('#individual_act').focus();
    });

    $('#company_btn').click(function(e){
        $('#company_form').slideDown();
        $('#individual_btn').attr('disabled', true);
        $('#company_btn').attr('disabled', true);
        $('#step1').slideUp();
        $('#goback2step1').slideDown();
    });

    $('#goback2step1_btn').click(function(e){
        $('#individual_form').slideUp();
        $('#company_form').slideUp();
        $('#individual_btn').attr('disabled', false);
        $('#company_btn').attr('disabled', false);
        $('#step1').slideDown();
        $('#goback2step1').slideUp();
    });

    $("#individual_birthday").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        yearRange: "-80:+0",
        maxDate: '-15y',
    });

    $('#individual_monthlyCheck').change(function (e) {
        if ($(this).prop("checked")) {
            $('#individual_monthlyCheckDate').val(0);
            $('#individual_monthlyCheckDate').attr('disabled', true);
        } else {
            $('#individual_monthlyCheckDate').val(0);
            $('#individual_monthlyCheckDate').attr('disabled', false);
        }
    });

    $('#company_monthlyCheck').change(function (e) {
        if ($(this).prop("checked")) {
            $('#company_monthlyCheckDate').val(0);
            $('#company_monthlyCheckDate').attr('disabled', true);
        } else {
            $('#company_monthlyCheckDate').val(0);
            $('#company_monthlyCheckDate').attr('disabled', false);
        }
    });

    $('#individual_address_twzipcode').twzipcode({
        'readonly': true
    });

    $('#company_address_twzipcode').twzipcode({
        'readonly': true
    });

    $('#company_deliveryAddress_twzipcode').twzipcode({
        'readonly': true
    });

    $('#individual_picture').change(function(){
        let input = $(this)[0];
        readURL(input, 'individual');
    });

    $('#company_picture').change(function(){
        let input = $(this)[0];
        readURL(input, 'company');
    });

    function readURL(input, type) {
        if(type == 'individual'){
            if (input.files && input.files[0]) {
                $('#individual_preview-upload').fadeIn();
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#individual_previewImg-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }else{
            if (input.files && input.files[0]) {
                $('#company_preview-upload').fadeIn();
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#company_previewImg-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    }

    $('input[name=individual_phone],input[name=individual_tel]').on('input', function () {
        // Set the required property of the other input to false if this input is not empty.
        $('input[name=individual_phone],input[name=individual_tel]').not(this).prop('required', !$(this).val().length);
    });

    $('input[name=company_operator_phone],input[name=company_operator_tel]').on('input', function () {
        // Set the required property of the other input to false if this input is not empty.
        $('input[name=company_operator_phone],input[name=company_operator_tel]').not(this).prop('required', !$(this).val().length);
    });

    $('#company_taxID').change(function(e){
        $taxID = $(this).val();
        if($taxID != ""){
            re = /^[0-9]{8}$/;
            if(re.test($taxID)){

                $.ajax({
                    url: 'http://localhost/Shangda/public/backend/consumers/taxID/' + $taxID + '/getData',
                    type: 'GET',
                    dataType: 'json',
                    success(response, textStatus){
                        console.log({response, textStatus});
                    },
                    error(XMLHttpRequest, textStatus, errorThrown){
                        console.log({XMLHttpRequest, textStatus, errorThrown});
                    }
                });

            }else{
                // 失敗
                alert('請輸入正確格式的統一編號。');
                $(this).val('');
            }
        }
    });


    // $('#copycompany1').click(function (e) {
    //     if ($(this).prop("checked")) {
    //         $('#deliveryAddress').val($('#companyAddress').val());
    //     } else {
    //         $('#deliveryAddress').val('');
    //     }
    // });

    // $('#copycompany2').click(function (e) {
    //     if ($(this).prop("checked")) {
    //         $('#invoiceAddress').val($('#companyAddress').val());
    //     } else {
    //         $('#invoiceAddress').val('');
    //     }
    // });
});