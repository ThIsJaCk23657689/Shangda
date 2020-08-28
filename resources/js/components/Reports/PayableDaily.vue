<template>
<div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table mr-2"></i>應付帳款日度報表 - {{ filters.start_date }} ~ {{ filters.end_date }}
        </div>
        <div class="card-body">
            <div class="row justify-content-center mb-2">
                <div class="col-md-12 justify-content-center">
                    <form action="#" method="GET">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-4">
                                <datepicker :input-class="'form-control'" :format="'yyyy-MM-dd'" :value="filters.start_date" @selected="getStartDate"></datepicker>
                            </div>
                            <div class="col-md-4">
                                <datepicker :input-class="'form-control'" :format="'yyyy-MM-dd'" :value="filters.end_date" @selected="getEndDate"></datepicker>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" v-for="(report, key) in reports" :key="key">
                    <thead>
                        <tr>
                            <th>廠商編號</th>
                            <th>廠商名稱</th>
                            <th>聯絡窗口</th>
                            <th>連絡電話</th>
                            <th>公司地址</th>
                            <th>應付總額</th>

                            <!-- <th>進貨日期</th>
                            <th>{{ tableTitle }}</th>
                            <th v-if="filters.type == 2">進貨數量</th>
                            <th>進貨總價</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="n in report.length" :key="n">
                            <td>{{ report[n - 1].id }}</td>
                            <td>{{ report[n - 1].name }}</td>
                            <td>{{ report[n - 1].operator_name_1 }}</td>
                            <td>{{ report[n - 1].operator_tel_1 }}</td>
                            <td>{{ report[n - 1].showAddress }}</td>
                            <td>{{ report[n - 1].totalPrice }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['reports', 'filters'],
    data(){
        return {
            tableTitle: '供應商名稱',
        }
    },
    methods: {
        submitFilter(e){
            this.$emit('refresh-data');
        },
        getStartDate(input_date){
            this.filters.start_date = $.datepicker.formatDate('yy-mm-dd', new Date(input_date));
            this.$emit('refresh-data');
        },
        getEndDate(input_date){
            this.filters.end_date = $.datepicker.formatDate('yy-mm-dd', new Date(input_date));
            this.$emit('refresh-data');
        },
    },
    created(){

    },
    mounted(){

    }
}
</script>

<style>
</style>
