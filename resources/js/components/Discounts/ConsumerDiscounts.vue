<template>
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-6 mb-2">
                <select id="product_id" class="form-control" @change="getProductData">
                    <option value="0">請選擇...</option>
                    <option-item v-for="data in products" :key="data.id" :data="data"></option-item>
                </select>
            </div>

            <div class="col-md-6">
                <button id="addProductBtn" type="button" class="btn btn-md btn-success" @click="addDiscount">新增折扣</button>
            </div>
        </div>

        <form id="editDiscountsForm" method="POST" action="#" v-on:submit.prevent="submitEditDisCountsForm">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>商品名稱</th>
                        <th>成本價</th>
                        <th>零售價</th>
                        <th>相對價格</th>
                        <th>絕對價格</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(discount, index) in discounts" :key="index">
                        <td>{{ discount.product.shownID }}</td>
                        <td>
                            {{ discount.product.name }}
                            <input type="hidden" :name="'discounts[' + (index + 1) + '][product_id]'" :value="discount.product.id">
                        </td>
                        <td>
                            <input :id="'costprice_' + (index + 1)" type="text" class="form-control mr-2" :value="discount.product.costprice" disabled style="width:50%;display:inline-block;">
                            <span> 元 / {{ discount.product.showUnit }}</span>
                        </td>
                        <td>
                            <input :id="'retailPrice_' + (index + 1)" type="text" class="form-control mr-2" :value="discount.product.retailPrice" disabled style="width:50%;display:inline-block;">
                            <span> 元 / {{ discount.product.showUnit }}</span>
                        </td>
                        <td>
                            <input :id="'relativePrice_' + (index + 1)" type="text" class="form-control" :name="'discounts[' + (index + 1)+ '][relativePrice]'" :value="discount.relativePrice" @change="calculateAbsolutePirce(index+1)">
                        </td>
                        <td>
                            <input :id="'absolutePirce_' + (index + 1)" type="text" class="form-control" :name="'discounts[' + (index + 1)+ '][absolutePirce]'" :value="discount.absolutePirce" @change="calculateRelativePrice(index+1)">
                        </td>
                        <td>
                            <button type="button" class="btn btn-md btn-danger" @click="deleteDiscount(index)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-block btn-primary">
                        確認儲存
                    </button>
                    <a :href="discountsIndex" class="btn btn-block btn-danger">
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
    props: ['products', 'discounts'],
    mounted() {
        console.log('ConsumerDiscounts.vue mounted.');
    },
    data(){
        return {
            current_product: [],
            discountsIndex: $('#discountsIndex').html(),
        }
    },
    methods: {
        // 新增原物料到商品成分表
        addDiscount(){
            let product_id = $('#product_id').val();
            if(product_id == 0){
                alert("請先選擇商品!");
            }else{
                this.$emit('refresh-products', {
                    id: product_id - 1,
                    type: 'add'
                });

                if(this.current_product.length != 0){
                    this.discounts.push({
                        count: this.discounts.length,
                        product: {
                            id: this.current_product.id,
                            shownID: this.current_product.shownID,
                            name: this.current_product.name,
                            costprice: Math.round(this.current_product.costprice * 1000) / 1000,
                            profit: Math.round(this.current_product.profit * 1000) / 1000,
                            retailPrice: Math.round(this.current_product.retailPrice * 1000) / 1000,
                            showUnit: this.current_product.showUnit
                        },
                        relativePrice: 0,
                        absolutePirce: this.current_product.retailPrice,
                    });
                }else{
                    alert('請選擇商品');
                }
            }
        },

        // 刪除原物料成分
        deleteDiscount(id){
            this.discounts.splice(id, 1);
            this.$emit('refresh-product', {
                id: $('#productID_' + (id + 1)).val(),
                type: 'deleted'
            });
        },

        // 計算絕對價格
        calculateAbsolutePirce(id){
            let costprice = parseFloat($('#costprice_' + id).val());
            let retailPrice = parseFloat($('#retailPrice_' + id).val());
            let relativePrice = parseFloat(Math.round($('#relativePrice_' + id).val() * 1000) / 1000);
            let absolutePirce = parseFloat(Math.round((retailPrice - relativePrice) * 1000) / 1000);

            if(absolutePirce < costprice){
                alert('折扣價已低於成本價，這麼做會開始虧錢，無法這樣使用。');
                relativePrice = 0;
                absolutePirce = retailPrice;

                $('#relativePrice_' + id).val(0);
                $('#absolutePirce_' + id).val(absolutePirce);
            }
        
            this.discounts[id - 1].relativePrice = relativePrice;
            this.discounts[id - 1].absolutePirce = absolutePirce;
        },

        // 計算相對價格
        calculateRelativePrice(id){
            let costprice = parseFloat($('#costprice_' + id).val());
            let retailPrice = parseFloat($('#retailPrice_' + id).val());
            let absolutePirce = parseFloat(Math.round($('#absolutePirce_' + id).val() * 1000) / 1000);
            let relativePrice = parseFloat(Math.round((retailPrice - absolutePirce) * 1000) / 1000);
            
            if(absolutePirce < costprice){
                alert('折扣價已低於成本價，這麼做會開始虧錢，無法這樣使用。');
                relativePrice = 0;
                absolutePirce = retailPrice;

                $('#relativePrice_' + id).val(0);
                $('#absolutePirce_' + id).val(absolutePirce);
            }
        
            this.discounts[id - 1].relativePrice = relativePrice;
            this.discounts[id - 1].absolutePirce = absolutePirce;
        },

        // 取得商品資料
        getProductData(){
            let product_id = $('#product_id').val();

            if(product_id != 0){
                let getProductInfo = $('#getProductInfo').html();
                $('#addProductBtn').attr('disabled', true);
                axios.post(getProductInfo, {
                    id: product_id
                }).then(response => {
                    // console.log(response);
                    this.current_product = response.data;
                    $('#addProductBtn').attr('disabled', false);
                });
            }else{
                alert('請選擇商品');
            }
        },

        // 發送編輯折扣表單
        submitEditDisCountsForm(){
            if(this.discounts.length == 0){
                alert('請先新增折扣商品!');
            }else{
                let url = $('#editDiscountsForm').attr('action');
                let data = $('#editDiscountsForm').serialize();

                // $('#LoadingModal').modal('show');
                axios.post(url, data).then(response => {
                    console.log(response);
                    alert(response.data.msg);
                }).catch((error) => {
                    console.error('編輯折扣時發生錯誤，錯誤訊息：' + error);
                    alert('編輯折扣時發生錯誤，錯誤訊息：' + error);
                    // $('#LoadingModal').modal('hide');
                });
            }
        }
    },
}
</script>

<style>

</style>