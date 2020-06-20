<!-- Modal -->
<div class="modal fade" id="DeliveredModal" tabindex="-1" role="dialog" aria-labelledby="DeliveredModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeliveredModalLabel">確認出貨</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="DeliveredForm" action="{{ route('sales.delivered') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" id="delivered_sales_id" name="sales_id" value="">

                        <div class="form-group row">
                            <label for="delivered_expectDelivered_at" class="col-md-4 col-form-label text-md-right">
                                預期出貨日
                            </label>

                            <div class="col-md-6">
                                <input id="delivered_expectDelivered_at" type="text" class="form-control" name="expectDelivered_at" value="" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delivered_delivered_at" class="col-md-4 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                實際出貨日期
                            </label>

                            <div class="col-md-6">
                                <input id="delivered_delivered_at" type="text" class="form-control" name="delivered_at" value="" required>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-block btn-primary">
                                    確認出貨
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
