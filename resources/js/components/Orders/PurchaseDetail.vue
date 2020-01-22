<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="PurchaseOrderDetailForm" method="POST" action="#">

            <input type="hidden" id="purchaseOrderID" name="purchaseOrder_id" value="">

            <div class="row">
                <div class="col-md-6 mb-2">
                    <select id="material_id" class="form-control" @change="getMaterialData">
                        <option value="0">請選擇...</option>
                        <option-item v-for="data in materials" :key="data.id" :data="data"></option-item>
                    </select>
                </div>

                <div class="col-md-6">
                    <button type="button" class="btn btn-md btn-success" @click="addDetail">新增至細項</button>
                </div>
            </div>

            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>原物料</th>
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
                        <td style="width: 5%">{{ index + 1 }}</td>
                        <td style="width: 20%">
                            {{ detail.material.name }}
                            <input type="hidden" :name="'details[' + (index + 1) + '][material_id]'" :value="detail.material.id">
                        </td>
                        <td style="width: 10%">
                            {{ detail.material.internationalNum }}
                        </td>
                        <td style="width: 15%">
                            <input :id="'qty_' + (index + 1)" type="text" class="form-control mr-2" :name="'details[' + (index + 1)+ '][quantity]'" :value="detail.quantity" @change="calculateSubtotal(index+1)" style="width:60%;display:inline-block;">
                            <span>{{ (detail.material.unit == 1)?'公斤':'公噸' }}</span>
                        </td>
                        <td style="width: 10%">
                            <input :id="'unitPrice_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][price]'" :value="detail.material.unitPrice" @change="calculateSubtotal(index+1)">
                        </td>
                        <td style="width: 10%">
                            <input :id="'discount_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][discount]'" :value="detail.discount" @change="calculateSubtotal(index+1)">
                        </td>
                        <td style="width: 10%">
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
    props: ['materials'],
    mounted() {
        console.log('PurchaseDetail.vue mounted.');
    },
    data(){
        return {
            details: [],
            current_material: [],
            total_price: 0
        };
    },
    methods: {
        // 新增原物料細項
        addDetail(){
            if(this.current_material.length != 0){
                this.details.push({
                    count: this.details.length,
                    material: {
                        id: this.current_material.id,
                        name: this.current_material.name,
                        internationalNum: this.current_material.internationalNum,
                        unitPrice: this.current_material.unitPrice,
                        unit: this.current_material.unit
                    },
                    quantity: 0,
                    discount: 1,
                    subTotal: 0,
                    comment: null
                });
            }else{
                alert('請選擇原物料');
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
            this.details[id - 1].material.unitPrice = unitPrice;
            this.details[id - 1].discount = discount;
            this.details[id - 1].subTotal = subTotal;
            this.calculateTotalPrice();
        },

        calculateTotalPrice(){
            this.total_price = 0;
            for(let i = 1; i <=  this.details.length; i++){
                
                let qty = this.details[i - 1].quantity;
                let unitPrice = this.details[i - 1].material.unitPrice;
                let discount = this.details[i - 1].discount;
                let subTotal = Math.round(unitPrice * qty * discount * 10000) / 10000;
                this.total_price = this.total_price + subTotal;
            }

            $('#beforePrice').val(this.total_price);

            let taxType = $('#taxType').val();
            let tax = (taxType == "1")? Math.round(this.total_price * 0.05 * 10000) / 10000: 0;
            $('#tax_price').val(tax);
            
            this.total_price = Math.round((this.total_price + tax) * 10000) / 10000;
            this.$emit('showTotalPrice', this.total_price)
            // console.log(this.total_price);
        },

        updateComment(id){
            let comment = $('#comment_' + id).val();
            this.details[id - 1].comment = comment;
        },

        getMaterialData(){
            let material_id = $('#material_id').val();

            if(material_id != 0){
                let getMeterialInfo = $('#getMeterialInfo').html();

                axios.post(getMeterialInfo, {
                    id: material_id
                }).then(response => {
                    this.current_material = response.data;
                    // console.log(response);
                });
            }else{
                alert('請選擇原物料');
            }
        },

        
    }
}
</script>

<style>

</style>