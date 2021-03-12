<template>
<div class="make-3D-space">
    <div class="product-card" @mouseenter="zoomIn" @mouseleave="zoomOut">
        <div class="product-front">
            <div class="shadow"></div>
            <img :src="product.coverImage" alt="" />
            <div class="image_overlay"></div>
            <div class="view_details" @click="flipToFront">查看圖片</div>
            <div class="stats">
                <div class="stats-container">
                    <div class="product_price-container" v-if="product.showPrice == 1">
                        <span class="product_price">{{ '$' + product.retailPrice }}</span>
                        <button class="cart-button" @click="addProductToCart">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <span class="d-none">{{ product.id }}</span>
                    </div>
                    <button type="button" class="product_ask_price" data-toggle="modal" data-target="#CreateContact" :data-id="product.id" v-else>
                        <i class="fas fa-comments-dollar mr-1"></i>
                        詢問價錢
                    </button>
                    <span class="product_name">{{ product.name }}</span>
                    <div class="product-options">
                        <strong>類別</strong>
                        <span>{{ product.category.name }}</span>
                        <!-- <strong>顏色</strong>
                        <div class="colors">
                            <div class="c-blue"><span></span></div>
                            <div class="c-red"><span></span></div>
                            <div class="c-white"><span></span></div>
                            <div class="c-green"><span></span></div>
                        </div> -->
                    </div>
                    <div class="readmore-container">
                        <a :href="product.showURL" class="readmore">
                            了解更多 >>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-back">
            <div class="shadow"></div>
            <div class="carousel">
                <ul>
                    <li v-for="picture in product.pictures" :key="picture.index">
                        <img :src="picture.url" alt="" />
                    </li>
                    <li v-if="product.pictures.length == 0">
                        <img :src="product.coverImage" alt="">
                    </li>
                </ul>
                <div class="arrows-perspective">
                    <div class="carouselPrev" @click="loadPrevImages">
                        <div class="y"></div>
                        <div class="x"></div>
                    </div>
                    <div class="carouselNext" @click="loadNextImages">
                        <div class="y"></div>
                        <div class="x"></div>
                    </div>
                </div>
            </div>
            <div class="flip-back" @click="flipToBack">
                <div class="cy"></div>
                <div class="cx"></div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['product'],
    data(){
        return {
            carouselSlideWidth: 335,
            isAnimating: false,
            carouselWidth: 0,
        }
    },
    methods: {
        flipToFront(e){
            let $this_product_card = $(e.target).parents('.product-card');
            $this_product_card.find('div.carouselNext, div.carouselPrev').removeClass('visible');
            $this_product_card.addClass('flip-10');
            setTimeout(function(){
                $this_product_card.removeClass('flip-10').addClass('flip90').find('div.shadow').show().fadeTo(80, 1, function(){
                    $this_product_card.find('.product-front, .product-front div.shadow').hide();
                });
            }, 50);

            setTimeout(function(){
                $this_product_card.removeClass('flip90').addClass('flip190');
                $this_product_card.find('.product-back').show().find('div.shadow').show().fadeTo( 90 , 0);
                setTimeout(function(){
                    $this_product_card.removeClass('flip190').addClass('flip180').find('div.shadow').hide();
                    setTimeout(function(){
                        $this_product_card.css('transition', '100ms ease-out');
                        $this_product_card.find('.cx, .cy').addClass('s1');
                        setTimeout(function(){$this_product_card.find('.cx, .cy').addClass('s2');}, 100);
                        setTimeout(function(){$this_product_card.find('.cx, .cy').addClass('s3');}, 200);
                        $this_product_card.find('div.carouselNext, div.carouselPrev').addClass('visible');
                    }, 100);
                }, 100);
            }, 150);
        },
        flipToBack(e){
            let $this_product_card = $(e.target).parents('.product-card');

            $this_product_card.removeClass('flip180').addClass('flip190');
            setTimeout(function(){
                $this_product_card.removeClass('flip190').addClass('flip90');

                $this_product_card.find('.product-back div.shadow').css('opacity', 0).fadeTo( 100 , 1, function(){
                    $this_product_card.find('.product-back, .product-back div.shadow').hide();
                    $this_product_card.find('.product-front, .product-front div.shadow').show();
                });
            }, 50);

            setTimeout(function(){
                $this_product_card.removeClass('flip90').addClass('flip-10');
                $this_product_card.find('.product-front div.shadow').show().fadeTo( 100 , 0);
                setTimeout(function(){
                    $this_product_card.find('.product-front div.shadow').hide();
                    $this_product_card.removeClass('flip-10').css('transition', '100ms ease-out');
                    $this_product_card.find('.cx, .cy').removeClass('s1 s2 s3');
                }, 100);
            }, 150);
        },
        loadPrevImages(e){
            let $carousel = $(e.target).parents('.carousel');
            let currentLeft = Math.abs(parseInt($($carousel).find('ul').css('left')));
            let newLeft = currentLeft - this.carouselSlideWidth;
            if(newLeft < 0  || this.isAnimating === true){return;}
            $carousel.find('ul').css({
                'left': '-' + newLeft + 'px',
                'transition': '300ms ease-out'
            });
            this.isAnimating = true;
            setTimeout(function(){
                vm.isAnimating = false;
            }, 300);
        },
        loadNextImages(e){
            let vm = this;
            let $carousel = $(e.target).parents('.carousel');
            let currentLeft = Math.abs(parseInt($($carousel).find('ul').css('left')));
            let newLeft = currentLeft + this.carouselSlideWidth;
            let carouselWidth = $carousel.find('ul').width();
            if(newLeft > (carouselWidth - this.carouselSlideWidth) || this.isAnimating === true){return;}
            $carousel.find('ul').css({
                'left': '-' + newLeft + 'px',
                'transition': '300ms ease-out'
            });
            this.isAnimating = true;
            setTimeout(function(){
                vm.isAnimating = false;
            }, 300);
        },
        zoomIn(e){
            $(e.target).addClass('animate');
            $(e.target).find('div.carouselNext, div.carouselPrev').addClass('visible');
        },
        zoomOut(e){
            $(e.target).removeClass('animate');
            $(e.target).find('div.carouselNext, div.carouselPrev').removeClass('visible');
        },
        addProductToCart(e){
            $.showLoadingModal();

            let $product_id = $(e.currentTarget).next().text();
            let AddProductToCartURL = $('#AddProductToCartURL').text();
            axios.post(AddProductToCartURL, {
                product_id: $product_id,
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

        }
    },
    created(){

    },
    mounted(){
        /* ----  Image Gallery Carousel   ---- */
        let vm = this;
        let carousel = $($(this.$el).find('.carousel ul'));

        carousel.children('li').each(function(){
            vm.carouselWidth += vm.carouselSlideWidth;
        });

        carousel.css('width', this.carouselWidth);
    }
}
</script>

<style>
</style>
