<template>
<div class="white-panel">
	<div class="login-show">
		<form action="#" method="POST" @submit.prevent="submitResetPasswordForm">
            <h2>重設密碼</h2>

            <input type="hidden" name="token" :value="PasswordResetToken">

            <div class="input-container">
                <input type="email" name="email" autocomplete="off" placeholder="信箱" required :value="EmailForInit">
            </div>

            <div class="input-container">
                <input type="password" name="password" autocomplete="off" placeholder="新密碼" required>
            </div>

            <div class="input-container">
                <input type="password" name="password_confirmation" autocomplete="off" placeholder="確認新密碼" required>
            </div>
            
            <div class="button-container">
                <button type="submit" class="submit-button">重設密碼</button>
            </div>
            
        </form>
	</div>
</div>
</template>

<script>
export default {
    props: [],
    data(){
        return {
            ConsumerPasswordUpdateURL: $('#ConsumerPasswordUpdateURL').text(),
            EmailForInit: $('#EmailForInit').text(),
            PasswordResetToken: $('#PasswordResetToken').text(),
        }
    },
    methods: {
        submitResetPasswordForm(e){
            let data = $(e.target).serializeObject();

            $.showLoadingModal();
            axios.post(this.ConsumerPasswordUpdateURL, data).then(response => {
                $.showSuccessModal(response.data.message, response.data.url);
            }).catch(error => {
                console.error('請求重設密碼信件失敗，錯誤訊息：' + error);
                $.showErrorModal(error);
            });
        },
    },
    created(){
        
    },
    mounted(){
        $('.login-show').addClass('show-log-panel').fadeTo(0, 100);
    },
}
</script>

<style>
</style>