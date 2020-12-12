<template>
<div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table mr-2"></i>顧客列表
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                
                <div class="col-md-12 justify-content-center">
                    <form method="GET" id="search-by-keywords-form"  @submit.prevent="changeKeywordsType">
                        
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-3">
                                <select name="status" id="status" class="form-control" @change="changeStatus">
                                    <option value="0">所有狀態</option>
                                    <option value="1">已封鎖</option>
                                    <option value="2">未封鎖</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="category" id="category" class="form-control" @change="changeCategory">
                                    <option value="0">所有類別</option>
                                    <option value="1">個人帳號</option>
                                    <option value="2">公司帳號</option>
                                    <option value="3">管理者創建</option>
                                    <option value="4">顧客創建</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="orderby" id="orderby" class="form-control" @change="changeOrder">
                                    <option value="4">排序方式</option>
                                    <option value="1">建立日期(舊->新)</option>
                                    <option value="2">建立日期(新->舊)</option>
                                    <option value="3">更新日期(舊->新)</option>
                                    <option value="4" selected>更新日期(新->舊)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <select name="type" id="type" class="form-control">
                                    <option value="0">所有欄位</option>
                                    <option value="1">帳號</option>
                                    <option value="2">名稱</option>
                                    <option value="3">統編</option>
                                    <option value="4">聯絡人姓名</option>
                                    <option value="5">聯絡人電話</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="keywords" name="keywords" type="text" class="form-control mb-2" value="" autocomplete="off" placeholder="關鍵字搜尋...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-block btn-primary">
                                    確認
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table id="ConsumersDataTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>編號</th>
                            <th>帳號</th>
                            <th>名稱</th>
                            <th>統編</th>
                            <th>聯絡人名稱</th>
                            <th>聯絡人電話</th>
                            <th>未沖帳總額</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <paginate-custom @updatePage="getConsumerList" :pageNum="pageNum" :totalPage="totalPage"></paginate-custom>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['consumers', 'rowsPerPage', 'pageNum' ,'totalPage'],
    data(){
        return {

        }
    },
    methods: {
        getConsumerList (pageNum){
            this.$emit('update-consumer', pageNum);
        },
        changeStatus(e){
            let status = e.target.value;
            this.$emit('change-status', status);
        },
        changeOrder(e){
            let orderby = e.target.value;
            this.$emit('change-order', orderby);
        },
        changeKeywordsType(e){
            let data = $(e.target).serializeObject();
            let keywords = data.keywords;
            let type = data.type;
            let category = data.category;
            let status = data.status;
            let orderby = data.orderby;
            this.$emit('change-keywords-type', keywords, type, status, category, orderby);
        },
        changeCategory: function(e){
            let category = e.target.value;
            this.$emit('change-category', category);
        },
    },
    created() {

    },
    mounted() {

    }
}
</script>

<style>

</style>
