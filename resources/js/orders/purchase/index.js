$(function() {

    $("#received_received_at").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        maxDate: new Date(),
    });

    $("#paid_paid_at").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        maxDate: new Date(),
    });

    let myDate = new Date();
    let date = myDate.getFullYear() + '-' + ('0' + (myDate.getMonth() + 1)).slice(-2) + '-' + ('0' + myDate.getDate()).slice(-2);
    $("#received_received_at").val(date);
    $("#paid_paid_at").val(date);

    $('.received-btn').click(function() {
        let purchaseID = $(this).data('id');
        let expectReceivedAt = $(this).data('expectReceivedAt');
        $("#received_purchase_id").val(purchaseID);
        $("#received_expectReceived_at").val(expectReceivedAt);
    });

    $('#ReceivedForm').submit(function(e) {
        e.preventDefault();

        let $url = $(this).attr('action');
        let $data = $(this).serializeObject();

        $.showLoadingModal();
        axios.post($url, $data).then(response => {
            // console.log(response.data);
            $.showSuccessModal(response.data.message, response.data.url);
            $('#ReceivedModal').modal('hide');
        }).catch(error => {
            $.showErrorModal(error);
            console.error('修改進貨單到貨時間時發生錯誤，錯誤訊息：' + error);
        });
    });

    $('.cancle-received-btn').click(function() {
        Swal.fire({
            title: '注意！',
            text: '您確定要取消到貨嗎？',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '確認',
            cancelButtonText: '取消',
        }).then((result) => {
            if (result.value) {
                $(this).next().submit();
            }
        });
    });

    $('.cancle-received-form').submit(function(e) {
        e.preventDefault();

        let $url = $(this).attr('action');
        let $data = $(this).serializeObject();

        $.showLoadingModal();
        axios.post($url, $data).then(response => {
            $.showSuccessModal(response.data.message, response.data.url);
        }).catch(error => {
            $.showErrorModal(error);
            console.error('取消進貨單到貨時間時發生錯誤，錯誤訊息：' + error);
        });
    });

    $('.paid-btn').click(function() {
        let purchaseID = $(this).data('id');
        $("#paid_purchase_id").val(purchaseID);
    });

    $('#PaidForm').submit(function(e) {
        e.preventDefault();

        let $url = $(this).attr('action');
        let $data = $(this).serializeObject();

        $.showLoadingModal();
        axios.post($url, $data).then(response => {
            // console.log(response.data);
            $.showSuccessModal(response.data.message, response.data.url);
            $('#PaidModal').modal('hide');
        }).catch(error => {
            $.showErrorModal(error);
            console.error('確認進貨單付清時間時發生錯誤，錯誤訊息：' + error);
        });
    });

    $('.cancle-paid-btn').click(function() {
        Swal.fire({
            title: '注意！',
            text: '您確定要取消此進貨單的付清狀態？',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '確認',
            cancelButtonText: '取消',
        }).then((result) => {
            if (result.value) {
                $(this).next().submit();
            }
        });
    });

    $('.cancle-paid-form').submit(function(e) {
        e.preventDefault();

        let $url = $(this).attr('action');
        let $data = $(this).serializeObject();

        $.showLoadingModal();
        axios.post($url, $data).then(response => {
            $.showSuccessModal(response.data.message, response.data.url);
        }).catch(error => {
            $.showErrorModal(error);
            console.error('確認或取消進貨單付清時發生錯誤，錯誤訊息：' + error);
        });
    });
});