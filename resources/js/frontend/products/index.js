Vue.component('product-filter', require('../../components/Frontend/Products/ProductFilter.vue').default);
Vue.component('product-container', require('../../components/Frontend/Products/ProductContainer.vue').default);
Vue.component('product-card', require('../../components/Frontend/Products/ProductCard.vue').default);
Vue.component('content-paginate', require('../../components/Frontend/Partials/ContentPaginate.vue').default);

const contnet = new Vue({
    el: '#product',
    data() {
        return {
            products: [],
            filter: {
                type: 0,
                keyword: '',
                order: 0,
            },

            totalcount: 0,
            currentPage: 1,
            totalPage: 0,
        }
    },
    methods: {
        getProducts(firstPage = 0) {
            $.showLoadingModal();

            if (firstPage == 1 || this.currentPage == 0) {
                this.currentPage = 1;
            }

            let url = $('#GetProductsList').text();
            axios.post(url, {
                skip: (this.currentPage - 1) * 21,
                type: this.filter.type,
                keywords: this.filter.keyword,
                orderBy: this.filter.order,
                firstPage: firstPage,
                status: 1
            }).then(response => {
                this.products = response.data.products;
                this.totalcount = response.data.totalcount;
                this.totalPage = Math.ceil(this.totalcount / 21);
                if (this.totalcount == 0) {
                    this.currentPage = 0;
                }
                $.closeModal();
            }).catch(error => {
                console.log('抓取商品資料時錯誤。');
                $.showErrorModal(error);
            });
        },
        refreshProduct(firstPage) {
            this.getProducts(firstPage);
            this.goBackToTop();
        },
        goBackToTop() {
            $('html, body').animate({
                scrollTop: 440
            }, 500);
        },
        chagePage(value) {
            this.currentPage = value;
            this.getProducts();
            this.goBackToTop();
        },
    },
    created() {
        this.getProducts();
    },
    mounted() {

    }
});