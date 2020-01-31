<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="ProduceCreateForm" method="POST" :action="createProduce" v-on:submit.prevent="submitProduceForm">

            <div class="form-group row">
                <label for="product_id" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    商品名稱
                </label>

                <div class="col-md-6">
                    <select id="product_id" class="form-control" name="product_id" @change="getProductData">
                        <option value="0">請選擇...</option>
                        <option-item v-for="product in products" :key="product.id" :data="product"></option-item>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="product_currentQty" class="col-md-4 col-form-label text-md-right">
                    目前庫存
                </label>

                <div class="col-md-4">
                    <input id="product_currentQty" type="text" class="form-control" name="product_currentQty" :value="current_product.quantity || 0" disabled>
                </div>

                <div class="col-md-2">
                    <label for="" class="col-form-label">{{ current_product.showUnit }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label for="product_quantity" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    庫存增量數量
                </label>

                <div class="col-md-4">
                    <input id="product_quantity" type="text" class="form-control" name="product_quantity" value="0" required @change="calculateProductAfterQty">
                </div>

                <div class="col-md-2">
                    <label for="product_quantity" class="col-form-label">{{ current_product.showUnit }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label for="product_afterQty" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    增量後庫存量
                </label>

                <div class="col-md-4">
                    <input id="product_afterQty" type="text" class="form-control" value="0" disabled>
                </div>

                <div class="col-md-2">
                    <label for="product_afterQty" class="col-form-label">{{ current_product.showUnit }}</label>
                </div>
            </div>

            <hr>

            <produces-detail ref="ProduceDetailForm" :materials="materials" v-on:refresh-materials="refreshMaterials"></produces-detail>

            <hr>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-block btn-primary">
                        確認新增
                    </button>
                    <a :href="getProducesIndex" class="btn btn-block btn-danger">
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
    props: ['products', 'current_product', 'materials'],
    mounted() {
        console.log('ProducesCreateForm.vue mounted.');

        // 庫存細項 表單程式碼
        $('#ProduceDetailForm').submit(function(e){
            e.preventDefault();

            let url = $('#createProduceDetail').html();
            let data = $(this).serialize();
            axios.post(url, data).then(response => {
                // console.log(response);
                alert("新增成功！" + response.data.massenge);
                // location.href = response.data.redirect;
            }).catch((error) => {
                console.error('新增庫存細項時發生錯誤，錯誤訊息：' + error);
            });
        });
    },
    data(){
        return {
            getProducesIndex: $('#getProducesIndex').html(),
            createProduce: $('#createProduce').html()
        }
    },
    methods: {
        refreshMaterials(data){
            this.$emit('refresh-materials', data);
        },

        // 取得商品資料 => 觸發監聽事件:get-product-data，並回傳所選擇的商品id到父元件
        getProductData(){
            let product_id = $('#product_id').val();
            if(product_id != 0){
                this.$emit('get-product-data', {
                    id: product_id
                });
            }else{
                alert('請選擇商品');
            }
        },

        // 觸發事件：當"庫存增量數量"欄位被更動時
        // 試算商品庫存：目前庫存 + 增加量 = 最終庫存 (四捨五入到小數點後4位)
        calculateProductAfterQty(){
            if($('#product_id').val() == "0"){
                alert("請先選擇商品!");
                $('#product_quantity').val(0);
            }else if($.isFloatOrInt($('#product_quantity'))){
                let currentQty = parseFloat($('#product_currentQty').val());
                let qty = parseFloat($('#product_quantity').val());
                let afterQty = parseFloat(Math.round((currentQty + qty) * 10000) / 10000);
                $('#product_afterQty').val(afterQty);
            }else{
                let afterQty = parseFloat($('#product_currentQty').val());
                $('#product_afterQty').val(afterQty);
            }
        },

        // 遞交Produce Create Form
        submitProduceForm(event){
            if($('#product_id').val() == "0"){
                alert("請先選擇商品!");
            }else if(this.$refs.ProduceDetailForm.details.length == 0){
                alert("請新增所消耗原物料!");
            }else{
                // 1. 先創建 Produce
                let url = event.target.action;
                let data = $(event.target).serialize();

                axios.post(url, data).then(response => {
                    // console.log(response);
                    $('#produceID').val(response.data.produce_id);

                    // 2. 建立 Produce Detail
                    $('#ProduceDetailForm').submit();
                }).catch((error) => {
                    console.error('新增商品庫存時發生錯誤，錯誤訊息：' + error);
                });
            }
        }
    }
}
</script>

