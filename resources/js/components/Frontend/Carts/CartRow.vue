<template>
<div class="cart-row">
    <div class="cart-cell w-15 p-3 cart-pic">
        <img :src="cart.product.coverImage" alt="" width="100%">
    </div>
    <div class="cart-cell w-85 p-3 cart-spec">
        <div class="cart-cell w-35">
            <a :href="cart.product.showURL" class="product-link">
                {{ cart.product.name }}
            </a>
        </div>
        <div class="cart-cell w-15">${{ cart.product.retailPrice }}</div>
        <div class="cart-cell w-20">
            <input type="text" class="form-control text-center quantity" name="quantity[]" v-model="cart.quantity" @input="quantityOnInput">
        </div>
        <div class="cart-cell w-15">${{ cart.subtotal }}</div>
        <div class="cart-cell w-15">
            <button class="btn btn-md btn-danger" @click="removeItem">
                <i class="far fa-trash-alt"></i>
            </button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['cart'],
    data(){
        return {

        }
    },
    methods: {
        quantityOnInput(e){
            let value = e.target.value.trim();
            let Int = /^[1-9]\d*$|^$/;
            if(Int.test(value)){
                // 是整數
                if(value <= 0 || value > 999){
                    // 小於等於0 或 大於 999  都是不合格的
                    this.cart.quantity = 1;
                }
            }else{
                // 不是整數
                this.cart.quantity = 1;
            }
            this.calculateSubTotal(this, e.target);
        },

        calculateSubTotal: _.debounce((vm, input) => {

            let url = $('#UpdateProductQtyURL').text();
            $('input.quantity').attr('disabled', true);
            axios.post(url, {
                _method: 'PATCH',
                product_id: vm.cart.product.id,
                quantity: vm.cart.quantity,
            }).then(response => {
                $('input.quantity').attr('disabled', false);
                if(response.data.overflowMsg != ''){
                    // 發生商品庫存不足夠
                    $.showWarningModal(response.data.overflowMsg);
                    vm.cart.quantity = response.data.realQty;
                }
                vm.cart.subtotal = Math.round(vm.cart.product.retailPrice * vm.cart.quantity);
                vm.calculateTotal();
            }).catch(error => {
                console.log('從購物車更新商品購買數量時發生錯誤。');
                $.showErrorModal(error);
                vm.cart.quantity = 1;
                vm.cart.subtotal = Math.round(vm.cart.product.retailPrice * vm.cart.quantity);
                vm.calculateTotal();
            });
        }, 500),

        calculateTotal(){
            this.$emit('calculate-total');
        },

        removeItem(e){
            Swal.fire({
                title: '注意！',
                text: '您確定要從購物車刪除此商品嗎?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確認',
                cancelButtonText: '取消',
            }).then((result) => {
                if (result.value) {
                    this.$emit('remove-item', {
                        index: this.cart.index,
                    });
                }
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
