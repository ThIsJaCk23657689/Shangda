Vue.component('billing-index-list', require('./../../components/Orders/BillingIndexList.vue').default);

const app = new Vue({
    el: '#billing',
    data() {
        return {
            consumers: [],
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

        $.showLoadingModal();
        axios.get(getConsumersName).then(response => {
            $.closeModal();
            this.consumers = response.data;
        }).catch(error => {
            $.showErrorModal(error);
            console.error('抓取顧客名稱列表失敗，錯誤：' + error);
        });
    }
});
