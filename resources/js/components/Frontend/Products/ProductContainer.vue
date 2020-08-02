<template>
<div class="row product-list">
    <product-card v-for="product in products" :product="product" :key="product.id"></product-card>
    <span class="not-found-message" v-if="products.length == 0">
        很抱歉，無法找到您所查詢的資料，請重新查詢謝謝。
    </span>
</div>
</template>

<script>
export default {
    props: ['products'],
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