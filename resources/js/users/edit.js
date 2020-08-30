Vue.component('user-update-form', require('./../components/Users/UserUpdateForm.vue').default);

const app = new Vue({
    el: '#user',
    data() {
        return {
            user: [],
            jobTitles: [],
        }
    },
    methods: {

    },
    created() {
        $.showLoadingModal();
        let UsersGetOneURL = $('#UsersGetOneURL').html();
        axios.get(UsersGetOneURL).then(response => {
            this.user = response.data.user;

            // 地址
            $('#address_twzipcode').twzipcode({
                'readonly': false,
                'zipcodeSel': this.user.address_zipcode,
                'county': this.user.address_county,
                'district': this.user.address_district,
                'zipcode': this.user.address_zipcode
            });
            $.closeModal();
        });

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
