<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="ProduceMaterialsDetailForm" method="POST" action="#">

            <input type="hidden" id="m_produceID" name="produce_id" value="">

            <div class="row">
                <div class="col-md-6 mb-2">
                    <select id="material_id" class="form-control" @change="getMaterialData">
                        <option value="0">請選擇...</option>
                        <option v-for="material in materials" :key="material.id" :value="material.id">{{ material.name }}</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <button id="addMaterialBtn" type="button" class="btn btn-md btn-success" @click="addDetail">新增至細項</button>
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
                            {{ detail.material.name }}<br/>
                            <span class="badge badge-warning" v-if="detail.material.showSafeQty > detail.currentQty">庫存警告</span>
                            <input type="hidden" :id="'materialID_' + (index + 1)" :name="'details[' + (index + 1) + '][material_id]'" :value="detail.material.id">
                        </td>
                        <td>
                            <input :id="'currentQty_' + (index + 1)" type="text" class="form-control mr-2" :value="detail.currentQty" disabled style="width:60%;display:inline-block;">
                            <span>{{ detail.material.showUnit }}</span>
                        </td>
                        <td>
                            <input :id="'quantity_' + (index + 1)" type="text" class="form-control mr-2" :name="'details[' + (index + 1)+ '][quantity]'" :value="detail.quantity" @input="calculateAfterQty(index+1)" style="width:60%;display:inline-block;">
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
    data(){
        return {
            details: [],
            current_material: [],
        };
    },
    methods: {
        // 取得原物料資料
        getMaterialData(){
            let material_id = $('#material_id').val();
            if(material_id != 0){
                let getMeterialInfo = $('#getMeterialInfo').html();
                $('#addMaterialBtn').attr('disabled', true);
                axios.post(getMeterialInfo, {
                    id: material_id
                }).then(response => {
                    this.current_material = response.data;
                    $('#addMaterialBtn').attr('disabled', false);
                });
            }else{
                this.current_material = [];
            }
        },

        // 新增原物料細項
        addDetail(){
            let material_id = $('#material_id').val();
            if(material_id == 0){
                $.showWarningModal("請先選擇原物料!");
            }else{
                this.$emit('refresh-materials', {
                    id: material_id - 1,
                    type: 'add'
                });

                if(this.current_material.length != 0){
                    this.details.push({
                        count: this.details.length,
                        material: {
                            id: this.current_material.id,
                            name: this.current_material.name,
                            unit: this.current_material.unit,
                            showUnit: this.current_material.showUnit,
                            showSafeQty: this.current_material.showSafeQty
                        },
                        currentQty: this.current_material.showStock,
                        quantity: 0,
                        afterQty: this.current_material.showStock,
                    });

                    this.current_material = [];
                }else{
                    $.showWarningModal('請選擇原物料');
                }
            }
        },

        // 刪除原物料細項
        deleteDetail(id){
            this.details.splice(id, 1);
            this.$emit('refresh-materials', {
                id: $('#materialID_' + (id+1)).val(),
                type: 'deleted'
            });
        },

        // 計算原物料減量
        calculateAfterQty(id){
            let currentQty = parseFloat($('#currentQty_' + id).val());
            let quantity, afterQty;
            if($.isFloatOrInt($('#quantity_'+ id))){
                quantity = parseFloat($('#quantity_'+ id).val());
                if(quantity > currentQty){
                    console.log(quantity > currentQty);
                    $.showWarningModal('原物料庫存不足！');
                    $('#quantity_'+ id).val(0);
                    afterQty = parseFloat(Math.round((currentQty) * 10000) / 10000);
                    this.details[id - 1].quantity = 0;
                }else{
                    afterQty = parseFloat(Math.round((currentQty - quantity) * 10000) / 10000);
                    this.details[id - 1].quantity = quantity;
                }
            }else{
                $('#quantity_'+ id).val(0);
                afterQty = parseFloat(Math.round((currentQty) * 10000) / 10000);
                this.details[id - 1].quantity = 0;
            }
            $('#afterQty_' + id).val(afterQty);
            this.details[id - 1].afterQty = afterQty;
        },

        // 發送細項表單
    },
    created(){

    },
    mounted() {

    },
}
</script>

<style>

</style>