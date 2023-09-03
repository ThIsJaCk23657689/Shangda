!function(t){var e={};function a(s){if(e[s])return e[s].exports;var r=e[s]={i:s,l:!1,exports:{}};return t[s].call(r.exports,r,r.exports,a),r.l=!0,r.exports}a.m=t,a.c=e,a.d=function(t,e,s){a.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:s})},a.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},a.t=function(t,e){if(1&e&&(t=a(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var s=Object.create(null);if(a.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)a.d(s,r,function(e){return t[e]}.bind(null,r));return s},a.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return a.d(e,"a",e),e},a.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},a.p="/",a(a.s=124)}({0:function(t,e,a){"use strict";function s(t,e,a,s,r,o,i,n){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=a,c._compiled=!0),s&&(c.functional=!0),o&&(c._scopeId="data-v-"+o),i?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},c._ssrRegister=l):r&&(l=n?function(){r.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:r),l)if(c.functional){c._injectStyles=l;var d=c.render;c.render=function(t,e){return l.call(e),d(t,e)}}else{var u=c.beforeCreate;c.beforeCreate=u?[].concat(u,l):[l]}return{exports:t,options:c}}a.d(e,"a",(function(){return s}))},124:function(t,e,a){t.exports=a(125)},125:function(t,e,a){Vue.component("sales-create-form",a(201).default),Vue.component("sales-detail",a(202).default);new Vue({el:"#sales",data:function(){return{consumers:[],current_consumer:[],products:[]}},methods:{getConsumerData:function(t){var e=this,a=$("#getConsumerInfo").html();$.showLoadingModal(),axios.post(a,t).then((function(t){$.closeModal(),e.current_consumer=t.data,0==e.current_consumer.monthlyCheckDate?e.current_consumer.settlement="當日結算":e.current_consumer.settlement="每個月"+e.current_consumer.monthlyCheckDate+"號結算"})).catch((function(t){$.showErrorModal(t),console.error("抓取顧客資料失敗，錯誤："+t)}))}},created:function(){var t=this,e=$("#getConsumersName").html(),a=$("#getProductsName").html();$.showLoadingModal(),axios.get(e).then((function(e){t.consumers=e.data})).catch((function(t){$.showErrorModal(t),console.error("抓取顧客名稱列表失敗，錯誤："+t)})),axios.get(a).then((function(e){t.products=e.data,$.closeModal()})).catch((function(t){$.showErrorModal(t),console.error("抓取商品名稱列表失敗，錯誤："+t)}))}})},201:function(t,e,a){"use strict";a.r(e);var s={props:["consumers","current_comsumer","products"],mounted:function(){$("#expectPay_at").datepicker({changeYear:!0,changeMonth:!0,dateFormat:"yy-mm-dd"}),$("#expectDeliver_at").datepicker({changeYear:!0,changeMonth:!0,dateFormat:"yy-mm-dd"});var t=new Date,e=t.getFullYear()+"-"+("0"+(t.getMonth()+1)).slice(-2)+"-"+("0"+t.getDate()).slice(-2);$("#created_at").val(e),$("#expectPay_at").val(e),$("#expectDeliver_at").val(e),$("#shownID").val($("#getSalesOrderShownID").html()),$("#creator").val($("#getAuthName").html()),$("#SalesOrderDetailForm").submit((function(t){t.preventDefault();var e=$("#createSalesOrderDetail").html(),a=$(this).serialize();axios.post(e,a).then((function(t){console.log(t.data.messenge),alert("新增進貨單成功！"),history.go(-1)})).catch((function(t){console.error("新增進貨單細項時發生錯誤，錯誤訊息："+t),alert("新增進貨單細項時發生錯誤，錯誤訊息："+t),$("#LoadingModal").modal("hide")}))}))},data:function(){return{total_price:0,getSalesOrderIndex:$("#getSalesOrderIndex").html()}},methods:{showTotalPrice:function(t){this.total_price=t},changeTax:function(){this.$refs.salesdetail.calculateTotalPrice()},getConsumerData:function(){var t=$("#consumer_id").val();0!=t?this.$emit("get-consumer-data",{id:t}):alert("請先選擇顧客!")},createSalesOrder:function(){var t=$("#createSalesOrder").html(),e=$("#SalesOrderCreateForm").serialize();$("#LoadingModal").modal("show"),axios.post(t,e).then((function(t){console.log(t),$("#salesOrderID").val(t.data.salesOrder_id),$("#SalesOrderDetailForm").submit()})).catch((function(t){console.error("新增進貨單時發生錯誤，錯誤訊息："+t),alert("新增進貨單時發生錯誤，錯誤訊息："+t),$("#LoadingModal").modal("hide")}))}}},r=a(0),o=Object(r.a)(s,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-11"},[e("form",{attrs:{id:"SalesOrderCreateForm",method:"POST",action:"#"},on:{submit:function(e){return e.preventDefault(),t.createSalesOrder.apply(null,arguments)}}},[e("input",{attrs:{type:"hidden",name:"status",value:"1"}}),t._v(" "),e("input",{attrs:{type:"hidden",name:"confirmStatus",value:"1"}}),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12"},[e("div",{staticClass:"form-group"},[t._m(0),t._v(" "),e("select",{staticClass:"form-control",attrs:{id:"consumer_id",name:"consumer_id"},on:{change:t.getConsumerData}},[e("option",{attrs:{value:"0"}},[t._v("請選擇...")]),t._v(" "),t._l(t.consumers,(function(a){return e("option",{domProps:{value:a.id}},[t._v(t._s(a.name))])}))],2)])])])]),t._v(" "),t._m(1),t._v(" "),t._m(2),t._v(" "),t._m(3)]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_shortName"}},[t._v("顧客簡稱")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_shortName",type:"text",readonly:""},domProps:{value:t.current_comsumer.shortName||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_act"}},[t._v("帳號")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_act",type:"text",readonly:""},domProps:{value:t.current_comsumer.account||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_taxID"}},[t._v("統一編號")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_taxID",type:"text",readonly:""},domProps:{value:t.current_comsumer.taxID||"無"}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_settlement"}},[t._v("結算方式")]),t._v(" "),e("input",{staticClass:"form-control mb-2",attrs:{id:"show_settlement",type:"text",readonly:""},domProps:{value:t.current_comsumer.settlement||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_uncheckedAmount"}},[t._v("未沖帳金額")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_uncheckedAmount",type:"text",readonly:""},domProps:{value:t.current_comsumer.uncheckedAmount||"0"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_totalConsumption"}},[t._v("總消費額")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_totalConsumption",type:"text",readonly:""},domProps:{value:t.current_comsumer.totalConsumption||"0"}})])])])]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group",staticStyle:{height:"72%"}},[e("label",{attrs:{for:"show_consumer_comment"}},[t._v("顧客備註")]),t._v(" "),e("textarea",{staticClass:"form-control",staticStyle:{height:"100%"},attrs:{id:"show_consumer_comment",type:"text",readonly:""},domProps:{value:t.current_comsumer.comment||"無"}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_companyAddress"}},[t._v("地址")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_companyAddress",type:"text",readonly:""},domProps:{value:t.current_comsumer.address||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_deliveryAddress"}},[t._v("送貨地址")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_deliveryAddress",type:"text",readonly:""},domProps:{value:t.current_comsumer.deliveryAddress||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_email"}},[t._v("信箱")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_email",type:"text",readonly:""},domProps:{value:t.current_comsumer.email||"無"}})])])]),t._v(" "),e("hr"),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[t._m(4),t._v(" "),e("div",{staticClass:"row"},[t._m(5),t._v(" "),e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group"},[t._m(6),t._v(" "),e("select",{staticClass:"form-control",attrs:{name:"taxType",id:"taxType",required:""},on:{change:t.changeTax}},[e("option",{attrs:{value:"1"}},[t._v("應稅")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("未稅")]),t._v(" "),e("option",{attrs:{value:"3"}},[t._v("免稅")]),t._v(" "),e("option",{attrs:{value:"4"}},[t._v("零稅 - 經海關")]),t._v(" "),e("option",{attrs:{value:"5"}},[t._v("零稅 - 非經海關")])])])])])]),t._v(" "),t._m(7)]),t._v(" "),e("hr"),t._v(" "),e("sales-detail",{ref:"salesdetail",attrs:{products:t.products},on:{showTotalPrice:t.showTotalPrice}}),t._v(" "),e("div",{staticClass:"row mb-2"},[t._m(8),t._v(" "),t._m(9),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"totalTaxPrice"}},[t._v("總額")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"totalTaxPrice",name:"totalTaxPrice",type:"text",required:""},domProps:{value:t.total_price||"0"}})])])]),t._v(" "),e("div",{staticClass:"form-group row justify-content-center"},[e("div",{staticClass:"col-md-8"},[e("button",{staticClass:"btn btn-block btn-primary",attrs:{type:"submit"}},[t._v("\r\n                        確認新增\r\n                    ")]),t._v(" "),e("a",{staticClass:"btn btn-block btn-danger",attrs:{href:t.getSalesOrderIndex}},[t._v("\r\n                        返回進貨單首頁\r\n                    ")])])])],1)])])}),[function(){var t=this._self._c;return t("label",{attrs:{for:"consumer_id"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("顧客名稱\r\n                                ")])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-2"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"shownID"}},[this._v("銷貨單編號")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"shownID",name:"shownID",type:"text",readonly:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-2"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"created_at"}},[this._v("訂單建立日期")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"created_at",type:"text",readonly:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-2"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"creator"}},[this._v("建立者")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"creator",type:"text",readonly:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-6"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"expectPay_at"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("預計付款日\r\n                                ")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"expectPay_at",name:"expectPay_at",type:"text",required:""}})])]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"expectDeliver_at"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("預計出貨日\r\n                                ")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"expectDeliver_at",name:"expectDeliver_at",type:"text",required:""}})])])])},function(){var t=this,e=t._self._c;return e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"invoiceType"}},[e("span",{staticClass:"text-danger mr-2"},[t._v("*")]),t._v("發票類型\r\n                                ")]),t._v(" "),e("select",{staticClass:"form-control",attrs:{name:"invoiceType",id:"invoiceType",required:""}},[e("option",{attrs:{value:"1"}},[t._v("三聯式")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("二聯式")]),t._v(" "),e("option",{attrs:{value:"3"}},[t._v("三聯銷退折讓")]),t._v(" "),e("option",{attrs:{value:"4"}},[t._v("二聯銷退折讓")]),t._v(" "),e("option",{attrs:{value:"5"}},[t._v("三聯式收銀機")]),t._v(" "),e("option",{attrs:{value:"6"}},[t._v("免用發票")])])])])},function(){var t=this._self._c;return t("label",{attrs:{for:"taxType"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("稅別\r\n                                ")])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-6"},[t("div",{staticClass:"form-group",staticStyle:{height:"72%"}},[t("label",{attrs:{for:"comment"}},[this._v("訂單備註")]),this._v(" "),t("textarea",{staticClass:"form-control",staticStyle:{height:"100%"},attrs:{id:"comment",name:"comment",type:"text"}})])])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"totalPrice"}},[this._v("銷售額")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"totalPrice",type:"text",value:"0",required:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"taxPrice"}},[this._v("稅額")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"taxPrice",type:"text",value:"0",required:""}})])])}],!1,null,null,null);e.default=o.exports},202:function(t,e,a){"use strict";a.r(e);var s={props:["products"],mounted:function(){},data:function(){return{details:[],current_product:[],total_price:0}},methods:{addDetail:function(){console.log(this.current_product),this.current_product?this.details.push({count:this.details.length,product:{id:this.current_product.id,name:this.current_product.name,internationalNum:this.current_product.internationalNum,unitPrice:this.current_product.retailPrice,qty_per_pack:this.current_product.qty_per_pack,showUnit:this.current_product.showUnit},pieces:0,quantity:0,discount:1,subTotal:0,comment:null}):alert("請選擇商品")},deleteDetail:function(t){this.details.splice(t,1),0!=this.details.length&&this.calculateSubtotal(1),this.calculateTotalPrice()},calculateSubtotal:function(t){var e=$("#qty_"+t).val(),a=$("#unitPrice_"+t).val(),s=$("#discount_"+t).val(),r=Math.round(a*e*s*1e4)/1e4;$("#subtotal_"+t).html(r),this.details[t-1].quantity=e,this.details[t-1].product.unitPrice=a,this.details[t-1].discount=s,this.details[t-1].subTotal=r,this.calculateTotalPrice()},calculateTotalPrice:function(){this.total_price=0;for(var t=1;t<=this.details.length;t++){var e=this.details[t-1].quantity,a=this.details[t-1].product.unitPrice,s=this.details[t-1].discount,r=Math.round(a*e*s*1e4)/1e4;this.total_price=this.total_price+r}$("#totalPrice").val(this.total_price);var o="1"==$("#taxType").val()?Math.round(.05*this.total_price*1e4)/1e4:0;$("#taxPrice").val(o),this.total_price=Math.round(Math.round(1e4*(this.total_price+o))/1e4),this.$emit("showTotalPrice",this.total_price)},calculateQty:function(t,e){var a=$("#qty_per_pack_"+t).val();if("p"==e){var s=$("#pcs_"+t).val();$("#qty_"+t).val(s*a),this.details[t-1].pieces=s}else if("q"==e){var r=$("#qty_"+t).val();$("#pcs_"+t).val(r/a),this.details[t-1].pieces=r/a}},updateComment:function(t){var e=$("#comment_"+t).val();this.details[t-1].comment=e},getProductData:function(){var t=this,e=$("#product_id").val();if(0!=e){var a=$("#getProductInfo").html();$.showLoadingModal(),$("#addDetailBtn").attr("disabled",!0),axios.post(a,{id:e}).then((function(e){$.closeModal(),t.current_product=e.data,$("#addDetailBtn").attr("disabled",!1)})).catch((function(t){$.showErrorModal(t),console.error("抓取商品資料失敗，錯誤："+t)}))}else alert("請選擇商品")}}},r=a(0),o=Object(r.a)(s,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-12"},[e("form",{attrs:{id:"SalesOrderDetailForm",method:"POST",action:"#"}},[e("input",{attrs:{type:"hidden",id:"salesOrderID",name:"salesOrder_id",value:""}}),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6 mb-2"},[e("select",{staticClass:"form-control",attrs:{id:"product_id"},on:{change:t.getProductData}},[e("option",{attrs:{value:"0"}},[t._v("請選擇...")]),t._v(" "),t._l(t.products,(function(a){return e("option",{domProps:{value:a.id}},[t._v(t._s(a.name))])}))],2)]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("button",{staticClass:"btn btn-md btn-success",attrs:{id:"addDetailBtn",type:"button"},on:{click:t.addDetail}},[t._v("新增至細項")])])]),t._v(" "),e("table",{staticClass:"table table-bordered",attrs:{width:"100%",cellspacing:"0"}},[t._m(0),t._v(" "),e("tbody",t._l(t.details,(function(a,s){return e("tr",{key:s},[e("td",{staticStyle:{width:"3%"}},[t._v(t._s(s+1))]),t._v(" "),e("td",{staticStyle:{width:"18%"}},[t._v("\r\n                            "+t._s(a.product.name)+"\r\n                            "),e("input",{attrs:{type:"hidden",name:"details["+(s+1)+"][product_id]"},domProps:{value:a.product.id}})]),t._v(" "),e("td",{staticStyle:{width:"10%"}},[t._v("\r\n                            "+t._s(a.product.internationalNum)+"\r\n                        ")]),t._v(" "),e("td",{staticStyle:{width:"18%"}},[e("input",{staticClass:"form-control",staticStyle:{width:"30%",display:"inline-block"},attrs:{id:"pcs_"+(s+1),type:"text",name:"details["+(s+1)+"][pieces]"},domProps:{value:a.pieces},on:{change:function(e){t.calculateQty(s+1,"p"),t.calculateSubtotal(s+1)}}}),t._v(" "),e("span",{staticClass:"mr-2"},[t._v("件")]),t._v(" "),e("input",{staticClass:"form-control",staticStyle:{width:"30%",display:"inline-block"},attrs:{id:"qty_"+(s+1),type:"text",name:"details["+(s+1)+"][quantity]"},domProps:{value:a.quantity},on:{change:function(e){t.calculateQty(s+1,"q"),t.calculateSubtotal(s+1)}}}),t._v(" "),e("span",[t._v(t._s(a.product.showUnit))]),t._v(" "),e("input",{attrs:{type:"hidden",id:"qty_per_pack_"+(s+1)},domProps:{value:a.product.qty_per_pack}})]),t._v(" "),e("td",{staticStyle:{width:"9%"}},[e("input",{staticClass:"form-control",attrs:{id:"unitPrice_"+(s+1),type:"text",name:"details["+(s+1)+"][price]"},domProps:{value:a.product.unitPrice},on:{change:function(e){return t.calculateSubtotal(s+1)}}})]),t._v(" "),e("td",{staticStyle:{width:"7%"}},[e("input",{staticClass:"form-control",attrs:{id:"discount_"+(s+1),type:"text",name:"details["+(s+1)+"][discount]"},domProps:{value:a.discount},on:{change:function(e){return t.calculateSubtotal(s+1)}}})]),t._v(" "),e("td",{staticStyle:{width:"15%"}},[e("input",{staticClass:"form-control",attrs:{id:"subtotal_"+(s+1),type:"text",disabled:""},domProps:{value:a.subTotal}})]),t._v(" "),e("td",{staticStyle:{width:"15%"}},[e("input",{staticClass:"form-control",attrs:{id:"comment_"+(s+1),type:"text",name:"details["+(s+1)+"][comment]"},domProps:{value:a.comment},on:{change:function(e){return t.updateComment(s+1)}}})]),t._v(" "),e("td",{staticStyle:{width:"5%"}},[e("button",{staticClass:"btn btn-md btn-danger",attrs:{type:"button"},on:{click:function(e){return t.deleteDetail(s)}}},[e("i",{staticClass:"far fa-trash-alt"})])])])})),0)])])])])}),[function(){var t=this,e=t._self._c;return e("thead",[e("tr",[e("th",[t._v("編號")]),t._v(" "),e("th",[t._v("商品")]),t._v(" "),e("th",[t._v("國際條碼")]),t._v(" "),e("th",[t._v("數量")]),t._v(" "),e("th",[t._v("單價")]),t._v(" "),e("th",[t._v("折數")]),t._v(" "),e("th",[t._v("小計")]),t._v(" "),e("th",[t._v("備註")]),t._v(" "),e("th",[t._v("操作")])])])}],!1,null,null,null);e.default=o.exports}});