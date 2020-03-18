<template>
<div class="row justify-content-center">
    <div class="col-md-10">

        <div class="row">
            <div class="col-md-6 mb-2">
                <select id="consumer_id" class="form-control" @change="getConsumerData">
                    <option value="0">請選擇...</option>
                    <option-item v-for="data in consumers" :key="data.id" :data="data"></option-item>
                </select>
            </div>

            <div class="col-md-6">
                <button id="addConsumerBtn" type="button" class="btn btn-md btn-success" @click="addDiscount">新增折扣</button>
            </div>
        </div>

        <form id="editDiscountsForm" method="POST" action="#" v-on:submit.prevent="submitEditDisCountsForm">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>顧客名稱</th>
                        <th>統編</th>
                        <th>負責人</th>
                        <th>電話</th>
                        <th>相對價格</th>
                        <th>絕對價格</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(discount, index) in discounts" :key="index">
                        <td>{{ discount.consumer.shownID }}</td>
                        <td>
                            {{ discount.consumer.name }}
                            <input type="hidden" :name="'discounts[' + (index + 1) + '][consumer_id]'" :value="discount.consumer.id">
                        </td>
                        <td>{{ discount.consumer.taxID }}</td>
                        <td>{{ discount.consumer.inCharge1 }}</td>
                        <td>{{ discount.consumer.tel1 }}</td>
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
    props: ['consumers', 'discounts'],
    mounted() {
        console.log('ProductDiscounts.vue mounted.');
    },
    data(){
        return {
            current_consumer: [],
            discountsIndex: $('#discountsIndex').html(),
        }
    },
    methods: {
        // 新增原物料到商品成分表
        addDiscount(){
            let consumer_id = $('#consumer_id').val();
            if(consumer_id == 0){
                alert("請先選擇顧客!");
            }else{
                this.$emit('refresh-consumers', {
                    id: consumer_id - 1,
                    type: 'add'
                });

                if(this.current_consumer.length != 0){
                    this.discounts.push({
                        count: this.discounts.length,
                        consumer: {
                            id: this.current_consumer.id,
                            shownID: this.current_consumer.shownID,
                            name: this.current_consumer.name,
                            taxID: this.current_consumer.taxID,
                            inCharge1: this.current_consumer.inCharge1,
                            tel1: this.current_consumer.tel1,
                        },
                        relativePrice: 0,
                        absolutePirce: parseFloat($('#retailPrice').val()),
                    });
                }else{
                    alert('請選擇顧客');
                }
            }
        },

        // 刪除原物料成分
        deleteDiscount(id){
            this.discounts.splice(id, 1);
            this.$emit('refresh-consumer', {
                id: $('#consumerID_' + (id + 1)).val(),
                type: 'deleted'
            });
        },

        // 計算絕對價格
        calculateAbsolutePirce(id){
            let costprice = parseFloat($('#totalCost').val());
            let retailPrice = parseFloat($('#retailPrice').val());
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
            let costprice = parseFloat($('#totalCost').val());
            let retailPrice = parseFloat($('#retailPrice').val());
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
        getConsumerData(){
            let consumer_id = $('#consumer_id').val();

            if(consumer_id != 0){
                let getConsumerInfo = $('#getConsumerInfo').html();
                $('#addConsumerBtn').attr('disabled', true);
                axios.post(getConsumerInfo, {
                    id: consumer_id
                }).then(response => {
                    this.current_consumer = response.data;
                    $('#addConsumerBtn').attr('disabled', false);
                });
            }else{
                alert('請選擇顧客');
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