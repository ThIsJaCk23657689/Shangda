Vue.component('consumer-discounts', require('./../components/Discounts/ConsumerDiscounts.vue').default);

const app = new Vue({
    el: '#discounts',
    data() {
        return {
            products: [],
            all_products: [],
            products_disabled: [],
            
            original_discounts: [],
            discounts: [],
        }
    },
    methods: {
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
        // 取得所有商品列表(id與name)
        let getProductsName = $('#getProductsName').html();
        axios.get(getProductsName).then(response => {
            this.products = response.data;
            this.all_products = this.products;
        });

        // 取得折扣資料
        let getDiscountsList = $('#getDiscountsList').html();
        axios.get(getDiscountsList).then(response => {
            this.original_discounts = response.data.discounts
            
            // 將　original_discounts　內的資料加入到　discounts　中
            for(let i = 0; i < this.original_discounts.length; i++){
                
                this.refreshProducts({
                    id: this.original_discounts[i].id - 1,
                    type: 'add'
                });

                this.discounts.push({
                    count: this.discounts.length,
                    product: {
                        id: this.original_discounts[i].id,
                        shownID: this.original_discounts[i].shownID,
                        name: this.original_discounts[i].name,
                        costprice: Math.round(this.original_discounts[i].costprice * 1000) / 1000,
                        profit: Math.round(this.original_discounts[i].profit * 1000) / 1000,
                        retailPrice: Math.round(this.original_discounts[i].retailPrice * 1000) / 1000,
                        showUnit: this.original_discounts[i].showUnit
                    },
                    relativePrice: this.original_discounts[i].pivot.price,
                    absolutePirce: Math.round((this.original_discounts[i].retailPrice - this.original_discounts[i].pivot.price) * 1000) / 1000,
                });
            }
        });
    },
    mounted(){
        
    }
});