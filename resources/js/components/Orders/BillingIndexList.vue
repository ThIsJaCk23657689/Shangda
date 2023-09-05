<template>
<div class="row justify-content-center">
    <div class="col-md-11">

        <form id="SalesOrderCreateForm" method="POST" action="#" @submit.prevent="createSalesOrder">

            <div class="row">

                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="consumer_id">顧客名稱</label>
                                <select id="consumer_id" name="consumer_id" class="form-control">
                                    <option value="0">請選擇...</option>
                                    <option v-for="consumer in consumers" :value="consumer.id">{{ consumer.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="start_at">起始時間</label>
                        <input id="start_at" name="start_at" type="text" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="end_at">截止時間</label>
                        <input id="end_at" name="end_at" type="text" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="text-white">_</label>
                        <button type="button" class="btn btn-block btn-primary" @click="generatePDF">
                            列印請款單
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
</template>

<style scoped>
</style>

<script>
export default {
    props: ['consumers'],
    mounted() {
        $("#start_at").datepicker({
            changeYear: true,
            changeMonth: true,
            dateFormat: 'yy-mm-dd'
        });

        $("#end_at").datepicker({
            changeYear: true,
            changeMonth: true,
            dateFormat: 'yy-mm-dd'
        });

        // 設定 訂單日期為今天 和 其他欄位 為預設。
        let myDate = new Date();
        let defaultStartDate = myDate.getFullYear() + '-' + ('0'+ (myDate.getMonth()) ).slice(-2) + '-' + ('0'+ myDate.getDate()).slice(-2);
        let defaultEndDate = myDate.getFullYear() + '-' + ('0'+ (myDate.getMonth() + 1) ).slice(-2) + '-' + ('0'+ myDate.getDate()).slice(-2);
        $("#start_at").val(defaultStartDate);
        $("#end_at").val(defaultEndDate);
    },
    data(){
        return {
            current_consumer: {},
        }
    },
    methods: {
        generatePDF() {
            const pdfURLString = $('#getBillingPDF').html();

            let consumer_id = $('#consumer_id').val();
            let start_at = $('#start_at').val();
            let end_at = $('#end_at').val();

            if (consumer_id == 0) {
                alert('請先選擇顧客');
                console.error('請先選擇顧客');
                return;
            }

            if (start_at == '' || end_at == '') {
                alert('請先選擇顧客');
                console.error('請選擇請款時間區段');
                return;
            }

            const url = `${pdfURLString}/${consumer_id}/${start_at}/${end_at}`;
            window.open(url, '_blank');
        }
    }
}
</script>

