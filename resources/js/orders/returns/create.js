Vue.component('return-create-form', require('./../../components/Orders/ReturnCreateForm.vue').default);
Vue.component('return-detail', require('./../../components/Orders/ReturnDetail.vue').default);


const app = new Vue({
    el: '#returns',
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
    }
});