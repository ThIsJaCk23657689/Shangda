Vue.component('sales-update-form', require('./../../components/Orders/SalesUpdateForm.vue').default);
Vue.component('return-update-detail', require('./../../components/Orders/ReturnUpdateDetail.vue').default);
const app = new Vue({
    el: '#sales',
    data() {
        return {
            consumers: [],
            current_consumer: [],
            products: [],
            salesOrder: [],
        }
    },
    methods: {
        getConsumerData(id) {
            let getConsumerInfo = $('#getConsumerInfo').html();

            axios.post(getConsumerInfo, id).then(response => {
                console.log(response);
                this.current_consumer = response.data;
                if (this.current_consumer.monthlyCheckDate == 0) {
                    this.current_consumer.settlement = '當日結算';
                } else {
                    this.current_consumer.settlement = '每個月' + this.current_consumer.monthlyCheckDate + '號結算';
                }
            });
        },
    },
    created() {
        let getConsumersName = $('#getConsumersName').html();
        let getProductsName = $('#getProductsName').html();

        axios.get(getConsumersName).then(response => {
            this.consumers = response.data;
        });

        axios.get(getProductsName).then(response => {
            this.products = response.data;
        });

        let getSalesOrderInfo = $('#getSalesOrderInfo').text();

        $.showLoadingModal();

        axios.get(getSalesOrderInfo).then(response => {
            this.salesOrder = response.data.salesOrder;
            this.salesOrder.details = response.data.details;
            $('#consumer_id').val(this.salesOrder.consumer_id);
            this.getConsumerData({
                id: this.salesOrder.consumer_id
            });

            // 計算金額
            let $total_price = 0;
            for (let i = 1; i <= this.salesOrder.details.length; i++) {
                let qty = this.salesOrder.details[i - 1].quantity;
                let price = this.salesOrder.details[i - 1].price;
                let discount = this.salesOrder.details[i - 1].discount;
                let subTotal = Math.round(price * qty * discount * 10000) / 10000;
                $total_price = $total_price + subTotal;
            }
            $('#beforePrice').val($total_price);

            let taxType = this.salesOrder.taxType;
            let tax = (taxType == "1") ? Math.round($total_price * 0.05 * 10000) / 10000 : 0;
            $('#tax_price').val(tax);

            $total_price = Math.round(($total_price + tax) * 10000) / 10000;
            this.$refs.salesOrderform.showTotalPrice($total_price);

            $.closeModal();
        });
    }
});