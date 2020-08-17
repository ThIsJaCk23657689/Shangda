Vue.component('announcement-update-form', require('./../components/Announcements/AnnouncementUpdateForm.vue').default);
Vue.component('upload-images', require('./../components/Partials/UploadImages.vue').default);

const app = new Vue({
    el: '#announcement',
    data() {
        return {
            announcement: [],
            AnnouncementsGetOneURL: $('#AnnouncementsGetOneURL').text(),
        }
    },
    methods: {

    },
    created() {
        $.showLoadingModal();
        axios.get(this.AnnouncementsGetOneURL).then(response => {
            this.announcement = response.data.announcement;
            $.closeModal();
        }).catch((error) => {
            console.error('讀取最新消息資料時發生錯誤：' + error);
            $.showErrorModal(error);
        });
    },
    mounted() {

    }
});