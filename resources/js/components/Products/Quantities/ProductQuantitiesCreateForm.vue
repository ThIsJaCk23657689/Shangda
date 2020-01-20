<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form method="POST" action="#">

            <div class="form-group row">
                <label for="product_id" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    商品名稱
                </label>

                <div class="col-md-6">
                    <select id="product_id" class="form-control" name="product_id" required autofocus>
                        <!-- @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach -->
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="quantity" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    庫存增量數量
                </label>

                <div class="col-md-4">
                    <input id="quantity" type="text" class="form-control" name="quantity" value="0" required autocomplete="quantity">
                </div>

                <div class="col-md-2">
                    <input id="unit" type="text" class="form-control" value="" disabled>
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
    props: [],
    mounted() {
        console.log('PurchaseCreateForm.vue mounted.')
        
    },
    data(){
        return {

        }
    },
    methods: {
        
    }
}
</script>

