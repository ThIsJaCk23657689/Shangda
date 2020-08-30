<template>
<div class="auth-panel bg-dark">
	<form class="auth-form" action="#" method="POST" @submit.prevent="submitRequestForm">
        <h2 class="form-title pb-2">忘記密碼</h2>
        <small class="text-white pb-3">我們將為您引導來重新設定您的密碼，請輸入您帳號所綁定的信箱。</small>
        
        <div class="input-container mb-2">
            <input type="email" class="form-control form-input mb-2" name="email" id="email" autocomplete="off" placeholder="信箱" required>
            <small id="email-error-msg" class="error-message"></small>
        </div>

        <small id="counter" class="text-white mb-2 d-none">沒有收到信件嗎？{{ counter }}秒後重新再試。</small>
            
        <div class="button-container">
            <button type="submit" class="submit-button">發送重設密碼連結</button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    props: [],
    data(){
        return {
            PasswordEmailURL: $('#PasswordEmailURL').text(),
            counter: 60,
        }
    },
    methods: {
        submitRequestForm(e){
            $('.input-container').removeClass('error');
            let data = $(e.target).serializeObject();

            $.showLoadingModal('驗證帳戶資訊中...');
            axios.post(this.PasswordEmailURL, data).then(response => {
                $.showSuccessModal(response.data.message);
                this.disableForm();
            }).catch(error => {
                console.error('請求重設密碼信件失敗，錯誤訊息：' + error);
                $.showErrorModal(error);
                $('.input-container').addClass('error');
                $('#email-error-msg').html(error.response.data.message);
            });
        },
        countDownTimer() {
            if(this.counter > 0){
                setTimeout(() => {
                    this.counter --;
                    this.countDownTimer();
                }, 1000);
            }else{
                this.enableForm();
            }
        },
        enableForm(){
            $('.submit-button').attr('disabled', false).removeClass('disabled');
            $('#email').attr('disabled', false);
            $('#counter').fadeTo(100, 0).addClass('d-none');
            this.counter = 60;
        },
        disableForm(){
            $('.submit-button').attr('disabled', true).addClass('disabled');
            $('#email').attr('disabled', true);
            $('#counter').removeClass('d-none').fadeTo(0, 100);
            this.countDownTimer();
        }
    },
    created(){
        
    },
    mounted(){

    },
}
</script>

<style>
</style>