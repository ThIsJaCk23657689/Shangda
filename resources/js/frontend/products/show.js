const contnet = new Vue({
    el: '#product-detail',
    data() {
        return {

        }
    },
    methods: {

    },
    created() {
        // let getOnePictures = $('#getOnePictures').text();
        // axios.get(getOnePictures).then(response => {
        //     // this.images = response.data.images;
        //     this.test = response.data.images;
        //     console.log(this.test);
        //     console.log(this.images);

        // });

    },
    mounted() {
        $('.sp-wrap').smoothproducts();

        $('#add-to-cart').click(function(e){
            e.preventDefault();
            
            $.showLoadingModal();
            let AddProductToCartURL = $('#AddProductToCartURL').text();
            axios.post(AddProductToCartURL, {
                product_id: $('#ProductID').text(),
                amount: 1
            }).then(response => {
                $.showSuccessModal(response.data.message);
            }).catch(error => {
                console.error('把商品加入購物車時發生錯誤！原因為：' + error);
                if(error.response.data.message == '請先登入！'){
                    $.showWarningModal(error.response.data.message, $('#ConsumerLoginURL').text(), '確認');
                }else{
                    $.showErrorModal(error);
                }
            });
        });
    }
});