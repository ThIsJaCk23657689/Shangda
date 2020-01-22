<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form method="POST" :action="createProduce">

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
                    <input id="product_currentQty" type="text" class="form-control" name="product_currentQty" :value="current_product.quantity" disabled>
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

            <produces-detail :materials="materials"></produces-detail>

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
        console.log('ProducesCreateForm.vue mounted.')
    },
    data(){
        return {
            getProducesIndex: $('#getProducesIndex').html(),
            createProduce: $('#createProduce').html()
        }
    },
    methods: {
        getProductData(){
            $('#product_quantity').val(0);
            let product_id = $('#product_id').val();
            if(product_id != 0){
                this.$emit('get-product-data', {
                    id: product_id
                });
            }else{
                alert('請選擇商品');
            }
        },

        calculateProductAfterQty(){
            if($('#product_currentQty').val() == ""){
                alert("請先選擇商品!");
                $('#product_quantity').val(0);
            }else{
                let currentQty = $('#product_currentQty').val();
                let qty = $('#product_quantity').val();
                let afterQty = currentQty - qty;
                $('#product_afterQty').val(afterQty);
            }
        }
    }
}
</script>

