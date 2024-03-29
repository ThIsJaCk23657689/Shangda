Vue.component('user-create-form', require('./../components/Users/UserCreateForm.vue').default);

const app = new Vue({
    el: '#user',
    data() {
        return {
            jobTitles: [],
        }
    },
    methods: {

    },
    created() {
        $.showLoadingModal();
        let GetJobTitleListURL = $('#GetJobTitleListURL').text();
        axios.get(GetJobTitleListURL).then(response => {
            this.jobTitles = response.data.jobTitles;
            
            // 刪除最後一個 編號:4 Admin 職位
            this.jobTitles.splice(3, 1);
            
            $.closeModal();
        }).catch(error => {
            console.error('抓取職稱清單時發生錯誤，原因：' + error);
            $.showErrorModal(error);
        });
    },
    mounted() {

    }
});