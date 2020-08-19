<template>
<div class="row filter-row">
    <div class="col-md-3 col-6 d-flex">
        <div class="filter-dropbox-container">
            <select id="filter-column" name="column" class="form-control filter-dropbox" v-model="filter.type" @change="changeType">
                <option value="0">依條件</option>
                <option value="1">商品名稱</option>
                <option value="2">規格</option>
                <option value="3">顏色</option>
                <option value="0">全部搜尋</option>
            </select>
        </div>
    </div>
    <div class="col-md-6 col-12 d-flex search-div">
        <div class="filter-search">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>
            <input type="text" id="search-input" name="keyword" class="form-control search-input" placeholder="請輸入關鍵字" v-model="filter.keyword" @keypress.enter="search">
            <a href="#" class="search-button" @click.prevent="search">
                搜尋
            </a>
        </div>
    </div>
    <div class="col-md-3 col-6 d-flex order-2">
        <select id="filter-order" name="order" class="form-control filter-dropbox" v-model="filter.order" @change="changeOrder">
            <option value="0">排序方式</option>
            <option value="1">最新 -> 最舊</option>
            <option value="2">最舊 -> 最新</option>
            <option value="3">價錢高 -> 價錢低</option>
            <option value="4">價錢低 -> 價錢高</option>
        </select>
    </div>
</div>
</template>

<script>
export default {
    props: ['filter'],
    data(){
        return {

        }
    },
    methods: {
        changeType(){
            this.$emit('refresh-announcement', 1);
        },
        search(){
            this.$emit('refresh-announcement', 1);
        },
        changeOrder(){
            this.$emit('refresh-announcement');
        }
    },
    created(){

    },
    mounted(){

    }
}
</script>

<style>
</style>
