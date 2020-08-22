<template>
<div class="modal fade bd-example-modal-lg" id="CreateContact" tabindex="-1" role="dialog" aria-labelledby="CreateContactLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateContactLabel">聯絡資訊</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="CreateContactForm" action="#" method="POST" @submit.prevent="CreateContact">

                        <input type="hidden" class="form-control" id="product_id" name="product_id" value="">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                名稱
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                性別
                            </label>

                            <div class="col-md-6">
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="0">小姐</option>
                                    <option value="1">先生</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>電話
                            </label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">信箱</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lineID" class="col-md-4 col-form-label text-md-right">Line ID</label>

                            <div class="col-md-6">
                                <input id="lineID" type="text" class="form-control" name="lineID" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">
                                留言
                            </label>

                            <div class="col-md-6">
                                <textarea class="form-control" id="comment" name="comment" cols="30" rows="5" placeholder="範例：您好，我對您們的產品極有興趣。"></textarea>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-block btn-primary">
                                    確認新增
                                </button>
                                <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">
                                    取消
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: [],
    data(){
        return {

        }
    },
    methods: {
        CreateContact(e){
            $.showLoadingModal();

            let url = $('#ContactStoreURL').text();
            let data = $(e.target).serializeObject();
            axios.post(url, data).then(response => {
                console.log(response.data);
                $.showSuccessModal(response.data.message);
            }).catch(error => {
                console.log('留下聯絡資訊時發生錯誤。');
                $.showErrorModal(error);
            });
        }
    },
    created(){

    },
    mounted(){
        $('#CreateContact').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $('#product_id').val(id);
        });
    }
}
</script>

<style>
</style>