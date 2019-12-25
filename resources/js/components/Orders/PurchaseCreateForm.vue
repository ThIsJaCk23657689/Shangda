<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form method="POST" action="#">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row justify-content-center">
                        <label for="supplier_id" class="col-md-2 col-form-label text-md-right">
                            <span class="text-danger">*</span>
                            供應商
                        </label>

                        <div class="col-md-5 mb-2">
                            <select id="supplier_id" class="form-control" name="supplier_id" @change="getSupplierData">
                                <option value="0">請選擇...</option>
                                <option-item v-for="supplier in suppliers" :key="supplier.id" :supplier="supplier"></option-item>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-block btn-primary">
                                新增供應商
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row justify-content-center">
                        <label for="stock_before" class="col-md-2 col-form-label text-md-right">
                            <span class="text-danger">*</span>
                            測試用
                        </label>

                        <div class="col-md-8 mb-2">
                            <input id="name" type="text" class="form-control" name="name" value="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="shortName" class="col-md-4 col-form-label text-md-right">供應商簡稱</label>

                <div class="col-md-6">
                    <input id="shortName" type="text" class="form-control" name="shortName" :value="current_supplier.shortName" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="taxId" class="col-md-4 col-form-label text-md-right">統一編號</label>

                <div class="col-md-6">
                    <input id="taxId" type="text" class="form-control" name="taxId" :value="current_supplier.taxId" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="tel" class="col-md-4 col-form-label text-md-right">電話</label>

                <div class="col-md-6">
                    <input id="tel" type="text" class="form-control" name="tel" :value="current_supplier.tel" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="tax" class="col-md-4 col-form-label text-md-right">傳真</label>

                <div class="col-md-6">
                    <input id="tax" type="text" class="form-control" name="tax" :value="current_supplier.tax" disabled>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label for="inCharge1" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    負責人1 - 名稱
                </label>

                <div class="col-md-6">
                    <input id="inCharge1" type="text" class="form-control" name="inCharge1" :value="current_supplier.inCharge1" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="tel1" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    負責人1 - 電話
                </label>

                <div class="col-md-6">
                    <input id="tel1" type="text" class="form-control" name="tel1" :value="current_supplier.tel1" disabled>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label for="companyAddress" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    公司地址
                </label>

                <div class="col-md-6">
                    <input id="companyAddress" type="text" class="form-control" name="companyAddress" :value="current_supplier.companyAddress" disabled>
                </div>
            </div>

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
    props: ['suppliers', 'current_supplier'],
    mounted() {
        console.log('Purchase Creare Form mounted.')
    },
    data(){
    
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
        }
    }
}
</script>

