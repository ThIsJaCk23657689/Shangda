<template>
<div class="auth-panel bg-dark">
    <form class="auth-form" action="#" method="POST" @submit.prevent="login">
        <h2 class="form-title">後台登入</h2>
        
        <div id="account-ic" class="input-container mb-2">
            <input type="text" class="form-control form-input mb-2" name="account" autocomplete="off" placeholder="帳號" required autofocus>
            <small id="account-error-msg" class="error-message"></small>
        </div>

        <div id="password-ic" class="input-container m-b-12">
            <input type="password" class="form-control form-input mb-2" name="password" autocomplete="current-password" placeholder="密碼" required>
            <small id="password-error-msg" class="error-message"></small>
        </div>
        
        <div class="auth-login-footer">
            <div class="checkbox-container">
                <input class="checkbox-input" type="checkbox" name="remember" id="remember">
                <label for="remember" class="checkbox-label">
                    記住我
                </label>
            </div>
            <div>
                <a :href="ForgetPasswordURL" class="form-link">忘記密碼？</a>
            </div>
        </div>
        <div class="button-container">
            <button type="submit" class="submit-button">登入</button>
        </div>
    </form>		
</div>
</template>

<script>
export default {
    props: [],
    data(){
        return {
            LoginURL: $('#LoginURL').text(),
            ForgetPasswordURL: $('#ForgetPasswordURL').text(),
        }
    },
    methods: {
        login(e){
            $('.form-input').removeClass('error');
            let data = $(e.target).serializeObject();

            $.showLoadingModal('驗證帳戶資訊中...');
            axios.post(this.LoginURL, data).then(response => {
                if($('#IntendedURL').html() != '' &&  $('#IntendedURL').html() != null){
                    location.href = $('#IntendedURL').html();
                }else{
                    location.href = response.data.redirect_url;
                }
            }).catch(error => {
                console.error('登入失敗，錯誤訊息：' + error);
                if(error.response.data.errors == null){
                    $.showErrorModalWithoutError('登入失敗，錯誤訊息：' + error.response.data.message + '\n請聯絡系統設計師處理。');
                }else{
                    console.error(error.response.data.errors);
                    $.showErrorModal(error);
                    let $key = Object.keys(error.response.data.errors);
                    $key.forEach(function(item, index){
                        $('#' + item + '-ic').addClass('error');
                        $('#' + item + '-error-msg').html('<strong>'+ error.response.data.errors[item] + '</strong>');
                    });
                }
            });
        }
    },
    created(){

    },
    mounted(){

    }
}
</script>

<style>
</style>