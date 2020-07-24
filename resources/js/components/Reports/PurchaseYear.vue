<template>
<div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table mr-2"></i>進貨年度報表 - {{ filters.year }}年
        </div>
        <div class="card-body">
            <div class="row justify-content-center mb-2">
                <div class="col-md-12 justify-content-center">
                    <form action="#" method="GET">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-3">
                                <select name="type" id="type" class="form-control" v-model="filters.type" @change="changeType">
                                    <option value="1">依供應商別</option>
                                    <option value="2">依原料別</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="year" name="year" class="form-control" placeholder="請輸入年份：2020" v-model="filters.year" @change="changeYear">
                            </div>
                            <div class="col-md-3">
                                <select name="orderby" id="orderby" class="form-control" v-model="filters.orderby" @change="changeOrderby">
                                    <option value="1">總進貨額升序</option>
                                    <option value="2">總進貨額降序</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table id="PurchaseYearTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>供應商姓名</th>
                            <th v-for="n in 12" :key="n">{{ n + '月' }}</th>
                            <th>小計</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="report in reports" :key="report[0]">
                            <td v-for="n in report.length" :key="n">{{ report[n - 1] }}</td>
                        </tr>
                        <tr>
                            <td v-for="index in month_total.length" :key="index">
                                <strong>{{ month_total[index - 1] }}</strong>
                            </td>
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
    props: ['reports', 'filters', 'month_total'],
    data(){
        return {

        }
    },
    methods: {
        changeType(e){
            this.$emit('refresh-data');
        },
        changeYear(e){
            this.$emit('refresh-data');
        },
        changeOrderby(e){
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
