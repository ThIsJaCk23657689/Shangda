<template>
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="SalesOrderDetailForm" method="POST" action="#">

            <input type="hidden" id="salesOrderID" name="salesOrder_id" :value="sales_order_id">

            <div class="row">

                <div class="col-md-3 mb-2">
                    <select id="product_search_type" class="form-control" v-model="current_search_type" @change="onChangeSearchType">
                        <option value="0">商品編號</option>
                        <option value="1">商品名稱</option>
                    </select>
                </div>

                <div v-if="current_search_type === '0'" class="col-md-3 mb-2">
                    <input id="searchProductIDInput" type="text" class="form-control" placeholder="請輸入商品編號..." @input="searchProductID" @keydown.enter.prevent="searchPressEnterKey" />

                    <div v-if="product_search_result.length !== 0" style="border: 1px solid; border-top: none; position: absolute; width: 90%; z-index: 40;">
                        <ul class="m-0 px-0 py-2 flex flex-column" style="list-style: none;background-color: #fafafa;">
                            <li v-for="(product, index) in product_search_result" :key="index" class="px-2" style="cursor: pointer;"
                                @mouseover="hoverSearchProductItem($event, true)"
                                @mouseleave="hoverSearchProductItem($event, false)"
                                @click="selectSearchProduct(product.id)">
                                {{ product.shownID }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div v-else class="col-md-3 mb-2">
                    <input id="searchProductNameInput" type="text" class="form-control" placeholder="請輸入商品名稱..." @input="searchProductName" @keydown.enter.prevent="searchPressEnterKey" />

                    <div v-if="product_search_result.length !== 0" style="border: 1px solid; border-top: none; position: absolute; width: 90%; z-index: 40;">
                        <ul class="m-0 px-0 py-2 flex flex-column" style="list-style: none;background-color: #fafafa;">
                            <li v-for="(product, index) in product_search_result" :key="index" class="px-2" style="cursor: pointer;"
                                @mouseover="hoverSearchProductItem($event, true)"
                                @mouseleave="hoverSearchProductItem($event, false)"
                                @click="selectSearchProduct(product.id)">
                                {{ product.name }}
                            </li>
                        </ul>
                    </div>
                </div>

<!--                <div class="col-md-6 mb-2">-->
<!--                    <select id="product_id" class="form-control" @change="getProductData">-->
<!--                        <option value="0">請選擇...</option>-->
<!--                        <option-item v-for="data in products" :key="data.id" :data="data"></option-item>-->
<!--                    </select>-->
<!--                </div>-->

<!--                <div class="col-md-6">-->
<!--                    <button id="addDetailBtn" type="button" class="btn btn-md btn-success" @click="addDetail">新增至細項</button>-->
<!--                </div>-->
            </div>

            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>商品編號</th>
                        <th>商品名稱</th>
                        <th>數量</th>
                        <th>單價</th>
                        <th>折數</th>
                        <th>小計</th>
                        <th>備註</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(detail, index) in details" :key="index">
                        <td style="width: 3%">{{ index + 1 }}</td>
                        <td style="width: 18%">
                            {{ detail.product.shownID }}
                            <input type="hidden" :name="'details[' + (index + 1) + '][product_id]'" :value="detail.product.id">
                        </td>
                        <td style="width: 18%">
                            {{ detail.product.name }}
                        </td>
                        <td style="width: 18%">
                            <input :id="'pcs_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][pieces]'" :value="detail.pieces" @change="calculateQty(index+1, 'p'); calculateSubtotal(index+1);" style="width:30%;display:inline-block;">
                            <span class="mr-2">件</span>
                            <input :id="'qty_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][quantity]'" :value="detail.quantity" @change="calculateQty(index+1, 'q'); calculateSubtotal(index+1);" style="width:30%;display:inline-block;">
                            <span>{{ detail.product.showUnit }}</span>
                            <input type="hidden" :id="'qty_per_pack_' + (index + 1)" :value="detail.product.qty_per_pack">
                        </td>
                        <td style="width: 9%">
                            <input :id="'unitPrice_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][price]'" :value="detail.price" @change="calculateSubtotal(index+1)">
                        </td>
                        <td style="width: 7%">
                            <input :id="'discount_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][discount]'" :value="detail.discount" @change="calculateSubtotal(index+1)">
                        </td>
                        <td style="width: 10%">
                            <input :id="'subtotal_' + (index + 1)" type="text" class="form-control" :value="detail.subTotal" disabled>
                        </td>
                        <td style="width: 15%">
                            <input :id="'comment_' + (index + 1)" type="text" class="form-control" :name="'details[' + (index + 1)+ '][comment]'" :value="detail.comment" @change="updateComment(index+1)">
                        </td>
                        <td style="width: 5%">
                            <button type="button" class="btn btn-md btn-danger" @click="deleteDetail(index)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
    </div>
</div>
</template>

<script>
export default {
    props: ['products', 'details', 'sales_order_id'],
    mounted() {
        console.log('ReturnUpdateDetail.vue mounted.');
    },
    data(){
        return {
            current_product: [],
            total_price: 0,

            current_search_type: '0',
            product_search_result: [],
        };
    },
    methods: {
        hoverSearchProductItem(event, IsHovered) {
            if (IsHovered) {
                event.target.classList.add('SearchHover');
            } else {
                event.target.classList.remove('SearchHover');
            }
        },

        // 切換商品搜尋類別
        onChangeSearchType(event) {
            this.current_search_type = event.target.value;
        },

        // 搜尋商品編號
        searchProductID(event) {
            let ProductID = event.target.value;
            if (ProductID === '') {
                this.product_search_result = [];
                return;
            }

            const regex = new RegExp(ProductID, 'i');
            this.product_search_result = this.products.filter(item => regex.test(item.shownID));
        },

        searchPressEnterKey(event) {
            let Text = event.target.value;

            if (Text === '') {
                this.product_search_result = [];
                return;
            }

            if (this.product_search_result.length !== 0) {
                this.selectSearchProduct(this.product_search_result[0].id);
            }
        },

        // 搜訊商品名稱
        searchProductName(event)  {
            let ProductName = event.target.value;
            if (ProductName === '') {
                this.product_search_result = [];
                return;
            }

            const regex = new RegExp(ProductName, 'i');
            this.product_search_result = this.products.filter(item => regex.test(item.name));
        },

        selectSearchProduct(ProductID) {
            let getProductInfo = $('#getProductInfo').html();

            $.showLoadingModal();
            $('#addDetailBtn').attr('disabled', true);
            axios.post(getProductInfo, {
                id: ProductID
            }).then(response => {
                $.closeModal();
                this.current_product = response.data;
                $('#addDetailBtn').attr('disabled', false);
                this.addDetail();
            }).catch(error => {
                $.showErrorModal(error);
                console.error('抓取商品資料失敗，錯誤：' + error);
            });

            if (this.current_search_type === '0') {
                $('#searchProductIDInput').val('').focus();
            } else {
                $('#searchProductNameInput').val('').focus();
            }
            this.product_search_result = [];
        },

        // 新增原物料細項
        addDetail(){
            if(this.current_product){
                this.details.push({
                    count: this.details.length,
                    product: {
                        id: this.current_product.id,
                        shownID: this.current_product.shownID,
                        name: this.current_product.name,
                        internationalNum: this.current_product.internationalNum,
                        unitPrice: this.current_product.retailPrice,
                        qty_per_pack: this.current_product.qty_per_pack,
                        showUnit: this.current_product.showUnit
                    },
                    pieces: 0,
                    quantity: 0,
                    price: this.current_product.retailPrice,
                    discount: 1,
                    subTotal: 0,
                    comment: null
                });
            }else{
                alert('請選擇商品');
            }
        },

        // 刪除原物料細項
        deleteDetail(id){
            this.details.splice(id, 1);
            if(this.details.length != 0){
                this.calculateSubtotal(1);
            }
            this.calculateTotalPrice();
        },

        calculateSubtotal(id){
            let qty = $('#qty_' + id).val();
            let unitPrice = $('#unitPrice_' + id).val();
            let discount = $('#discount_' + id).val();
            let subTotal = Math.round(unitPrice * qty * discount * 10000) / 10000;
            $('#subtotal_' + id).html(subTotal);

            this.details[id - 1].quantity = qty;
            this.details[id - 1].price = unitPrice;
            this.details[id - 1].discount = discount;
            this.details[id - 1].subTotal = subTotal;
            this.calculateTotalPrice();
        },

        calculateTotalPrice(){
            this.total_price = 0;
            for(let i = 1; i <=  this.details.length; i++){

                let qty = this.details[i - 1].quantity;
                let unitPrice = this.details[i - 1].price;
                let discount = this.details[i - 1].discount;
                let subTotal = Math.round(unitPrice * qty * discount * 10000) / 10000;
                this.total_price = this.total_price + subTotal;
            }

            $('#beforePrice').val(this.total_price);

            let taxType = $('#taxType').val();
            let tax = (taxType == "1")? Math.round(this.total_price * 0.05 * 10000) / 10000: 0;
            $('#taxPrice').val(tax);

            this.total_price = Math.round((this.total_price + tax) * 10000) / 10000;
            this.$emit('show-total-price', this.total_price)
            // console.log(this.total_price);
        },

        calculateQty(id, type){
            let qty_per_pack = $('#qty_per_pack_' + id).val();
            if (qty_per_pack == 0) {
                // 自動計算功能先關閉
                return;
            }

            if(type == 'p'){
                let pcs = $('#pcs_' + id).val();
                $('#qty_' + id).val(pcs * qty_per_pack);

                this.details[id - 1].pieces = pcs;
            }else if(type == 'q'){
                let qty = $('#qty_' + id).val();
                $('#pcs_' + id).val(qty / qty_per_pack);

                this.details[id - 1].pieces = qty / qty_per_pack;
            }
        },

        updateComment(id){
            let comment = $('#comment_' + id).val();
            this.details[id - 1].comment = comment;
        },

        // 取得商品資料
        getProductData(){
            let product_id = $('#product_id').val();

            if(product_id != 0){
                let getProductInfo = $('#getProductInfo').html();

                $.showLoadingModal();
                $('#addDetailBtn').attr('disabled', true);
                axios.post(getProductInfo, {
                    id: product_id
                }).then(response => {
                    $.closeModal();
                    this.current_product = response.data;
                    $('#addDetailBtn').attr('disabled', false);
                }).catch(error => {
                    $.showErrorModal(error);
                    console.error('抓取商品資料失敗，錯誤：' + error);
                });
            }else{
                alert('請選擇商品');
            }
        },


    }
}
</script>

<style>
.SearchHover {
    color: #fff3cd;
    background-color: #00BCD4;
}
</style>
