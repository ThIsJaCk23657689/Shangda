<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="ProduceProductsDetailForm" method="POST" action="#">

            <input type="hidden" id="p_produceID" name="produce_id" value="">

            <div class="row">
                <div class="col-md-6 mb-2">
                    <select id="product_id" class="form-control" @change="getProductData">
                        <option value="0">請選擇...</option>
                        <option v-for="product in products" :key="product.id" :value="product.id">{{ product.name }}</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <button id="addProductBtn" type="button" class="btn btn-md btn-success" @click="addDetail">新增至細項</button>
                </div>
            </div>

            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>商品</th>
                        <th>產前量</th>
                        <th>增加量</th>
                        <th>產後量</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(detail, index) in details" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>
                            {{ detail.product.name }}<br/>
                            <span class="badge badge-warning" v-if="detail.product.safeQuantity > (detail.currentQty + detail.quantity)">庫存警告</span>
                            <input type="hidden" :id="'p_productID_' + (index + 1)" :name="'details[' + (index + 1) + '][product_id]'" :value="detail.product.id">
                        </td>
                        <td>
                            <input :id="'p_currentQty_' + (index + 1)" type="text" class="form-control mr-2" :value="detail.currentQty" disabled style="width:60%;display:inline-block;">
                            <span>{{ detail.product.showUnit }}</span>
                        </td>
                        <td>
                            <input :id="'p_quantity_' + (index + 1)" type="text" class="form-control mr-2" :name="'details[' + (index + 1)+ '][quantity]'" :value="detail.quantity" @change="calculateAfterQty(index+1)" style="width:60%;display:inline-block;">
                            <span>{{ detail.product.showUnit }}</span>
                        </td>
                        <td>
                            <input :id="'p_afterQty_' + (index + 1)" type="text" class="form-control mr-2" :value="detail.afterQty" disabled style="width:60%;display:inline-block;">
                            <span>{{ detail.product.showUnit }}</span>
                        </td>
                        <td >
                            <button type="button" class="btn btn-md btn-danger" @click="deleteDetail(index)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
    </div>
</div>
</template>

<script>
export default {
    props: ['products'],
    data(){
        return {
            details: [],
            current_product: [],
        };
    },
    methods: {
        // 取得商品資料
        getProductData(){
            let product_id = $('#product_id').val();
            if(product_id != 0){
                let getProductsInfo = $('#getProductsInfo').html();
                $('#addProductBtn').attr('disabled', true);
                axios.post(getProductsInfo, {
                    id: product_id
                }).then(response => {
                    this.current_product = response.data;
                    $('#addProductBtn').attr('disabled', false);
                });
            }else{
                this.current_product = [];
            }
        },

        // 新增商品細項
        addDetail(){
            let product_id = $('#product_id').val();
            if(product_id == 0){
                $.showWarningModal('請先選擇商品!');
            }else{
                this.$emit('refresh-products', {
                    id: product_id - 1,
                    type: 'add'
                });

                if(this.current_product.length != 0){
                    this.details.push({
                        count: this.details.length,
                        product: {
                            id: this.current_product.id,
                            name: this.current_product.name,
                            unit: this.current_product.unit,
                            showUnit: this.current_product.showUnit,
                            safeQuantity: this.current_product.safeQuantity,
                        },
                        currentQty: this.current_product.quantity,
                        quantity: 0,
                        afterQty: this.current_product.quantity,
                    });

                    this.current_product = [];
                }else{
                    $.showWarningModal('請先選擇商品!');
                }
            }
        },

        // 刪除商品細項
        deleteDetail(id){
            this.details.splice(id, 1);
            this.$emit('refresh-products', {
                id: $('#productID_' + (id+1)).val(),
                type: 'deleted'
            });
        },

        // 計算商品的增量
        calculateAfterQty(id){
            let currentQty = parseFloat($('#p_currentQty_' + id).val());
            let quantity, afterQty;
            if($.isFloatOrInt($('#p_quantity_'+ id))){
                quantity = parseFloat($('#p_quantity_'+ id).val());
                afterQty = parseFloat(Math.round((currentQty + quantity) * 10000) / 10000);
                this.details[id - 1].quantity = quantity;
            }else{
                $('#p_quantity_'+ id).val(0);
                afterQty = parseFloat(Math.round((currentQty) * 10000) / 10000);
                this.details[id - 1].quantity = 0;
            }
            $('#p_afterQty_' + id).val(afterQty);
            this.details[id - 1].afterQty = afterQty;
        },

        setDetails($details){
            this.details = $details;
        }
    },
    created(){

    },
    mounted() {
        // console.log('ProducesDetail.vue mounted.');
    },
}
</script>

<style>

</style>