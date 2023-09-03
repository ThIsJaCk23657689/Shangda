<template>
<div class="row justify-content-center">
    <div class="col-md-11">
        <form id="SalesOrderCreateForm" method="POST" action="#" @submit.prevent="createSalesOrder">

            <input type="hidden" name="status" value="1">
            <input type="hidden" name="confirmStatus" value="1">

            <div class="row">

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="consumer_id">
                                    <span class="text-danger mr-2">*</span>顧客名稱
                                </label>
                                <select id="consumer_id" name="consumer_id" class="form-control" @change="getConsumerData">
                                    <option value="0">請選擇...</option>
                                    <option v-for="consumer in consumers" :value="consumer.id">{{ consumer.name }}</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="consumer_id" style="color: white;">+</label>
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#CreateConsumerModal">
                                    <i class="fas fa-user-tie mr-2"></i>
                                    新增顧客
                                </button>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="shownID">銷貨單編號</label>
                        <input id="shownID" name="shownID" type="text" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="created_at">訂單建立日期</label>
                        <input id="created_at" type="text" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="creator">建立者</label>
                        <input id="creator" type="text" class="form-control" readonly>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_shortName">顧客簡稱</label>
                                <input id="show_shortName" type="text" class="form-control" :value="current_comsumer.shortName || '無'" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_act">帳號</label>
                                <input id="show_act" type="text" class="form-control" :value="current_comsumer.account || '無'" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_taxID">統一編號</label>
                                <input id="show_taxID" type="text" class="form-control" :value="current_comsumer.taxID || '無'" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_settlement">結算方式</label>
                                <input id="show_settlement" type="text" class="form-control mb-2" :value="current_comsumer.settlement || '無'" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_uncheckedAmount">未沖帳金額</label>
                                <input id="show_uncheckedAmount" type="text" class="form-control" :value="current_comsumer.uncheckedAmount || '0'" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_totalConsumption">總消費額</label>
                                <input id="show_totalConsumption" type="text" class="form-control" :value="current_comsumer.totalConsumption || '0'" readonly>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group" style="height: 72%">
                        <label for="show_consumer_comment">顧客備註</label>
                        <textarea id="show_consumer_comment" type="text" class="form-control" :value="current_comsumer.comment || '無'" readonly style="height: 100%"></textarea>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="show_companyAddress">地址</label>
                        <input id="show_companyAddress" type="text" class="form-control" :value="current_comsumer.address || '無'" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="show_deliveryAddress">送貨地址</label>
                        <input id="show_deliveryAddress" type="text" class="form-control" :value="current_comsumer.deliveryAddress || '無'" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="show_email">信箱</label>
                        <input id="show_email" type="text" class="form-control" :value="current_comsumer.email || '無'" readonly>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expectPay_at">
                                    <span class="text-danger mr-2">*</span>預計付款日
                                </label>
                                <input id="expectPay_at" name="expectPay_at" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expectDeliver_at">
                                    <span class="text-danger mr-2">*</span>預計出貨日
                                </label>
                                <input id="expectDeliver_at" name="expectDeliver_at" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="invoiceType">
                                    <span class="text-danger mr-2">*</span>發票類型
                                </label>
                                <select name="invoiceType" id="invoiceType" class="form-control" required>
                                    <option value="1">三聯式</option>
                                    <option value="2">二聯式</option>
                                    <option value="3">三聯銷退折讓</option>
                                    <option value="4">二聯銷退折讓</option>
                                    <option value="5">三聯式收銀機</option>
                                    <option value="6">免用發票</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="taxType">
                                    <span class="text-danger mr-2">*</span>稅別
                                </label>
                                <select name="taxType" id="taxType" class="form-control" required @change="changeTax">
                                    <option value="1">應稅</option>
                                    <option value="2">未稅</option>
                                    <option value="3">免稅</option>
                                    <option value="4">零稅 - 經海關</option>
                                    <option value="5">零稅 - 非經海關</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="height: 72%">
                        <label for="comment">訂單備註</label>
                        <textarea id="comment" name="comment" type="text" class="form-control" style="height: 100%"></textarea>
                    </div>
                </div>
            </div>

            <hr>

            <sales-detail ref="salesdetail" :products="products" v-on:showTotalPrice="showTotalPrice"></sales-detail>

            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="totalPrice">銷售額</label>
                        <input id="totalPrice" type="text" class="form-control" value="0" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="taxPrice">稅額</label>
                        <input id="taxPrice" type="text" class="form-control" value="0" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="totalTaxPrice">總額</label>
                        <input id="totalTaxPrice" name="totalTaxPrice" type="text" class="form-control" :value="total_price || '0'" required>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="button" class="btn btn-block btn-primary" @click="createSalesOrder">
                        確認新增
                    </button>
                    <a :href="getSalesOrderIndex" class="btn btn-block btn-danger">
                        返回進貨單首頁
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
    props: ['consumers', 'current_comsumer', 'products'],
    mounted() {
        $("#expectPay_at").datepicker({
            changeYear: true,
            changeMonth: true,
            dateFormat: 'yy-mm-dd'
        });

        $("#expectDeliver_at").datepicker({
            changeYear: true,
            changeMonth: true,
            dateFormat: 'yy-mm-dd'
        });

        // 設定 訂單日期為今天 和 其他欄位 為預設。
        var myDate = new Date();
        var date = myDate.getFullYear() + '-' + ('0'+ (myDate.getMonth() + 1) ).slice(-2) + '-' + ('0'+ myDate.getDate()).slice(-2);
        $("#created_at").val(date);
        $("#expectPay_at").val(date);
        $("#expectDeliver_at").val(date);

        $('#shownID').val($('#getSalesOrderShownID').html());

        // 顯示此訂單建立者名稱
        $('#creator').val($('#getAuthName').html());

        // 訂單細項 表單程式碼
        $('#SalesOrderDetailForm').submit(function(e){
            e.preventDefault();

            let url = $('#createSalesOrderDetail').html();
            let data = $(this).serialize();
            axios.post(url, data).then(response => {
                console.log(response.data.messenge);
                alert('新增進貨單成功！');
                history.go(-1);
            }).catch((error) => {
                console.error('新增進貨單細項時發生錯誤，錯誤訊息：' + error);
                alert('新增進貨單細項時發生錯誤，錯誤訊息：' + error);
                $('#LoadingModal').modal('hide');
            });
        });
    },
    data(){
        return {
            total_price: 0,
            getSalesOrderIndex: $('#getSalesOrderIndex').html(),
        }
    },
    methods: {
        showTotalPrice(total_price){
            this.total_price = total_price;
        },

        changeTax () {
            this.$refs.salesdetail.calculateTotalPrice()  // 呼叫子元件裡的toggleFood方法
        },

        getConsumerData(){
            let consumer_id = $('#consumer_id').val();
            if(consumer_id != 0){
                this.$emit('get-consumer-data', {
                    id: consumer_id
                });
            }else{
                alert('請先選擇顧客!');
            }
        },

        createSalesOrder(){
            // 新建進貨單
            alert('createSalesOrder');

            // 1. 先創建 SalesOrder
            let url = $('#createSalesOrder').html();

            let data = $('#SalesOrderCreateForm').serialize();
            $('#LoadingModal').modal('show');
            axios.post(url, data).then(response => {
                console.log(response);
                $('#salesOrderID').val(response.data.salesOrder_id);

                // 2. 建立 SalesOrderDetail
                $('#SalesOrderDetailForm').submit();
            }).catch((error) => {
                console.error('新增進貨單時發生錯誤，錯誤訊息：' + error);
                alert('新增進貨單時發生錯誤，錯誤訊息：' + error);
                $('#LoadingModal').modal('hide');
            });
        },
    }
}
</script>

