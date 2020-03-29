Vue.component('product-discounts', require('./../components/Discounts/ProductDiscounts.vue').default);

const app = new Vue({
    el: '#discounts',
    data() {
        return {
            consumers: [],
            all_consumers: [],
            consumers_disabled: [],
            
            original_discounts: [],
            this_product_retailPrice: 0,
            discounts: [],
        }
    },
    methods: {
        // 更新客戶清單
        refreshConsumers(data){
            this.consumers = this.all_consumers;

            if(data.type == 'add'){
                this.consumers_disabled.push({
                    id: this.consumers[data.id].id,
                    name: this.consumers[data.id].name
                });
            }else{
                let index;
                for(let i = 0; i < this.consumers_disabled.length; i++){
                    if(this.consumers_disabled[i].id == data.id){
                        index = i;
                        break;
                    }
                }
                this.consumers_disabled.splice(index, 1);
            }
            
            this.consumers = [];
            for(let i = 0; i < this.all_consumers.length; i++){
                let canAdd = true;
                for(let j = 0; j < this.consumers_disabled.length; j++){
                    if(this.all_consumers[i].id == this.consumers_disabled[j].id){
                        canAdd = false;
                    }
                }
                if(canAdd){
                    this.consumers.push(this.all_consumers[i]);
                }
            }
        },
    },
    created(){
        // 取得所有顧客列表(id與name)
        let getConsumersName = $('#getConsumersName').html();
        axios.get(getConsumersName).then(response => {
            this.consumers = response.data;
            this.all_consumers = this.consumers;
        });

        // 取得折扣資料
        let getDiscountsList = $('#getDiscountsList').html();
        axios.get(getDiscountsList).then(response => {
            this.original_discounts = response.data.discounts;
            this.this_product_retailPrice = response.data.retailPrice;
            
            // 將　original_discounts　內的資料加入到　discounts　中
            for(let i = 0; i < this.original_discounts.length; i++){
                
                this.refreshConsumers({
                    id: this.original_discounts[i].id - 1,
                    type: 'add'
                });

                this.discounts.push({
                    count: this.discounts.length,
                    consumer: {
                        id: this.original_discounts[i].id,
                        shownID: this.original_discounts[i].shownID,
                        name: this.original_discounts[i].name,
                        taxID: this.original_discounts[i].taxID,
                        inCharge1: this.original_discounts[i].inCharge1,
                        tel1: this.original_discounts[i].tel1,
                    },
                    relativePrice: this.original_discounts[i].pivot.price,
                    absolutePirce: Math.round((this.this_product_retailPrice - this.original_discounts[i].pivot.price) * 1000) / 1000,
                });
            }
        });
    },
    mounted(){
        
    }
});