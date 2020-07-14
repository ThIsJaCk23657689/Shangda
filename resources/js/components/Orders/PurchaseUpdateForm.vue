<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="PurchaseOrderUpdateForm" method="POST" action="#" @submit.prevent="updatePurchaseOrder">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="supplier_id" class="col-md-3 col-form-label text-md-right">
                            <span class="text-danger">*</span>
                            供應商
                        </label>

                        <div class="col-md-6 mb-2">
                            <select id="supplier_id" class="form-control" name="supplier_id" v-model="purchase.supplier_id" @change="getSupplierData">
                                <option value="0">請選擇...</option>
                                <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{ supplier.name }}</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#CreateSupplierModal">
                                新增供應商
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <create-supplier-modal></create-supplier-modal>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="showShortName" class="col-md-3 col-form-label text-md-right">供應商簡稱</label>

                        <div class="col-md-6">
                            <input id="showShortName" type="text" class="form-control" :value="current_supplier.shortName" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="showTaxId" class="col-md-3 col-form-label text-md-right">統一編號</label>

                        <div class="col-md-6">
                            <input id="showTaxId" type="text" class="form-control" :value="current_supplier.taxId" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <label for="showTel" class="col-md-3 col-form-label text-md-right">電話</label>

                        <div class="col-md-6">
                            <input id="showTel" type="text" class="form-control" :value="current_supplier.tel" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <label for="showTax" class="col-md-3 col-form-label text-md-right">傳真</label>

                        <div class="col-md-6">
                            <input id="showTax" type="text" class="form-control" :value="current_supplier.tax" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="showInCharge1" class="col-md-3 col-form-label text-md-right">
                            負責人1 - 名稱
                        </label>

                        <div class="col-md-6">
                            <input id="showInCharge1" type="text" class="form-control" :value="current_supplier.operator_name_1" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="showTel1" class="col-md-3 col-form-label text-md-right">
                            負責人1 - 電話
                        </label>

                        <div class="col-md-6">
                            <input id="showTel1" type="text" class="form-control" :value="current_supplier.operator_tel_1" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <label for="showCompanyAddress" class="col-md-3 col-form-label text-md-right">
                            公司地址
                        </label>

                        <div class="col-md-9">
                            <input id="showCompanyAddress" type="text" class="form-control" :value="current_supplier.companyAddress" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="expectReceived_at" class="col-md-3 col-form-label text-md-right">
                            <span class="text-danger">*</span>
                            預期到貨時間
                        </label>
                        <div class="col-md-6">
                            <input id="expectReceived_at" name="expectReceived_at" type="text" class="form-control" v-model="purchase.expectReceived_at"  autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="PurchaseComment" class="col-md-3 col-form-label text-md-right">
                            備註
                        </label>
                        <div class="col-md-6">
                            <textarea name="comment" id="PurchaseComment" class="form-control" cols="30" rows="2" v-model="purchase.comment"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="taxType" class="col-md-3 col-form-label text-md-right">
                            稅別
                        </label>

                        <div class="col-md-6">
                            <select name="taxType" id="taxType" class="form-control" required v-model="purchase.taxType" @change="changeTax">
                                <option value="1">應稅</option>
                                <option value="2">未稅</option>
                                <option value="3">免稅</option>
                                <option value="4">零稅 - 經海關</option>
                                <option value="5">零稅 - 非經海關</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="invoiceType" class="col-md-3 col-form-label text-md-right">
                            發票類型
                        </label>

                        <div class="col-md-6">
                            <select name="invoiceType" id="invoiceType" class="form-control" v-model="purchase.invoiceType" required>
                                <option value="1">三聯式</option>
                                <option value="2">二聯式</option>
                                <option value="3">三聯銷退折讓</option>
                                <option value="4">二聯銷退折讓</option>
                                <option value="5">三聯式收銀機</option>
                                <option value="6">免用發票</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <input id="totalPrice" name="totalPrice" type="hidden" class="form-control" :value="total_price">

            <purchase-update-detail 
                ref="purchasedetail" 
                :materials="materials" 
                :details="purchase.details"
                @show-total-price="showTotalPrice">
            </purchase-update-detail>

            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="row">
                        <label for="beforePrice" class="col-md-3 col-form-label text-md-right">銷售額</label>

                        <div class="col-md-6">
                            <input id="beforePrice" type="text" class="form-control" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <label for="tax_price" class="col-md-2 col-form-label text-md-right">稅額</label>

                        <div class="col-md-6">
                            <input id="tax_price" type="text" class="form-control" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <label for="totalPrice" class="col-md-2 col-form-label text-md-right">總額</label>

                        <div class="col-md-6">
                            <input id="showTotalPrice" type="text" class="form-control" :value="total_price" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-block btn-success">
                        確認修改
                    </button>
                    <a :href="returnUrl" class="btn btn-block btn-danger">
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
    props: ['suppliers', 'current_supplier', 'materials', 'purchase', 'returnUrl'],
    data(){
        return {
            total_price: 0,
        }
    },
    methods: {
        getSupplierData(){
            let supplier_id = $('#supplier_id').val();
            if(supplier_id != 0){
                this.$emit('get-supplier-data', {
                    id: supplier_id
                });
            }else{
                $.showWarningModal('請選擇廠商');
                this.$emit('get-supplier-data', null);
            }
        },

        showTotalPrice(total_price){
            this.total_price = total_price;
        },

        changeTax () {
            this.$refs.purchasedetail.calculateTotalPrice();
        },

        updatePurchaseOrder(e){
            // 檢查是否有新增原物料在進貨單內。
            if(this.purchase.details.length == 0){
                $.showWarningModal('進貨單必須至少要有一項原物料進貨。');
                return false;
            }

            // 1. 先創建 PurchaseOrder
            let url = $('#updatePurchaseOrder').text();
            let data = $(e.target).serialize();

            $.showLoadingModal();
            axios.patch(url, data).then(response => {
                $('#purchaseOrderID').val(response.data.PurchaseOrderID);

                // 2. 編輯 PurchaseOrderDetail
                let detailURL = $('#updatePurchaseOrderDetail').text();
                let detailData = $('#PurchaseOrderDetailForm').serialize();

                axios.patch(detailURL, detailData).then(response => {
                   $.showSuccessModal(response.data.message, response.data.url);
                }).catch((error) => {
                    console.error('更新進貨單細項時發生錯誤，錯誤訊息：' + error);
                    $.showErrorModal(error);
                });
            }).catch((error) => {
                console.error('更新進貨單時發生錯誤，錯誤訊息：' + error);
                $.showErrorModal(error);
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