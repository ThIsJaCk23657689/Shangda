<template>
<div class="sale-orders-list">
    <sale-order-card v-for="saleOrder in saleOrders" :saleOrder="saleOrder" :key="saleOrder.id"></sale-order-card>
    <div class="not-found-message" v-if="saleOrders.length == 0">
        很抱歉，無法找到您所查詢的資料，請重新查詢謝謝。
    </div>
</div>
</template>



<script>
export default {
    props: ['saleOrders'],
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
