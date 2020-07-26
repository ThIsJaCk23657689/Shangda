<template>
<div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table mr-2"></i>銷貨日報表 - {{ filters.start_date }} ~ {{ filters.end_date }}
        </div>
        <div class="card-body">
            <div class="row justify-content-center mb-2">
                <div class="col-md-12 justify-content-center">
                    <form action="#" method="GET">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-3">
                                <select name="type" id="type" class="form-control" v-model="filters.type" @change="changeType">
                                    <option value="1">依客戶別</option>
                                    <option value="2">依商品別</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <datepicker :input-class="'form-control'" :format="'yyyy-MM-dd'" :value="filters.start_date" @selected="getStartDate"></datepicker>
                            </div>
                            <div class="col-md-3">
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
                            <th>銷貨日期</th>
                            <th>{{ tableTitle }}</th>
                            <th v-if="filters.type == 2">銷貨數量</th>
                            <th>銷貨總價</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="n in report.length" :key="n">
                            <td>{{ report[n - 1].date }}</td>
                            <td>{{ report[n - 1].name }}</td>
                            <td v-if="filters.type == 2">{{ report[n - 1].quantity }}<span v-if="report[n - 1].quantity != ''">{{ ' ' + report[n - 1].unit == 1? '公斤':'公噸' }}</span></td>
                            <td>{{ report[n - 1].subTotal }}</td>
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
            tableTitle: '客戶名稱',
        }
    },
    methods: {
        changeType(e){
            if(e.target.value == 1){
                this.tableTitle = '客戶名稱';
            }else{
                this.tableTitle = '商品名稱';
            }
            this.$emit('refresh-data');
        },
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
