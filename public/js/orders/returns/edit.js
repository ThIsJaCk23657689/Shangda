!function(t){var e={};function r(a){if(e[a])return e[a].exports;var s=e[a]={i:a,l:!1,exports:{}};return t[a].call(s.exports,s,s.exports,r),s.l=!0,s.exports}r.m=t,r.c=e,r.d=function(t,e,a){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(r.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var s in t)r.d(a,s,function(e){return t[e]}.bind(null,s));return a},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="/",r(r.s=133)}({0:function(t,e,r){"use strict";function a(t,e,r,a,s,o,n,i){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=r,c._compiled=!0),a&&(c.functional=!0),o&&(c._scopeId="data-v-"+o),n?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),s&&s.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(n)},c._ssrRegister=l):s&&(l=i?function(){s.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:s),l)if(c.functional){c._injectStyles=l;var d=c.render;c.render=function(t,e){return l.call(e),d(t,e)}}else{var u=c.beforeCreate;c.beforeCreate=u?[].concat(u,l):[l]}return{exports:t,options:c}}r.d(e,"a",(function(){return a}))},133:function(t,e,r){t.exports=r(134)},134:function(t,e,r){Vue.component("return-update-form",r(209).default),Vue.component("return-update-detail",r(59).default);new Vue({el:"#return",data:function(){return{consumers:[],current_consumer:[],products:[],returnOrder:[]}},methods:{getConsumerData:function(t){var e=this,r=$("#getConsumerInfo").html();axios.post(r,t).then((function(t){console.log(t),e.current_consumer=t.data,0==e.current_consumer.monthlyCheckDate?e.current_consumer.settlement="當日結算":e.current_consumer.settlement="每個月"+e.current_consumer.monthlyCheckDate+"號結算"}))}},created:function(){var t=this,e=$("#getConsumersName").html(),r=$("#getProductsName").html();axios.get(e).then((function(e){t.consumers=e.data})),axios.get(r).then((function(e){t.products=e.data}));var a=$("#getReturnOrderInfo").text();$.showLoadingModal(),axios.get(a).then((function(e){t.returnOrder=e.data.returnOrder,t.returnOrder.details=e.data.details,$("#consumer_id").val(t.returnOrder.consumer_id),t.getConsumerData({id:t.returnOrder.consumer_id});for(var r=0,a=1;a<=t.returnOrder.details.length;a++){var s=t.returnOrder.details[a-1].quantity,o=t.returnOrder.details[a-1].price,n=t.returnOrder.details[a-1].discount;r+=Math.round(o*s*n*1e4)/1e4}$("#beforePrice").val(r);var i="1"==t.returnOrder.taxType?Math.round(.05*r*1e4)/1e4:0;$("#tax_price").val(i),r=Math.round(1e4*(r+i))/1e4,t.$refs.returnOrderform.showTotalPrice(r),$.closeModal()}))}})},209:function(t,e,r){"use strict";r.r(e);var a={props:["consumers","current_consumer","products","returnOrder","returnUrl"],data:function(){return{total_price:0}},methods:{getConsumerData:function(){var t=$("#consumer_id").val();0!=t?this.$emit("get-consumer-data",{id:t}):($.showWarningModal("請選擇廠商"),this.$emit("get-consumer-data",null))},showTotalPrice:function(t){this.total_price=t},changeTax:function(){this.$refs.returndetail.calculateTotalPrice()},updateReturnOrder:function(t){if(0==this.returnOrder.details.length)return $.showWarningModal("退貨單必須至少要有一項產品退貨。"),!1;var e=$("#updateReturnOrder").text(),r=$(t.target).serialize();$.showLoadingModal(),axios.patch(e,r).then((function(t){var e=$("#updateReturnOrderDetail").text(),r=$("#SalesOrderDetailForm").serialize();axios.patch(e,r).then((function(t){$.showSuccessModal(t.data.message,t.data.url)})).catch((function(t){console.error("更新退貨單細項時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))})).catch((function(t){console.error("更新退貨單時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))}},created:function(){},mounted:function(){}},s=r(0),o=Object(s.a)(a,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-11"},[e("form",{attrs:{id:"ReturnOrderUpdateForm",method:"POST",action:"#"},on:{submit:function(e){return e.preventDefault(),t.updateReturnOrder.apply(null,arguments)}}},[e("input",{attrs:{type:"hidden",name:"status",value:"2"}}),t._v(" "),e("input",{attrs:{type:"hidden",name:"confirmStatus",value:"1"}}),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12"},[e("div",{staticClass:"form-group"},[t._m(0),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.returnOrder.consumer_id,expression:"returnOrder.consumer_id"}],staticClass:"form-control",attrs:{id:"consumer_id",name:"consumer_id"},on:{change:[function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.returnOrder,"consumer_id",e.target.multiple?r:r[0])},t.getConsumerData]}},[e("option",{attrs:{value:"0"}},[t._v("請選擇...")]),t._v(" "),t._l(t.consumers,(function(t){return e("option-item",{key:t.id,attrs:{data:t}})}))],2)])])])]),t._v(" "),e("div",{staticClass:"col-md-2"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"shownID"}},[t._v("退貨單編號")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.returnOrder.shown_id,expression:"returnOrder.shown_id"}],staticClass:"form-control",attrs:{id:"shownID",name:"shownID",type:"text",readonly:""},domProps:{value:t.returnOrder.shown_id},on:{input:function(e){e.target.composing||t.$set(t.returnOrder,"shown_id",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-2"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"created_at"}},[t._v("訂單建立日期")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.returnOrder.created_at,expression:"returnOrder.created_at"}],staticClass:"form-control",attrs:{id:"created_at",type:"text",readonly:""},domProps:{value:t.returnOrder.created_at},on:{input:function(e){e.target.composing||t.$set(t.returnOrder,"created_at",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-2"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"creator"}},[t._v("建立者")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.returnOrder.creator,expression:"returnOrder.creator"}],staticClass:"form-control",attrs:{id:"creator",type:"text",readonly:""},domProps:{value:t.returnOrder.creator},on:{input:function(e){e.target.composing||t.$set(t.returnOrder,"creator",e.target.value)}}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_shortName"}},[t._v("顧客簡稱")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_shortName",type:"text",readonly:""},domProps:{value:t.current_consumer.shortName||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_act"}},[t._v("帳號")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_act",type:"text",readonly:""},domProps:{value:t.current_consumer.act||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_taxID"}},[t._v("統一編號")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_taxID",type:"text",readonly:""},domProps:{value:t.current_consumer.taxID||"無"}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_settlement"}},[t._v("結算方式")]),t._v(" "),e("input",{staticClass:"form-control mb-2",attrs:{id:"show_settlement",type:"text",readonly:""},domProps:{value:t.current_consumer.settlement||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_uncheckedAmount"}},[t._v("未沖帳金額")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_uncheckedAmount",type:"text",readonly:""},domProps:{value:t.current_consumer.uncheckedAmount||"0"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_totalConsumption"}},[t._v("總消費額")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_totalConsumption",type:"text",readonly:""},domProps:{value:t.current_consumer.totalConsumption||"0"}})])])])]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group",staticStyle:{height:"72%"}},[e("label",{attrs:{for:"show_consumer_comment"}},[t._v("顧客備註")]),t._v(" "),e("textarea",{staticClass:"form-control",staticStyle:{height:"100%"},attrs:{id:"show_consumer_comment",type:"text",readonly:""},domProps:{value:t.current_consumer.comment||"無"}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_companyAddress"}},[t._v("公司地址")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_companyAddress",type:"text",readonly:""},domProps:{value:t.current_consumer.companyAddress||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_deliveryAddress"}},[t._v("送貨地址")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_deliveryAddress",type:"text",readonly:""},domProps:{value:t.current_consumer.deliveryAddress||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_invoiceAddress"}},[t._v("發票地址")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_invoiceAddress",type:"text",readonly:""},domProps:{value:t.current_consumer.invoiceAddress||"無"}})])])]),t._v(" "),e("hr"),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group"},[t._m(1),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.returnOrder.taxType,expression:"returnOrder.taxType"}],staticClass:"form-control",attrs:{name:"taxType",id:"taxType",required:""},on:{change:[function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.returnOrder,"taxType",e.target.multiple?r:r[0])},t.changeTax]}},[e("option",{attrs:{value:"1"}},[t._v("應稅")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("未稅")]),t._v(" "),e("option",{attrs:{value:"3"}},[t._v("免稅")]),t._v(" "),e("option",{attrs:{value:"4"}},[t._v("零稅 - 經海關")]),t._v(" "),e("option",{attrs:{value:"5"}},[t._v("零稅 - 非經海關")])])])]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group",staticStyle:{height:"72%"}},[e("label",{attrs:{for:"comment"}},[t._v("訂單備註")]),t._v(" "),e("textarea",{directives:[{name:"model",rawName:"v-model",value:t.returnOrder.comment,expression:"returnOrder.comment"}],staticClass:"form-control",staticStyle:{height:"100%"},attrs:{id:"comment",name:"comment",type:"text"},domProps:{value:t.returnOrder.comment},on:{input:function(e){e.target.composing||t.$set(t.returnOrder,"comment",e.target.value)}}})])])]),t._v(" "),e("hr"),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"totalPrice",name:"totalPrice",type:"hidden"},domProps:{value:t.total_price}}),t._v(" "),e("return-update-detail",{ref:"returndetail",attrs:{products:t.products,details:t.returnOrder.details,sales_order_id:t.returnOrder.id},on:{"show-total-price":t.showTotalPrice}}),t._v(" "),e("div",{staticClass:"row mb-2"},[t._m(2),t._v(" "),t._m(3),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"totalTaxPrice"}},[t._v("總額")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"totalTaxPrice",name:"totalTaxPrice",type:"text",required:"",readonly:""},domProps:{value:t.total_price||"0"}})])])]),t._v(" "),e("div",{staticClass:"form-group row justify-content-center"},[e("div",{staticClass:"col-md-8"},[e("button",{staticClass:"btn btn-block btn-primary",attrs:{type:"submit"}},[t._v("\r\n                        確認修改\r\n                    ")]),t._v(" "),e("a",{staticClass:"btn btn-block btn-danger",attrs:{href:t.returnUrl}},[t._v("\r\n                        返回退貨單首頁\r\n                    ")])])]),t._v(" "),e("loading-modal")],1)])])}),[function(){var t=this._self._c;return t("label",{attrs:{for:"consumer_id"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("顧客名稱\r\n                                ")])},function(){var t=this._self._c;return t("label",{attrs:{for:"taxType"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("稅別\r\n                        ")])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"beforePrice"}},[this._v("退貨額")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"beforePrice",type:"text",value:"0",required:"",readonly:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"taxPrice"}},[this._v("稅額")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"taxPrice",type:"text",value:"0",required:"",readonly:""}})])])}],!1,null,null,null);e.default=o.exports},59:function(t,e,r){"use strict";r.r(e);var a={props:["products","details","sales_order_id"],mounted:function(){console.log("ReturnUpdateDetail.vue mounted.")},data:function(){return{current_product:[],total_price:0}},methods:{addDetail:function(){0!=this.current_product.length?this.details.push({count:this.details.length,product:{id:this.current_product.id,name:this.current_product.name,internationalNum:this.current_product.internationalNum,unitPrice:this.current_product.retailPrice,qty_per_pack:this.current_product.qty_per_pack,showUnit:this.current_product.showUnit},pieces:0,quantity:0,price:this.current_product.retailPrice,discount:1,subTotal:0,comment:null}):alert("請選擇商品")},deleteDetail:function(t){this.details.splice(t,1),0!=this.details.length&&this.calculateSubtotal(1),this.calculateTotalPrice()},calculateSubtotal:function(t){var e=$("#qty_"+t).val(),r=$("#unitPrice_"+t).val(),a=$("#discount_"+t).val(),s=Math.round(r*e*a*1e4)/1e4;$("#subtotal_"+t).html(s),this.details[t-1].quantity=e,this.details[t-1].price=r,this.details[t-1].discount=a,this.details[t-1].subTotal=s,this.calculateTotalPrice()},calculateTotalPrice:function(){this.total_price=0;for(var t=1;t<=this.details.length;t++){var e=this.details[t-1].quantity,r=this.details[t-1].price,a=this.details[t-1].discount,s=Math.round(r*e*a*1e4)/1e4;this.total_price=this.total_price+s}$("#beforePrice").val(this.total_price);var o="1"==$("#taxType").val()?Math.round(.05*this.total_price*1e4)/1e4:0;$("#taxPrice").val(o),this.total_price=Math.round(1e4*(this.total_price+o))/1e4,this.$emit("show-total-price",this.total_price)},calculateQty:function(t,e){var r=$("#qty_per_pack_"+t).val();if("p"==e){var a=$("#pcs_"+t).val();$("#qty_"+t).val(a*r),this.details[t-1].pieces=a}else if("q"==e){var s=$("#qty_"+t).val();$("#pcs_"+t).val(s/r),this.details[t-1].pieces=s/r}},updateComment:function(t){var e=$("#comment_"+t).val();this.details[t-1].comment=e},getProductData:function(){var t=this,e=$("#product_id").val();if(0!=e){var r=$("#getProductInfo").html();$("#addDetailBtn").attr("disabled",!0),axios.post(r,{id:e}).then((function(e){t.current_product=e.data,$("#addDetailBtn").attr("disabled",!1)}))}else alert("請選擇商品")}}},s=r(0),o=Object(s.a)(a,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-12"},[e("form",{attrs:{id:"SalesOrderDetailForm",method:"POST",action:"#"}},[e("input",{attrs:{type:"hidden",id:"salesOrderID",name:"salesOrder_id"},domProps:{value:t.sales_order_id}}),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6 mb-2"},[e("select",{staticClass:"form-control",attrs:{id:"product_id"},on:{change:t.getProductData}},[e("option",{attrs:{value:"0"}},[t._v("請選擇...")]),t._v(" "),t._l(t.products,(function(t){return e("option-item",{key:t.id,attrs:{data:t}})}))],2)]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("button",{staticClass:"btn btn-md btn-success",attrs:{id:"addDetailBtn",type:"button"},on:{click:t.addDetail}},[t._v("新增至細項")])])]),t._v(" "),e("table",{staticClass:"table table-bordered",attrs:{width:"100%",cellspacing:"0"}},[t._m(0),t._v(" "),e("tbody",t._l(t.details,(function(r,a){return e("tr",{key:a},[e("td",{staticStyle:{width:"4%"}},[t._v(t._s(a+1))]),t._v(" "),e("td",{staticStyle:{width:"20%"}},[t._v("\r\n                            "+t._s(r.product.name)+"\r\n                            "),e("input",{attrs:{type:"hidden",name:"details["+(a+1)+"][product_id]"},domProps:{value:r.product.id}})]),t._v(" "),e("td",{staticStyle:{width:"10%"}},[t._v("\r\n                            "+t._s(r.product.internationalNum)+"\r\n                        ")]),t._v(" "),e("td",{staticStyle:{width:"20%"}},[e("input",{staticClass:"form-control",staticStyle:{width:"30%",display:"inline-block"},attrs:{id:"pcs_"+(a+1),type:"text",name:"details["+(a+1)+"][pieces]"},domProps:{value:r.pieces},on:{change:function(e){t.calculateQty(a+1,"p"),t.calculateSubtotal(a+1)}}}),t._v(" "),e("span",{staticClass:"mr-2"},[t._v("件")]),t._v(" "),e("input",{staticClass:"form-control",staticStyle:{width:"30%",display:"inline-block"},attrs:{id:"qty_"+(a+1),type:"text",name:"details["+(a+1)+"][quantity]"},domProps:{value:r.quantity},on:{change:function(e){t.calculateQty(a+1,"q"),t.calculateSubtotal(a+1)}}}),t._v(" "),e("span",[t._v(t._s(r.product.showUnit))]),t._v(" "),e("input",{attrs:{type:"hidden",id:"qty_per_pack_"+(a+1)},domProps:{value:r.product.qty_per_pack}})]),t._v(" "),e("td",{staticStyle:{width:"10%"}},[e("input",{staticClass:"form-control",attrs:{id:"unitPrice_"+(a+1),type:"text",name:"details["+(a+1)+"][price]"},domProps:{value:r.price},on:{change:function(e){return t.calculateSubtotal(a+1)}}})]),t._v(" "),e("td",{staticStyle:{width:"8%"}},[e("input",{staticClass:"form-control",attrs:{id:"discount_"+(a+1),type:"text",name:"details["+(a+1)+"][discount]"},domProps:{value:r.discount},on:{change:function(e){return t.calculateSubtotal(a+1)}}})]),t._v(" "),e("td",{staticStyle:{width:"8%"}},[e("input",{staticClass:"form-control",attrs:{id:"subtotal_"+(a+1),type:"text",disabled:""},domProps:{value:r.subTotal}})]),t._v(" "),e("td",{staticStyle:{width:"15%"}},[e("input",{staticClass:"form-control",attrs:{id:"comment_"+(a+1),type:"text",name:"details["+(a+1)+"][comment]"},domProps:{value:r.comment},on:{change:function(e){return t.updateComment(a+1)}}})]),t._v(" "),e("td",{staticStyle:{width:"5%"}},[e("button",{staticClass:"btn btn-md btn-danger",attrs:{type:"button"},on:{click:function(e){return t.deleteDetail(a)}}},[e("i",{staticClass:"far fa-trash-alt"})])])])})),0)])])])])}),[function(){var t=this,e=t._self._c;return e("thead",[e("tr",[e("th",[t._v("編號")]),t._v(" "),e("th",[t._v("商品")]),t._v(" "),e("th",[t._v("國際條碼")]),t._v(" "),e("th",[t._v("數量")]),t._v(" "),e("th",[t._v("單價")]),t._v(" "),e("th",[t._v("折數")]),t._v(" "),e("th",[t._v("小計")]),t._v(" "),e("th",[t._v("備註")]),t._v(" "),e("th",[t._v("操作")])])])}],!1,null,null,null);e.default=o.exports}});