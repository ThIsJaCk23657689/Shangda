Vue.component('produces-create-form', require('./../components/Produces/ProducesCreateForm.vue').default);
Vue.component('produces-detail', require('./../components/Produces/ProducesDetail.vue').default);

const app = new Vue({
    el: '#Produces',
    data() {
        return {
            products: [],
            current_product: [],
            materials: []
        }
    },
    methods: {
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
        });
    }
});