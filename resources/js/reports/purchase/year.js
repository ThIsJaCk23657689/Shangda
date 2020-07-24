Vue.component('purchase-year', require('../../components/Reports/PurchaseYear.vue').default);

const app = new Vue({
    el: '#reports',
    data() {
        return {
            reports: [],
            month_total: ['合計', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            filters: {
                type: 1,
                year: 2020,
                orderby: 1
            },

        }
    },
    methods: {
        refreshData(e) {
            let getPurchaseYearData = $('#getPurchaseYearData').text();

            $.showLoadingModal();
            axios.post(getPurchaseYearData, this.filters).then(response => {
                this.reports = response.data.result;
                let month_total = ['合計', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

                let vm = this;
                let $key = Object.keys(this.reports);
                $key.forEach(function(item, index) {
                    let report = vm.reports[item];
                    for (let $i = 1; $i < report.length; $i++) {
                        month_total[$i] += report[$i];
                        month_total[$i] = Math.round(month_total[$i] * 100) / 100;
                    }
                });
                this.month_total = month_total;

                $.closeModal();
            }).catch(error => {
                console.log('生成報表時發生錯誤：' + error);
                $.showErrorModal(error);
            });
        }
    },
    created() {
        this.refreshData();
    },
    mounted() {

    }
});