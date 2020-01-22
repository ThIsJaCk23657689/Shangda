<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="ProduceDetailForm" method="POST" action="#">

            <input type="hidden" id="produceID" name="produce_id" value="">

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
                        <th>目前庫存量</th>
                        <th>消耗庫存量</th>
                        <th>剩餘庫存量</th>
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
                            <input :id="'currentQty_' + (index + 1)" type="text" class="form-control mr-2" :value="detail.currentQty" disabled style="width:60%;display:inline-block;">
                            <span>{{ detail.material.showUnit }}</span>
                        </td>
                        <td>
                            <input :id="'quantity_' + (index + 1)" type="text" class="form-control mr-2" :name="'details[' + (index + 1)+ '][quantity]'" :value="detail.quantity" @change="calculateAfterQty(index+1)" style="width:60%;display:inline-block;">
                            <span>{{ detail.material.showUnit }}</span>
                        </td>
                        <td>
                            <input :id="'afterQty_' + (index + 1)" type="text" class="form-control mr-2" :value="detail.afterQty" disabled style="width:60%;display:inline-block;">
                            <span>{{ detail.material.showUnit }}</span>
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
    props: ['materials'],
    mounted() {
        console.log('ProducesDetail.vue mounted.');
    },
    data(){
        return {
            details: [],
            current_material: [],
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
                        unit: this.current_material.unit,
                        showUnit: this.current_material.showUnit
                    },
                    currentQty: this.current_material.showStock,
                    quantity: 0,
                    afterQty: 0,
                });
            }else{
                alert('請選擇原物料');
            }
        },

        // 刪除原物料細項
        deleteDetail(id){
            this.details.splice(id, 1);
        },

        // 計算原物料減量
        calculateAfterQty(id){
            let currentQty = parseFloat($('#currentQty_' + id).val());
            let quantity, afterQty;
            if($.isFloatOrInt($('#quantity_'+ id))){
                quantity = parseFloat($('#quantity_'+ id).val());
                afterQty = parseFloat(Math.round((currentQty - quantity) * 10000) / 10000);
                this.details[id - 1].quantity = quantity;
            }else{
                $('#quantity_'+ id).val(0);
                afterQty = parseFloat(Math.round((currentQty) * 10000) / 10000);
                this.details[id - 1].quantity = 0;
            }
            $('#afterQty' + id).val(afterQty);
            this.details[id - 1].afterQty = afterQty;
        },

        // 取得原物料資料
        getMaterialData(){
            let material_id = $('#material_id').val();

            if(material_id != 0){
                let getMeterialInfo = $('#getMeterialInfo').html();

                axios.post(getMeterialInfo, {
                    id: material_id
                }).then(response => {
                    // console.log(response);
                    this.current_material = response.data;
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