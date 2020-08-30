<template>
<div class="auth-panel bg-dark">
    <form class="auth-form" action="#" method="POST" @submit.prevent="submitResetPasswordForm">
        <h2 class="form-title">重設密碼</h2>
        <input type="hidden" name="token" :value="PasswordResetToken">

        <div id="email-ic" class="input-container">
            <input type="email" class="form-control form-input mb-2" name="email" autocomplete="off" placeholder="信箱" required :value="EmailForInit">
            <small id="email-error-msg" class="error-message"></small>
        </div>

        <div id="password-ic" class="input-container">
            <input type="password" class="form-control form-input mb-2" name="password" autocomplete="off" placeholder="新密碼" required>
            <small id="password-error-msg" class="error-message"></small>
        </div>

        <div id="password_confirmation-ic" class="input-container">
            <input type="password" class="form-control form-input" name="password_confirmation" autocomplete="off" placeholder="確認新密碼" required>
            <small id="password_confirmation-error-msg" class="error-message"></small>
        </div>

        <div class="button-container">
            <button type="submit" class="submit-button">重設密碼</button>
        </div>
    </form>		
</div>
</template>

<script>
export default {
    props: [],
    data(){
        return {
            PasswordUpdateURL: $('#PasswordUpdateURL').text(),
            EmailForInit: $('#EmailForInit').text(),
            PasswordResetToken: $('#PasswordResetToken').text(),
        }
    },
    methods: {
        submitResetPasswordForm(e){
            let data = $(e.target).serializeObject();

            $.showLoadingModal();
            axios.post(this.PasswordUpdateURL, data).then(response => {
                $.showSuccessModal(response.data.message, response.data.url);
            }).catch(error => {
                console.error('請求重設密碼信件失敗，錯誤訊息：' + error);
                $.showErrorModal(error);

                let $key = Object.keys(error.response.data.errors);
                $key.forEach(function(item, index){
                    $('#' + item + '-ic').addClass('error');
                    $('#' + item + '-error-msg').html('<strong>'+ error.response.data.errors[item] + '</strong>');
                });
            });
        },
    },
    created(){
        
    },
    mounted(){

    },
}
</script>

<style>
</style>