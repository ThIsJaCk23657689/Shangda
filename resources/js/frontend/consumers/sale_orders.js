Vue.component('sale-orders-container', require('../../components/Frontend/SaleOrders/SaleOrdersContainer.vue').default);
Vue.component('sale-order-card', require('../../components/Frontend/SaleOrders/SaleOrderCard.vue').default);
Vue.component('content-paginate', require('../../components/Frontend/Partials/ContentPaginate.vue').default);
Vue.component('sale-order-filter', require('../../components/Frontend/SaleOrders/SaleOrderFilter.vue').default);

const contnet = new Vue({
    el: '#sale-orders',
    data() {
        return {
            saleOrders: [],
            filter: {
                status: 0,
            },

            totalcount: 0,
            currentPage: 1,
            totalPage: 0,
        }
    },
    methods: {
        getSaleOrders(firstPage = 0) {
            $.showLoadingModal();

            if (firstPage == 1 || this.currentPage == 0) {
                this.currentPage = 1;
            }

            let url = $('#getSaleOrdersFrontend').text();
            let consumer_id = $('#getConsumerID').text();
            axios.post(url, {
                skip: (this.currentPage - 1) * 5,
                status: this.filter.status,
                firstPage: firstPage,
                consumer_id: consumer_id,
            }).then(response => {
                this.saleOrders = response.data.sale_orders;
                this.totalcount = response.data.totalcount;
                this.totalPage = Math.ceil(this.totalcount / 5);
                if (this.totalcount == 0) {
                    this.currentPage = 0;
                }
                $.closeModal();
            }).catch(error => {
                console.log('抓取訂單資料時錯誤。');
                $.showErrorModal(error);
            });
        },
        changeStatus(status) {
            this.filter.status = status;
            let firstPage = 1;
            this.getSaleOrders(firstPage);
            this.goBackToTop();
        },
        goBackToTop() {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        },
        chagePage(value) {
            this.currentPage = value;
            this.getSaleOrders();
            this.goBackToTop();
        },
    },
    created() {
        this.getSaleOrders();
    },
    mounted() {

    }
});
