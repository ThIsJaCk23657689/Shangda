<template>
<div class="announcement-card" @mouseenter="zoomIn" @mouseleave="zoomOut">
    <a :href="announcement.detailURL" class="card-link">
        
        <div class="announcement-card-image">
            <img :src="announcement.showCoverImage" alt="最新消息封面圖">
            <div class="image-gray"></div>
        </div>
        <div class="announcement-card-info">
            <div class="announcement-card-date">
                <h3>{{ announcement.showDay }}</h3>
                <span>{{ announcement.showMonth }}<br>{{ announcement.showYear }}</span>
            </div>
            <div class="announcement-card-title">
                {{ announcement.title }}
            </div>
        </div>
        
    </a>
</div>
</template>

<script>
export default {
    props: ['announcement'],
    data(){
        return {

        }
    },
    methods: {
        zoomIn(e){
            $(e.target).addClass('animate');
        },
        zoomOut(e){
            $(e.target).removeClass('animate');
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