Vue.component('sales-month', require('../../components/Reports/SalesMonth.vue').default);

const app = new Vue({
    el: '#reports',
    data() {
        return {
            reports: [],
            infos: {
                totalSales: 0,
                totalSalesCount: 0,
                averageSales: 0,
            },
            chart: {},
            queryArgs: {
                year: new Date().getFullYear(),
                month: new Date().getMonth() + 1,
            },
        }
    },
    methods: {
        fetchData(e) {
            let getSalesMonthData = $('#getSalesMonthData').text();

            $.showLoadingModal();
            axios.post(getSalesMonthData, this.queryArgs).then(response => {
                this.reports = response.data.result;

                // 總銷售額初始化為 0
                this.infos.totalSales = 0;

                // 如果 this.reports 是 array
                this.reports.forEach(report => {
                    this.infos.totalSales += report.sales;
                });

                // 商品總數
                this.infos.totalSalesCount = this.reports.length;

                // 平均銷售額（加上防止除以 0）
                this.infos.averageSales = this.reports.length > 0
                    ? Math.round(this.infos.totalSales / this.infos.totalSalesCount)
                    : 0;

                $.closeModal();
            }).catch(error => {
                console.log('生成報表時發生錯誤：' + error);
                $.showErrorModal(error);
            });
        },
        getTrendData(productId) {
            let getSalesMonthTrend = $('#getSalesMonthTrendData').text();
            axios.post(getSalesMonthTrend, {
                product_id: productId,
                year: this.queryArgs.year,
                month: this.queryArgs.month,
            }).then(response => {
                this.chart = response.data.result;
            }).catch(error => {
                console.log('產生銷售趨勢圖時發生錯誤：' + error);
            });
        }
    },
    created() {
        this.fetchData();
    },
    mounted() {
    }
});
