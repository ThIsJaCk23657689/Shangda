<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="PurchaseOrderCreateForm" method="POST" action="#" v-on:submit.prevent="createPurchaseOrder">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="supplier_id" class="col-md-3 col-form-label text-md-right">
                            <span class="text-danger">*</span>
                            供應商
                        </label>

                        <div class="col-md-6 mb-2">
                            <select id="supplier_id" class="form-control" name="supplier_id" @change="getSupplierData">
                                <option value="0">請選擇...</option>
                                <option-item v-for="data in suppliers" :key="data.id" :data="data"></option-item>
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
                            <input id="showInCharge1" type="text" class="form-control" :value="current_supplier.inCharge1" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="showTel1" class="col-md-3 col-form-label text-md-right">
                            負責人1 - 電話
                        </label>

                        <div class="col-md-6">
                            <input id="showTel1" type="text" class="form-control" :value="current_supplier.tel1" disabled>
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
                            預期到貨時間
                        </label>

                        <div class="col-md-6">
                            <input id="expectReceived_at" type="date" class="form-control" name="expectReceived_at" value="" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="PurchaseComment" class="col-md-3 col-form-label text-md-right">
                            備註
                        </label>

                        <div class="col-md-6">
                            <input id="PurchaseComment" type="text" class="form-control" name="comment" value="">
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
                            <select name="taxType" id="taxType" class="form-control" required>
                                <option value="1">應稅</option>
                                <option value="2">零稅 - 經海關</option>
                                <option value="3">零稅 - 非經海關</option>
                                <option value="4">免稅</option>
                                <option value="5">未稅</option>
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
                            <select name="invoiceType" id="invoiceType" class="form-control" required>
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

            <purchase-detail :materials="materials"></purchase-detail>

            <input type="text" name="totalPrice" id="totalPrice" value="0">

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-block btn-primary">
                        確認新增
                    </button>
                    <a href="#" class="btn btn-block btn-danger">
                        返回上一頁
                    </a>
                </div>
            </div>

        </form>
    </div>
</div>
</template>

<style>
</style>

<script>
export default {
    props: ['suppliers', 'current_supplier', 'materials'],
    mounted() {
        console.log('PurchaseCreareForm.vue mounted.')
        
        // 訂單細項 表單程式碼
        $('#PurchaseOrderDetailForm').submit(function(e){
            e.preventDefault();

            let url = $('#createPurchaseOrderDetail').html();
            let data = $(this).serialize();
            axios.post(url, data).then(response => {
                console.log(response);
            }).catch((error) => {
                console.error('新增進貨單細項時發生錯誤，錯誤訊息：' + error);
            });
        });
    },
    data(){
        return {
            
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
                alert('請選擇廠商');
            }
        },

        createPurchaseOrder(){
            // 新建進貨單

            // 1. 先創建 PurchaseOrder
            let url = $('#createPurchaseOrder').html();

            let data = $('#PurchaseOrderCreateForm').serialize();
            axios.post(url, data).then(response => {
                console.log(response);
                $('#purchaseOrderID').val(response.data.purchaseOrder_id);

                // 2. 建立 PurchaseOrderDetail
                $('#PurchaseOrderDetailForm').submit();
            }).catch((error) => {
                console.error('新增進貨單時發生錯誤，錯誤訊息：' + error);
            });
        },
    }
}
</script>

