<template>
<form id="individual_form" method="POST" :action="ConsumersStoreURL" enctype="multipart/form-data" @submit.prevent="consumerCreateForm" style="display: none">

    <input id="individual_account_type" name="account_type" type="hidden" value="individual">

    <div class="row">
        <div class="col-md-12 mb-2">
            <h4>2. 填寫帳戶資訊</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="individual_account">
                    <span class="text-danger mr-2">*</span>帳號
                </label>
                <input id="individual_account" name="individual_account" type="text" class="form-control" value="" required autocomplete="off" placeholder="請輸入6~30個英文或數字">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="individual_password">
                    <span class="text-danger mr-2">*</span>密碼
                </label>
                <input id="individual_password" name="individual_password" type="password" class="form-control" value="" required autocomplete="off" placeholder="請輸入至少6個英文或數字">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="individual_password_confirmation">
                    <span class="text-danger mr-2">*</span>密碼確認
                </label>
                <input id="individual_password_confirmation" name="individual_password_confirmation" type="password" class="form-control" value="" required autocomplete="off" placeholder="請再次輸入密碼">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-2">
            <h4>3. 填寫基本資訊</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 text-center">
            <upload-images ref="uploadIndividualConsumerAvatars" :uploadimg="uploadimg" :title="title" :aspect-ratio="1" :prefix="'IndividualConsumer'"></upload-images>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="individual_name">
                            <span class="text-danger mr-2">*</span>姓名
                        </label>
                        <input id="individual_name" name="individual_name" type="text" class="form-control" value="" required autocomplete="off" placeholder="例：王大明">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="individual_shortName">簡稱</label>
                        <input id="individual_shortName" name="individual_shortName" type="text" class="form-control" value="" autocomplete="off" placeholder="例：明哥">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="individual_gender">
                            <span class="text-danger mr-2">*</span>性別
                        </label>
                        <select id="individual_gender" name="individual_gender" class="form-control" required>
                            <option value="0">女</option>
                            <option value="1">男</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="individual_birthday">生日</label>
                        <input id="individual_birthday" name="individual_birthday" type="text" class="form-control" value="" autocomplete="off" placeholder="例：1950-01-01">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="individual_monthlyCheckDate">
                            <span class="text-danger mr-2">*</span>月結日
                        </label>
                        <select id="individual_monthlyCheckDate" name="individual_monthlyCheckDate" class="form-control mb-2" disabled>
                            <option value="0">請選擇...</option>
                            <option v-for="n in 31" :key="n" :value="n">{{ n }}</option>
                        </select>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="individual_monthlyCheck" id="individual_monthlyCheck" value="1" checked>
                            <label class="custom-control-label" for="individual_monthlyCheck">
                                <small>日結</small>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" v-if="formtype == 'backend'">
                    <div class="form-group">
                        <label for="individual_uncheckedAmount">
                            <span class="text-danger mr-2">*</span>未沖銷帳款
                        </label>
                        <input id="individual_uncheckedAmount" name="individual_uncheckedAmount" type="text" class="form-control" value="0" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-4" v-if="formtype == 'backend'">
                    <div class="form-group">
                        <label for="individual_totalConsumption">
                            <span class="text-danger mr-2">*</span>總消費額
                        </label>
                        <input id="individual_totalConsumption" name="individual_totalConsumption" type="text" class="form-control" value="0" autocomplete="off" required>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="individual_comment">備註</label>
                        <textarea id="individual_comment" name="individual_comment" type="text" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-2">
            <h4>4. 填寫聯絡資訊</h4>
            <small>手機與電話欄位擇一填寫。</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="individual_phone">
                    <span class="text-warning mr-2">*</span>手機
                </label>
                <input id="individual_phone" name="individual_phone" type="text" class="form-control" value="" autocomplete="off" placeholder="例：0912345678" required>
                <small class="form-text text-muted">手機號碼不需+886。</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="individual_tel">
                    <span class="text-warning mr-2">*</span>電話
                </label>
                <input id="individual_tel" name="individual_tel" type="text" class="form-control" value="" autocomplete="off" placeholder="例：0412345678">
                <small class="form-text text-muted">電話請包含區碼並省略"-"。</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="individual_email">
                    <span class="text-danger mr-2">*</span>信箱
                </label>
                <input id="individual_email" name="individual_email" type="email" class="form-control" value="" autocomplete="off" required placeholder="例：test@example.com">
                <small class="form-text text-muted">請填寫正確並可使用之信箱。</small>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="individual_lineID">Line ID</label>
                <input id="individual_lineID" name="individual_lineID" type="text" class="form-control" value="" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div id="individual_address_twzipcode" class="form-group">
                <label><span class="text-danger mr-2">*</span>地址</label>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div data-role="county" data-style="form-control" data-name="individual_address_county" data-value="" data-required="1"></div>
                    </div>
                    <div class="col-md-4">
                        <div data-role="district" data-style="form-control" data-name="individual_address_district" data-value="" data-required="1"></div>
                    </div>
                    <div class="col-md-4">
                        <div data-role="zipcode" data-style="form-control" data-name="individual_address_zipcode" data-value="" data-required="1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input id="individual_address_others" type="text" class="form-control" name="individual_address_others" value="" required autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" v-if="formtype == 'frontend'">
            <div class="form-group">
                <label for=""><span class="text-danger mr-2">*</span>機器人驗證</label>
                <vue-recaptcha :sitekey="captchasitekey" :loadRecaptchaScript="true"></vue-recaptcha>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary" v-if="formtype == 'backend'">
                    確認新增
                </button>
                <button type="submit" class="btn btn-block btn-primary" v-else>
                    註冊
                </button>
                <a :href="ConsumersIndexURL" class="btn btn-block btn-danger">
                    返回列表
                </a>
            </div>
        </div>
    </div>

</form>
</template>

<script>
export default {
    props: ['uploadimg', 'formtype', 'captchasitekey'],
    data(){
        return {
            ConsumersIndexURL: $('#ConsumersIndexURL').text(),
            ConsumersStoreURL: $('#ConsumersStoreURL').text(),
            title: '顧客頭貼',
        }
    },
    methods: {
        consumerCreateForm(e){
            let url = this.ConsumersStoreURL;
            let formdata = new FormData($(e.target)[0]);

            $.showLoadingModal();
            axios.post(url, formdata, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                $.showSuccessModal(response.data.message, response.data.url);
            }).catch((error) => {
                console.error('新增顧客時發生錯誤，錯誤訊息：' + error);
                $.showErrorModal(error);
            });
        }
    },
    created(){

    },
    mounted(){
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

        $('input[name=individual_phone],input[name=individual_tel]').on('input', function () {
            // Set the required property of the other input to false if this input is not empty.
            $('input[name=individual_phone],input[name=individual_tel]').not(this).prop('required', !$(this).val().length);
        });
    }
}
</script>

<style>
</style>
