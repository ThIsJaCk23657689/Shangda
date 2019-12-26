<template>
<div class="modal fade bd-example-modal-lg" id="CreateSupplierModal" tabindex="-1" role="dialog" aria-labelledby="CreateSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateSupplierModalLabel">新增供應商</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="CreateSupplierForm" action="#" method="POST">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                供應商名稱
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shortName" class="col-md-4 col-form-label text-md-right">供應商簡稱</label>

                            <div class="col-md-6">
                                <input id="shortName" type="text" class="form-control" name="shortName" value="" autocomplete="shortName">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="taxId" class="col-md-4 col-form-label text-md-right">統一編號</label>

                            <div class="col-md-6">
                                <input id="taxId" type="text" class="form-control" name="taxId" value="" autocomplete="taxId">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">電話</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="tel" value="" autocomplete="tel">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tax" class="col-md-4 col-form-label text-md-right">傳真</label>

                            <div class="col-md-6">
                                <input id="tax" type="text" class="form-control" name="tax" value="" autocomplete="tax">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="inCharge1" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                負責人1 - 名稱
                            </label>

                            <div class="col-md-6">
                                <input id="inCharge1" type="text" class="form-control" name="inCharge1" value="" autocomplete="inCharge1">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel1" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                負責人1 - 電話
                            </label>

                            <div class="col-md-6">
                                <input id="tel1" type="text" class="form-control" name="tel1" value="" autocomplete="tel1">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email1" class="col-md-4 col-form-label text-md-right">負責人1 - 信箱</label>

                            <div class="col-md-6">
                                <input id="email1" type="email" class="form-control" name="email1" value="" autocomplete="email1">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="inCharge2" class="col-md-4 col-form-label text-md-right">負責人2 - 名稱</label>

                            <div class="col-md-6">
                                <input id="inCharge2" type="text" class="form-control" name="inCharge2" value="" autocomplete="inCharge2">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel2" class="col-md-4 col-form-label text-md-right">負責人2 - 電話</label>

                            <div class="col-md-6">
                                <input id="tel2" type="text" class="form-control" name="tel2" value="" autocomplete="tel2">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email2" class="col-md-4 col-form-label text-md-right">負責人2 - 信箱</label>

                            <div class="col-md-6">
                                <input id="email2" type="email" class="form-control" name="email2" value="" autocomplete="email2">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="companyAddress" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                公司地址
                            </label>

                            <div class="col-md-6">
                                <input id="companyAddress" type="text" class="form-control" name="companyAddress" value="" autocomplete="companyAddress" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deliveryAddress" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                送貨地址
                            </label>

                            <div class="col-md-6">
                                <input id="deliveryAddress" type="text" class="form-control" name="deliveryAddress" value="" autocomplete="deliveryAddress" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="copycompany1">
                                <label class="form-check-label" for="copycompany1">同公司地址</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invoiceAddress" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                發票地址
                            </label>

                            <div class="col-md-6">
                                <input id="invoiceAddress" type="text" class="form-control" name="invoiceAddress" value="" required autocomplete="invoiceAddress">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="copycompany2">
                                <label class="form-check-label" for="copycompany2">同公司地址</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">備註</label>

                            <div class="col-md-6">
                                <input id="comment" type="text" class="form-control" name="comment" value="" autocomplete="comment">
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
    mounted() {
        console.log('CreateSupplierModal.vue mounted.');

        $('#copycompany1').click(function(e){   
            if($(this).prop("checked")) {
                $('#deliveryAddress').val($('#companyAddress').val());
            }else{
                $('#deliveryAddress').val('');
            }
        });

        $('#copycompany2').click(function(e){        
            if($(this).prop("checked")) {
                $('#invoiceAddress').val($('#companyAddress').val());
            }else{
                $('#invoiceAddress').val('');
            }
        });
    },
    data(){
        return {
            
        }
    },
}
</script>

<style>

</style>