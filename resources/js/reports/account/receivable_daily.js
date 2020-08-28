import Datepicker from 'vuejs-datepicker';

Vue.component('receivable-daily', require('../../components/Reports/ReceivableDaily.vue').default);
Vue.component('datepicker', Datepicker);

const app = new Vue({
    el: '#reports',
    data() {
        return {
            reports: {},
            filters: {
                start_date: '2020-06-26',
                end_date: '2020-07-26'
            },

        }
    },
    methods: {
        refreshData(e) {
            let getPayableDailyData = $('#getPayableDailyData').text();

            $.showLoadingModal();
            axios.post(getPayableDailyData, this.filters).then(response => {
                this.reports = response.data.result;

                let vm = this;
                let $key = Object.keys(this.reports);
                $key.forEach(function(item, index) {
                    let report = vm.reports[item];
                    let daily_total = 0;
                    for (let $i = 0; $i < Object.keys(report).length; $i++) {
                        daily_total += report[$i].totalPrice;
                    }
                    vm.reports[item].push({
                        id: '小計',
                        operator_name: '',
                        operator_tel: '',
                        showAddress: '',
                        totalPrice: daily_total,
                    });
                });

                $.closeModal();
            }).catch(error => {
                console.log('生成報表時發生錯誤：' + error);
                $.showErrorModal(error);
            });
        },
    },
    created() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        this.filters.end_date = today;
        this.refreshData();

    },
    mounted() {

    }
});