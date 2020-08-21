<template>
<div class="login-reg-panel">
	<div class="login-info-box">
		<h2>已經有帳號了？</h2>
		<p>切換到登入頁進行登入!</p>
		<!-- <label id="label-register" for="log-reg-show">登入</label> -->
		<!-- <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked" @change="changeMode"> -->
	</div>
							
	<div class="register-info-box">
		<h2>沒有帳號嗎？</h2>
		<p>馬上註冊，優惠馬上到！</p>
        <a :href="ConsumerRegisterURL" class="register-link">註冊</a>
		<!-- <label id="label-login" for="log-login-show">註冊</label> -->
		<!-- <input type="radio" name="active-log-panel" id="log-login-show" @change="changeMode"> -->
	</div>
							
	<div class="white-panel">
		<div class="login-show">
			<form action="#" method="POST" @submit.prevent="consumerLogin">
                <h2>登入</h2>
                <input type="text" name="account" autocomplete="off" placeholder="帳號" required>
                <input type="password" name="password" autocomplete="current-password" placeholder="密碼" required>
                <button type="submit" class="submit-button">登入</button>
                <a :href="ForgetPasswordURL">忘記密碼？</a>
            </form>
		</div>
		<!-- <div class="register-show">
			<h2>註冊</h2>
			<input type="text" placeholder="Email">
			<input type="password" placeholder="Password">
			<input type="password" placeholder="Confirm Password">
            <button type="button" class="submit-button">註冊</button>
		</div> -->
	</div>
</div>
</template>

<script>
export default {
    props: [],
    data(){
        return {
            ConsumerLoginURL: $('#ConsumerLoginURL').text(),
            ForgetPasswordURL: $('#ForgetPasswordURL').text(),
            ConsumerRegisterURL: $('#ConsumerRegisterURL').text(),
        }
    },
    methods: {
        changeMode(){
            if($('#log-login-show').is(':checked')) {
                $('.register-info-box').fadeOut(); 
                $('.login-info-box').fadeIn();
                
                $('.white-panel').addClass('right-log');
                $('.register-show').addClass('show-log-panel').fadeTo(0, 100);
                $('.login-show').fadeTo(100, 0).removeClass('show-log-panel');
                
            }else if($('#log-reg-show').is(':checked')) {
                $('.register-info-box').fadeIn();
                $('.login-info-box').fadeOut();
                
                $('.white-panel').removeClass('right-log');
                $('.login-show').addClass('show-log-panel').fadeTo(0, 100);
                $('.register-show').fadeTo(100, 0).removeClass('show-log-panel');
            }
        },
        consumerLogin(e){
            let data = $(e.target).serializeObject();

            $.showLoadingModal('驗證帳戶資訊中...');
            axios.post(this.ConsumerLoginURL, data).then(response => {
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
                    // let $key = Object.keys(error.response.data.errors);
                    // $key.forEach(function(item, index){
                    //     $('#' + item).addClass('is-invalid');
                    //     $('#' + item + '_error').html('<strong>'+ error.response.data.errors[item] + '</strong>');
                    // });
                }
            });
        }
    },
    created(){

    },
    mounted(){
        $('.login-info-box').fadeOut();
        $('.login-show').addClass('show-log-panel').fadeTo(0, 100);
    }
}
</script>

<style>
</style>