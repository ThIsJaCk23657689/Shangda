
Vue.component('purchase-create-form', require('./../components/Orders/PurchaseCreateForm.vue').default);
Vue.component('purchase-detail', require('./../components/Orders/PurchaseDetail.vue').default);

Vue.component('option-item', require('./../components/Partials/OptionItem.vue').default);
Vue.component('create-supplier-modal', require('./../components/Modals/CreateSupplierModal.vue').default);

const app = new Vue({
    el: '#purchase',
    data() {
        return {
            suppliers: [],
            current_supplier: [],

            materials: [],

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
        },
    },
    created(){
        let apiSupplierShowName = $('#apiSupplierShowName').html();
        let apiMeterialShowName = $('#apiMeterialShowName').html();

        axios.get(apiSupplierShowName).then(response => {
            this.suppliers = response.data;
        });

        axios.get(apiMeterialShowName).then(response => {
            this.materials = response.data;
        });

        $.fn.serializeObject = function()
        {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    }
});