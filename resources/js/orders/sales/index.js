$(function() {
    $("#delivered_delivered_at").datepicker({
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
    $("#delivered_delivered_at").val(date);
    $("#paid_paid_at").val(date);

    $('.delivered-btn').click(function() {
        let salesID = $(this).data('id');
        let expectDeliveredAt = $(this).data('expectDeliveredAt');

        $("#delivered_sales_id").val(salesID);
        $("#delivered_expectDelivered_at").val(expectDeliveredAt);
    });

    $('.cancle-delivered-btn').click(function() {
        Swal.fire({
            title: '注意！',
            text: '您確定要取消出貨嗎？',
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

    $('.cancle-delivered-form').submit(function(e) {
        e.preventDefault();

        let $url = $(this).attr('action');
        let $data = $(this).serializeObject();

        $.showLoadingModal();
        axios.post($url, $data).then(response => {
            $.showSuccessModal(response.data.message, response.data.url);
        }).catch(error => {
            $.showErrorModal(error);
            console.error('取消銷貨單出貨時間時發生錯誤，錯誤訊息：' + error);
        });
    });

    $('#DeliveredForm').submit(function(e) {
        e.preventDefault();

        let $url = $(this).attr('action');
        let $data = $(this).serializeObject();

        $.showLoadingModal();
        axios.post($url, $data).then(response => {
            // console.log(response.data);
            $.showSuccessModal(response.data.message, response.data.url);
            $('#DeliveredForm').modal('hide');
        }).catch(error => {
            $.showErrorModal(error);
            console.error('修改銷貨單到貨時間時發生錯誤，錯誤訊息：' + error);
        });
    });

    $('.paid-btn').click(function() {
        let salesID = $(this).data('id');
        $("#paid_sales_id").val(salesID);
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
            text: '您確定要取消此銷貨單的付清狀態？',
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