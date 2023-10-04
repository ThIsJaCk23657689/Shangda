!function(t){var e={};function r(a){if(e[a])return e[a].exports;var s=e[a]={i:a,l:!1,exports:{}};return t[a].call(s.exports,s,s.exports,r),s.l=!0,s.exports}r.m=t,r.c=e,r.d=function(t,e,a){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(r.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var s in t)r.d(a,s,function(e){return t[e]}.bind(null,s));return a},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="/",r(r.s=132)}({0:function(t,e,r){"use strict";function a(t,e,r,a,s,o,n,i){var c,l="function"==typeof t?t.options:t;if(e&&(l.render=e,l.staticRenderFns=r,l._compiled=!0),a&&(l.functional=!0),o&&(l._scopeId="data-v-"+o),n?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),s&&s.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(n)},l._ssrRegister=c):s&&(c=i?function(){s.call(this,(l.functional?this.parent:this).$root.$options.shadowRoot)}:s),c)if(l.functional){l._injectStyles=c;var u=l.render;l.render=function(t,e){return c.call(e),u(t,e)}}else{var d=l.beforeCreate;l.beforeCreate=d?[].concat(d,c):[c]}return{exports:t,options:l}}r.d(e,"a",(function(){return a}))},132:function(t,e,r){t.exports=r(133)},133:function(t,e,r){Vue.component("sales-update-form",r(211).default),Vue.component("return-update-detail",r(62).default);new Vue({el:"#sales",data:function(){return{consumers:[],current_consumer:[],products:[],salesOrder:[]}},methods:{getConsumerData:function(t){var e=this,r=$("#getConsumerInfo").html();axios.post(r,t).then((function(t){console.log(t),e.current_consumer=t.data,0==e.current_consumer.monthlyCheckDate?e.current_consumer.settlement="當日結算":e.current_consumer.settlement="每個月"+e.current_consumer.monthlyCheckDate+"號結算"}))}},created:function(){var t=this,e=$("#getConsumersName").html(),r=$("#getProductsName").html();axios.get(e).then((function(e){t.consumers=e.data})),axios.get(r).then((function(e){t.products=e.data}));var a=$("#getSalesOrderInfo").text();$.showLoadingModal(),axios.get(a).then((function(e){t.salesOrder=e.data.salesOrder,t.salesOrder.details=e.data.details,$("#consumer_id").val(t.salesOrder.consumer_id),t.getConsumerData({id:t.salesOrder.consumer_id});for(var r=0,a=1;a<=t.salesOrder.details.length;a++){var s=t.salesOrder.details[a-1].quantity,o=t.salesOrder.details[a-1].price,n=t.salesOrder.details[a-1].discount;r+=Math.round(o*s*n*1e4)/1e4}$("#beforePrice").val(r);var i="1"==t.salesOrder.taxType?Math.round(.05*r*1e4)/1e4:0;$("#tax_price").val(i),r=Math.round(1e4*(r+i))/1e4,t.$refs.salesOrderform.showTotalPrice(r),$.closeModal()}))}})},211:function(t,e,r){"use strict";r.r(e);var a={props:["consumers","current_consumer","products","salesOrder","returnUrl"],data:function(){return{total_price:0}},methods:{getConsumerData:function(){var t=$("#consumer_id").val();0!=t?this.$emit("get-consumer-data",{id:t}):($.showWarningModal("請選擇廠商"),this.$emit("get-consumer-data",null))},showTotalPrice:function(t){this.total_price=t},changeTax:function(){this.$refs.returndetail.calculateTotalPrice()},updateSalesOrder:function(t){var e=this;if(0==this.salesOrder.details.length)return $.showWarningModal("銷貨單必須至少要有一項產品銷貨。"),!1;var r=$("#updateSalesOrder").text(),a=$(t.target).serialize();$.showLoadingModal(),axios.patch(r,a).then((function(t){var r=$("#updateSalesOrderDetail").text(),a=$("#SalesOrderDetailForm").serialize();axios.patch(r,a).then((function(t){$.showSuccessModal(t.data.message,e.returnUrl)})).catch((function(t){console.error("更新銷貨單細項時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))})).catch((function(t){console.error("更新銷貨單時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))}},created:function(){},mounted:function(){$("#expectPay_at").datepicker({changeYear:!0,changeMonth:!0,dateFormat:"yy-mm-dd"}),$("#expectDeliver_at").datepicker({changeYear:!0,changeMonth:!0,dateFormat:"yy-mm-dd"}),$("#transaction_at").datepicker({changeYear:!0,changeMonth:!0,dateFormat:"yy-mm-dd"})}},s=r(0),o=Object(s.a)(a,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-11"},[e("form",{attrs:{id:"SalesOrderUpdateForm",method:"POST",action:"#"},on:{submit:function(e){return e.preventDefault(),t.updateSalesOrder.apply(null,arguments)}}},[e("input",{attrs:{type:"hidden",name:"status",value:"1"}}),t._v(" "),e("input",{attrs:{type:"hidden",name:"confirmStatus",value:"1"}}),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12"},[e("div",{staticClass:"form-group"},[t._m(0),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.salesOrder.consumer_id,expression:"salesOrder.consumer_id"}],staticClass:"form-control",attrs:{id:"consumer_id",name:"consumer_id"},on:{change:[function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.salesOrder,"consumer_id",e.target.multiple?r:r[0])},t.getConsumerData]}},[e("option",{attrs:{value:"0"}},[t._v("請選擇...")]),t._v(" "),t._l(t.consumers,(function(r){return e("option",{domProps:{value:r.id}},[t._v(t._s(r.name))])}))],2)])])])]),t._v(" "),e("div",{staticClass:"col-md-2"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"shownID"}},[t._v("銷貨單編號")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.salesOrder.shown_id,expression:"salesOrder.shown_id"}],staticClass:"form-control",attrs:{id:"shownID",name:"shownID",type:"text",readonly:""},domProps:{value:t.salesOrder.shown_id},on:{input:function(e){e.target.composing||t.$set(t.salesOrder,"shown_id",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-2"},[e("div",{staticClass:"form-group"},[t._m(1),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.salesOrder.transaction_at,expression:"salesOrder.transaction_at"}],staticClass:"form-control",attrs:{id:"transaction_at",name:"transaction_at",type:"text",required:""},domProps:{value:t.salesOrder.transaction_at},on:{input:function(e){e.target.composing||t.$set(t.salesOrder,"transaction_at",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-2"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"creator"}},[t._v("建立者")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.salesOrder.creator,expression:"salesOrder.creator"}],staticClass:"form-control",attrs:{id:"creator",type:"text",readonly:""},domProps:{value:t.salesOrder.creator},on:{input:function(e){e.target.composing||t.$set(t.salesOrder,"creator",e.target.value)}}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_shortName"}},[t._v("顧客簡稱")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_shortName",type:"text",readonly:""},domProps:{value:t.current_consumer.shortName||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_act"}},[t._v("帳號")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_act",type:"text",readonly:""},domProps:{value:t.current_consumer.account||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_taxID"}},[t._v("統一編號")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_taxID",type:"text",readonly:""},domProps:{value:t.current_consumer.taxID||"無"}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_settlement"}},[t._v("結算方式")]),t._v(" "),e("input",{staticClass:"form-control mb-2",attrs:{id:"show_settlement",type:"text",readonly:""},domProps:{value:t.current_consumer.settlement||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_uncheckedAmount"}},[t._v("未沖帳金額")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_uncheckedAmount",type:"text",readonly:""},domProps:{value:t.current_consumer.uncheckedAmount||"0"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_totalConsumption"}},[t._v("總消費額")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_totalConsumption",type:"text",readonly:""},domProps:{value:t.current_consumer.totalConsumption||"0"}})])])])]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group",staticStyle:{height:"72%"}},[e("label",{attrs:{for:"show_consumer_comment"}},[t._v("顧客備註")]),t._v(" "),e("textarea",{staticClass:"form-control",staticStyle:{height:"100%"},attrs:{id:"show_consumer_comment",type:"text",readonly:""},domProps:{value:t.current_consumer.comment||"無"}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_companyAddress"}},[t._v("地址")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_companyAddress",type:"text",readonly:""},domProps:{value:t.current_consumer.address||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_deliveryAddress"}},[t._v("送貨地址")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_deliveryAddress",type:"text",readonly:""},domProps:{value:t.current_consumer.deliveryAddress||"無"}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"show_email"}},[t._v("信箱")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"show_email",type:"text",readonly:""},domProps:{value:t.current_consumer.email||"無"}})])])]),t._v(" "),e("hr"),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group"},[t._m(2),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.salesOrder.expectPay_at,expression:"salesOrder.expectPay_at"}],staticClass:"form-control",attrs:{id:"expectPay_at",name:"expectPay_at",type:"text",required:""},domProps:{value:t.salesOrder.expectPay_at},on:{input:function(e){e.target.composing||t.$set(t.salesOrder,"expectPay_at",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group"},[t._m(3),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.salesOrder.expectDeliver_at,expression:"salesOrder.expectDeliver_at"}],staticClass:"form-control",attrs:{id:"expectDeliver_at",name:"expectDeliver_at",type:"text",required:""},domProps:{value:t.salesOrder.expectDeliver_at},on:{input:function(e){e.target.composing||t.$set(t.salesOrder,"expectDeliver_at",e.target.value)}}})])])]),t._v(" "),e("div",{staticClass:"row"},[t._m(4),t._v(" "),e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group"},[t._m(5),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.salesOrder.taxType,expression:"salesOrder.taxType"}],staticClass:"form-control",attrs:{name:"taxType",id:"taxType",required:""},on:{change:[function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.salesOrder,"taxType",e.target.multiple?r:r[0])},t.changeTax]}},[e("option",{attrs:{value:"1"}},[t._v("應稅")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("未稅")]),t._v(" "),e("option",{attrs:{value:"3"}},[t._v("免稅")]),t._v(" "),e("option",{attrs:{value:"4"}},[t._v("零稅 - 經海關")]),t._v(" "),e("option",{attrs:{value:"5"}},[t._v("零稅 - 非經海關")])])])])])]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group",staticStyle:{height:"72%"}},[e("label",{attrs:{for:"comment"}},[t._v("訂單備註")]),t._v(" "),e("textarea",{directives:[{name:"model",rawName:"v-model",value:t.salesOrder.comment,expression:"salesOrder.comment"}],staticClass:"form-control",staticStyle:{height:"100%"},attrs:{id:"comment",name:"comment",type:"text"},domProps:{value:t.salesOrder.comment},on:{input:function(e){e.target.composing||t.$set(t.salesOrder,"comment",e.target.value)}}})])])]),t._v(" "),e("hr"),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"totalPrice",name:"totalPrice",type:"hidden"},domProps:{value:t.total_price}}),t._v(" "),e("return-update-detail",{ref:"returndetail",attrs:{products:t.products,details:t.salesOrder.details,sales_order_id:t.salesOrder.id},on:{"show-total-price":t.showTotalPrice}}),t._v(" "),e("div",{staticClass:"row mb-2"},[t._m(6),t._v(" "),t._m(7),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"totalTaxPrice"}},[t._v("總額")]),t._v(" "),e("input",{staticClass:"form-control",attrs:{id:"totalTaxPrice",name:"totalTaxPrice",type:"text",required:"",readonly:""},domProps:{value:t.total_price||"0"}})])])]),t._v(" "),e("div",{staticClass:"form-group row justify-content-center"},[e("div",{staticClass:"col-md-8"},[e("button",{staticClass:"btn btn-block btn-primary",attrs:{type:"submit"}},[t._v("\r\n                        確認修改\r\n                    ")]),t._v(" "),e("a",{staticClass:"btn btn-block btn-danger",attrs:{href:t.returnUrl}},[t._v("\r\n                        返回銷貨單首頁\r\n                    ")])])]),t._v(" "),e("loading-modal")],1)])])}),[function(){var t=this._self._c;return t("label",{attrs:{for:"consumer_id"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("顧客名稱\r\n                                ")])},function(){var t=this._self._c;return t("label",{attrs:{for:"transaction_at"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("訂單日期\r\n                        ")])},function(){var t=this._self._c;return t("label",{attrs:{for:"expectPay_at"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("預計付款日\r\n                                ")])},function(){var t=this._self._c;return t("label",{attrs:{for:"expectDeliver_at"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("預計出貨日\r\n                                ")])},function(){var t=this,e=t._self._c;return e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"invoiceType"}},[e("span",{staticClass:"text-danger mr-2"},[t._v("*")]),t._v("發票類型\r\n                                ")]),t._v(" "),e("select",{staticClass:"form-control",attrs:{name:"invoiceType",id:"invoiceType",required:""}},[e("option",{attrs:{value:"1"}},[t._v("三聯式")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("二聯式")]),t._v(" "),e("option",{attrs:{value:"3"}},[t._v("三聯銷退折讓")]),t._v(" "),e("option",{attrs:{value:"4"}},[t._v("二聯銷退折讓")]),t._v(" "),e("option",{attrs:{value:"5"}},[t._v("三聯式收銀機")]),t._v(" "),e("option",{attrs:{value:"6"}},[t._v("免用發票")])])])])},function(){var t=this._self._c;return t("label",{attrs:{for:"taxType"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("稅別\r\n                                ")])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"beforePrice"}},[this._v("銷貨額")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"beforePrice",type:"text",value:"0",required:"",readonly:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"taxPrice"}},[this._v("稅額")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"taxPrice",type:"text",value:"0",required:"",readonly:""}})])])}],!1,null,null,null);e.default=o.exports},46:function(t,e){t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var r=function(t,e){var r=t[1]||"",a=t[3];if(!a)return r;if(e&&"function"==typeof btoa){var s=(n=a,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(n))))+" */"),o=a.sources.map((function(t){return"/*# sourceURL="+a.sourceRoot+t+" */"}));return[r].concat(o).concat([s]).join("\n")}var n;return[r].join("\n")}(e,t);return e[2]?"@media "+e[2]+"{"+r+"}":r})).join("")},e.i=function(t,r){"string"==typeof t&&(t=[[null,t,""]]);for(var a={},s=0;s<this.length;s++){var o=this[s][0];"number"==typeof o&&(a[o]=!0)}for(s=0;s<t.length;s++){var n=t[s];"number"==typeof n[0]&&a[n[0]]||(r&&!n[2]?n[2]=r:r&&(n[2]="("+n[2]+") and ("+r+")"),e.push(n))}},e}},47:function(t,e,r){var a,s,o={},n=(a=function(){return window&&document&&document.all&&!window.atob},function(){return void 0===s&&(s=a.apply(this,arguments)),s}),i=function(t,e){return e?e.querySelector(t):document.querySelector(t)},c=function(t){var e={};return function(t,r){if("function"==typeof t)return t();if(void 0===e[t]){var a=i.call(this,t,r);if(window.HTMLIFrameElement&&a instanceof window.HTMLIFrameElement)try{a=a.contentDocument.head}catch(t){a=null}e[t]=a}return e[t]}}(),l=null,u=0,d=[],p=r(48);function v(t,e){for(var r=0;r<t.length;r++){var a=t[r],s=o[a.id];if(s){s.refs++;for(var n=0;n<s.parts.length;n++)s.parts[n](a.parts[n]);for(;n<a.parts.length;n++)s.parts.push(g(a.parts[n],e))}else{var i=[];for(n=0;n<a.parts.length;n++)i.push(g(a.parts[n],e));o[a.id]={id:a.id,refs:1,parts:i}}}}function m(t,e){for(var r=[],a={},s=0;s<t.length;s++){var o=t[s],n=e.base?o[0]+e.base:o[0],i={css:o[1],media:o[2],sourceMap:o[3]};a[n]?a[n].parts.push(i):r.push(a[n]={id:n,parts:[i]})}return r}function f(t,e){var r=c(t.insertInto);if(!r)throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");var a=d[d.length-1];if("top"===t.insertAt)a?a.nextSibling?r.insertBefore(e,a.nextSibling):r.appendChild(e):r.insertBefore(e,r.firstChild),d.push(e);else if("bottom"===t.insertAt)r.appendChild(e);else{if("object"!=typeof t.insertAt||!t.insertAt.before)throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");var s=c(t.insertAt.before,r);r.insertBefore(e,s)}}function _(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t);var e=d.indexOf(t);e>=0&&d.splice(e,1)}function h(t){var e=document.createElement("style");if(void 0===t.attrs.type&&(t.attrs.type="text/css"),void 0===t.attrs.nonce){var a=function(){0;return r.nc}();a&&(t.attrs.nonce=a)}return y(e,t.attrs),f(t,e),e}function y(t,e){Object.keys(e).forEach((function(r){t.setAttribute(r,e[r])}))}function g(t,e){var r,a,s,o;if(e.transform&&t.css){if(!(o="function"==typeof e.transform?e.transform(t.css):e.transform.default(t.css)))return function(){};t.css=o}if(e.singleton){var n=u++;r=l||(l=h(e)),a=x.bind(null,r,n,!1),s=x.bind(null,r,n,!0)}else t.sourceMap&&"function"==typeof URL&&"function"==typeof URL.createObjectURL&&"function"==typeof URL.revokeObjectURL&&"function"==typeof Blob&&"function"==typeof btoa?(r=function(t){var e=document.createElement("link");return void 0===t.attrs.type&&(t.attrs.type="text/css"),t.attrs.rel="stylesheet",y(e,t.attrs),f(t,e),e}(e),a=P.bind(null,r,e),s=function(){_(r),r.href&&URL.revokeObjectURL(r.href)}):(r=h(e),a=w.bind(null,r),s=function(){_(r)});return a(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;a(t=e)}else s()}}t.exports=function(t,e){if("undefined"!=typeof DEBUG&&DEBUG&&"object"!=typeof document)throw new Error("The style-loader cannot be used in a non-browser environment");(e=e||{}).attrs="object"==typeof e.attrs?e.attrs:{},e.singleton||"boolean"==typeof e.singleton||(e.singleton=n()),e.insertInto||(e.insertInto="head"),e.insertAt||(e.insertAt="bottom");var r=m(t,e);return v(r,e),function(t){for(var a=[],s=0;s<r.length;s++){var n=r[s];(i=o[n.id]).refs--,a.push(i)}t&&v(m(t,e),e);for(s=0;s<a.length;s++){var i;if(0===(i=a[s]).refs){for(var c=0;c<i.parts.length;c++)i.parts[c]();delete o[i.id]}}}};var C,b=(C=[],function(t,e){return C[t]=e,C.filter(Boolean).join("\n")});function x(t,e,r,a){var s=r?"":a.css;if(t.styleSheet)t.styleSheet.cssText=b(e,s);else{var o=document.createTextNode(s),n=t.childNodes;n[e]&&t.removeChild(n[e]),n.length?t.insertBefore(o,n[e]):t.appendChild(o)}}function w(t,e){var r=e.css,a=e.media;if(a&&t.setAttribute("media",a),t.styleSheet)t.styleSheet.cssText=r;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(r))}}function P(t,e,r){var a=r.css,s=r.sourceMap,o=void 0===e.convertToAbsoluteUrls&&s;(e.convertToAbsoluteUrls||o)&&(a=p(a)),s&&(a+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(s))))+" */");var n=new Blob([a],{type:"text/css"}),i=t.href;t.href=URL.createObjectURL(n),i&&URL.revokeObjectURL(i)}},48:function(t,e){t.exports=function(t){var e="undefined"!=typeof window&&window.location;if(!e)throw new Error("fixUrls requires window.location");if(!t||"string"!=typeof t)return t;var r=e.protocol+"//"+e.host,a=r+e.pathname.replace(/\/[^\/]*$/,"/");return t.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi,(function(t,e){var s,o=e.trim().replace(/^"(.*)"$/,(function(t,e){return e})).replace(/^'(.*)'$/,(function(t,e){return e}));return/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(o)?t:(s=0===o.indexOf("//")?o:0===o.indexOf("/")?r+o:a+o.replace(/^\.\//,""),"url("+JSON.stringify(s)+")")}))}},50:function(t,e,r){var a=r(56);"string"==typeof a&&(a=[[t.i,a,""]]);var s={hmr:!0,transform:void 0,insertInto:void 0};r(47)(a,s);a.locals&&(t.exports=a.locals)},55:function(t,e,r){"use strict";r(50)},56:function(t,e,r){(t.exports=r(46)(!1)).push([t.i,".SearchHover{color:#fff3cd;background-color:#00bcd4}",""])},62:function(t,e,r){"use strict";r.r(e);var a={props:["products","details","sales_order_id"],mounted:function(){console.log("ReturnUpdateDetail.vue mounted.")},data:function(){return{current_product:[],total_price:0,current_search_type:"0",product_search_result:[]}},methods:{hoverSearchProductItem:function(t,e){e?t.target.classList.add("SearchHover"):t.target.classList.remove("SearchHover")},onChangeSearchType:function(t){this.current_search_type=t.target.value},searchProductID:function(t){var e=t.target.value;if(""!==e){var r=new RegExp(e,"i");this.product_search_result=this.products.filter((function(t){return r.test(t.shownID)}))}else this.product_search_result=[]},searchPressEnterKey:function(t){""!==t.target.value?0!==this.product_search_result.length&&this.selectSearchProduct(this.product_search_result[0].id):this.product_search_result=[]},searchProductName:function(t){var e=t.target.value;if(""!==e){var r=new RegExp(e,"i");this.product_search_result=this.products.filter((function(t){return r.test(t.name)}))}else this.product_search_result=[]},selectSearchProduct:function(t){var e=this,r=$("#getProductInfo").html();$.showLoadingModal(),$("#addDetailBtn").attr("disabled",!0),axios.post(r,{id:t}).then((function(t){$.closeModal(),e.current_product=t.data,$("#addDetailBtn").attr("disabled",!1),e.addDetail()})).catch((function(t){$.showErrorModal(t),console.error("抓取商品資料失敗，錯誤："+t)})),"0"===this.current_search_type?$("#searchProductIDInput").val("").focus():$("#searchProductNameInput").val("").focus(),this.product_search_result=[]},addDetail:function(){this.current_product?this.details.push({count:this.details.length,product:{id:this.current_product.id,shownID:this.current_product.shownID,name:this.current_product.name,internationalNum:this.current_product.internationalNum,unitPrice:this.current_product.retailPrice,qty_per_pack:this.current_product.qty_per_pack,showUnit:this.current_product.showUnit},pieces:0,quantity:0,price:this.current_product.retailPrice,discount:1,subTotal:0,comment:null}):alert("請選擇商品")},deleteDetail:function(t){this.details.splice(t,1),0!=this.details.length&&this.calculateSubtotal(1),this.calculateTotalPrice()},calculateSubtotal:function(t){var e=$("#qty_"+t).val(),r=$("#unitPrice_"+t).val(),a=$("#discount_"+t).val(),s=Math.round(r*e*a*1e4)/1e4;$("#subtotal_"+t).html(s),this.details[t-1].quantity=e,this.details[t-1].price=r,this.details[t-1].discount=a,this.details[t-1].subTotal=s,this.calculateTotalPrice()},calculateTotalPrice:function(){this.total_price=0;for(var t=1;t<=this.details.length;t++){var e=this.details[t-1].quantity,r=this.details[t-1].price,a=this.details[t-1].discount,s=Math.round(r*e*a*1e4)/1e4;this.total_price=this.total_price+s}$("#beforePrice").val(this.total_price);var o="1"==$("#taxType").val()?Math.round(.05*this.total_price*1e4)/1e4:0;$("#taxPrice").val(o),this.total_price=Math.round(1e4*(this.total_price+o))/1e4,this.$emit("show-total-price",this.total_price)},calculateQty:function(t,e){var r=$("#qty_per_pack_"+t).val();if("0"!==r&&0!==r){if("p"==e){var a=$("#pcs_"+t).val();$("#qty_"+t).val(a*r),this.details[t-1].pieces=a}else if("q"==e){var s=$("#qty_"+t).val();$("#pcs_"+t).val(s/r),this.details[t-1].pieces=s/r}}else this.details[t-1].pieces=0},updateComment:function(t){var e=$("#comment_"+t).val();this.details[t-1].comment=e},getProductData:function(){var t=this,e=$("#product_id").val();if(0!=e){var r=$("#getProductInfo").html();$.showLoadingModal(),$("#addDetailBtn").attr("disabled",!0),axios.post(r,{id:e}).then((function(e){$.closeModal(),t.current_product=e.data,$("#addDetailBtn").attr("disabled",!1)})).catch((function(t){$.showErrorModal(t),console.error("抓取商品資料失敗，錯誤："+t)}))}else alert("請選擇商品")}}},s=(r(55),r(0)),o=Object(s.a)(a,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-12"},[e("form",{attrs:{id:"SalesOrderDetailForm",method:"POST",action:"#"}},[e("input",{attrs:{type:"hidden",id:"salesOrderID",name:"salesOrder_id"},domProps:{value:t.sales_order_id}}),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-3 mb-2"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.current_search_type,expression:"current_search_type"}],staticClass:"form-control",attrs:{id:"product_search_type"},on:{change:[function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.current_search_type=e.target.multiple?r:r[0]},t.onChangeSearchType]}},[e("option",{attrs:{value:"0"}},[t._v("商品編號")]),t._v(" "),e("option",{attrs:{value:"1"}},[t._v("商品名稱")])])]),t._v(" "),"0"===t.current_search_type?e("div",{staticClass:"col-md-3 mb-2"},[e("input",{staticClass:"form-control",attrs:{id:"searchProductIDInput",type:"text",placeholder:"請輸入商品編號..."},on:{input:t.searchProductID,keydown:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:(e.preventDefault(),t.searchPressEnterKey.apply(null,arguments))}}}),t._v(" "),0!==t.product_search_result.length?e("div",{staticStyle:{border:"1px solid","border-top":"none",position:"absolute",width:"90%","z-index":"40"}},[e("ul",{staticClass:"m-0 px-0 py-2 flex flex-column",staticStyle:{"list-style":"none","background-color":"#fafafa"}},t._l(t.product_search_result,(function(r,a){return e("li",{key:a,staticClass:"px-2",staticStyle:{cursor:"pointer"},on:{mouseover:function(e){return t.hoverSearchProductItem(e,!0)},mouseleave:function(e){return t.hoverSearchProductItem(e,!1)},click:function(e){return t.selectSearchProduct(r.id)}}},[t._v("\r\n                                "+t._s(r.shownID)+"\r\n                            ")])})),0)]):t._e()]):e("div",{staticClass:"col-md-3 mb-2"},[e("input",{staticClass:"form-control",attrs:{id:"searchProductNameInput",type:"text",placeholder:"請輸入商品名稱..."},on:{input:t.searchProductName,keydown:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:(e.preventDefault(),t.searchPressEnterKey.apply(null,arguments))}}}),t._v(" "),0!==t.product_search_result.length?e("div",{staticStyle:{border:"1px solid","border-top":"none",position:"absolute",width:"90%","z-index":"40"}},[e("ul",{staticClass:"m-0 px-0 py-2 flex flex-column",staticStyle:{"list-style":"none","background-color":"#fafafa"}},t._l(t.product_search_result,(function(r,a){return e("li",{key:a,staticClass:"px-2",staticStyle:{cursor:"pointer"},on:{mouseover:function(e){return t.hoverSearchProductItem(e,!0)},mouseleave:function(e){return t.hoverSearchProductItem(e,!1)},click:function(e){return t.selectSearchProduct(r.id)}}},[t._v("\r\n                                "+t._s(r.name)+"\r\n                            ")])})),0)]):t._e()])]),t._v(" "),e("table",{staticClass:"table table-bordered",attrs:{width:"100%",cellspacing:"0"}},[t._m(0),t._v(" "),e("tbody",t._l(t.details,(function(r,a){return e("tr",{key:a},[e("td",{staticStyle:{width:"3%"}},[t._v(t._s(a+1))]),t._v(" "),e("td",{staticStyle:{width:"18%"}},[t._v("\r\n                            "+t._s(r.product.shownID)+"\r\n                            "),e("input",{attrs:{type:"hidden",name:"details["+(a+1)+"][product_id]"},domProps:{value:r.product.id}})]),t._v(" "),e("td",{staticStyle:{width:"18%"}},[t._v("\r\n                            "+t._s(r.product.name)+"\r\n                        ")]),t._v(" "),e("td",{staticStyle:{width:"23%"}},[e("input",{attrs:{type:"hidden",id:"qty_per_pack_"+(a+1)},domProps:{value:r.product.qty_per_pack}}),t._v(" "),0!==r.product.qty_per_pack?e("input",{staticClass:"form-control",staticStyle:{width:"40%",display:"inline-block"},attrs:{id:"pcs_"+(a+1),type:"text",name:"details["+(a+1)+"][pieces]"},domProps:{value:r.pieces},on:{change:function(e){t.calculateQty(a+1,"p"),t.calculateSubtotal(a+1)}}}):e("input",{staticClass:"form-control",staticStyle:{width:"40%",display:"inline-block"},attrs:{disabled:"",id:"pcs_"+(a+1),type:"text",name:"details["+(a+1)+"][pieces]"},domProps:{value:r.pieces},on:{change:function(e){t.calculateQty(a+1,"p"),t.calculateSubtotal(a+1)}}}),t._v(" "),e("span",{staticClass:"mr-2"},[t._v("件")]),t._v(" "),e("input",{staticClass:"form-control",staticStyle:{width:"40%",display:"inline-block"},attrs:{id:"qty_"+(a+1),type:"text",name:"details["+(a+1)+"][quantity]"},domProps:{value:r.quantity},on:{change:function(e){t.calculateQty(a+1,"q"),t.calculateSubtotal(a+1)}}}),t._v(" "),e("span",[t._v(t._s(r.product.showUnit))])]),t._v(" "),e("td",{staticStyle:{width:"9%"}},[e("input",{staticClass:"form-control",attrs:{id:"unitPrice_"+(a+1),type:"text",name:"details["+(a+1)+"][price]"},domProps:{value:r.price},on:{change:function(e){return t.calculateSubtotal(a+1)}}})]),t._v(" "),e("td",{staticStyle:{width:"7%"}},[e("input",{staticClass:"form-control",attrs:{id:"discount_"+(a+1),type:"text",name:"details["+(a+1)+"][discount]"},domProps:{value:r.discount},on:{change:function(e){return t.calculateSubtotal(a+1)}}})]),t._v(" "),e("td",{staticStyle:{width:"10%"}},[e("input",{staticClass:"form-control",attrs:{id:"subtotal_"+(a+1),type:"text",disabled:""},domProps:{value:r.subTotal}})]),t._v(" "),e("td",{staticStyle:{width:"10%"}},[e("input",{staticClass:"form-control",attrs:{id:"comment_"+(a+1),type:"text",name:"details["+(a+1)+"][comment]"},domProps:{value:r.comment},on:{change:function(e){return t.updateComment(a+1)}}})]),t._v(" "),e("td",{staticStyle:{width:"5%"}},[e("button",{staticClass:"btn btn-md btn-danger",attrs:{type:"button"},on:{click:function(e){return t.deleteDetail(a)}}},[e("i",{staticClass:"far fa-trash-alt"})])])])})),0)])])])])}),[function(){var t=this,e=t._self._c;return e("thead",[e("tr",[e("th",[t._v("編號")]),t._v(" "),e("th",[t._v("商品編號")]),t._v(" "),e("th",[t._v("商品名稱")]),t._v(" "),e("th",[t._v("數量")]),t._v(" "),e("th",[t._v("單價")]),t._v(" "),e("th",[t._v("折數")]),t._v(" "),e("th",[t._v("小計")]),t._v(" "),e("th",[t._v("備註")]),t._v(" "),e("th",[t._v("操作")])])])}],!1,null,null,null);e.default=o.exports}});