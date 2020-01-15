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
                        <td>{{ index + 1 }}</td>
                        <td>
                            {{ detail.material.name }}
                            <input type="hidden" :name="'details[' + (index + 1) + '][material_id]'" :value="detail.material.id">
                        </td>
                        <td>
                            {{ detail.material.internationalNum }}
                        </td>
                        <td>
                            <input :id="'qty_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][quantity]'" :value="detail.quantity" @change="calculateSubtotal(index+1)">
                        </td>
                        <td>
                            <input :id="'unitPrice_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][material_unitPrice]'" :value="detail.material.unitPrice" @change="calculateSubtotal(index+1)">
                        </td>
                        <td>
                            <input :id="'discount_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][discount]'" :value="detail.discount" @change="calculateSubtotal(index+1)">
                        </td>
                        <td>
                            <span :id="'subtotal_' + (index + 1)">0</span>
                        </td>
                        <td>
                            <input type="text" class="form-control" :name="'details[' + (index + 1)+ '][comment]'" :value="detail.comment">
                        </td>
                        <td>
                            <button class="btn btn-md btn-danger">
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
        };
    },
    methods: {
        addDetail(){
            if(this.current_material.length != 0){
                this.details.push({
                    material: {
                        id: this.current_material.id,
                        name: this.current_material.name,
                        internationalNum: this.current_material.internationalNum,
                        unitPrice: this.current_material.unitPrice
                    },
                    quantity: 0,
                    discount: 1,
                    subTotal: null,
                    comment: null
                });
            }else{
                alert('請選擇原物料');
            }
        },

        calculateSubtotal(id){
            let qty = $('#qty_' + id).val();
            let unitPrice = $('#unitPrice_' + id).val();
            let discount = $('#discount_' + id).val();
            let subTotal = unitPrice * qty * discount;
            $('#subtotal_' + id).html(subTotal);
        },

        getMaterialData(){
            let material_id = $('#material_id').val();

            if(material_id != 0){
                let apiMeterialGetInfo = $('#apiMeterialGetInfo').html();

                axios.post(apiMeterialGetInfo, {
                    id: material_id
                }).then(response => {
                    this.current_material = response.data;
                    console.log(response);
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