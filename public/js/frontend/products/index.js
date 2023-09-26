!function(t){var a={};function e(s){if(a[s])return a[s].exports;var i=a[s]={i:s,l:!1,exports:{}};return t[s].call(i.exports,i,i.exports,e),i.l=!0,i.exports}e.m=t,e.c=a,e.d=function(t,a,s){e.o(t,a)||Object.defineProperty(t,a,{enumerable:!0,get:s})},e.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e.t=function(t,a){if(1&a&&(t=e(t)),8&a)return t;if(4&a&&"object"==typeof t&&t&&t.__esModule)return t;var s=Object.create(null);if(e.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:t}),2&a&&"string"!=typeof t)for(var i in t)e.d(s,i,function(a){return t[a]}.bind(null,i));return s},e.n=function(t){var a=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(a,"a",a),a},e.o=function(t,a){return Object.prototype.hasOwnProperty.call(t,a)},e.p="/",e(e.s=74)}({0:function(t,a,e){"use strict";function s(t,a,e,s,i,r,n,o){var c,l="function"==typeof t?t.options:t;if(a&&(l.render=a,l.staticRenderFns=e,l._compiled=!0),s&&(l.functional=!0),r&&(l._scopeId="data-v-"+r),n?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(n)},l._ssrRegister=c):i&&(c=o?function(){i.call(this,(l.functional?this.parent:this).$root.$options.shadowRoot)}:i),c)if(l.functional){l._injectStyles=c;var d=l.render;l.render=function(t,a){return c.call(a),d(t,a)}}else{var u=l.beforeCreate;l.beforeCreate=u?[].concat(u,c):[c]}return{exports:t,options:l}}e.d(a,"a",(function(){return s}))},183:function(t,a,e){"use strict";e.r(a);var s={props:["filter"],data:function(){return{}},methods:{changeType:function(){this.$emit("refresh-product",1)},search:function(){this.$emit("refresh-product",1)},changeOrder:function(){this.$emit("refresh-product")}},created:function(){},mounted:function(){}},i=e(0),r=Object(i.a)(s,(function(){var t=this,a=t._self._c;return a("div",{staticClass:"row filter-row"},[a("div",{staticClass:"col-md-3 col-6 d-flex"},[a("div",{staticClass:"filter-dropbox-container"},[a("select",{directives:[{name:"model",rawName:"v-model",value:t.filter.type,expression:"filter.type"}],staticClass:"form-control filter-dropbox",attrs:{id:"filter-column",name:"column"},on:{change:[function(a){var e=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.filter,"type",a.target.multiple?e:e[0])},t.changeType]}},[a("option",{attrs:{value:"0"}},[t._v("依條件")]),t._v(" "),a("option",{attrs:{value:"1"}},[t._v("商品名稱")]),t._v(" "),a("option",{attrs:{value:"2"}},[t._v("規格")]),t._v(" "),a("option",{attrs:{value:"3"}},[t._v("顏色")]),t._v(" "),a("option",{attrs:{value:"0"}},[t._v("全部搜尋")])])])]),t._v(" "),a("div",{staticClass:"col-md-6 col-12 d-flex search-div"},[a("div",{staticClass:"filter-search"},[t._m(0),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.filter.keyword,expression:"filter.keyword"}],staticClass:"form-control search-input",attrs:{type:"text",id:"search-input",name:"keyword",placeholder:"請輸入商品等關鍵字"},domProps:{value:t.filter.keyword},on:{keypress:function(a){return!a.type.indexOf("key")&&t._k(a.keyCode,"enter",13,a.key,"Enter")?null:t.search.apply(null,arguments)},input:function(a){a.target.composing||t.$set(t.filter,"keyword",a.target.value)}}}),t._v(" "),a("a",{staticClass:"search-button",attrs:{href:"#"},on:{click:function(a){return a.preventDefault(),t.search.apply(null,arguments)}}},[t._v("\r\n                搜尋\r\n            ")])])]),t._v(" "),a("div",{staticClass:"col-md-3 col-6 d-flex order-2"},[a("select",{directives:[{name:"model",rawName:"v-model",value:t.filter.order,expression:"filter.order"}],staticClass:"form-control filter-dropbox",attrs:{id:"filter-order",name:"order"},on:{change:[function(a){var e=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.filter,"order",a.target.multiple?e:e[0])},t.changeOrder]}},[a("option",{attrs:{value:"0"}},[t._v("排序方式")]),t._v(" "),a("option",{attrs:{value:"1"}},[t._v("最新 -> 最舊")]),t._v(" "),a("option",{attrs:{value:"2"}},[t._v("最舊 -> 最新")]),t._v(" "),a("option",{attrs:{value:"3"}},[t._v("價錢高 -> 價錢低")]),t._v(" "),a("option",{attrs:{value:"4"}},[t._v("價錢低 -> 價錢高")])])])])}),[function(){var t=this._self._c;return t("div",{staticClass:"search-icon"},[t("i",{staticClass:"fas fa-search"})])}],!1,null,null,null);a.default=r.exports},184:function(t,a,e){"use strict";e.r(a);var s={props:["products"],data:function(){return{}},methods:{},created:function(){},mounted:function(){}},i=e(0),r=Object(i.a)(s,(function(){var t=this._self._c;return t("div",{staticClass:"row product-list"},[this._l(this.products,(function(a){return t("product-card",{key:a.id,attrs:{product:a}})})),this._v(" "),0==this.products.length?t("span",{staticClass:"not-found-message"},[this._v("\r\n        很抱歉，無法找到您所查詢的資料，請重新查詢謝謝。\r\n    ")]):this._e()],2)}),[],!1,null,null,null);a.default=r.exports},185:function(t,a,e){"use strict";e.r(a);var s={props:["product"],data:function(){return{carouselSlideWidth:335,isAnimating:!1,carouselWidth:0}},methods:{flipToFront:function(t){var a=$(t.target).parents(".product-card");a.find("div.carouselNext, div.carouselPrev").removeClass("visible"),a.addClass("flip-10"),setTimeout((function(){a.removeClass("flip-10").addClass("flip90").find("div.shadow").show().fadeTo(80,1,(function(){a.find(".product-front, .product-front div.shadow").hide()}))}),50),setTimeout((function(){a.removeClass("flip90").addClass("flip190"),a.find(".product-back").show().find("div.shadow").show().fadeTo(90,0),setTimeout((function(){a.removeClass("flip190").addClass("flip180").find("div.shadow").hide(),setTimeout((function(){a.css("transition","100ms ease-out"),a.find(".cx, .cy").addClass("s1"),setTimeout((function(){a.find(".cx, .cy").addClass("s2")}),100),setTimeout((function(){a.find(".cx, .cy").addClass("s3")}),200),a.find("div.carouselNext, div.carouselPrev").addClass("visible")}),100)}),100)}),150)},flipToBack:function(t){var a=$(t.target).parents(".product-card");a.removeClass("flip180").addClass("flip190"),setTimeout((function(){a.removeClass("flip190").addClass("flip90"),a.find(".product-back div.shadow").css("opacity",0).fadeTo(100,1,(function(){a.find(".product-back, .product-back div.shadow").hide(),a.find(".product-front, .product-front div.shadow").show()}))}),50),setTimeout((function(){a.removeClass("flip90").addClass("flip-10"),a.find(".product-front div.shadow").show().fadeTo(100,0),setTimeout((function(){a.find(".product-front div.shadow").hide(),a.removeClass("flip-10").css("transition","100ms ease-out"),a.find(".cx, .cy").removeClass("s1 s2 s3")}),100)}),150)},loadPrevImages:function(t){var a=this,e=$(t.target).parents(".carousel"),s=Math.abs(parseInt($(e).find("ul").css("left")))-this.carouselSlideWidth;s<0||!0===this.isAnimating||(e.find("ul").css({left:"-"+s+"px",transition:"300ms ease-out"}),this.isAnimating=!0,setTimeout((function(){a.isAnimating=!1}),300))},loadNextImages:function(t){var a=this,e=$(t.target).parents(".carousel"),s=Math.abs(parseInt($(e).find("ul").css("left")))+this.carouselSlideWidth;s>e.find("ul").width()-this.carouselSlideWidth||!0===this.isAnimating||(e.find("ul").css({left:"-"+s+"px",transition:"300ms ease-out"}),this.isAnimating=!0,setTimeout((function(){a.isAnimating=!1}),300))},zoomIn:function(t){$(t.target).addClass("animate"),$(t.target).find("div.carouselNext, div.carouselPrev").addClass("visible")},zoomOut:function(t){$(t.target).removeClass("animate"),$(t.target).find("div.carouselNext, div.carouselPrev").removeClass("visible")},addProductToCart:function(t){$.showLoadingModal();var a=$(t.currentTarget).next().text(),e=$("#AddProductToCartURL").text();axios.post(e,{product_id:a}).then((function(t){$.showSuccessModal(t.data.message)})).catch((function(t){console.error("把商品加入購物車時發生錯誤！原因為："+t),"請先登入！"==t.response.data.message?$.showWarningModal(t.response.data.message,$("#ConsumerLoginURL").text(),"確認"):$.showErrorModal(t)}))}},created:function(){},mounted:function(){var t=this,a=$($(this.$el).find(".carousel ul"));a.children("li").each((function(){t.carouselWidth+=t.carouselSlideWidth})),a.css("width",this.carouselWidth)}},i=e(0),r=Object(i.a)(s,(function(){var t=this,a=t._self._c;return a("div",{staticClass:"make-3D-space"},[a("div",{staticClass:"product-card",on:{mouseenter:t.zoomIn,mouseleave:t.zoomOut}},[a("div",{staticClass:"product-front"},[a("div",{staticClass:"shadow"}),t._v(" "),a("img",{attrs:{src:t.product.coverImage,alt:""}}),t._v(" "),a("div",{staticClass:"image_overlay"}),t._v(" "),a("div",{staticClass:"view_details",on:{click:t.flipToFront}},[t._v("查看圖片")]),t._v(" "),a("div",{staticClass:"stats"},[a("div",{staticClass:"stats-container"},[1==t.product.showPrice?a("div",{staticClass:"product_price-container"},[a("span",{staticClass:"product_price"},[t._v(t._s("$"+t.product.retailPrice))]),t._v(" "),a("button",{staticClass:"cart-button",on:{click:t.addProductToCart}},[a("i",{staticClass:"fas fa-shopping-cart"})]),t._v(" "),a("span",{staticClass:"d-none"},[t._v(t._s(t.product.id))])]):a("button",{staticClass:"product_ask_price",attrs:{type:"button","data-toggle":"modal","data-target":"#CreateContact","data-id":t.product.id}},[a("i",{staticClass:"fas fa-comments-dollar mr-1"}),t._v("\r\n                        詢問價錢\r\n                    ")]),t._v(" "),a("span",{staticClass:"product_name"},[t._v(t._s(t.product.name))]),t._v(" "),a("div",{staticClass:"product-options"},[a("strong",[t._v("類別")]),t._v(" "),a("span",[t._v(t._s(t.product.category.name))])]),t._v(" "),a("div",{staticClass:"readmore-container"},[a("a",{staticClass:"readmore",attrs:{href:t.product.showURL}},[t._v("\r\n                            了解更多 >>\r\n                        ")])])])])]),t._v(" "),a("div",{staticClass:"product-back"},[a("div",{staticClass:"shadow"}),t._v(" "),a("div",{staticClass:"carousel"},[a("ul",[t._l(t.product.pictures,(function(t){return a("li",{key:t.index},[a("img",{attrs:{src:t.url,alt:""}})])})),t._v(" "),0==t.product.pictures.length?a("li",[a("img",{attrs:{src:t.product.coverImage,alt:""}})]):t._e()],2),t._v(" "),a("div",{staticClass:"arrows-perspective"},[a("div",{staticClass:"carouselPrev",on:{click:t.loadPrevImages}},[a("div",{staticClass:"y"}),t._v(" "),a("div",{staticClass:"x"})]),t._v(" "),a("div",{staticClass:"carouselNext",on:{click:t.loadNextImages}},[a("div",{staticClass:"y"}),t._v(" "),a("div",{staticClass:"x"})])])]),t._v(" "),a("div",{staticClass:"flip-back",on:{click:t.flipToBack}},[a("div",{staticClass:"cy"}),t._v(" "),a("div",{staticClass:"cx"})])])])])}),[],!1,null,null,null);a.default=r.exports},186:function(t,a,e){"use strict";e.r(a);var s={props:[],data:function(){return{}},methods:{CreateContact:function(t){$.showLoadingModal();var a=$("#ContactStoreURL").text(),e=$(t.target).serializeObject();axios.post(a,e).then((function(t){console.log(t.data),$.showSuccessModal(t.data.message)})).catch((function(t){console.log("留下聯絡資訊時發生錯誤。"),$.showErrorModal(t)}))}},created:function(){},mounted:function(){$("#CreateContact").on("show.bs.modal",(function(t){var a=$(t.relatedTarget).data("id");$("#product_id").val(a)}))}},i=e(0),r=Object(i.a)(s,(function(){var t=this,a=t._self._c;return a("div",{staticClass:"modal fade bd-example-modal-lg",attrs:{id:"CreateContact",tabindex:"-1",role:"dialog","aria-labelledby":"CreateContactLabel","aria-hidden":"true"}},[a("div",{staticClass:"modal-dialog modal-lg",attrs:{role:"document"}},[a("div",{staticClass:"modal-content"},[t._m(0),t._v(" "),a("div",{staticClass:"modal-body"},[a("div",{staticClass:"container-fluid"},[a("form",{attrs:{id:"CreateContactForm",action:"#",method:"POST"},on:{submit:function(a){return a.preventDefault(),t.CreateContact.apply(null,arguments)}}},[a("input",{staticClass:"form-control",attrs:{type:"hidden",id:"product_id",name:"product_id",value:""}}),t._v(" "),t._m(1),t._v(" "),t._m(2),t._v(" "),t._m(3),t._v(" "),t._m(4),t._v(" "),t._m(5),t._v(" "),t._m(6),t._v(" "),t._m(7)])])])])])])}),[function(){var t=this._self._c;return t("div",{staticClass:"modal-header"},[t("h5",{staticClass:"modal-title",attrs:{id:"CreateContactLabel"}},[this._v("聯絡資訊")]),this._v(" "),t("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"}},[t("span",{attrs:{"aria-hidden":"true"}},[this._v("×")])])])},function(){var t=this._self._c;return t("div",{staticClass:"form-group row"},[t("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"name"}},[t("span",{staticClass:"text-danger"},[this._v("*")]),this._v("\r\n                                名稱\r\n                            ")]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("input",{staticClass:"form-control",attrs:{id:"name",type:"text",name:"name",value:"",required:"",autofocus:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"form-group row"},[t("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"gender"}},[t("span",{staticClass:"text-danger"},[this._v("*")]),this._v("\r\n                                性別\r\n                            ")]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("select",{staticClass:"form-control",attrs:{id:"gender",name:"gender",required:""}},[t("option",{attrs:{value:"0"}},[this._v("小姐")]),this._v(" "),t("option",{attrs:{value:"1"}},[this._v("先生")])])])])},function(){var t=this._self._c;return t("div",{staticClass:"form-group row"},[t("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"phone"}},[t("span",{staticClass:"text-danger"},[this._v("*")]),this._v("電話\r\n                            ")]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("input",{staticClass:"form-control",attrs:{id:"phone",type:"text",name:"phone",value:"",required:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"form-group row"},[t("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"email"}},[this._v("信箱")]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("input",{staticClass:"form-control",attrs:{id:"email",type:"email",name:"email",value:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"form-group row"},[t("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"lineID"}},[this._v("Line ID")]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("input",{staticClass:"form-control",attrs:{id:"lineID",type:"text",name:"lineID",value:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"form-group row"},[t("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"comment"}},[this._v("\r\n                                留言\r\n                            ")]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("textarea",{staticClass:"form-control",attrs:{id:"comment",name:"comment",cols:"30",rows:"5",placeholder:"範例：您好，我對您們的產品極有興趣。"}})])])},function(){var t=this._self._c;return t("div",{staticClass:"form-group row justify-content-center"},[t("div",{staticClass:"col-md-8"},[t("button",{staticClass:"btn btn-block btn-primary",attrs:{type:"submit"}},[this._v("\r\n                                    確認新增\r\n                                ")]),this._v(" "),t("button",{staticClass:"btn btn-block btn-danger",attrs:{type:"button","data-dismiss":"modal"}},[this._v("\r\n                                    取消\r\n                                ")])])])}],!1,null,null,null);a.default=r.exports},51:function(t,a,e){"use strict";e.r(a);var s={props:["currentPage","totalPage"],data:function(){return{}},methods:{range:function(t,a){for(var e=[],s=t;s<=a;s++)e.push(s);return e},chagePage:function(t){var a=parseInt($(t.target).text());this.$emit("chage-page",a)},nextPage:function(){this.$emit("chage-page",this.currentPage+1)},prevPage:function(){this.$emit("chage-page",this.currentPage-1)}},created:function(){},mounted:function(){}},i=e(0),r=Object(i.a)(s,(function(){var t=this,a=t._self._c;return a("div",{staticClass:"row"},[a("div",{staticClass:"content-paginate-container"},[t.totalPage<=7?a("ul",{staticClass:"content-paginate"},[a("li",[t.currentPage>1?a("span",{on:{click:t.prevPage}},[a("i",{staticClass:"fa fa-angle-left",attrs:{"aria-hidden":"true"}})]):t._e()]),t._v(" "),t._l(t.totalPage,(function(e){return a("li",{key:e},[e==t.currentPage?a("span",{staticClass:"activated"},[t._v(t._s(e))]):a("span",{on:{click:t.chagePage}},[t._v(t._s(e))])])})),t._v(" "),a("li",[t.currentPage!=t.totalPage&&t.totalPage>0?a("span",{on:{click:t.nextPage}},[a("i",{staticClass:"fa fa-angle-right",attrs:{"aria-hidden":"true"}})]):t._e()])],2):t._e(),t._v(" "),t.totalPage>7?a("ul",{staticClass:"content-paginate"},[a("li",[1!=t.currentPage?a("span",{on:{click:t.prevPage}},[a("i",{staticClass:"fa fa-angle-left",attrs:{"aria-hidden":"true"}})]):t._e()]),t._v(" "),t.currentPage<=4?a("div",{staticClass:"d-inline"},t._l(5,(function(e){return a("li",{key:e},[e==t.currentPage?a("span",{staticClass:"activated"},[t._v(t._s(e))]):a("span",{on:{click:t.chagePage}},[t._v(t._s(e))])])})),0):t.currentPage>t.totalPage-4?a("div",{staticClass:"d-inline"},t._l(3,(function(e){return a("li",{key:e},[e==t.currentPage?a("span",{staticClass:"activated"},[t._v(t._s(e))]):a("span",{on:{click:t.chagePage}},[t._v(t._s(e))])])})),0):a("div",{staticClass:"d-inline"},t._l(2,(function(e){return a("li",{key:e},[e==t.currentPage?a("span",{staticClass:"activated"},[t._v(t._s(e))]):a("span",{on:{click:t.chagePage}},[t._v(t._s(e))])])})),0),t._v(" "),a("li",{staticClass:"disabled"},[t._v("...")]),t._v(" "),t.currentPage>4&&t.currentPage<t.totalPage-3?a("div",{staticClass:"d-inline"},[t._l(t.range(t.currentPage-1,t.currentPage+1),(function(e){return a("li",{key:e},[e==t.currentPage?a("span",{staticClass:"activated"},[t._v(t._s(e))]):a("span",{on:{click:t.chagePage}},[t._v(t._s(e))])])})),t._v(" "),a("li",{staticClass:"disabled"},[t._v("...")])],2):t._e(),t._v(" "),t.currentPage>t.totalPage-4?a("div",{staticClass:"d-inline"},t._l(t.range(t.totalPage-4,t.totalPage),(function(e){return a("li",{key:e},[e==t.currentPage?a("span",{staticClass:"activated"},[t._v(t._s(e))]):a("span",{on:{click:t.chagePage}},[t._v(t._s(e))])])})),0):t.currentPage<=4?a("div",{staticClass:"d-inline"},t._l(t.range(t.totalPage-2,t.totalPage),(function(e){return a("li",{key:e},[e==t.currentPage?a("span",{staticClass:"activated"},[t._v(t._s(e))]):a("span",{on:{click:t.chagePage}},[t._v(t._s(e))])])})),0):a("div",{staticClass:"d-inline"},t._l(t.range(t.totalPage-1,t.totalPage),(function(e){return a("li",{key:e},[e==t.currentPage?a("span",{staticClass:"activated"},[t._v(t._s(e))]):a("span",{on:{click:t.chagePage}},[t._v(t._s(e))])])})),0),t._v(" "),a("li",[t.currentPage!=t.totalPage&&t.totalPage>0?a("span",{on:{click:t.nextPage}},[a("i",{staticClass:"fa fa-angle-right",attrs:{"aria-hidden":"true"}})]):t._e()])]):t._e()])])}),[],!1,null,null,null);a.default=r.exports},74:function(t,a,e){t.exports=e(75)},75:function(t,a,e){Vue.component("product-filter",e(183).default),Vue.component("product-container",e(184).default),Vue.component("product-card",e(185).default),Vue.component("content-paginate",e(51).default),Vue.component("contact-form",e(186).default);new Vue({el:"#product",data:function(){return{products:[],filter:{type:0,keyword:"",order:0},totalcount:0,currentPage:1,totalPage:0}},methods:{getProducts:function(){var t=this,a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0;$.showLoadingModal(),1!=a&&0!=this.currentPage||(this.currentPage=1);var e=$("#GetProductsList").text();axios.post(e,{skip:21*(this.currentPage-1),type:this.filter.type,keywords:this.filter.keyword,orderBy:this.filter.order,firstPage:a,status:1}).then((function(a){t.products=a.data.products,t.totalcount=a.data.totalcount,t.totalPage=Math.ceil(t.totalcount/21),0==t.totalcount&&(t.currentPage=0),$.closeModal()})).catch((function(t){console.log("抓取商品資料時錯誤。"),$.showErrorModal(t)}))},refreshProduct:function(t){this.getProducts(t),this.goBackToTop()},goBackToTop:function(){$("html, body").animate({scrollTop:440},500)},chagePage:function(t){this.currentPage=t,this.getProducts(),this.goBackToTop()}},created:function(){this.getProducts()},mounted:function(){}})}});