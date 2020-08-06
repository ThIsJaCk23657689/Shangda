<template>
<div class="sale-order-content">
    <div class="card">
        <div class="card-header">
            <p><i class="fas fa-calendar-alt"></i> {{ saleOrder.showCreatedDate }}</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p>訂單編號 : {{ saleOrder.shown_id }}</p>
                </div>
                <div class="col-md-6">
                    <p>訂單狀態 : {{ saleOrder.showSaleOrderStatus }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>訂單總額 : {{ saleOrder.totalTaxPrice }} 元</p>
                </div>
            </div>
            <a :href="saleOrder.showURL" class="btn btn-primary">查看訂單詳細資料</a>
        </div>
    </div>
</div>

</template>

<script>
export default {
    props: ['saleOrder'],
    data(){
        return {

        }
    },
    methods: {

    },
    created(){

    },
    mounted(){

    }
}
</script>

<style>
</style>
