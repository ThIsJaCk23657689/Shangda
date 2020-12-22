<template>
<form id="company_form" method="POST" :action="ConsumersStoreURL" enctype="multipart/form-data" @submit.prevent="consumerCreateForm" style="display: none">

    <input id="company_account_type" name="account_type" type="hidden" value="company">

    <div class="row">
        <div class="col-md-12 mb-2">
            <h4>2. 填寫帳戶資訊</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="company_account">
                    <span class="text-danger mr-2">*</span>帳號
                </label>
                <input id="company_account" name="company_account" type="text" class="form-control" value="" required autocomplete="off" placeholder="請輸入6~30個英文或數字">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="company_password">
                    <span class="text-danger mr-2">*</span>密碼
                </label>
                <input id="company_password" name="company_password" type="password" class="form-control" value="" required autocomplete="off" placeholder="請輸入至少6個英文或數字">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="company_password_confirmation">
                    <span class="text-danger mr-2">*</span>密碼確認
                </label>
                <input id="company_password_confirmation" name="company_password_confirmation" type="password" class="form-control" value="" required autocomplete="off" placeholder="請再次輸入密碼">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-2">
            <h4>3. 填寫基本資訊</h4>
            <small>請先填寫統一編號，可以自動填寫部分欄位</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 text-center">
            <upload-images ref="uploadCompanyConsumerAvatars" :uploadimg="uploadimg" :title="title" :aspect-ratio="1" :prefix="'CompanyConsumer'"></upload-images>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_taxID">
                            <span class="text-danger mr-2">*</span>統一編號
                        </label>
                        <input id="company_taxID" name="company_taxID" type="text" class="form-control" value="" required autocomplete="off" placeholder="例：12345678" @change="searchByTaxID">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_taxID_type">
                            <span class="text-danger mr-2">*</span>統編類型
                        </label>
                        <input id="company_taxID_type" name="company_taxID_type" type="text" class="form-control" value="" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="company_name">
                            <span class="text-danger mr-2">*</span>公司名稱
                        </label>
                        <input id="company_name" name="company_name" type="text" class="form-control" value="" required autocomplete="off" placeholder="例：尚達塑膠有限公司">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label id="branch_label" for="company_branch" class="text-muted">
                            <span id="branch_required_tag" class="text-danger mr-2" style="display: none;">*</span>分店名
                        </label>
                        <input id="company_branch" name="company_branch" type="text" class="form-control" value="" autocomplete="off" placeholder="例：文心店" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_shortName">簡稱</label>
                        <input id="company_shortName" name="company_shortName" type="text" class="form-control" value="" autocomplete="off" placeholder="例：尚達">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_principal">負責人姓名</label>
                        <input id="company_principal" name="company_principal" type="text" class="form-control" value="" autocomplete="off" placeholder="例：王大明">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="company_monthlyCheckDate">
                            <span class="text-danger mr-2">*</span>月結日
                        </label>
                        <select id="company_monthlyCheckDate" name="company_monthlyCheckDate" class="form-control mb-2" disabled>
                            <option value="0">請選擇...</option>
                            <option v-for="n in 31" :key="n" :value="n">{{ n }}</option>
                        </select>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="company_monthlyCheck" id="company_monthlyCheck" value="1" checked>
                            <label class="custom-control-label" for="company_monthlyCheck">
                                <small>日結</small>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" v-if="formtype == 'backend'">
                    <div class="form-group">
                        <label for="company_uncheckedAmount">
                            <span class="text-danger mr-2">*</span>未沖銷帳款
                        </label>
                        <input id="company_uncheckedAmount" name="company_uncheckedAmount" type="text" class="form-control" value="0" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-4" v-if="formtype == 'backend'">
                    <div class="form-group">
                        <label for="company_totalConsumption">
                            <span class="text-danger mr-2">*</span>總消費額
                        </label>
                        <input id="company_totalConsumption" name="company_totalConsumption" type="text" class="form-control" value="0" autocomplete="off" required>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="company_comment">備註</label>
                        <textarea id="company_comment" name="company_comment" type="text" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-2">
            <h4>4. 填寫聯絡資訊</h4>
            <small>聯絡人手機與聯絡人電話欄位擇一填寫。</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="company_tel">公司電話</label>
                <input id="company_tel" name="company_tel" type="text" class="form-control" value="" autocomplete="off" placeholder="例：0412345678">
                <small class="form-text text-muted">電話請包含區碼並省略"-"。</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="company_tax">公司傳真</label>
                <input id="company_tax" name="company_tax" type="text" class="form-control" value="" autocomplete="off" placeholder="例：0412345678">
                <small class="form-text text-muted">傳真請包含區碼並省略"-"。</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="company_email">
                    <span class="text-danger mr-2">*</span>公司信箱
                </label>
                <input id="company_email" name="company_email" type="email" class="form-control" value="" autocomplete="off" placeholder="例：test@example.com" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="company_lineID">Line ID</label>
                <input id="company_lineID" name="company_lineID" type="text" class="form-control" value="" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="company_operator_name_1">
                    <span class="text-danger mr-2">*</span>聯絡窗口1 - 姓名
                </label>
                <input id="company_operator_name_1" name="company_operator_name_1" type="text" class="form-control mb-2" value="" required autocomplete="off" placeholder="例：王大明">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="isSameAsPrincipal" value="1">
                    <label class="custom-control-label" for="isSameAsPrincipal">
                        <small>與負責人相同</small>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="company_operator_tel_1">
                    <span class="text-warning mr-2">*</span>聯絡窗口1 - 電話
                </label>
                <input id="company_operator_tel_1" name="company_operator_tel_1" type="text" class="form-control" value="" autocomplete="off" placeholder="例：0412345678">
                <small class="form-text text-muted">電話請包含區碼並省略"-"。</small>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="isSameAsComTel" value="1">
                    <label class="custom-control-label" for="isSameAsComTel">
                        <small>與公司電話相同</small>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="company_operator_phone_1">
                    <span class="text-warning mr-2">*</span>聯絡窗口1 - 手機
                </label>
                <input id="company_operator_phone_1" name="company_operator_phone_1" type="text" class="form-control" value="" autocomplete="off" placeholder="例：0912345678" required>
                <small class="form-text text-muted">手機號碼不需+886</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="company_operator_email_1">聯絡窗口1 - 信箱</label>
                <input id="company_operator_email_1" name="company_operator_email_1" type="email" class="form-control" value="" autocomplete="off" placeholder="例：test@example.com">
                <small class="form-text text-muted">此信箱不綁定帳號，用於聯絡</small>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="isSameAsComEmail" value="1">
                    <label class="custom-control-label" for="isSameAsComEmail">
                        <small>與公司信箱相同</small>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="company_operator_name_2">聯絡窗口2 - 姓名</label>
                <input id="company_operator_name_2" name="company_operator_name_2" type="text" class="form-control mb-2" value="" autocomplete="off" placeholder="例：王大明">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="company_operator_tel_2">聯絡窗口2 - 電話</label>
                <input id="company_operator_tel_2" name="company_operator_tel_2" type="text" class="form-control" value="" autocomplete="off" placeholder="例：0412345678">
                <small class="form-text text-muted">電話請包含區碼並省略"-"。</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="company_operator_phone_2">
                    <span class="text-warning mr-2">*</span>聯絡窗口2 - 手機
                </label>
                <input id="company_operator_phone_2" name="company_operator_phone_2" type="text" class="form-control" value="" autocomplete="off" placeholder="例：0912345678">
                <small class="form-text text-muted">手機號碼不需+886</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="company_operator_email_2">聯絡窗口2 - 信箱</label>
                <input id="company_operator_email_2" name="company_operator_email_2" type="email" class="form-control" value="" autocomplete="off" placeholder="例：test@example.com">
                <small class="form-text text-muted">此信箱不綁定帳號，用於聯絡</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div id="company_address_twzipcode" class="form-group">
                <label><span class="text-danger mr-2">*</span>公司地址</label>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div data-role="county" data-style="form-control" data-name="company_address_county" data-value="" data-required="1"></div>
                    </div>
                    <div class="col-md-4">
                        <div data-role="district" data-style="form-control" data-name="company_address_district" data-value="" data-required="1"></div>
                    </div>
                    <div class="col-md-4">
                        <div data-role="zipcode" data-style="form-control" data-name="company_address_zipcode" data-value="" data-required="1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input id="company_address_others" type="text" class="form-control" name="company_address_others" value="" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div id="company_deliveryAddress_twzipcode" class="form-group">
                <label><span class="text-danger mr-2">*</span>送貨地址</label>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div data-role="county" data-style="form-control" data-name="company_deliveryAddress_county" data-value="" data-required="1"></div>
                    </div>
                    <div class="col-md-4">
                        <div data-role="district" data-style="form-control" data-name="company_deliveryAddress_district" data-value="" data-required="1"></div>
                    </div>
                    <div class="col-md-4">
                        <div data-role="zipcode" data-style="form-control" data-name="company_deliveryAddress_zipcode" data-value="" data-required="1"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="company_deliveryAddress_others" type="text" class="form-control" name="company_deliveryAddress_others" value="" autocomplete="off" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="isSameAsComAddress" id="isSameAsComAddress" value="1">
                            <label class="custom-control-label" for="isSameAsComAddress">
                                <small>與公司地址相同</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4" v-if="formtype == 'frontend'">
        <div class="col-md-12 d-flex justify-content-center">
            <vue-recaptcha :sitekey="captchasitekey" :loadRecaptchaScript="true"></vue-recaptcha>
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
            title: '顧客圖片',
        }
    },
    methods: {
        searchByTaxID(e){
            // 分公司欄位設定為非必填，且disabled開啟，必填星號消失。
            $('#branch_label').addClass('text-muted');
            $('#company_branch').attr('disabled', true);
            $('#company_branch').attr('required', false);
            $('#branch_required_tag').fadeOut();

            // 清空資料
            $('#company_taxID_type').val('');
            $('#company_name').val('');
            $('#company_principal').val('');

            let $taxID = $(e.target).val();
            if($taxID != ""){
                let re = /^[0-9]{8}$/;
                if(re.test($taxID)){

                    let url = 'http://localhost/Shangda/public/backend/consumers/taxID/' + $taxID + '/getData';

                    $.showLoadingModal();
                    axios.get(url).then(response => {
                        switch (response.data.status) {
                            case "4":
                                // 抓取api資料時出錯。
                                $.showErrorModalWithoutError(response.data.msg);
                                console.log(response.data.result);
                                break;

                            case "3":
                                // 如果統編是公司類型的話
                                // 自動填上統編類型、公司名稱、負責人名稱
                                $('#company_taxID_type').val(response.data.type);
                                $('#company_name').val(response.data.result['0'].Company_Name);
                                $('#company_principal').val(response.data.result['0'].Responsible_Name);
                                break;
                            case "2":
                                // 如果統編是分公司類型的話
                                // 分公司欄位設定為必填，且disabled關閉，必填星號出現。
                                $('#branch_label').removeClass('text-muted');
                                $('#company_branch').attr('disabled', false);
                                $('#company_branch').attr('required', true);
                                $('#branch_required_tag').fadeIn();

                                // 由於目前無法抓取分公司統編資料，所以不自動填上資料了
                                $('#company_taxID_type').val(response.data.type);

                                break;
                            case "1":
                                // 如果統編是商業類型的話

                                // 由於目前無法抓取商業統編資料，所以不自動填上資料了
                                $('#company_taxID_type').val(response.data.type);

                                break;
                            default:
                                // 如果統編為無效的話
                                $.showWarningModal('查無此統編相關資料，無法使用此統編進行註冊。');
                                $('#company_taxID').val('');
                                break;
                            }
                            $.closeModal();
                    }).catch((error) => {
                        console.error('查詢統一編號時發生錯誤，錯誤訊息：' + error);
                        $.showErrorModal(error);
                    });
                }else{
                    // 失敗
                    $.showErrorModalWithoutError('請輸入正確格式的統一編號。');
                    $(e.target).val('');
                }
            }
        },
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
        $('#company_address_twzipcode').twzipcode({
            'readonly': true
        });

        $('#company_deliveryAddress_twzipcode').twzipcode({
            'readonly': true
        });

        $('input[name=company_operator_phone_1],input[name=company_operator_tel_1]').on('input', function () {
            // Set the required property of the other input to false if this input is not empty.
            $('input[name=company_operator_phone_1],input[name=company_operator_tel_1]').not(this).prop('required', !$(this).val().length);
        });

        $('input[name=company_operator_phone_2],input[name=company_operator_tel_2]').on('input', function () {
            // Set the required property of the other input to false if this input is not empty.
            $('input[name=company_operator_phone_2],input[name=company_operator_tel_2]').not(this).prop('required', !$(this).val().length);
        });

        $('#isSameAsPrincipal').click(function (e) {
            if ($(this).prop("checked")) {
                $('#company_operator_name_1').val($('#company_principal').val());
            } else {
                $('#company_operator_name_1').val('');
            }
        });

        $('#isSameAsComTel').click(function (e) {
            if ($(this).prop("checked")) {
                $('#company_operator_tel_1').val($('#company_tel').val());
            } else {
                $('#company_operator_tel_1').val('');
            }
        });

        $('#isSameAsComEmail').click(function (e) {
            if ($(this).prop("checked")) {
                $('#company_operator_email_1').val($('#company_email').val());
            } else {
                $('#company_operator_email_1').val('');
            }
        });

        $('#isSameAsComAddress').click(function (e) {
            if ($(this).prop("checked")) {
                let $zipcode = $('#company_address_twzipcode').twzipcode('get', 'zipcode');
                $('#company_deliveryAddress_twzipcode').twzipcode('set', $zipcode[0]);
                $('#company_deliveryAddress_others').val($('#company_address_others').val());
            } else {
                $('#company_deliveryAddress_twzipcode').twzipcode('reset');
                $('#company_deliveryAddress_others').val('');
            }
        });
    }
}
</script>

<style>
</style>
