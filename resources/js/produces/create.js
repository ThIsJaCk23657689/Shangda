Vue.component('produces-create-form', require('./../components/Produces/ProducesCreateForm.vue').default);
Vue.component('produces-detail', require('./../components/Produces/ProducesDetail.vue').default);

const app = new Vue({
    el: '#Produces',
    data() {
        return {
            products: [],
            current_product: [],
            materials: [],
            all_materials: [],
            materials_disabled: [],
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
        
        // 取得商品資料
        getProductData(id){
            let getProductsInfo = $('#getProductsInfo').html();

            axios.post(getProductsInfo, id).then(response => {
                // console.log(response);
                this.current_product = response.data;
                
                // 觸發事件：當"商品名稱"欄位被更動時
                // 試算商品庫存：目前庫存 + 增加量 = 最終庫存 (四捨五入到小數點後4位)
                let currentQty = this.current_product.quantity;
                let qty = parseFloat($('#product_quantity').val());
                let afterQty = parseFloat(Math.round((currentQty + qty) * 10000) / 10000);
                $('#product_afterQty').val(afterQty);
            });
        },
    },
    created(){
        // 取得所有商品列表(id與name)
        let getProductsName = $('#getProductsName').html();
        axios.get(getProductsName).then(response => {
            this.products = response.data;
        });

        // 取得所有原物料列表(id與name)
        let getMeterialsName = $('#getMeterialsName').html();
        axios.get(getMeterialsName).then(response => {
            this.materials = response.data;
            this.all_materials = this.materials;
        });
    }
});