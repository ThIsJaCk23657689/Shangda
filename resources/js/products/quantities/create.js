Vue.component('product-quantities-create-form', require('./../../components/Products/Quantities/ProductQuantitiesCreateForm.vue').default);

const app = new Vue({
    el: '#ProductQuantities',
    data() {
        return {
            products: [],
            current_product: [],
            materials: []
        }
    },
    methods: {
        getProductData(id){
            let getProductsInfo = $('#getProductsInfo').html();

            axios.post(getProductsInfo, id).then(response => {
                console.log(response);
                this.current_product = response.data;
            });
        },
    },
    created(){
        let getProductsName = $('#getProductsName').html();

        axios.get(getProductsName).then(response => {
            this.products = response.data;
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