<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="SalesOrderDetailForm" method="POST" action="#">

            <input type="hidden" id="salesOrderID" name="salesOrder_id" value="">

            <div class="row">
                <div class="col-md-6 mb-2">
                    <select id="product_id" class="form-control" @change="getProductData">
                        <option value="0">請選擇...</option>
                        <option-item v-for="data in products" :key="data.id" :data="data"></option-item>
                    </select>
                </div>

                <div class="col-md-6">
                    <button id="addDetailBtn" type="button" class="btn btn-md btn-success" @click="addDetail">新增至細項</button>
                </div>
            </div>

            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>商品</th>
                        <th>國際條碼</th>
                        <th>數量</th>
                        <th>單價</th>
                        <th>折數</th>
                        <th>小計</th>
                        <th>備註</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(detail, index) in details" :key="index">
                        <td style="width: 3%">{{ index + 1 }}</td>
                        <td style="width: 18%">
                            {{ detail.product.name }}
                            <input type="hidden" :name="'details[' + (index + 1) + '][product_id]'" :value="detail.product.id">
                        </td>
                        <td style="width: 10%">
                            {{ detail.product.internationalNum }}
                        </td>
                        <td style="width: 18%">
                            <input :id="'pcs_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][pieces]'" :value="detail.pieces" @change="calculateQty(index+1, 'p'); calculateSubtotal(index+1);" style="width:30%;display:inline-block;">
                            <span class="mr-2">件</span>
                            <input :id="'qty_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][quantity]'" :value="detail.quantity" @change="calculateQty(index+1, 'q'); calculateSubtotal(index+1);" style="width:30%;display:inline-block;">
                            <span>{{ detail.product.showUnit }}</span>
                            <input type="hidden" :id="'qty_per_pack_' + (index + 1)" :value="detail.product.qty_per_pack">
                        </td>
                        <td style="width: 9%">
                            <input :id="'unitPrice_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][price]'" :value="detail.product.unitPrice" @change="calculateSubtotal(index+1)">
                        </td>
                        <td style="width: 7%">
                            <input :id="'discount_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][discount]'" :value="detail.discount" @change="calculateSubtotal(index+1)">
                        </td>
                        <td style="width: 15%">
                            <input :id="'subtotal_' + (index + 1)" type="text" class="form-control" :value="detail.subTotal" disabled>
                        </td>
                        <td style="width: 15%">
                            <input :id="'comment_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][comment]'" :value="detail.comment" @change="updateComment(index+1)">
                        </td>
                        <td style="width: 5%">
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
    mounted() {
        console.log('SalesDetail.vue mounted.');
    },
    data(){
        return {
            details: [],
            current_product: [],
            total_price: 0
        };
    },
    methods: {
        // 新增原物料細項
        addDetail(){
            if(this.current_product.length != 0){
                this.details.push({
                    count: this.details.length,
                    product: {
                        id: this.current_product.id,
                        name: this.current_product.name,
                        internationalNum: this.current_product.internationalNum,
                        unitPrice: this.current_product.retailPrice,
                        qty_per_pack: this.current_product.qty_per_pack,
                        showUnit: this.current_product.showUnit
                    },
                    pieces: 0,
                    quantity: 0,
                    discount: 1,
                    subTotal: 0,
                    comment: null
                });
            }else{
                alert('請選擇商品');
            }
        },

        // 刪除原物料細項
        deleteDetail(id){
            this.details.splice(id, 1);
            if(this.details.length != 0){
                this.calculateSubtotal(1);
            }
            this.calculateTotalPrice();
        },

        calculateSubtotal(id){
            let qty = $('#qty_' + id).val();
            let unitPrice = $('#unitPrice_' + id).val();
            let discount = $('#discount_' + id).val();
            let subTotal = Math.round(unitPrice * qty * discount * 10000) / 10000;
            $('#subtotal_' + id).html(subTotal);

            this.details[id - 1].quantity = qty;
            this.details[id - 1].product.unitPrice = unitPrice;
            this.details[id - 1].discount = discount;
            this.details[id - 1].subTotal = subTotal;
            this.calculateTotalPrice();
        },

        calculateTotalPrice(){
            this.total_price = 0;
            for(let i = 1; i <=  this.details.length; i++){

                let qty = this.details[i - 1].quantity;
                let unitPrice = this.details[i - 1].product.unitPrice;
                let discount = this.details[i - 1].discount;
                let subTotal = Math.round(unitPrice * qty * discount * 10000) / 10000;
                this.total_price = this.total_price + subTotal;
            }

            $('#totalPrice').val(this.total_price);

            let taxType = $('#taxType').val();
            let tax = (taxType == "1")? Math.round(this.total_price * 0.05 * 10000) / 10000: 0;
            $('#taxPrice').val(tax);

            this.total_price = Math.round(Math.round((this.total_price + tax) * 10000) / 10000);
            this.$emit('showTotalPrice', this.total_price)
            // console.log(this.total_price);
        },

        calculateQty(id, type){
            let qty_per_pack = $('#qty_per_pack_' + id).val();
            if(type == 'p'){
                let pcs = $('#pcs_' + id).val();
                $('#qty_' + id).val(pcs * qty_per_pack);

                this.details[id - 1].pieces = pcs;
            }else if(type == 'q'){
                let qty = $('#qty_' + id).val();
                $('#pcs_' + id).val(qty / qty_per_pack);

                this.details[id - 1].pieces = qty / qty_per_pack;
            }
        },

        updateComment(id){
            let comment = $('#comment_' + id).val();
            this.details[id - 1].comment = comment;
        },

        // 取得商品資料
        getProductData(){
            let product_id = $('#product_id').val();

            if(product_id != 0){
                let getProductInfo = $('#getProductInfo').html();

                $('#addDetailBtn').attr('disabled', true);
                axios.post(getProductInfo, {
                    id: product_id
                }).then(response => {
                    this.current_product = response.data;
                    $('#addDetailBtn').attr('disabled', false);
                });
            }else{
                alert('請選擇商品');
            }
        },


    }
}
</script>

<style>

</style>
