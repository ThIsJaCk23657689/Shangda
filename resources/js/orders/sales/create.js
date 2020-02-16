
Vue.component('sales-create-form', require('./../../components/Orders/SalesCreateForm.vue').default);
Vue.component('sales-detail', require('./../../components/Orders/SalesDetail.vue').default);

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
        getConsumerData(id){
            let getConsumerInfo = $('#getConsumerInfo').html();

            axios.post(getConsumerInfo, id).then(response => {
                console.log(response);
                this.current_consumer = response.data;
                if(this.current_consumer.monthlyCheckDate == 0){
                    this.current_consumer.settlement = '當日結算';
                }else{
                    this.current_consumer.settlement = '每個月' + this.current_consumer.monthlyCheckDate + '號結算';
                }
            });
        },
    },
    created(){
        let getConsumersName = $('#getConsumersName').html();
        let getProductssName = $('#getProductssName').html();

        axios.get(getConsumersName).then(response => {
            this.consumers = response.data;
        });

        axios.get(getProductssName).then(response => {
            this.products = response.data;
        });
    }
});