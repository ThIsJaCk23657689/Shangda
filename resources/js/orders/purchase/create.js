
Vue.component('purchase-create-form', require('./../../components/Orders/PurchaseCreateForm.vue').default);
Vue.component('purchase-detail', require('./../../components/Orders/PurchaseDetail.vue').default);

Vue.component('create-supplier-modal', require('./../../components/Modals/CreateSupplierModal.vue').default);

const app = new Vue({
    el: '#purchase',
    data() {
        return {
            suppliers: [],
            current_supplier: [],
            materials: [],
            form_error: [],
        }
    },
    methods: {
        getSupplierData(id){
            let getSupplierInfo = $('#getSupplierInfo').html();

            axios.post(getSupplierInfo, id).then(response => {
                console.log(response);
                this.current_supplier = response.data;
            });
        },
    },
    created(){
        let getSuppliersName = $('#getSuppliersName').html();
        let getMeterialsName = $('#getMeterialsName').html();

        axios.get(getSuppliersName).then(response => {
            this.suppliers = response.data;
        });

        axios.get(getMeterialsName).then(response => {
            this.materials = response.data;
        });
    }
});