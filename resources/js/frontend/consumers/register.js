$(function() {

    $('#individual_btn').click(function(e) {
        $('#individual_form').slideDown();
        $('#individual_btn').attr('disabled', true);
        $('#company_btn').attr('disabled', true);
        $('#step1').slideUp();
        $('#goback2step1').slideDown();
        $('#individual_act').focus();
    });

    $('#company_btn').click(function(e) {
        $('#company_form').slideDown();
        $('#individual_btn').attr('disabled', true);
        $('#company_btn').attr('disabled', true);
        $('#step1').slideUp();
        $('#goback2step1').slideDown();
    });

    $('#goback2step1_btn').click(function(e) {
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

    $('#individual_monthlyCheck').change(function(e) {
        if ($(this).prop("checked")) {
            $('#individual_monthlyCheckDate').val(0);
            $('#individual_monthlyCheckDate').attr('disabled', true);
        } else {
            $('#individual_monthlyCheckDate').val(0);
            $('#individual_monthlyCheckDate').attr('disabled', false);
        }
    });

    $('#company_monthlyCheck').change(function(e) {
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

    $('#individual_picture').change(function() {
        let input = $(this)[0];
        readURL(input, 'individual');
    });

    $('#company_picture').change(function() {
        let input = $(this)[0];
        readURL(input, 'company');
    });

    function readURL(input, type) {
        if (type == 'individual') {
            if (input.files && input.files[0]) {
                $('#individual_preview-upload').fadeIn();
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#individual_previewImg-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        } else {
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

    $('input[name=individual_phone],input[name=individual_tel]').on('input', function() {
        // Set the required property of the other input to false if this input is not empty.
        $('input[name=individual_phone],input[name=individual_tel]').not(this).prop('required', !$(this).val().length);
    });

    $('input[name=company_operator_phone],input[name=company_operator_tel]').on('input', function() {
        // Set the required property of the other input to false if this input is not empty.
        $('input[name=company_operator_phone],input[name=company_operator_tel]').not(this).prop('required', !$(this).val().length);
    });

    $('#company_taxID').change(function(e) {

        // 分公司欄位設定為非必填，且disabled開啟，必填星號消失。
        $('#branch_label').addClass('text-muted');
        $('#company_branch').attr('disabled', true);
        $('#company_branch').attr('required', false);
        $('#branch_required_tag').fadeOut();

        // 清空資料
        $('#company_taxID_type').val('');
        $('#company_name').val('');
        $('#company_principal').val('');

        $taxID = $(this).val();
        if ($taxID != "") {
            re = /^[0-9]{8}$/;
            if (re.test($taxID)) {

                $.ajax({
                    url: 'http://localhost/Shangda/public/backend/consumers/taxID/' + $taxID + '/getData',
                    type: 'GET',
                    dataType: 'json',
                    success(response, textStatus) {

                        switch (response.status) {
                            case "4":
                                // 抓取api資料時出錯。
                                alert(response.msg);
                                console.log(response.result);

                                break;
                            case "3":
                                // 如果統編是公司類型的話

                                // 自動填上統編類型、公司名稱、負責人名稱
                                $('#company_taxID_type').val(response.type);
                                $('#company_name').val(response.result['0'].Company_Name);
                                $('#company_principal').val(response.result['0'].Responsible_Name);

                                break;
                            case "2":
                                // 如果統編是分公司類型的話

                                // 分公司欄位設定為必填，且disabled關閉，必填星號出現。
                                $('#branch_label').removeClass('text-muted');
                                $('#company_branch').attr('disabled', false);
                                $('#company_branch').attr('required', true);
                                $('#branch_required_tag').fadeIn();

                                // 由於目前無法抓取分公司統編資料，所以不自動填上資料了
                                $('#company_taxID_type').val(response.type);

                                break;
                            case "1":
                                // 如果統編是商業類型的話

                                // 由於目前無法抓取商業統編資料，所以不自動填上資料了
                                $('#company_taxID_type').val(response.type);

                                break;
                            default:
                                // 如果統編為無效的話
                                alert('查無此統編相關資料，無法使用此統編進行註冊。');
                                $('#company_taxID').val('');

                                break;
                        }
                        console.log(response);
                    },
                    error(XMLHttpRequest, textStatus, errorThrown) {
                        console.log({ XMLHttpRequest, textStatus, errorThrown });
                    }
                });

            } else {
                // 失敗
                alert('請輸入正確格式的統一編號。');
                $(this).val('');
            }
        }
    });


    $('#isSameAsPrincipal').click(function(e) {
        if ($(this).prop("checked")) {
            $('#company_operator_name').val($('#company_principal').val());
        } else {
            $('#company_operator_name').val('');
        }
    });

    $('#isSameAsComTel').click(function(e) {
        if ($(this).prop("checked")) {
            $('#company_operator_tel').val($('#company_tel').val());
        } else {
            $('#company_operator_tel').val('');
        }
    });

    $('#isSameAsComEmail').click(function(e) {
        if ($(this).prop("checked")) {
            $('#company_operator_email').val($('#company_email').val());
        } else {
            $('#company_operator_email').val('');
        }
    });

    $('#isSameAsComAddress').click(function(e) {
        if ($(this).prop("checked")) {
            $zipcode = $('#company_address_twzipcode').twzipcode('get', 'zipcode');
            $('#company_deliveryAddress_twzipcode').twzipcode('set', $zipcode[0]);
            $('#company_deliveryAddress_others').val($('#company_address_others').val());
        } else {
            $('#company_deliveryAddress_twzipcode').twzipcode('reset');
            $('#company_deliveryAddress_others').val('');
        }
    });
});