Vue.component('sales-create-form', require('./../../components/Orders/SalesCreateForm.vue').default);
Vue.component('sales-detail', require('./../../components/Orders/SalesDetail.vue').default);
// Vue.component('create-consumer-modal', require('./../../components/Modals/CreateConsumerModal.vue').default);
// Vue.component('create-supplier-modal', require('./../../components/Modals/CreateSupplierModal.vue').default);

const app = new Vue({
    el: '#sales',
    data() {
        return {
            consumers: [],
            current_consumer: [],
            products: [],
        }
    },
    methods: {
        getConsumerData(id) {
            let getConsumerInfo = $('#getConsumerInfo').html();

            $.showLoadingModal();
            axios.post(getConsumerInfo, id).then(response => {
                $.closeModal();
                this.current_consumer = response.data;
                if (this.current_consumer.monthlyCheckDate == 0) {
                    this.current_consumer.settlement = '當日結算';
                } else {
                    this.current_consumer.settlement = '每個月' + this.current_consumer.monthlyCheckDate + '號結算';
                }
            }).catch(error => {
                $.showErrorModal(error);
                console.error('抓取顧客資料失敗，錯誤：' + error);
            });
        },
    },
    created() {
        let getConsumersName = $('#getConsumersName').html();
        let getProductsName = $('#getProductsName').html();

        $.showLoadingModal();
        axios.get(getConsumersName).then(response => {
            this.consumers = response.data;
        }).catch(error => {
            $.showErrorModal(error);
            console.error('抓取顧客名稱列表失敗，錯誤：' + error);
        });

        axios.get(getProductsName).then(response => {
            this.products = response.data;
            $.closeModal();
        }).catch(error => {
            $.showErrorModal(error);
            console.error('抓取商品名稱列表失敗，錯誤：' + error);
        });
    }
});
