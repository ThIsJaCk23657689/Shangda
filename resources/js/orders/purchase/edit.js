
Vue.component('purchase-update-form', require('./../../components/Orders/PurchaseUpdateForm.vue').default);
Vue.component('purchase-update-detail', require('./../../components/Orders/PurchaseUpdateDetail.vue').default);
Vue.component('create-supplier-modal', require('./../../components/Modals/CreateSupplierModal.vue').default);

const app = new Vue({
    el: '#purchase',
    data() {
        return {
            suppliers: [],
            current_supplier: [],
            materials: [],
            purchase: [],
        }
    },
    methods: {
        getSupplierData(id){
            if(id == null){
                this.current_supplier = [];
            }else{
                let getSupplierInfo = $('#getSupplierInfo').text();
                $.showLoadingModal();
                axios.post(getSupplierInfo, id).then(response => {
                    this.current_supplier = response.data;
                    $.closeModal();
                });
            }
        },
    },
    created(){
        let getSuppliersName = $('#getSuppliersName').text();
        let getMeterialsName = $('#getMeterialsName').text();
        let getPurchaseOrderInfo = $('#getPurchaseOrderInfo').text();

        $.showLoadingModal();
        axios.get(getSuppliersName).then(response => {
            this.suppliers = response.data;
        });

        axios.get(getMeterialsName).then(response => {
            this.materials = response.data;
        });

        axios.get(getPurchaseOrderInfo).then(response => {
            this.purchase = response.data.purchase;
            this.purchase.details = response.data.details;
            $('#supplier_id').val(this.purchase.supplier_id);
            this.getSupplierData({
                id: this.purchase.supplier_id
            });

            // 計算金額
            let $total_price = 0;
            for(let i = 1; i <=  this.purchase.details.length; i++){
                let qty = this.purchase.details[i - 1].quantity;
                let price = this.purchase.details[i - 1].price;
                let discount = this.purchase.details[i - 1].discount;
                let subTotal = Math.round(price * qty * discount * 10000) / 10000;
                $total_price = $total_price + subTotal;
            }
            $('#beforePrice').val($total_price);

            let taxType = this.purchase.taxType;
            let tax = (taxType == "1")? Math.round($total_price * 0.05 * 10000) / 10000: 0;
            $('#tax_price').val(tax);
            
            $total_price = Math.round(($total_price + tax) * 10000) / 10000;
            this.$refs.purchaseform.showTotalPrice($total_price);

            $.closeModal();
        });
    }
});