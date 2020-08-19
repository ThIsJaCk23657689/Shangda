Vue.component('announcement-filter', require('../../components/Frontend/Announcements/AnnouncementFilter.vue').default);
Vue.component('announcement-container', require('../../components/Frontend/Announcements/AnnouncementContainer.vue').default);
Vue.component('announcement-card', require('../../components/Frontend/Announcements/AnnouncementCard.vue').default);
Vue.component('content-paginate', require('../../components/Frontend/Partials/ContentPaginate.vue').default);

const contnet = new Vue({
    el: '#announcement',
    data() {
        return {
            announcements: [],
            filter: {
                type: 0,
                keyword: '',
                order: 0,
            },

            totalcount: 0,
            currentPage: 1,
            totalPage: 0,
        }
    },
    methods: {
        getAnnouncements(firstPage = 0) {
            $.showLoadingModal();

            if (firstPage == 1 || this.currentPage == 0) {
                this.currentPage = 1;
            }

            let url = $('#GetAnnouncementsList').text();
            axios.post(url, {
                skip: (this.currentPage - 1) * 4,
                type: this.filter.type,
                keywords: this.filter.keyword,
                orderBy: this.filter.order,
                firstPage: firstPage,
                status: 1
            }).then(response => {
                this.announcements = response.data.announcements;
                this.totalcount = response.data.totalcount;
                this.totalPage = Math.ceil(this.totalcount / 20);
                if (this.totalcount == 0) {
                    this.currentPage = 0;
                }
                $.closeModal();
            }).catch(error => {
                console.log('抓取最新消息資料時錯誤。');
                $.showErrorModal(error);
            });
        },
        refreshAnnouncement(firstPage) {
            this.getAnnouncements(firstPage);
            this.goBackToTop();
        },
        goBackToTop() {
            $('html, body').animate({
                scrollTop: 440
            }, 500);
        },
        chagePage(value) {
            this.currentPage = value;
            this.getProducts();
            this.goBackToTop();
        },
    },
    created() {
        this.getAnnouncements();
    },
    mounted() {

    }
});