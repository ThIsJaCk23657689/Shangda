Vue.component('cart-table', require('./../../components/Frontend/Carts/CartTable.vue').default);
Vue.component('cart-row', require('./../../components/Frontend/Carts/CartRow.vue').default);

const app = new Vue({
    el: '#cart',
    data() {
        return {
            products: [],
            carts: [],
            status:{
                totalcount: 0,
                totalprice: 0,
            }
        }
    },
    methods: {
        getCart(){
            let url = $('#CartGetOneURL').text();
            axios.get(url).then(response => {
                this.products = response.data.products;

                for(let $i = 0; $i < this.products.length; $i++){
                    this.carts.push({
                        index: this.carts.length,
                        product: {
                            id: this.products[$i].id,
                            coverImage: this.products[$i].coverImage,
                            name: this.products[$i].name,
                            retailPrice: this.products[$i].retailPrice,
                            showURL: this.products[$i].showURL,
                            maxQty: (this.products[$i].quantity <= 999) ? this.products[$i].quantity : 999,
                        },
                        quantity: this.products[$i].pivot.quantity,
                        subtotal: Math.round(this.products[$i].pivot.subTotal),
                    });
                    this.status.totalcount += this.products[$i].pivot.quantity;
                    this.status.totalprice += this.products[$i].pivot.subTotal;
                }
                this.status.totalprice = Math.round(this.status.totalprice);
                
                $.closeModal();
            }).catch(error => {
                console.log('抓取購物車資料時錯誤。');
                $.showErrorModal(error);
            });
        }
    },
    created(){
        
    },
    mounted(){
        this.getCart();
    }
});