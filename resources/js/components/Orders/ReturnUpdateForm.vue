<template>
<div class="row justify-content-center">
    <div class="col-md-11">
        <form id="ReturnOrderUpdateForm" method="POST" action="#" v-on:submit.prevent="updateReturnOrder">

            <!-- 退貨單 -->
            <input type="hidden" name="status" value="2">
            <!-- 核准狀態 -->
            <input type="hidden" name="confirmStatus" value="1">

            <div class="row">

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="consumer_id">
                                    <span class="text-danger mr-2">*</span>顧客名稱
                                </label>
                                <select id="consumer_id" name="consumer_id" class="form-control" v-model="returnOrder.consumer_id" @change="getConsumerData">
                                    <option value="0">請選擇...</option>
                                    <option-item v-for="data in consumers" :key="data.id" :data="data"></option-item>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="consumer_id" style="color: white;">+</label>
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#CreateConsumerModal">
                                    <i class="fas fa-user-tie mr-2"></i>
                                    新增顧客
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="shownID">退貨單編號</label>
                        <input id="shownID" name="shownID" type="text" class="form-control"  v-model="returnOrder.shown_id" readonly>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="created_at">訂單建立日期</label>
                        <input id="created_at" type="text" class="form-control"  v-model="returnOrder.created_at" readonly>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="creator">建立者</label>
                        <input id="creator" type="text" class="form-control" v-model="returnOrder.creator" readonly>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_shortName">顧客簡稱</label>
                                <input id="show_shortName" type="text" class="form-control" :value="current_consumer.shortName || '無'" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_act">帳號</label>
                                <input id="show_act" type="text" class="form-control" :value="current_consumer.act || '無'" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_taxID">統一編號</label>
                                <input id="show_taxID" type="text" class="form-control" :value="current_consumer.taxID || '無'" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_settlement">結算方式</label>
                                <input id="show_settlement" type="text" class="form-control mb-2" :value="current_consumer.settlement || '無'" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_uncheckedAmount">未沖帳金額</label>
                                <input id="show_uncheckedAmount" type="text" class="form-control" :value="current_consumer.uncheckedAmount || '0'" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_totalConsumption">總消費額</label>
                                <input id="show_totalConsumption" type="text" class="form-control" :value="current_consumer.totalConsumption || '0'" readonly>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group" style="height: 72%">
                        <label for="show_consumer_comment">顧客備註</label>
                        <textarea id="show_consumer_comment" type="text" class="form-control" :value="current_consumer.comment || '無'" readonly style="height: 100%"></textarea>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="show_companyAddress">公司地址</label>
                        <input id="show_companyAddress" type="text" class="form-control" :value="current_consumer.companyAddress || '無'" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="show_deliveryAddress">送貨地址</label>
                        <input id="show_deliveryAddress" type="text" class="form-control" :value="current_consumer.deliveryAddress || '無'" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="show_invoiceAddress">發票地址</label>
                        <input id="show_invoiceAddress" type="text" class="form-control" :value="current_consumer.invoiceAddress || '無'" readonly>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="taxType">
                            <span class="text-danger mr-2">*</span>稅別
                        </label>
                        <select name="taxType" id="taxType" class="form-control" v-model="returnOrder.taxType" required @change="changeTax">
                            <option value="1">應稅</option>
                            <option value="2">未稅</option>
                            <option value="3">免稅</option>
                            <option value="4">零稅 - 經海關</option>
                            <option value="5">零稅 - 非經海關</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="height: 72%">
                        <label for="comment">訂單備註</label>
                        <textarea id="comment" name="comment" type="text" class="form-control" v-model="returnOrder.comment" style="height: 100%"></textarea>
                    </div>
                </div>
            </div>

            <hr>

            <input id="totalPrice" name="totalPrice" type="hidden" class="form-control" :value="total_price">

            <return-update-detail
                ref="returndetail"
                :products="products"
                :details="returnOrder.details"
                :sales_order_id="returnOrder.id"
                @show-total-price="showTotalPrice">
            </return-update-detail>

            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="beforePrice">退貨額</label>
                        <input id="beforePrice" type="text" class="form-control" value="0" required readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="taxPrice">稅額</label>
                        <input id="taxPrice" type="text" class="form-control" value="0" required readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="totalTaxPrice">總額</label>
                        <input id="totalTaxPrice" name="totalTaxPrice" type="text" class="form-control" :value="total_price || '0'" required readonly>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-block btn-primary">
                        確認修改
                    </button>
                    <a :href="returnUrl" class="btn btn-block btn-danger">
                        返回退貨單首頁
                    </a>
                </div>
            </div>
            <loading-modal></loading-modal>

        </form>
    </div>
</div>
</template>

<style>
</style>

<script>
export default {
    props: ['consumers', 'current_consumer', 'products', 'returnOrder', 'returnUrl'],
   data(){
        return {
            total_price: 0,
        }
    },
    methods: {
        getConsumerData(){
            let consumer_id = $('#consumer_id').val();
            if(consumer_id != 0){
                this.$emit('get-consumer-data', {
                    id: consumer_id
                });
            }else{
                $.showWarningModal('請選擇廠商');
                this.$emit('get-consumer-data', null);
            }
        },

        showTotalPrice(total_price){
            this.total_price = total_price;
        },

        changeTax () {
            this.$refs.returndetail.calculateTotalPrice();
        },

        updateReturnOrder(e){
            // 檢查是否有新增原物料在進貨單內。
            if(this.returnOrder.details.length == 0){
                $.showWarningModal('退貨單必須至少要有一項產品退貨。');
                return false;
            }

            // 1. 先創建 ReturnOrder
            let url = $('#updateReturnOrder').text();
            let data = $(e.target).serialize();

            $.showLoadingModal();
            axios.patch(url, data).then(response => {
                // $('#salesOrderID').val(response.data.ReturnOrderID);

                // 2. 編輯 ReturnOrderDetail
                let detailURL = $('#updateReturnOrderDetail').text();
                let detailData = $('#SalesOrderDetailForm').serialize();

                axios.patch(detailURL, detailData).then(response => {
                   $.showSuccessModal(response.data.message, response.data.url);
                }).catch((error) => {
                    console.error('更新退貨單細項時發生錯誤，錯誤訊息：' + error);
                    $.showErrorModal(error);
                });
            }).catch((error) => {
                console.error('更新退貨單時發生錯誤，錯誤訊息：' + error);
                $.showErrorModal(error);
            });
        }
    },
    created(){

    },
    mounted(){

    }
}
</script>

