<template>
<div class="row justify-content-center">
    <div class="col-md-10">
        <form method="POST" action="#" @submit.prevent="supplierCreateForm">
            
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4>1. 供應商基本資訊</h4>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">
                            <span class="text-danger mr-2">*</span>供應商名稱
                        </label>
                        <input id="name" name="name" type="text" class="form-control" value="" required autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shortName">供應商簡稱</label>
                        <input id="shortName" name="shortName" type="text" class="form-control" value="" autocomplete="off">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="taxId">統一編號</label>
                        <input id="taxId" name="taxId" type="text" class="form-control" value="" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tel">電話</label>
                                <input id="tel" type="text" class="form-control" name="tel" value="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tax">傳真</label>
                                <input id="tax" type="text" class="form-control" name="tax" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="companyAddress_twzipcode" class="form-group">
                                <label><span class="text-danger mr-2">*</span>公司地址</label>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <div data-role="county" data-style="form-control" data-name="companyAddress_county" data-value=""></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div data-role="district" data-style="form-control" data-name="companyAddress_district" data-value=""></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div data-role="zipcode" data-style="form-control" data-name="companyAddress_zipcode" data-value=""></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="companyAddress_others" type="text" class="form-control" name="companyAddress_others" value="" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">備註</label>
                                <textarea id="comment" name="comment" type="text" class="form-control" rows="6"></textarea>              
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4>2. 窗口聯絡資訊</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_name_1"><span class="text-danger mr-2">*</span>聯絡窗口1 - 名稱</label>
                        <input id="operator_name_1" type="text" class="form-control" name="operator_name_1" value="" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_tel_1"><span class="text-danger mr-2">*</span>聯絡窗口1 - 電話</label>
                        <input id="operator_tel_1" type="text" class="form-control" name="operator_tel_1" value="" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_email_1">聯絡窗口1 - 信箱</label>
                        <input id="operator_email_1" type="email" class="form-control" name="operator_email_1" value="" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_name_2">聯絡窗口2 - 名稱</label>
                        <input id="operator_name_2" type="text" class="form-control" name="operator_name_2" value="" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_tel_2">聯絡窗口2 - 電話</label>
                        <input id="operator_tel_2" type="text" class="form-control" name="operator_tel_2" value="" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_email_2">聯絡窗口2 - 信箱</label>
                        <input id="operator_email_2" type="email" class="form-control" name="operator_email_2" value="" autocomplete="off">
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4>3. 付款資訊</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bank_name">銀行名稱</label>
                        <input id="bank_name" type="text" class="form-control" name="bank_name" value="" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bank_branch_name">分行名稱</label>
                        <input id="bank_branch_name" type="text" class="form-control" name="bank_branch_name" value="" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bank_code">銀行通匯代號</label>
                        <input id="bank_code" type="text" class="form-control" name="bank_code" value="" autocomplete="off">
                        <small class="form-text text-muted">銀行代號+分行代號</small>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bank_account">帳號</label>
                        <input id="bank_account" type="text" class="form-control" name="bank_account" value="" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bank_account_name">戶名</label>
                        <input id="bank_account_name" type="text" class="form-control mb-2" name="bank_account_name" value="" autocomplete="off">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="isSameAsName" id="isSameAsName" value="1">
                            <label class="custom-control-label" for="isSameAsName">
                                <small>與供應商名稱相同</small>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="monthlyCheckDate">
                            <span class="text-danger mr-2">*</span>月結日
                        </label>
                        <select id="monthlyCheckDate" name="monthlyCheckDate" class="form-control mb-2" disabled>
                            <option value="0">請選擇...</option>
                            <option v-for="n in 31" :key="n" :value="n">{{ n }}</option>
                        </select>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="monthlyCheck" id="monthlyCheck" value="1" checked>
                            <label class="custom-control-label" for="monthlyCheck">
                                <small>日結</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-block btn-primary">
                        確認新增
                    </button>
                    <a :href="SuppliersIndexURL" class="btn btn-block btn-danger">
                        返回列表
                    </a>
                </div>
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
            SuppliersIndexURL: $('#SuppliersIndexURL').text(),
            SuppliersStoreURL: $('#SuppliersStoreURL').text(),
        }
    },
    methods: {
        supplierCreateForm(e) {
            let url = this.SuppliersStoreURL;
            let data = $(e.target).serializeObject();

            $.showLoadingModal();
            axios.post(url, data).then(response => {
                $.showSuccessModal(response.data.message, response.data.url);
            }).catch((error) => {
                console.error('新增供應商時發生錯誤，錯誤訊息：' + error);
                $.showErrorModal(error);
            });
        }
    },
    created(){

    },
    mounted(){
        $('#companyAddress_twzipcode').twzipcode({
            'readonly': true
        });
    
        $('#monthlyCheck').change(function (e) {
            if ($(this).prop("checked")) {
                $('#monthlyCheckDate').val(0);
                $('#monthlyCheckDate').attr('disabled', true);
            } else {
                $('#monthlyCheckDate').val(0);
                $('#monthlyCheckDate').attr('disabled', false);
            }
        });
    
        $('#isSameAsName').click(function (e) {
            if ($(this).prop("checked")) {
                $('#bank_account_name').val($('#name').val());
            } else {
                $('#bank_account_name').val('');
            }
        });
    }
}
</script>

<style>
</style>