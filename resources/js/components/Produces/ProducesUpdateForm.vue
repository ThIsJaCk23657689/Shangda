<template>
<div class="row justify-content-center">
    <div class="col-md-10">
        <form id="ProduceUpdateForm" method="POST" action="#" @submit.prevent="updateProduceForm">

            <div id="step1" class="row">
                <div class="col-md-12 mb-2">
                    <h4>1. 投入原物料</h4>
                    <small>請輸入投入原料數量</small>
                </div>
            </div>

            <produces-materials-detail 
                ref="ProducesMaterialsDetail" 
                :materials="materials" 
                @refresh-materials="refreshMaterials">
            </produces-materials-detail>

            <hr>

            <div id="step2" class="row">
                <div class="col-md-12 mb-2">
                    <h4>2. 產出商品</h4>
                    <small>請輸入產出商品數量</small>
                </div>
            </div>

            <produces-products-detail 
                ref="ProducesProductsDetail" 
                :products="products"
                @refresh-products="refreshProducts">
            </produces-products-detail>

            <hr>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-block btn-success">
                        確認修改
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
    props: ['products', 'materials', 'produce'],
    data(){
        return {
            getProducesIndex: $('#getProducesIndex').text(),
            updateProduce: $('#updateProduce').text()
        }
    },
    methods: {
        refreshMaterials(data){
            this.$emit('refresh-materials', data);
        },

        refreshProducts(data){
            this.$emit('refresh-products', data);
        },

        // 遞交Produce Update Form
        updateProduceForm(e){
            if(this.$refs.ProducesMaterialsDetail.details.length == 0){
                $.showWarningModal("不可沒有所消耗的原物料!");
                return false;
            }

            if(this.$refs.ProducesProductsDetail.details.length == 0){
                $.showWarningModal("不可沒有所產出的商品!");
                return false;
            }

            if(!this.checkNoZeroQty(this.$refs.ProducesMaterialsDetail.details) || !this.checkNoZeroQty(this.$refs.ProducesProductsDetail.details)){
                $.showWarningModal("不得有0投入的原物料或者0產出商品的存在！");
                return false;
            }

            $.showLoadingModal();
            let url = this.updateProduce;
            let data = $(e.target).serialize();
            axios.patch(url, data).then(response => {
                $('#m_produceID').val(response.data.produce_id);
                $('#p_produceID').val(response.data.produce_id);

                let detail_url = $('#updateProduceDetail').text();
                let detail_data = {
                    produce_id: response.data.produce_id,
                    material_details: this.$refs.ProducesMaterialsDetail.details,
                    product_details: this.$refs.ProducesProductsDetail.details,
                };
                axios.patch(detail_url, detail_data).then(response => {
                    $.showSuccessModal(response.data.message, response.data.url);
                    // location.href = $('#getProducesIndex').html();
                }).catch((error) => {
                    console.error('新增庫存細項時發生錯誤，錯誤訊息：' + error);
                    $.showErrorModal(error);
                });
            }).catch((error) => {
                console.error('新增商品庫存時發生錯誤，錯誤訊息：' + error);
                $.showErrorModal(error);
            });
        },
        checkNoZeroQty($details){
            let result = true;
            for(let i = 0; i < $details.length; i++){
                if($details[i].quantity == 0){
                    result = false;
                    break;
                }
            }
            return result;
        }
    },
    created(){

    },
    mounted() {

    },
}
</script>

