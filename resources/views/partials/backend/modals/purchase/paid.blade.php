<!-- Modal -->
<div class="modal fade" id="PaidModal" tabindex="-1" role="dialog" aria-labelledby="PaidModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PaidModalLabel">確認付清</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="PaidForm" action="{{ route('purchase.paid') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" id="paid_purchase_id" name="purchase_id" value="">

                        <div class="form-group row">
                            <label for="paid_paid_at" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                付清日期
                            </label>

                            <div class="col-md-6">
                                <input id="paid_paid_at" type="text" class="form-control" name="paid_at" value="" required>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-block btn-primary">
                                    確認付清
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
