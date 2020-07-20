Vue.component('produces-update-form', require('./../components/Produces/ProducesUpdateForm.vue').default);
Vue.component('produces-materials-detail', require('./../components/Produces/ProducesMaterialsDetail.vue').default);
Vue.component('produces-products-detail', require('./../components/Produces/ProducesProductsDetail.vue').default);

const app = new Vue({
    el: '#Produces',
    data() {
        return {
            products: [],
            all_products: [],
            products_disabled: [],
            
            materials: [],
            all_materials: [],
            materials_disabled: [],

            produce: [],
        }
    },
    methods: {
        // 更新原物料清單
        refreshMaterials(data){
            this.materials = this.all_materials;

            if(data.type == 'add'){
                this.materials_disabled.push({
                    id: this.materials[data.id].id,
                    name: this.materials[data.id].name
                });
            }else{
                let index;
                for(let i = 0; i < this.materials_disabled.length; i++){
                    if(this.materials_disabled[i].id == data.id){
                        index = i;
                        break;
                    }
                }
                this.materials_disabled.splice(index, 1);
            }
            
            this.materials = [];
            for(let i = 0; i < this.all_materials.length; i++){
                let canAdd = true;
                for(let j = 0; j < this.materials_disabled.length; j++){
                    if(this.all_materials[i].id == this.materials_disabled[j].id){
                        canAdd = false;
                    }
                }
                if(canAdd){
                    this.materials.push(this.all_materials[i]);
                }
            }
        },

        // 更新商品清單
        refreshProducts(data){
            this.products = this.all_products;

            if(data.type == 'add'){
                this.products_disabled.push({
                    id: this.products[data.id].id,
                    name: this.products[data.id].name
                });
            }else{
                let index;
                for(let i = 0; i < this.products_disabled.length; i++){
                    if(this.products_disabled[i].id == data.id){
                        index = i;
                        break;
                    }
                }
                this.products_disabled.splice(index, 1);
            }
            
            this.products = [];
            for(let i = 0; i < this.all_products.length; i++){
                let canAdd = true;
                for(let j = 0; j < this.products_disabled.length; j++){
                    if(this.all_products[i].id == this.products_disabled[j].id){
                        canAdd = false;
                    }
                }
                if(canAdd){
                    this.products.push(this.all_products[i]);
                }
            }
        },
    },
    created(){
        $.showLoadingModal();

        // 取得所有商品列表(id與name)
        let getProductsName = $('#getProductsName').text();
        axios.get(getProductsName).then(response => {
            this.products = response.data;
            this.all_products = this.products;
        });

        // 取得所有原物料列表(id與name)
        let getMeterialsName = $('#getMeterialsName').text();
        axios.get(getMeterialsName).then(response => {
            this.materials = response.data;
            this.all_materials = this.materials;
        });

        // 取得欲要修改的produce資料。
        let getProducesData = $('#getProducesData').text();
        axios.get(getProducesData).then(response => {
            this.produce = response.data.produce;
            let update_form = this.$refs.ProduceUpdateForm;
            update_form.$refs.ProducesMaterialsDetail.setDetails(this.produce.produce_details);
            update_form.$refs.ProducesProductsDetail.setDetails(this.produce.produce_products);
            $.closeModal();
        });
    },
    mounted() {
        
    },
});