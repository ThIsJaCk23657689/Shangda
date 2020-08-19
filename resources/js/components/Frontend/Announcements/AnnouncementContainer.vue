<template>
<div class="row announcement-list">
    <announcement-card v-for="announcement in announcements" :announcement="announcement" :key="announcement.id"></announcement-card>
    <span class="not-found-message" v-if="announcements.length == 0">
        很抱歉，無法找到您所查詢的資料，請重新查詢謝謝。
    </span>
</div>
</template>

<script>
export default {
    props: ['announcements'],
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
