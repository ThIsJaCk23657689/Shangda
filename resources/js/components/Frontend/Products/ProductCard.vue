<template>
<div class="make-3D-space">
    <div class="product-card">
        <div class="product-front">
            <div class="shadow"></div>
            <img :src="product.imgs[0].url" alt="" />
            <div class="image_overlay"></div>
            <div class="view_details" @click="flipToFront">查看圖片</div>
            <div class="stats">
                <div class="stats-container">
                    <span class="product_price">{{ '$' + product.retailPrice }}</span>
                    <span class="product_name">{{ product.name }}</span>
                    <div class="product-options">
                        <strong>類別</strong>
                        <span>耐熱袋</span>
                        <!-- <strong>顏色</strong>
                        <div class="colors">
                            <div class="c-blue"><span></span></div>
                            <div class="c-red"><span></span></div>
                            <div class="c-white"><span></span></div>
                            <div class="c-green"><span></span></div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="product-back">
            <div class="shadow"></div>
            <div class="carousel">
                <ul>
                    <li v-for="image in product.imgs" :key="image.index">
                        <img :src="image.url" alt="" />
                    </li>
                </ul>
                <div class="arrows-perspective">
                    <div class="carouselPrev">
                        <div class="y"></div>
                        <div class="x"></div>
                    </div>
                    <div class="carouselNext">
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
        }
    },
    created(){

    },
    mounted(){
        // 商品卡片的hover事件
        $('.product-card').hover(function(){
            $(this).addClass('animate');
            $(this).find('div.carouselNext, div.carouselPrev').addClass('visible');
        }, function(){
            $(this).removeClass('animate');
            $(this).find('div.carouselNext, div.carouselPrev').removeClass('visible');
        });

        /* ----  Image Gallery Carousel   ---- */
        let carouselSlideWidth = 335;
        let isAnimating = false;
        for(let $i = 0; $i < $('.carousel ul').length; $i++){
            let carousel = $($('.carousel ul')[$i]);
            let carouselWidth = 0;

            $($('.carousel ul')[$i]).children('li').each(function(){
                carouselWidth += carouselSlideWidth;
            });

            // building the width of the casousel
            $(carousel).css('width', carouselWidth);
        }

        // Load Next Image
        $('div.carouselNext').on('click', function(){
            let $carousel = $(this).parents('.carousel');
            let currentLeft = Math.abs(parseInt($($carousel).find('ul').css('left')));
            let newLeft = currentLeft + carouselSlideWidth;
            let carouselWidth = $carousel.find('ul').width();
            if(newLeft == carouselWidth || isAnimating === true){return;}
            $carousel.find('ul').css({
                'left': '-' + newLeft + 'px',
                'transition': '300ms ease-out'
            });
            isAnimating = true;
            setTimeout(function(){isAnimating = false;}, 300);
        });

        // Load Previous Image
        $('div.carouselPrev').on('click', function(){
            let $carousel = $(this).parents('.carousel');
            let currentLeft = Math.abs(parseInt($($carousel).find('ul').css('left')));
            let newLeft = currentLeft - carouselSlideWidth;
            if(newLeft < 0  || isAnimating === true){return;}
            $carousel.find('ul').css({
                'left': '-' + newLeft + 'px',
                'transition': '300ms ease-out'
            });
            isAnimating = true;
            setTimeout(function(){isAnimating = false;}, 300);
        });
    }
}
</script>

<style>
</style>
