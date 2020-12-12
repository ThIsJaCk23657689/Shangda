Vue.component('consumers-table', require('./../components/Consumers/ConsumersTable.vue').default);
Vue.component('paginate-custom', require('./../components/Partials/PaginateCustom.vue').default);

const app = new Vue({
    el: '#consumer',
    data() {
        return {
            rowsPerPage: 10,
            pageNum: 1,
            totalPage: 0,
            DataTotalCount: 0,

            consumers: [],

            status: 0,
            category: 14,
            type: 0,
            keywords: '',
            orderby: 2,
        }
    },
    methods: {
        changeStatus(status) {
            this.status = status;
            this.updateConsumer(this.pageNum, true)
        },
        changeOrder(orderby) {
            this.orderby = orderby;
            this.updateConsumer(this.pageNum, true)
        },
        changeKeywordsType(keywords, type, status, category, orderby) {
            this.category = category;
            this.keywords = keywords;
            this.type = type;
            this.status = status;
            this.orderby = orderby;
            this.updateConsumer(this.pageNum, true)
        },
        changeCategory(category) {
            this.category = category;
            this.updateConsumer(this.pageNum, true)
        },
        updateConsumer(pageNum, first_page) {
            if (first_page) {
                this.pageNum = 1;
            } else {
                this.pageNum = pageNum;
            }
            // console.log(first_page);

            let skip = (pageNum - 1) * this.rowsPerPage;
            let take = this.rowsPerPage;
            let status = this.status;
            let keywords = this.keywords;
            let type = this.type;
            let category = this.category;
            let orderby = this.orderby;

            let ConsumersGetList = $('#ConsumersGetList').html();
            $('.dataTables_processing', $('#ConsumersDataTable').closest('.dataTables_wrapper')).fadeIn();
            axios.get(ConsumersGetList, {
                params: {
                    skip: skip,
                    take: take,
                    status: status,
                    keywords: keywords,
                    type: type,
                    category: category,
                    first_page: first_page,
                    orderby: orderby,
                }
            }).then(response => {
                this.consumers = response.data.consumers;
                this.DataTotalCount = response.data.DataTotalCount;
                this.totalPage = Math.ceil(this.DataTotalCount / this.rowsPerPage);
                $('.dataTables_processing', $('#ConsumersDataTable').closest('.dataTables_wrapper')).fadeOut();
                $('#ConsumersDataTable').dataTable().fnClearTable();
                if (this.consumers.length != 0) {
                    $('#ConsumersDataTable').dataTable().fnAddData(this.consumers);
                }
                this.refreshDeleteBtn();
            }).catch(error => {
                console.log("讀取顧客清單時發生錯誤！");
                console.log(error);
            });
        },
        refreshDeleteBtn() {
            let $vm = this;
            
            // 封鎖顧客
            $('.delete-btn').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: '注意！',
                    text: '確定要封鎖此顧客嗎？',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '確認',
                    cancelButtonText: '取消',
                }).then((result) => {
                    if (result.value) {
                        $.showLoadingModal();
                        let $url = $(this).next().html();
                        axios.post($url, {
                            _method: 'DELETE'
                        }).then(response => {
                            // console.log(response);
                            $.showSuccessModal('封鎖成功！');
                            $vm.updateConsumer($vm.pageNum, true);
                        }).catch(error => {
                            $.showErrorModal(error);
                        });
                    }
                });
            });

            // 解除封鎖
            $('.unlock-btn').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: '注意！',
                    text: '確定要解鎖此顧客嗎？',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '確認',
                    cancelButtonText: '取消',
                }).then((result) => {
                    if (result.value) {
                        $.showLoadingModal();
                        let $url = $(this).next().html();
                        axios.post($url, {
                            _method: 'DELETE'
                        }).then(response => {
                            // console.log(response);
                            $.showSuccessModal('解鎖成功！');
                            $vm.updateConsumer($vm.pageNum, true);
                        }).catch(error => {
                            $.showErrorModal(error);
                        });
                    }
                });
            });
        }
    },
    created() {
        let ConsumersGetList = $('#ConsumersGetList').html();
        axios.get(ConsumersGetList).then(response => {
            this.DataTotalCount = response.data.DataTotalCount;
            this.totalPage = Math.ceil(this.DataTotalCount / this.rowsPerPage);
            this.consumers = response.data.consumers;

            $('#ConsumersDataTable').on('draw.dt', function() {
                // console.log('drawing a table');
            }).on('init.dt', function() {
                // console.log('intial a table');
            }).dataTable({
                data: this.consumers,
                columns: [
                    { data: 'index' },
                    { data: 'account' },
                    { data: 'name' },
                    { data: 'taxID' },
                    { data: 'operator_name_1' },
                    { data: 'operator_tel_1' },
                    { data: 'uncheckedAmount' },
                    { data: 'action' },
                ],
                lengthChange: false,
                searching: false,
                pageLength: this.rowsPerPage,
                info: false,
                paging: false,
                processing: true,
                "ordering": false
            });
            this.refreshDeleteBtn();
        });
    },
    mounted() {

    }
});
