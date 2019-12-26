
Vue.component('purchase-create-form', require('./../components/Orders/PurchaseCreateForm.vue').default);
Vue.component('option-item', require('./../components/Partials/OptionItem.vue').default);
Vue.component('create-supplier-modal', require('./../components/Modals/CreateSupplierModal.vue').default);

const app = new Vue({
    el: '#purchase',
    data() {
        return {
            suppliers: [],
            current_supplier: [],

            form_error: []
        }
    },
    methods: {
        getSupplierData(id){
            let apiSupplierGetInfo = $('#apiSupplierGetInfo').html();

            axios.post(apiSupplierGetInfo, id).then(response => {
                console.log(response);
                this.current_supplier = response.data;
            });
        }
    },
    created(){
        let apiSupplierShowName = $('#apiSupplierShowName').html();

        axios.get(apiSupplierShowName).then(response => {
            this.suppliers = response.data;
        });
    }
});