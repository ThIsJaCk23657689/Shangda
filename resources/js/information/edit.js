Vue.component('information-update-form', require('./../components/Information/InformationUpdateForm.vue').default);
Vue.component('upload-images', require('./../components/Partials/UploadImages.vue').default);

const app = new Vue({
    el: '#information',
    data() {
        return {
            information: [],
            InformationGetOneURL: $('#InformationGetOneURL').text(),
        }
    },
    methods: {

    },
    created() {
        $.showLoadingModal();
        axios.get(this.InformationGetOneURL).then(response => {
            this.information = response.data.information;
            $.closeModal();
        }).catch((error) => {
            console.error('讀取最新消息資料時發生錯誤：' + error);
            $.showErrorModal(error);
        });
    },
    mounted() {

    }
});