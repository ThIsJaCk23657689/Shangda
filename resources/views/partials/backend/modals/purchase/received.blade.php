<!-- Modal -->
<div class="modal fade" id="ReceivedModal" tabindex="-1" role="dialog" aria-labelledby="ReceivedModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ReceivedModalLabel">確認到貨</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="ReceivedForm" action="{{ route('purchase.received') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" id="received_purchase_id" name="purchase_id" value="">

                        <div class="form-group row">
                            <label for="received_expectReceived_at" class="col-md-4 col-form-label text-md-right">
                                預期到貨日
                            </label>

                            <div class="col-md-6">
                                <input id="received_expectReceived_at" type="text" class="form-control" name="expectReceived_at" value="" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="received_received_at" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                實際到貨日期
                            </label>

                            <div class="col-md-6">
                                <input id="received_received_at" type="text" class="form-control" name="received_at" value="" required>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-block btn-primary">
                                    確認到貨
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
