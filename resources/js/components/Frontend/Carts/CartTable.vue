<template>
<div class="cart-table">
    <div class="cart-header">
        <div class="cart-cell w-45">商品</div>
        <div class="cart-cell w-15">單價</div>
        <div class="cart-cell w-15">數量</div>
        <div class="cart-cell w-15">小計</div>
        <div class="cart-cell w-10">操作</div>
    </div>
    <cart-row v-for="cart in carts" :key="cart.product.id" :cart="cart" @calculate-total="calculateTotal" @remove-item="removeItem"></cart-row>
    <div class="cart-row" v-if="carts.length == 0">
        <div class="cart-cell w-100 h-80">
            <h3 class="mb-0">購物車尚未有任何商品，趕快到商品列表逛逛吧！</h3>
        </div>
    </div>
    <div class="cart-footer">
        <div class="cart-cell w-70 status-cell">
            購買總金額（{{ status.totalcount }}個商品）：<span class="total-price">${{ status.totalprice }}</span>
        </div>
        <div class="cart-cell w-30">
            <button type="button" class="btn btn-md btn-checkout" :disabled="carts.length == 0" @click="checkout">送出訂單</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['carts', 'status'],
    data(){
        return {

        }
    },
    methods: {
        calculateTotal(e){
            this.status.totalcount = 0;
            this.status.totalprice = 0;
            for(let $i = 0; $i < this.carts.length; $i++){
                this.status.totalcount += parseInt(this.carts[$i].quantity);
                this.status.totalprice += parseInt(this.carts[$i].subtotal);
            }
            this.status.totalprice = Math.round(this.status.totalprice);
        },
        removeItem(payload){

            let url = $('#RemoveProductURL').text();
            axios.post(url, {
                _method: 'DELETE',
                product_id: this.carts[payload.index].product.id
            }).then(response => {
                $.showSuccessModal(response.data.message);

                this.carts.splice(payload.index, 1);
                for(let $i = 0; $i < this.carts.length; $i++){
                    this.carts[$i].index = $i;
                }
                this.calculateTotal();

            }).catch(error => {
                console.log('從購物車刪除商品時發生錯誤。');
                $.showErrorModal(error);
            });
        },
        checkout(e){
            Swal.fire({
                title: '注意！',
                text: '您確定是否要結帳?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確認',
                cancelButtonText: '取消',
            }).then((result) => {
                if (result.value) {
                    this.submitCheckOutData();
                }
            });
        },
        submitCheckOutData(){
            $.showLoadingModal();

            let url = $('#CheckOutURL').text();
            axios.post(url, {
                carts: this.carts,
            }).then(response => {
                console.log(response.data);
                $.showSuccessModal(response.data.message);
            }).catch(error => {
                console.log('結帳時發生錯誤。');
                $.showErrorModal(error);
            });
        }
    },
    created(){

    },
    mounted(){

    }
}
</script>

<style>
</style>
